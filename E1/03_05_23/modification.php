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
    $sql = 'SELECT * FROM SceneTest';
    $resultat = $connect->query($sql);
    ?>
    <header>Sélectionnez une scène à modifier</header>
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
        <div id="divConteneur">
            <!-- tableau contenant la liste de toutes les scènes présentes dans la BDD, ces scènes sont modifiables en cliquant sur leur nom -->
            <table class="scene">
                <tr>
                    <?php
                    $nbscene = 0;
                    while ($data = $resultat->fetch_assoc())
                    {
                        // le tableau doit être composé de 5 colonnes
                        if ($nbscene % 5 == 0 and $nbscene != 0)
                        {
                            ?>
                            </tr>
                            <tr>
                            <?php
                        }
                        ?>
                        <!-- cellule contenant une scène -->
                        <td class="tabscene" bgcolor="<?php echo $data['couleurscene'] ?>" id="<?php echo $data['id'] ?>"><a href="modifscene.php?id=<?php echo $data['id'] ?>&nom=<?php echo $data['nom'] ?>"><?php echo $data['nom'] ?></a></td>
                        <?php
                        $nbscene++;
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>