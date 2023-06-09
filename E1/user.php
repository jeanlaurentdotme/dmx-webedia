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
    <script>
        const envoiscene = new WebSocket("ws://198.168.65.44:3000");
        function envoi(id)
        {
            envoiscene.send(id);
        }
    </script>
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
    $connexion = mysqli_connect(SERVEUR, LOGIN, MDP);
    if (!$connexion)
    {
        echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
        exit();
    }
    ?>

    <!-- affiche le nom de l'utilisateur -->
    <header><?php echo $pseudo ?></header>

    <div height="1800px" width="100%">
        <!-- menu avec tous les choix possibles -->
        <div>
            <table class="menu">
                <tr id="img">
                    <td>
                        <img class="avatar" src="images/webedia.jpg" alt="Logo de webedia">
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
    
        <!-- tableau comportant l'ensemble des scènes choisies par l'utiliseur : chaque clic sur une scène lance cette dernière -->
        <div>
            <table class="divclassiques">
                <tr>
                    <?php
                    $oui = new mysqli(SERVEUR, LOGIN, MDP, BDD);
                    // on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
                    $sql = 'SELECT positionTableau, idScene FROM SceneParUser WHERE idUser=' . $iduser . ';';
                    $req = $oui->query($sql);
                    $nbscene = 0;

                    // on range les résultats de la requête dans deux tableaux
                    $postab = array();
                    $idscene = array();
                    while ($resultat = $req->fetch_assoc())
                    {
                        array_push($postab, $resultat['positionTableau']);
                        array_push($idscene, $resultat['idScene']);
                    }

                    // on compte le nombre d'élements dans les tableaux (chaque tableau est de même taille)
                    $postab_length = count($postab);

                    // on effectue 20 tours de boucle afin de déterminer si dans la i-ème case du tableau une scène correspond
                    for ($i = 1; $i < 21; $i++)
                    {
                        $result = 0;

                        // le tableau doit être composé de 5 colonnes
                        if ($nbscene % 5 == 0 and $nbscene != 0)
                        {
                            ?>
                            </tr>
                            <tr>
                            <?php
                        }

                        // si le numéro de la case correspond à une valeur du tableau postab, on affiche la scène associée à cette valeur
                        for ($j = 0; $j < $postab_length; $j++)
                        {
                            if ($i == $postab[$j])
                            {
                                $sqlscene = 'SELECT * FROM Scene WHERE id=' . $idscene[$j] . ';';
                                $reqscene = $oui->query($sqlscene);
                                while ($listescene = $reqscene->fetch_assoc())
                                {
                                    ?>
                                        <td class="affichagescene" style=background-color:<?php echo $listescene['couleurscene'] ?> id="<?php echo $idscene[$j] ?>" onclick="envoi(<?php echo $idscene[$j] ?>);"><?php echo $listescene['name'] ?></td>
                                    <?php
                                }
                                $result = 1;
                            }
                        }

                        // si le numéro de la case ne correspond pas à une valeur du tableau postab, on affiche une case vide
                        if ($result == 0)
                        {
                            ?>
                                <td class="affichage" id="<?php echo $i ?>"></td>
                            <?php
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