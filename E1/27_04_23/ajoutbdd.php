<?php
//on inclue le fichier qui contient nom_de_serveur, nom_bdd, login et password d'accès à la bdd mysql
include ("connect.php");
    session_start();
    if (!isset($_SESSION['login'])){header('Location: index.php');
        exit();}
//on vérifie que le visiteur a correctement envoyé le formulaire
if (isset($_POST['enregistrer']) && $_POST['enregistrer'] == 'Enregistrer') 
{
   //on teste l'existence des variables et on vérifie qu'elle ne sont pas vides
   if ((isset($_POST['nom']) && !empty($_POST['nom'])))
   {
        $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
        if (!$connexion)
        {
           echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
           exit();
        }
        mysqli_select_db ($connexion, BDD); print "Connexion BDD reussie puis";echo "<br/>"; 
        // on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
        $sql = 'SELECT count(*) FROM SceneTest WHERE nom="'.mysqli_escape_string($connexion, $_POST['nom']).'"';
        $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error($connexion));
        $data = mysqli_fetch_array($req);
        //si aucun autre login identique existe, on inscrit ce nouveau login
        if ($data[0] == 0)
        {
           $sql = 'INSERT INTO SceneTest(id, nom, couleurscene, L1, L2, L3) VALUES(0,"'.mysqli_escape_string($connexion, $_POST['nom']).'","'.mysqli_escape_string($connexion, $_POST['background']).'","'.mysqli_escape_string($connexion, $_POST['L1']).'","'.mysqli_escape_string($connexion, $_POST['L2']).'","'.mysqli_escape_string($connexion, $_POST['L3']).'")';
           mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
           $erreur = 'insertion reussie !';
           echo $erreur;
           //echo"<br/><a href='admin.php'>Retour à la page admin</a>";
           //exit();
           header('Location: ajout.php');
        }
        //sinon on n'inscrit pas ce login
        else
        {
           $erreur = "Echec de l'insertion!<br/>Une scene possede deja ce nom !";
           echo $erreur; 
           echo"<br/><a href='admin.php'>Retour a la page admin</a>";
           exit();
        }
    }
}
   //Si au moins un des champs est vide
   else
   {
      $erreur = "Echec de l'insertion !<br/>Veuillez mettre un nom à la scene !";
      echo $erreur; 
      echo"<br/><a href='ajout.php'>Ajout de scene</a>";
      exit();
   }

?>