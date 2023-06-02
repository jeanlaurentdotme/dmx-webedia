<?php

   function hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
   {
      $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
      $rgbArray = array();
      $colorVal = hexdec($hexStr);
      $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
      $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
      $rgbArray['blue'] = 0xFF & $colorVal;
      return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
   }
// fichier comportant les infos de connexion à la BDD
include ("connect.php");

// si aucun utilisateur n'est connecté -> renvoi à la page index
session_start();
if (!isset($_SESSION['login']))
{
   header('Location: index.php');
   exit();
}

// on vérifie que l'utilisateur a correctement envoyé le formulaire
if (isset($_POST['enregistrer']) && $_POST['enregistrer'] == 'Enregistrer') 
{
   // on teste l'existence des variables et on vérifie qu'elle ne sont pas vides
   if ((isset($_POST['nom']) && !empty($_POST['nom'])))
   {
      // connexion à la BDD
      $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
      if (!$connexion)
      {
         echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
         exit();
      }
      mysqli_select_db ($connexion, BDD);
      print "Connexion BDD reussie puis";
      echo "<br/>";
      
      $equipData = getInstantiatedEquipments($connexion);


      // on ajoute la nouvelle scène dans la BDD
      $sql = 'INSERT INTO SceneTest(id, name, couleurscene) VALUES(0,"'.mysqli_escape_string($connexion, $_POST['nom']).'","'.mysqli_escape_string($connexion, $_POST['background']).'")';
      mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));

      $last_id = mysqli_insert_id($connexion);
      $nb = $_POST['compteur'];
      for ($i=0; $i<$nb;$i++){
         $j = $i + 1;
         $canr = 3*$i + 1;
         $cang = 8*$i + 2;
         $canb = 8*$i + 3;
         $couleur = $_POST['L'.$j];
         $r = substr($couleur, 1, 2);
         $red = hexdec($r);
         $g = substr($couleur, 3, 2);
         $green = hexdec($g);
         $b = substr($couleur, 5, 2);
         $blue = hexdec($b);
         $sql = 'INSERT INTO CanalValue(idInstanceEquip, idCanalEquip, idScene, value) VALUES('.$j.','.$canr.','.$last_id.', '.$red.'), ('.$j.','.$cang.','.$last_id.', '.$green.'), ('.$j.','.$canb.','.$last_id.', '.$blue.')';
         mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
      }


      header('Location: admin.php');

   }
}
   // si au moins un des champs est vide
   else
   {
      $erreur = "Echec de l'insertion !<br/>Veuillez mettre un nom à la scene !";
      echo $erreur; 
      echo"<br/><a href='ajout.php'>Ajout de scene</a>";
      exit();
   }



?>