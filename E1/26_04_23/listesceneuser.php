<?php
$iduser = $_POST['iduser'];
$nbscene = $_POST['nbscene'];
$postab = array();
$idscene = array();
for ($i=0; $i<$nbscene;$i++)
{
    $postab[$i]=$_POST["postab"][$i];
    $idscene[$i]=$_POST["idscene"][$i];
}
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
    $sql = "DELETE FROM SceneParUserTest WHERE idUser=".$iduser.";";
    mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
    for ($i=0; $i<$nbscene; $i++)
    {
        $sql = "INSERT INTO SceneParUserTest (idUser, idScene, positionTableau) VALUES ($iduser, ".$idscene[$i].", ".$postab[$i].";";
        mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
    }
    $erreur = 'insertion reussie !';
    echo $erreur;
    //echo"<br/><a href='admin.php'>Retour à la page admin</a>";
    //exit();
?>