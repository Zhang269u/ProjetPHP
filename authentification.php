<html lang="Fr">
<meta charset="UTF-8"/>
<link rel="stylesheet" href="News.css">
<?php
require_once ('Connexion.php');
?>
<html>
<head>
    <title>Authentification</title>
</head>

<body>
<?php
session_start();
if(isset($_POST['user'])&& isset($_POST['mdp'])){
    $bSoumis=1;
	$result = $objPdo->query('select * from redacteur');
	foreach($result as $row){
		if($_POST['user']==$row['adressemail'] && $_POST['mdp']==$row['motdepasse'])
	{
		$_SESSION['login']='ok';
        $_SESSION['id']=$row['idredacteur'];
		if($_SESSION['url']!='')
			header("location: {$_SESSION['url']}");
		else header("location: News.php");
	}
	}
	}
else
    $bSoumis=0;
?>
<div class="titre">
Pour accéder à cette page il est nécessaire de vous identifier <br/></div>
<div class="formaut"><form method="POST" action="authentification.php">
    <div class="phrase1">Identifiant : <input type='text' name='user'><br/></input></div>
    <div class="phrase2">Mot de passe : <input type='password' name='mdp'><br/></input></div>
    <div classe="valider"><input type='submit' value='valider'></input></div></div>
</form>
</body>
</html>
