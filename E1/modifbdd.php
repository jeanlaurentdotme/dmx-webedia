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
      $idscene = $_POST['id'];
      // on modifie la scène avec les infos rentrées dans le formulaire
      $sql = "UPDATE Scene SET name='".mysqli_escape_string($connexion, $_POST['nom'])."', couleurscene='".mysqli_escape_string($connexion, $_POST['background'])."' WHERE id=".$idscene.";";
      mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
      
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

      // on parcourt la BDD et on range la scène à modifier dans un tableau
      $sql = 'UPDATE CanalValue SET value ="'.$red.'" WHERE idInstanceEquip ='.$keys[$i].' AND idCanalEquip='.$idcanal1.' AND idScene = '.$idscene.';';
      $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
      $sql = 'UPDATE CanalValue SET value ="'.$green.'" WHERE idInstanceEquip ='.$keys[$i].' AND idCanalEquip='.$idcanal2.' AND idScene = '.$idscene.';';
      $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
      $sql = 'UPDATE CanalValue SET value ="'.$blue.'" WHERE idInstanceEquip ='.$keys[$i].' AND idCanalEquip='.$idcanal3.' AND idScene = '.$idscene.';';
      $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
      $data = mysqli_fetch_array($req);
      $erreur = 'modification reussie !';
      echo $erreur;
      header('Location: modification.php');
   }
}
   // si aucun nom de scène n'est rentré
   else
   {
      $erreur = "Echec de l'insertion !<br/>Veuillez mettre un nom à la scene !";
      echo $erreur; 
      echo"<br/><a href='modification.php'>Modifier une scène</a>";
      exit();
   }
}
?>