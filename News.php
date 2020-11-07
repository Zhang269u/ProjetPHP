<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css">
<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);
session_start();
$ordre="idnews ASC";
if (isset($_POST['ordre']))
{
    $ordre = $_POST['ordre'];
    header('refresh:');
}

?>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<h1>Liste des Nouvelles</h1>
<form method="post">
  <div class="orga">  <select name="ordre" >
        <option value="datenews ASC" <?php if($ordre=='datenews ASC') echo 'selected="selected"'  ?>>Date croissante</option>
        <option value="datenews DESC" <?php if($ordre=='datenews DESC') echo 'selected="selected"'  ?>>Date décroissante</option>
        <option value="idtheme ASC" <?php if($ordre=='idtheme ASC') echo 'selected="selected"'  ?>>Theme</option>
    </select><br></div>
    <input type="submit" name="change" value=" Organiser ">
</form>
<center>
    <table>
        <?php
        $result = $objPdo->query('select * from news order by '.$ordre);
        foreach ($result as $row )
        {
            echo '<tr>';
            $dateMySQL = $row['datenews'];
            echo '<td>'.date("d/m/Y H:i:s", strtotime($dateMySQL)).'</td>';
            echo '<td>'.$row['titrenews'].'</td>';
            echo '<td>'.$row['textenews'].'</td>';
            $result2 = $objPdo->query('select * from theme');
            foreach ($result2 as $row2){
                if($row['idtheme']==$row2['idtheme'])
                    echo '<td>'.$row2['description'].'</td>';
            }
            echo '</tr>';
        }

        ?>

    </table>
</center>
<br>
<a href="Redacteur.php">
    <?php
    if($_SESSION['login']!='ok')
        echo '<img src="img/connexion.png" target="_self">';
    else
        echo '<img src="img/EspaceRedac.png"target="_self">';
    ?>
</a><br><br>
<a href="CreeRedacteur.php"><img src="img/inscription.png"target="_self"></a>
</body>
</html>
