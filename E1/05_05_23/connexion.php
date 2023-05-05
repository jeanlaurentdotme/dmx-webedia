<?php
// fichier comportant les infos de connexion à la BDD
include ("connect.php");

// on vérifie que l'utilisateur a correctement saisi puis envoyé le formulaire
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion')
{
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pwd']) && !empty($_POST['pwd'])))
    {
        // connexion à la BDD
        $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);
        if (!$connexion)
        {
            echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
            exit;
        }
        mysqli_select_db ($connexion, BDD);
        print "Connexion BDD reussie puis";
        echo "<br/>";

        // on parcourt la BDD pour chercher l'existence du login mot et du mot de passe saisis par l'utilisateur et on les range dans un tableau
        $sql = 'SELECT count(*) FROM User WHERE login="'.mysqli_real_escape_string($connexion, $_POST['login']).'" AND password="'.mysqli_real_escape_string($connexion, md5($_POST['pwd'])).'"';
        $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($connexion));
        $data = mysqli_fetch_array($req);

        // si on obtient une réponse, alors l'utilisateur est un membre et on démarre sa session
        if ($data[0] == 1)
        {
            // si le login est celui de l'admin, on démarre sa session correspondante
            if($_POST['login'] == 'Admin')
            {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $sql = 'SELECT id FROM User WHERE login="'.$_SESSION['login'].'";';
                $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($connexion));
                $data = mysqli_fetch_assoc($req);
                $_SESSION['id'] = $data["id"];
                header('Location: admin.php');
                exit();
            }

            // sinon on démarre la session de l'utilisateur concerné
            else
            {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $sql = 'SELECT id FROM User WHERE login="'.$_SESSION['login'].'";';
                $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($connexion));
                $data = mysqli_fetch_assoc($req);
                $_SESSION['id'] = $data["id"];
                header('Location: user.php');
                exit();
            }
        }

        // si l'utilisateur a saisi un mauvais login ou mot de passe, on affiche une erreur
        elseif ($data[0] == 0)
        {
            $erreur = 'Login ou mot de passe non reconnu !';
            echo $erreur; 
            echo"<br/><a href='index.php'>Accueil</a>";
            exit();
        }
        // sinon il existe un problème dans la base de données
        else
        {
            $erreur = 'Plusieurs membres ont<br/>les memes login et mot de passe !';
            echo $erreur; 
            echo"<br/><a href='index.php'>Accueil</a>";
            exit();
        }
        mysqli_free_result($req);
        mysqli_close($connexion);
    }
    else
    {
        $erreur = 'Errreur de saisie !<br/>Au moins un des champs est vide !';
        echo $erreur; 
        echo"<br/><a href='index.php'>Accueil</a>";
        exit();
    }
}
?>