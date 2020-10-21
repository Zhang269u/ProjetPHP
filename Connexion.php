<?php
$db_config=array();
$db_config['SGBD']='mysql';
$db_config['HOST']='devbdd.iutmetz.univ-lorraine.fr';
$db_config['DB_NAME']='zhang269u_SiteVente';
$db_config['USER']='zhang269u_appli';
$db_config['PASSWORD']='Vevyilxi2001';


try
{
    $objPdo = new PDO
    ($db_config['SGBD'].':host='.$db_config['HOST'].';dbname='.$db_config['DB_NAME'], $db_config['USER'], $db_config['PASSWORD'] );
    unset($db_config);
}
catch( Exception $exception )
{
    die($exception->getMessage());
}


?>