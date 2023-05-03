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
  <!-- formulaire permettant de se connecter -->
  <p>Connexion à votre compte :</p>
  <form action="connexion.php" method="post">
    login : <input type="text" name="login" value="">
    mot de passe : <input type="password" name="pwd" value="">
    <input type="submit" name="connexion" value="Connexion">
  </form>
  <!-- lien permettant de s'inscrire -->
  <a href="inscription.php">S'inscrire</a>
</body>

</html>