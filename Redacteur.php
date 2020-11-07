 <?php
require_once ('Connexion.php');
?>
<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css"><html>
<body>
<?php
session_start();
$_SESSION['url']='Redacteur.php';
if($_SESSION['login']!='ok'){
    header("Location:authentification.php");
}
$result = $objPdo->query('select nom,prenom from redacteur where idredacteur='.$_SESSION['id']);
foreach ($result as $row )
{
    echo '<center>' . '<h1>'.$row['nom'].'</h1>';
    echo '<h2>'.$row['prenom'].'</h2>';
}

$result2 = $objPdo->query('SELECT COUNT(*) FROM `news` WHERE idredacteur='.$_SESSION['id']);
foreach ($result2 as $a){
    if($a['COUNT(*)']!=0){
        echo '<h3>News que vous avez rédigée</h3>';
        echo '<table>';
        $result3 = $objPdo->query('select * from news where idredacteur='.$_SESSION['id']);
        foreach ($result3 as $row )
        {
            echo '<tr>';
            echo '<td>'.$row['titrenews'].'</td>';
            echo '<td>'.$row['datenews'].'</td>';
            echo '<td>'.$row['textenews'].'</td>';
            echo '<td><a href="Modifier.php?ref='.$row['idnews'].'"><img src="img/écrire.png"target="_self"></a></td>';
            echo '<td><a href="Supprimer.php?ref='.$row['idnews'].'" onclick='.'"return(confirm('."'Etes-vous sûr de vouloir supprimer cette article ?'".'));"><img src="img/supprimer.png"target="_self"></a></td>';
            echo '</tr>';
        }
        echo '<tr><td><a href="AjoutNews.php"><img src="img/+.png"target="_self"></a></td></tr>';
        echo '</table>';
    }
    else
        echo '<table><tr><td><a href="AjoutNews.php"><img src="img/+.png"target="_self"></a></td></tr></table>';
}
'</center>'

?>
<br>
<a href="deconnexion.php" onclick="return(confirm('Etes-vous sûr de vouloir vous deconnecter ?'));"><img src="img/deconnexion.png"target="_self"></a>
<a href="News.php"><img src="img/retour.png"target="_self"></a>
</body>
</html>
