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
  <img src="images/webedia_banner.png" alt="Bannière de Webedia">
  <!-- formulaire permettant de se connecter -->
  <header class="center">Connexion à votre compte :</header><br />
  <form action="connexion.php" method="post" class="center">
    <label for="login">Login</label><br />
    <input type="text" id="login" name="login" value=""><br />

    <label for="pwd">Mot de passe</label><br />
    <input type="password" id="pwd" name="pwd" value=""><br />
    <input class="bouton" type="submit" name="connexion" value="Connexion">
    <!-- bouton permettant de s'inscrire -->
    <button><a class="bouton" href="inscription.php">S'inscrire</a></button>
  </form>

</body>

</html>