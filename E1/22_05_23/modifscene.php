<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Gestion de scènes</title>
    <link rel='stylesheet' href='css/main.css' /> 
    <link rel="icon" type="image/png" href="images/webedia.jpg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Konkhmer+Sleokchher&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // fichier comportant les infos de connexion à la BDD
    include("connect.php");

    // si aucun utilisateur n'est connecté -> renvoi à la page index
    session_start();
    if (!isset($_SESSION['login']))
    {
        header('Location: index.php');
        exit();
    }

    // récupération du login et de l'id de l'utilisateur
    $pseudo = $_SESSION['login'];
    $iduser = $_SESSION['id'];

    // connexion à la BDD
    $connexion = mysqli_connect(SERVEUR, LOGIN, MDP);
    if (!$connexion)
    {
        echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
        exit();
    }

    // on récupère la liste des scènes déjà enregistrées dans la BDD
    $connect = new mysqli(SERVEUR, LOGIN, MDP, BDD);
    $sql = 'SELECT * FROM Scene';
    $resultat = $connect->query($sql);

    // on récupère le nom et l'ID de la scène à modifier
    $idscene = $_GET['id'];
    $nom = $_GET['name'];

    ?>
    <header>Modifiez la scène <?php echo $nom ?></header>
    <div height="1800px" width="100%">
        <!-- menu avec tous les choix possibles -->
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
            <!-- formulaire permettant de modifier une scène -->
            <form action="modifbdd.php" method="post">
                Nom de la scène <input type="text" name="nom" value="<?php echo $nom ?>"><br />
                <br />
                Couleur de l'arrière plan <input type="color" name="background" value=""><br />
                <br />
                Couleur de la 1ère lumière <input type="color" name="L1" value="">
                Couleur de la 2ème lumière <input type="color" name="L2" value="">
                Couleur de la 3ème lumière <input type="color" name="L3" value="">
                <br />
                <br />
                <input type="hidden" name="id" value="<?php echo $idscene ?>">
                <input class="bouton" type="submit" name="enregistrer" value="Enregistrer">
            </form>
        </div>
    </div>
</body>

</html>