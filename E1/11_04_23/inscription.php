<html>
<head>
    <meta charset='utf-8'>
    <title>Inscription</title>
    <link rel='stylesheet' href='css/test.css'/>
  <!---
    <script src='main.js'></script>
  -->
  <link rel="icon" type="image/png" href="images/icone.png"/>
</head>
<body>
    Inscription à l'espace membre :<br/>
    <form action="verifinscription.php" method="post">
        pseudo<input type="text" name="login" value=""><br />
        mot de passe<input type="password" name="mdp1" value=""><br />
        confirmation mdp<input type="password" name="mdp2" value=""><br />
        <input type="submit" name="inscription" value="Inscription">
    </form>
</body>
</html>