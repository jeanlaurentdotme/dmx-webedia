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
                        $sqlpostab = 'SELECT posiTionTableau FROM SceneParUserTest WHERE idUser='.$iduser.';';
                        $sqlidscene = 'SELECT idScene FROM SceneParUserTest WHERE idUser='.$iduser.';';
                        $reqpostab = $oui->query($sqlpostab);
                        $reqidscene = $oui->query($sqlidscene);
                        $postab = $reqpostab->fetch_array();
                        $idscene = $reqidscene->fetch_array();
                        $postab_length = count($postab);
                        $nbscene = 0;
                            for ($i=1; $i<21; $i++)
                            {
                                $result = 0;
                                if($nbscene%5==0 AND $nbscene!=0)
                                {	
                                    ?>
                                    </tr>
			                        <tr class="div3">
                                    <?php
                                }
			                    for($j=0; $j<$postab_length;$j++)
			                    {
                                        if ($i==$postab[$j])
                                        {
                                            ?>
                                            <td><div class ="div3" id="<?php echo $idscene[$j]?>">Scène<?php echo $idscene[$j]?></div></td>
                                            <?php
                                            $result = 1;
                                        }
                                    }	
                                    
                                
                                if ($result == 0)
                                {
                                    ?> <td id="<?php echo $i?>">Aucune scène</td> <?php
                                }
                                $result = 0;
                                $nbscene++;
                            } 
                        ?>
                    </tr>
                </table>
            </div>
        </div>
</body>
</html>