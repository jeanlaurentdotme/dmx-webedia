<?php
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

      $keys = array_keys($equipData);
      // on ajoute la nouvelle scène dans la BDD
      $sql = 'INSERT INTO Scene(id, name, couleurscene) VALUES(0,"'.mysqli_escape_string($connexion, $_POST['nom']).'","'.mysqli_escape_string($connexion, $_POST['background']).'")';
      mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
      $last_id = mysqli_insert_id($connexion);

      for ($i = 0; $i<sizeof($keys); $i++)
      {
         $couleur = $_POST['L'.($i +1)];
         $r = substr($couleur, 1, 2);
         $red = hexdec($r);
         $g = substr($couleur, 3, 2);
         $green = hexdec($g);
         $b = substr($couleur, 5, 2);
         $blue = hexdec($b);
         $idcanal1 = $equipData[$keys[$i]]['data'][0]['idCanal'];
         $idcanal2 = $equipData[$keys[$i]]['data'][1]['idCanal'];
         $idcanal3 = $equipData[$keys[$i]]['data'][2]['idCanal'];

         //echo(json_encode($equipData));

         $sql = 'INSERT INTO CanalValue(idInstanceEquip, idCanalEquip, idScene, value) VALUES('.$keys[$i].', '.$idcanal1.', '.$last_id.', '.$red.'), ('.$keys[$i].', '.$idcanal2.', '.$last_id.', '.$green.'), ('.$keys[$i].', '.$idcanal3.', '.$last_id.', '.$blue.')';
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