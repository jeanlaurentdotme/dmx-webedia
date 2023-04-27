<?php
//on inclue le fichier qui contient nom_de_serveur, nom_bdd, login et password d'accès à la bdd mysql
include ("connect.php");
session_start();
if (!isset($_SESSION['login']))
{
    header('Location: index.php');
    exit();
}
$connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
if (!$connexion)
{
    echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
    exit();
}
mysqli_select_db ($connexion, BDD);
print "Connexion BDD reussie puis";echo "<br/>"; 
// on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
$sql = 'SELECT count(*) FROM SceneTest WHERE nom="'.mysqli_escape_string($connexion, $_POST['nom']).'"';
$req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
$data = mysqli_fetch_array($req);
//si aucun autre login identique existe, on inscrit ce nouveau login
$lien = $_GET['id'];
$sql = "DELETE FROM SceneTest WHERE id=".$lien.";";
mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
$erreur = 'suppression reussie !';
echo $erreur;
//echo"<br/><a href='admin.php'>Retour à la page admin</a>";
//exit();
header('Location: suppression.php');
?>