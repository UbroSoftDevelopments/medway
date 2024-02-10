<?php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$pid = $_POST['pid'];

$result = $db->prepare("SELECT  candidate.*,
academicmaster.academicname, candidatephotomaster.photo,
MAX(CASE WHEN contacts.contact_type = 'email' THEN contacts.contact_value ELSE NULL END) email,
MAX(CASE WHEN contacts.contact_type = 'mob_student' THEN contacts.contact_value ELSE NULL END) mobile

FROM   
(((`candidate` INNER JOIN 
candidatephotomaster on candidate.reg_no = candidatephotomaster.candidateid)
inner join contacts on candidate.id = contacts.candidateid )
inner join academicmaster on candidate.id = academicmaster.candidateid )

WHERE candidate.pprid = $pid
GROUP   BY candidate.id;");
$result->execute();
$spsp = $result->fetchAll(PDO::FETCH_ASSOC);
$photoarray = json_encode($spsp);

echo $photoarray;
?>
