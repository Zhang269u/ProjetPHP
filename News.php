<?php
require_once ('Connexion.php');
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
<a href="Redacteur.php">Login</a>
<a href="CreeRedacteur.php">Nouveau Redacteur</a>
</body>
</html>
