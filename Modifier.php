<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css">
<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);
$result2 = $objPdo->query('select * from news where idnews='.$_GET['ref']);
foreach($result2 as $row){
    $titre=$row['titrenews'];
    $theme=$row['idtheme'];
    $textenews=$row['textenews'];
}
if(isset($_POST['Annuler']))
    header('Location:Redacteur.php');
$Terreur=[];
if(isset($_POST['Modifier'])){
    $Terreur['titre']='A saisir';
    $titre='';
    if(isset($_POST['titre'])){
        $titre=$_POST['titre'];
        if(!empty(trim($titre)))
            $Terreur['titre']='';
    }
    $Terreur['theme']='A choisir';
    $theme='';
    if(isset($_POST['theme'])){
        $theme=$_POST['theme'];
        if(!empty(trim($theme)))
            $Terreur['theme']='';
    }
    $Terreur['textenews']='A saisir';
    $textenews='';
    if(isset($_POST['textenews'])){
        $textenews=$_POST['textenews'];
        if(!empty(trim($textenews)))
            $Terreur['textenews']='';
    }
    if($Terreur['textenews']=='' && $Terreur['theme']=='' && $Terreur['titre']==''){
        $insert_stmt = $objPdo->prepare('UPDATE `news` SET `idtheme`=?, `titrenews`=?, `textenews`=? WHERE idnews=?');
        $insert_stmt->bindValue(1, $theme, PDO::PARAM_INT);
        $insert_stmt->bindValue(2, $titre, PDO::PARAM_STR);
        $insert_stmt->bindValue(3, $textenews, PDO::PARAM_STR);
        $insert_stmt->bindValue(4, $_GET['ref'], PDO::PARAM_INT);
        $insert_stmt->execute();
        header("Location:News.php");
    }
}
?>
<html>
<body>
<?php
session_start();
$_SESSION['url']='Modifier.php?ref='.$_GET['ref'];
if($_SESSION['login']!='ok'){
    header("Location:authentification.php");
}
?>
<div style="text-align: center;">
    <form method="post" action=''>

        <label for="Titre">Titre de la news : </label>
        <input type="text" id="Titre" name="titre" value="<?php echo $titre ?>">
        <span style='color:red'><?php echo $Terreur['titre'] ?></span>
        <br>
        Theme : <select name="theme" id="theme" value="<?php echo $theme ?>">
            <option value=""></option>
            <?php
            $result = $objPdo->query('select * from theme');
            foreach ($result as $row) {
                if($theme==$row['idtheme'])
                    echo '<option value=' . $row['idtheme'] . ' selected="selected">' . $row['description'] . '</option>';
                else
                    echo '<option value=' . $row['idtheme'] . '>' . $row['description'] . '</option>';
            }
            ?>
        </select>
        <span style='color:red'><?php echo $Terreur['theme'] ?></span><br>
        <label for="textenews">Contenue</label>
        <span style='color:red'><?php echo $Terreur['textenews'] ?></span><br>
        <textarea name="textenews" rows=20 cols=50><?php echo $textenews ?></textarea><br>
        <input type="submit" id='Valider' name="Modifier" value=" Modifier ">
        <input type="submit" value=' Annuler ' name="Annuler">
    </form>
</div>
</body>
</html>
