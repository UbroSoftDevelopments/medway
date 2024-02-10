<?php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$psid = $_POST['psid'];

$result = $db->prepare("SELECT enrollmentno,(SELECT name FROM candidate where id=ex.candidateid) cname,
    (SELECT photo FROM candidatephotomaster where candidateid=ex.enrollmentno) photo,
    (SELECT `signature` FROM candidatephotomaster where candidateid=ex.enrollmentno) sig FROM `examcandidate` ex where papershiftid = $psid ");
$result->execute();
$spsp = $result->fetchAll(PDO::FETCH_ASSOC);
$photoarray = json_encode($spsp);

echo $photoarray;
?>
