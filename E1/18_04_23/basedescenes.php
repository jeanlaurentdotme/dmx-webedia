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
    <header><?php echo $pseudo?></header>
        <div height="1800px" width="100%">
            <div id="divConteneur1">
                <table class="base">
                    <tr>
                        <td colspan="5">
                            <img class="avatar" src="images/logo.jpg" alt="Logo de user">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="oui"><a href="user.php">Retour à l'interface</a><a href="deconnexion.php">Enregistrer les modifications</a></td>

                    </tr>
                    <tr class="div2">
                    <?php 
                    $nbscene = 0;
                    while($data = $resultat->fetch_assoc())
                    {
                        if($nbscene%5==0 AND $nbscene!=0)
                        {
                            ?>
                            </tr>
                            <tr class="div2">
                            <td class ="div2" bgcolor="<?php echo $data['couleurscene']?>" id="<?php echo $data['id']?>" ondrop="drop(event)" ondragover="allowDrop(event)"><a href="modifscene.php?id=<?php echo $data['id']?>&nom=<?php echo $data['nom']?>"><?php echo $data['nom']?></a></td>
                            <?php
                        }
                        else
                        {
                        ?>
                        <td class="div2" bgcolor="<?php echo $data['couleurscene']?>" id="<?php echo $data['id']?>" ondrop="drop(event)" ondragover="allowDrop(event)"><a href="modifscene.php?id=<?php echo $data['id']?>&nom=<?php echo $data['nom']?>"><?php echo $data['nom']?></a></td>
                        <?php
                        }
                    $nbscene++;
                    } ?>
                    </tr>
                </table>
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
        </div>
</body>
</html>