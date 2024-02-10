<?php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$psid = $_POST['psid'];
$ccode = $_POST['ccode'];

$result = $db->prepare("SELECT ex.enrollmentno,(SELECT name FROM candidate where id=ex.candidateid) cname,
(SELECT dob FROM candidate where candidate.id=ex.candidateid) dob,
(SELECT gender FROM candidate where candidate.id=ex.candidateid) gender,
(SELECT photo FROM candidatephotomaster where candidatephotomaster.candidateid=ex.enrollmentno) photo,
(SELECT signature FROM candidatephotomaster where candidatephotomaster.candidateid=ex.enrollmentno) sig 
FROM `examcandidate` ex where
 ex.papershiftid = $psid and ex.centercode = '$ccode'");
$result->execute();
$spsp = $result->fetchAll(PDO::FETCH_ASSOC);
$photoarray = json_encode($spsp);

echo $photoarray;
?>
