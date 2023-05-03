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
<img src="images/webedia_banner.png" alt="Logo de user">
  <!-- formulaire permettant de s'inscrire -->
  <header class="center">Inscription à l'espace membre :</header><br />
  <form action="verifinscription.php" method="post" class="center">
    <label for="login">Pseudo</label><br />
    <input type="text" id="login" name="login" value=""><br />

    <label for="pwd1">Mot de passe</label><br />
    <input type="password" id="pwd1" name="mdp1" value=""><br />

    <label for="pwd2">Confirmation du mot de passe</label><br />
    <input type="password" id="pwd2" name="mdp2" value=""><br />
    <input type="submit" name="inscription" value="Inscription">
  </form>
</body>

</html>