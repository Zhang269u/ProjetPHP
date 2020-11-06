<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);
session_start();
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<h1>Liste des Nouvelles</h1>
<table>
    <?php
    $result = $objPdo->query('select * from news');
        foreach ($result as $row )
        {
            echo '<tr>';
            echo '<td>'.$row['titrenews'].'</td>';
            echo '<td>'.$row['datenews'].'</td>';
            echo '<td>'.$row['textenews'].'</td>';
            echo '</tr>';
        }

    ?>

</table>
<a href="Redacteur.php">
    <?php
    if($_SESSION['login']!='ok')
        echo "Login";
    else
        echo "Acceder a son espace"
        ?>
</a><br><br>
<a href="CreeRedacteur.php">Nouveau Redacteur</a>
</body>
</html>