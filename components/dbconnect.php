<?php 

$dbuser = getenv("DBUSER");
$dbmdp= getenv("DBPASSWORD");

try{
    $bdd = new PDO('mysql:host=remotemysql.com;dbname=tMyE4KVDKJ;charset=utf8', $dbuser, $dbmdp);
} catch (Exeption $e) {
    die('Erreur : '.$e->getMessage());
}

?>

