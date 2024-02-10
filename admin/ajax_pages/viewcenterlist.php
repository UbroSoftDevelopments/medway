<?php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$psid = $_POST['psid'];

$result = $db->prepare("SELECT * FROM `center` where paperid = $psid");
$result->execute();
$spsp = $result->fetchAll(PDO::FETCH_ASSOC);
$photoarray = json_encode($spsp);

echo $photoarray;
?>
