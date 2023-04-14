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
    ?>
    <header>Sélectionnez une scène à supprimer</header>
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
            <div>
                <table class="scene">
                    <tr>
                    <?php while($data = $resultat->fetch_assoc())
                    {
                        ?>
                        <td bgcolor="<?php echo $data['couleurscene']?>"><?php echo $data['nom']?></td>
                    <?php
                    } ?>
                    </tr>
                </table>
            </div>
        </div>
</body>
</html>