<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css">
<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);
session_start();
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<h1>Liste des Nouvelles</h1>
<center>
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
</center>
<a href="Redacteur.php">
    <?php
    if($_SESSION['login']!='ok')
        echo '<img src="connexion.png" target="_self">';
    else
        echo '<img src="EspaceRedac.png"target="_self">';
        ?>
</a><br><br>
<a href="CreeRedacteur.php"><img src="inscription.png"target="_self"></a>
</body>
</html>
