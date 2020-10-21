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
	if(!$_GET['ref'])
		$result = $objPdo->query('select * from redacteur');
	else
		$result = $objPdo->query('select * from redacteur where idredacteur = '.$GET['ref']);
	foreach($result as $row){
		if($_POST['user']==$row['adressemail'] && $_POST['mdp']==$row['motdepasse'])
	{
		$_SESSION['login']='ok';
		if($_SESSION['url']!='')
			header("location: {$_SESSION['url']}");
		else header("location: News.php");
	}
	}
	}
else
    $bSoumis=0;
?>

Pour accéder à cette page il est nécessaire de vous identifier <br/>
<form method="POST" action="authentification.php">
    Identifiant : <input type='text' name='user'><br/></input>
    Mot de passe : <input type='password' name='mdp'><br/></input>
    <input type='submit' value='valider'></input>
</form>
</body>
</html>
