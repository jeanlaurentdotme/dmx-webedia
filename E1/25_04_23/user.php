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
    session_start();
    if (!isset($_SESSION['login'])){header('Location: index.php');
        exit();}
    $pseudo = $_SESSION['login'];
    ?>
    <header><?php echo $pseudo?></header>
        <div height="1800px" width="100%">
            <div>
                <table class="menu">
                    <tr id ="img">
                        <td>
                            <img class="avatar" src="images/logo.jpg" alt="Logo de user">
                        </td>
                    </tr>
                    <tr>
                        <td><a href="basedescenes.php">Personnalisation de l'interface</a></td>
                    </tr>
                    <tr>
                        <td><a href="deconnexion.php">Changer de compte</a></td>
                    </tr>
                </table>
                </div>
            </div>
            <div>
                <table class="divclassiques">
                    <tr>
                        <td>Scène 1</td>
                        <td>Scène 2</td>
                        <td>Scène 3</td>
                        <td>Scène 4</td>
                        <td>Scène 5</td>
                    </tr>
                    <tr>
                        <td>Scène 6</td>
                        <td>Scène 7</td>
                        <td>Scène 8</td>
                        <td>Scène 9</td>
                        <td>Scène 10</td>
                    </tr>
                    <tr>
                        <td>Scène 11</td>
                        <td>Scène 12</td>
                        <td>Scène 13</td>
                        <td>Scène 14</td>
                        <td>Scène 15</td>
                    </tr>
                    <tr>
                        <td>Scène 16</td>
                        <td>Scène 17</td>
                        <td>Scène 18</td>
                        <td>Scène 19</td>
                        <td>Scène 20</td>
                    </tr>
                </table>
            </div>
        </div>
</body>
</html>