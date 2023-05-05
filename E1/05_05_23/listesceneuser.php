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

// récupération de l'id de l'utilisateur et du nombre de scènes à enregistrer transmis par le code JS
$iduser = $_POST['iduser'];
$nbscene = $_POST['nbscene'];

// récupération du login de l'utilisateur
$pseudo = $_SESSION['login'];

// on enregistre les scènes ainsi que leur position dans deux tableaux
$postab = array();
$idscene = array();
for ($i=0; $i<$nbscene;$i++)
{
    array_push($postab, $_POST['postab'.$i]);
    array_push($idscene, $_POST['idscene'.$i]);
}

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

// on supprime les précédents enregistrements de la BDD correspondant à l'utilisateur connecté
$sql = "DELETE FROM SceneParUserTest WHERE idUser=".$iduser.";";
mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));

// on enregistre dans la BDD les scènes et leur position envoyés par le code JS
for ($i=0; $i<$nbscene;$i++)
{
    $add = "INSERT INTO SceneParUserTest (idUser, idScene, positionTableau) VALUES (".$iduser.", ".$idscene[$i].", ".$postab[$i].");";
    mysqli_query($connexion, $add) or die('Erreur SQL !'.$add.'<br />'.mysqli_error($connexion));
}
?>