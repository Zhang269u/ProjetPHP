<?php
require_once ('Connexion.php');
$result=$objPdo->query('delete from news where idnews='.$_GET['ref']);
header("location:Redacteur.php");
?>