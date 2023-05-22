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

        // fonction permettant d'envoyer les scènes choisies dans un fichier php puis dans la BDD
        function recup()
        {
            var donnees = "";

            // on récupère l'ID de l'utilisateur
            let iduser = document.getElementById("button").value;

            // on utilise XMLHttpRequest pour envoyer des variables JS dans du PHP
            var xhr_object = new XMLHttpRequest();
            var method = "POST";
            var filename = "listesceneuser.php";
            xhr_object.open(method, filename, true);
            xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let nbscene = 0;

            // on vérifie toutes les cellules du tableau
            for (let i = 1; i < 21; i++)
            {
                var c = "tab" + i;
                let tabid = document.getElementById(c);

                // on vérifie si chaque cellule possède une scène
                if (tabid.hasChildNodes())
                {
                    const enfant = tabid.firstElementChild;
                    var e = enfant.id;
                    donnees = donnees + "postab" + nbscene + "=" + i + "&idscene" + nbscene + "=" + e + "&";
                    nbscene = nbscene + 1;
                }
            }
            xhr_object.onreadystatechange = function()
            {
                if (xhr_object.readyState == 4)
                {
                    alert("Les scènes ont bien été enregistrées");
                }
            }
            donnees = donnees + "iduser=" + iduser + "&nbscene=" + nbscene;

            // on envoie les données au fichier PHP
            xhr_object.send(donnees);
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

    // on récupère la liste des scènes déjà enregistrées dans la BDD
    $oui = new mysqli(SERVEUR, LOGIN, MDP, BDD);
    $sql = 'SELECT * FROM Scene';
    $resultat = $oui->query($sql);
    ?>

    <!-- affiche le nom de l'utilisateur -->
    <header><?php echo $pseudo; ?></header>
    <div height="1800px" width="100%">
        <!-- menu avec tous les choix possibles -->
        <div id="divConteneur1">
            <table class="base">
                <tr>
                    <td class="banner" colspan="5">
                        <img class="banner" src="images/webedia_banner.png" alt="Logo de user">
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="choix"><a href="admin.php">Retour à l'interface</a><button class="save" id="button" value="<?php echo $iduser; ?>" onclick="recup()">Enregistrer</button></td>
                </tr>
                <!-- tableau contenant la liste de toutes les scènes présentes dans la BDD -->
                <tr>
                    <?php
                    $nbscene = 0;
                    while ($data = $resultat->fetch_assoc())
                    {
                        // le tableau doit être composé de 5 colonnes
                        if ($nbscene % 5 == 0 and $nbscene != 0)
                        {
                            ?>
                            </tr>
                            <tr>
                            <?php
                        }
                        ?>
                        <!-- tableau avec les différentes scènes pouvant accueillir du drag'n drop -->
                        <td class="tabliste" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <!-- div contenant les scènes déplaçables grâce au drag'n drop -->
                            <div class="listescenes" style=background-color:<?php echo $data['couleurscene'] ?> id="<?php echo $data['id'] ?>" draggable="true" ondragstart="drag(event)" id="drag<?php echo $data['id'] ?>"><?php echo $data['name'] ?></div>
                        </td>
                        <?php
                        $nbscene++;
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div>
            <!-- tableau pouvant accueillir du drag'n drop et servant à enregistrer les scènes choisies par l'utilisateur connecté sur son interface -->
            <table class="scenes">
                <tr>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab1></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab2></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab3></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab4></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab5></td>
                </tr>
                <tr>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab6></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab7></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab8></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab9></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab10></td>
                </tr>
                <tr>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab11></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab12></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab13></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab14></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab15></td>
                </tr>
                <tr>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab16></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab17></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab18></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab19></td>
                    <td class="tabaenregistrer" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab20></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>