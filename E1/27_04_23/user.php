<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Gestion de scènes</title>
    <link rel='stylesheet' href='css/main.css'/>
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
    //$pseudo = mysqli_query($connexion, 'SELECT login FROM User WHERE login="'.$_SESSION['login'].'"')
    $pseudo = $_SESSION['login'];
    $iduser = $_SESSION['id'];
    $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
    if (!$connexion)
    {
       echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
       exit();
    }
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
                    <?php                    
                    $oui = new mysqli(SERVEUR, LOGIN, MDP, BDD);
                    // on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
                    $sql = 'SELECT positionTableau, idScene FROM SceneParUserTest WHERE idUser='.$iduser.';';
                    $req = $oui->query($sql);
                    $nbscene = 0;
                    $postab = array();
                    $idscene = array();
                    while ($resultat = $req->fetch_assoc())
                    {
                        array_push($postab, $resultat['positionTableau']);
                        array_push($idscene, $resultat['idScene']);
                    }
                    $postab_length = count($postab);
                    for ($i=1; $i<21; $i++)
                    {
                        $result = 0;
                        if($nbscene%5==0 AND $nbscene!=0)
                        {	
                            ?>
                            </tr>
			                <tr>
                            <?php
                        }
		                for($j=0; $j<$postab_length;$j++)
			            {
                            if ($i==$postab[$j])
                                {
                                    $sqlscene = 'SELECT * FROM SceneTest WHERE id='.$idscene[$j].';';
                                    $reqscene = $oui->query($sqlscene);
                                    while ($listescene = $reqscene->fetch_assoc())
                                    {
                                        ?>
                                        <td>
                                            <div class ="div3" style=background-color:<?php echo $listescene['couleurscene']?> id="<?php echo $idscene[$j]?>">Scène <?php echo $listescene['nom']?></div>
                                        </td>
                                        <?php
                                    }
                                    $result = 1;
                                }
                        }	
                        if ($result == 0)
                        {
                            ?>
                            <td id="<?php echo $i?>">Aucune scène</td>
                            <?php
                        }
                        $result = 0;
                        $nbscene++;
                    } 
                    ?>
                </tr>
            </table>
        </div>
</body>
</html>