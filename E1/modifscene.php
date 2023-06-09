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
    <?php
    // fichier comportant les infos de connexion à la BDD
    include("connect.php");

    // si aucun utilisateur n'est connecté -> renvoi à la page index
    session_start();
    if (!isset($_SESSION['login']))
    {
        header('Location: index.php');
        exit();
    }

    // récupération du login et de l'id de l'utilisateur
    $pseudo = $_SESSION['login'];
    $iduser = $_SESSION['id'];

      // connexion à la BDD
      $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
      if (!$connexion)
      {
         echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
         exit();
      }
      mysqli_select_db ($connexion, BDD);
    
    
    // on récupère le nom et l'ID de la scène à modifier
    $idscene = $_GET['id'];
    $nom = $_GET['name'];
    

    $equipData = getInstantiatedEquipments($connexion);
    $keys = array_keys($equipData);

    $sql = 'SELECT value FROM CanalValue WHERE idScene='.$idscene.';';
    $req = mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
    $canal = array();
    while($canalv = $req->fetch_assoc())
    {
        array_push($canal, $canalv['value']);
    }
    
    //echo(json_encode($canal));
    $sql = 'SELECT couleurscene FROM Scene WHERE id='.$idscene.';';
    $req = mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
    $data = mysqli_fetch_array($req);

    // on récupère les infos de la scène à modifier
    $back = $data['couleurscene'];
    
    ?>
    <header>Modifiez la scène <?php echo $nom ?></header>
    <div height="1800px" width="100%">
        <!-- menu avec tous les choix possibles -->
        <div>
            <table class="menu">
                <tr>
                    <td><a href="admin.php">Interface</a></td>
                </tr>
                <tr>
                    <td><a href="basedescenesadmin.php">Personnalisation de l'interface</a></td>
                </tr>
                <tr>
                    <td><a href="ajout.php">Ajouter une scène</a></td>
                </tr>
                <tr>
                    <td><a href="modification.php">Modifier une scène</a></td>
                </tr>
                <tr>
                    <td><a href="suppression.php">Supprimer une scène</a></td>
                </tr>
                <tr>
                    <td><a href="deconnexion.php">Changer de compte</a></td>
                </tr>
            </table>
        </div>
        <div class="divclassiques">
            <!-- formulaire permettant de modifier une scène -->
            <form action="modifbdd.php" method="post">
                Nom de la scène <input type="text" name="nom" value="<?php echo $nom ?>"><br />
                <br />
                Couleur de l'arrière plan <input type="color" name="background" value="<?php echo $back ?>"><br />
                <div id="divParent">
                    
                    <?php
                $keys = array_keys($equipData);
                $keys1 = array_keys($canal);
                for($i = 0; $i < sizeof($keys); $i++)
                {
                    $r = $canal[3*$i];
                    $red = strval(dechex($r));
                    if (strlen($red) == 1)
                    {
                        $red = '0'.$red;
                    }
                    $g = $canal[3*$i+1];
                    $green = strval(dechex($g));
                    if (strlen($green) == 1)
                    {
                        $green = '0'.$green;
                    }
                    $b = $canal[3*$i+2];
                    $blue = strval(dechex($b));
                    if (strlen($blue) == 1)
                    {
                        $blue = '0'.$blue;
                    }
                    $couleur = '#';
                    $couleur .= $red;
                    $couleur .= $green;
                    $couleur .= $blue;
                    echo("<div id='divChild".($i+1)."'>");
                    echo("<label for=\"Lumière ".($i+1)."\"> Couleur de la lumière ".($i +1)." (".$equipData[$keys[$i]]['data'][0]['equipementName'].")</label>
                    <input type=\"color\" name=\"L".$keys[$i]."\" id=\"".$keys[$i]."\" value=\"".$couleur."\">");
                    echo("</div>");
                }                
                ?>
                </div>
                <input type="hidden" name="id" value="<?php echo $idscene ?>">
                <br />
                <input class="bouton" type="submit" name="enregistrer" value="Enregistrer">
            </form>
        </div>
    </div>
</body>

</html>