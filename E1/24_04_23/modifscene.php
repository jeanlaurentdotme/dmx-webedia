<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Gestion de scènes</title>
    <link rel='stylesheet' href='css/test.css'/>
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
    $lien = $_GET['id'];
    $nom = $_GET['nom'];
    ?>
    <header>Modifiez la scène <?php echo $nom ?></header>
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
                        <td><a href="index.php">Changer de compte</a></td>
                    </tr>
                </table>
            </div>
            <div class="divclassiques">
                <form action="modifbdd.php" method="post">
                Nom de la scène <input type="text" name="nom" value="<?php echo $nom ?>"><br />
                Couleur de l'arrière plan <input type="color" name="background" value=""><br />
                Couleur de la 1ère lumière <input type="color" name="L1" value="">
                Couleur de la 2ème lumière <input type="color" name="L2" value="">
                Couleur de la 3ème lumière <input type="color" name="L3" value="">
                <input type="hidden" name="id" value = "<?php echo $lien ?>">
                <input type="submit" name="enregistrer" value="Enregistrer">
                </form>
            </div>
        </div>
</body>
</html>