<?php
// page PHP reliée au code JS appelé par la fonction XMLHttpRequest

// fichier comportant les infos de connexion à la BDD
include ("connect.php");

// si aucun utilisateur n'est connecté -> renvoi à la page index
session_start();
if (!isset($_SESSION['login']))
{
    header('Location: index.php');
    exit();
}

// récupération de l'id de la scène à supprimer transmis par le code JS
$idscene = $_POST['id'];

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

// on parcourt la BDD et on range la scène à supprimer dans un tableau
$sql = 'SELECT count(*) FROM Scene WHERE id="'.mysqli_escape_string($connexion, $idscene).'"';
$req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
$data = mysqli_fetch_array($req);

// on supprime la scène choisie de la BDD
$sql = "DELETE FROM SceneParUser WHERE idScene=".$idscene.";";
mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
$sql = "DELETE FROM Scene WHERE id=".$idscene.";";
mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
$erreur = 'suppression reussie !';
echo $erreur;
header('Location: suppression.php');
?>