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
        function ajoutlum()
        {
            var divParent = document.getElementById('divParent');
            var nouveauLabel = document.createElement('label');
            var nouveauInput = document.createElement('input');
            var nb = document.getElementById('nb');
            i = Number(document.getElementById('nb').value) + 1;
            nouveauLabel.appendChild(document.createTextNode(" Couleur de la "+i+"ème lumière "));
            nouveauLabel.htmlFor = "Lumière "+i;
            nouveauInput.type = 'color';
            nouveauInput.name = 'L'+i;
            nouveauInput.id = i;
            divParent.appendChild(nouveauLabel);
            divParent.appendChild(nouveauInput);
            nb.setAttribute("value",i);
            if (i%3==0)
            {
                var br = document.createElement('br');
                divParent.appendChild(br);
            }
        }
        function enleverlum()
        {
            var divParent = document.getElementById('divParent');
            divParent.removeChild(divParent.lastChild);
            divParent.removeChild(divParent.lastChild);
            var nb = document.getElementById('nb');
            i = Number(document.getElementById('nb').value) - 1;
            nb.setAttribute("value",i);
            if (i%3==2)
            {
                divParent.removeChild(divParent.lastChild);
            }
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
    mysqli_select_db ($connexion, BDD);
          
    $equipData = getInstantiatedEquipments($connexion);



    ?>

    <header>Créez une nouvelle scène</header>
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
            <!-- formulaire permettant de créer une scène -->
            <form action="ajoutbdd.php" method="post" id="form">
                Nom de la scène <input type="text" name="nom"><br />
                <br />
                Couleur de l'arrière plan <input type="color" name="background"><br />
                <div id="divParent">

<?php
                $keys = array_keys($equipData);
                for($i = 0; $i < sizeof($keys); $i++)
                {
                    echo("<div id='divChild".($i+1)."'>");
                    echo("<label for=\"Lumière ".($i+1)."\"> Couleur de la lumière ".($i +1)." (".$equipData[$keys[$i]]['data'][0]['equipementName'].")</label>
                    <input type=\"color\" name=\"L".$keys[$i]."\" id=\"".$keys[$i]."\" >");
                    echo("</div>");
                }                
?>
                </div>


                <br />
                <input type="button" onclick="ajoutlum()" value="Ajouter une lumière">
                <input type="button" onclick="enleverlum()" value="Enelever une lumière">
                <input type="hidden" name="compteur" id="nb" value="1">
                <br />
                <input class="bouton" type="submit" name="enregistrer" value="Enregistrer">
            </form>
        </div>
    </div>
</body>

</html>