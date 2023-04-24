<?php
header('Content-type: text/html; charset=iso-8859-1'); 
$iduser = $_SESSION['id'];
$pseudo = $_SESSION['login'];
//on inclue le fichier qui contient nom_de_serveur, nom_bdd, login et password d'accès à la bdd mysql
include ("connect.php");
    $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
    if (!$connexion)
    {
        echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
        exit();
    }
    mysqli_select_db ($connexion, BDD); print "Connexion BDD reussie puis";echo "<br/>";
    $sql = "INSERT INTO SceneParUserTest (idUser, idScene, positionTableau) VALUES ($iduser, ".$_POST['idscene'].", ".$_POST['postab'].";";
    mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
    $erreur = 'insertion reussie !';
    echo $erreur;
    //echo"<br/><a href='admin.php'>Retour à la page admin</a>";
    //exit();
?>