<html>
<head>
    <title>Deconnexion</title>
</head>

<body>
<?php
session_start();
$_SESSION[]=array();
session_destroy();
header("location: News.php");
?>
</body>
</html>