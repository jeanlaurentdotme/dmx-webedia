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
      $idscene = $_POST['id'];
      // on parcourt la BDD et on range la scène à modifier dans un tableau
      $sql = 'SELECT count(*) FROM Scene WHERE id="'.mysqli_escape_string($connexion, $idscene).'"';
      $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
      $data = mysqli_fetch_array($req);
      // on modifie la scène avec les infos rentrées dans le formulaire
      $sql = "UPDATE Scene SET name='".mysqli_escape_string($connexion, $_POST['nom'])."', couleurscene='".mysqli_escape_string($connexion, $_POST['background'])."', L1='".mysqli_escape_string($connexion, $_POST['L1'])."', L2='".mysqli_escape_string($connexion, $_POST['L2'])."', L3='".mysqli_escape_string($connexion, $_POST['L3'])."' WHERE id=".$idscene.";";
      mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
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
?>