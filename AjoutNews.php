<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css">
<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);
?>
<html>
<body>
<?php
session_start();
$_SESSION['url']='AjoutNews.php';
if($_SESSION['login']!='ok'){
    header("Location:authentification.php");
}
$Terreur=[];
if(isset($_POST['Valider'])){
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
        $insert_stmt = $objPdo->prepare('INSERT INTO `news` ( `idtheme`, `titrenews`, `datenews`, `textenews`, `idredacteur`) VALUES (?,?,now(),?,?)');
        $insert_stmt->bindValue(1, $theme, PDO::PARAM_INT);
        $insert_stmt->bindValue(2, $titre, PDO::PARAM_STR);
        $insert_stmt->bindValue(3, $textenews, PDO::PARAM_STR);
        $insert_stmt->bindValue(4, $_SESSION['id'], PDO::PARAM_INT);
        $insert_stmt->execute();
        header("Location:News.php");
    }
}
?>
<div style="text-align: center;">
<div class= "newss"><form method="post" action=''>

     <label for="Titre">Titre de la news : </label>
    <input type="text" id="Titre" name="titre" value="<?php echo $textenews ?>">
    <span style='color:red'><?php echo $Terreur['titre'] ?></span>
    <br>
    Theme : <select name="theme" id="theme">
        <option value=""></option>
    <?php
        $result = $objPdo->query('select * from theme');
        foreach ($result as $row) {
                echo '<option value=' . $row['idtheme'] . '>' . $row['description'] . '</option>';
        }
    ?>
    </select>
    <span style='color:red'><?php echo $Terreur['theme'] ?></span><br>
    <label for="textenews">Contenu</label>
    <span style='color:red'><?php echo $Terreur['textenews'] ?></span><br>
    <textarea name="textenews" rows=20 cols=50><?php echo $textenews ?></textarea><br>
    <div class="Uploader"><input type="submit" id='Valider' name="Valider" value=" Uploader "></div>
  </div>
</form>
</div>
</body>
</html>
