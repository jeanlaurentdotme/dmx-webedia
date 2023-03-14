<?php
session_start();
if (!isset($_SESSION['login'])){header('Location: index.php');
    exit();}
?>
<html>
<head>
    <meta charset='utf-8'>
    <title>Espace membre</title>
    <link rel='stylesheet' href='css/main.css'/>
  <!---
    <script src='main.js'></script>
  -->
  <link rel="icon" type="image/png" href="images/icone.png"/>
</head>
<body>
  <?php
    $pseudo = mysqli_query($connexion, 'SELECT nom FROM User WHERE login="'.$_SESSION['login'].'"')
  ?>
    <p><strong>ESPACE MEMBRES</strong><br />
    Bienvenue <?php echo $pseudo?> !<br/>
    <a href="deconnexion.php">Déconnexion</a>
    </p>
</body>
</html>