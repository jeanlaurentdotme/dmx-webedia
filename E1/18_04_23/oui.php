<?php
    include ("connect.php");
    session_start();
    if (!isset($_SESSION['login'])){header('Location: index.php');
        exit();}
    $pseudo = $_SESSION['login'];
    $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
    if (!$connexion)
    {
       echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
       exit();
    }
    $oui = new mysqli(SERVEUR, LOGIN, MDP, BDD);
    // on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
    $sql = 'SELECT * FROM SceneTest';
    $resultat = $oui->query($sql);
    while($data = $resultat->fetch_assoc())
        {
            echo $data['nom'];
        }
    ?>