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

      // on ajoute la nouvelle scène dans la BDD
      $sql = 'INSERT INTO Scene(id, name, couleurscene, L1, L2, L3) VALUES(0,"'.mysqli_escape_string($connexion, $_POST['nom']).'","'.mysqli_escape_string($connexion, $_POST['background']).'","'.mysqli_escape_string($connexion, $_POST['L1']).'","'.mysqli_escape_string($connexion, $_POST['L2']).'","'.mysqli_escape_string($connexion, $_POST['L3']).'")';
      mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
      $erreur = 'insertion reussie !';
      echo $erreur;
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