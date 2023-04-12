<?php
$connect = mysqli_connect("192.168.64.144", "root", "root");
mysqli_select_db($connect, "PROJETWEBEDIA") or die ("erreur de connexion base");
$req = "SELECT * FROM User";
$result = mysqli_query($connect, $req);


?>