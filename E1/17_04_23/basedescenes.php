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
    <script>
    function allowDrop(ev)
    {
        ev.preventDefault();
    }
    
    function drag(ev)
    {
        ev.dataTransfer.setData("text", ev.target.id);
    }
    
    function drop(ev)
    {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
    </script>
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
                <table class="base">
                    <tr>
                        <td colspan="5">
                            <img class="avatar" src="images/logo.jpg" alt="Logo de user">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="oui"><a href="user.php">Retour à l'interface</a><a href="deconnexion.php">Enregistrer les modifications</a></td>

                    </tr>
                    <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="images/scene_1.png" draggable="true" ondragstart="drag(event)" id="drag1" object-fit="fill" width="100" height="100"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="images/scene_2.png" draggable="true" ondragstart="drag(event)" id="drag2" object-fit="fill" width="100" height="100"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="images/scene_3.png" draggable="true" ondragstart="drag(event)" id="drag3" object-fit="fill" width="100" height="100"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                </table>
                </div>
            </div>
            <div>
                <table class="scenes">
                    <tr>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                </table>
            </div>
        </div>
</body>
</html>