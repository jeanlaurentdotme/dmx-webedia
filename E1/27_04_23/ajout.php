<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Gestion de scènes</title>
    <link rel='stylesheet' href='css/main.css'/>
  <!---
    <script src='main.js'></script>
  -->
  <link rel="icon" type="image/png" href="images/icone.png"/>
</head>
<body>
<?php
    include ("connect.php");
    session_start();
    if (!isset($_SESSION['login'])){header('Location: index.php');
        exit();}
    $pseudo = $_SESSION['login'];
    $iduser = $_SESSION['id'];
    $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
    if (!$connexion)
    {
       echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
       exit();
    }
    ?>
    <header>Créez une nouvelle scène</header>
        <div height="1800px" width="100%">
            <div>
                <table class="menu">
                    <tr>
                        <td><a href="admin.php">Interface</a></td>
                    </tr>
                    <tr>
                        <td><a href="basedescenesadmin.php">Personnalisation de l'interface</a></td>
                    </tr>
                    <tr>
                        <td><a href="ajout.php">Ajouter une scène</a></td>
                    </tr>
                    <tr>
                        <td><a href="modification.php">Modifier une scène</a></td>
                    </tr>
                    <tr>
                        <td><a href="suppression.php">Supprimer une scène</a></td>
                    </tr>
                    <tr>
                        <td><a href="deconnexion.php">Changer de compte</a></td>
                    </tr>
                </table>
            </div>
            <div class="divclassiques">
                <form action="ajoutbdd.php" method="post">
                Nom de la scène <input type="text" name="nom" value=""><br />
                Couleur de l'arrière plan <input type="color" name="background" value=""><br />
                Couleur de la 1ère lumière <input type="color" name="L1" value="">
                Couleur de la 2ème lumière <input type="color" name="L2" value="">
                Couleur de la 3ème lumière <input type="color" name="L3" value="">
                <input type="submit" name="enregistrer" value="Enregistrer">
                </form>
            </div>
        </div>
</body>
</html>