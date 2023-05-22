<?php
// ferme la session de l'utilisateur précédemment connecté
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();
?>