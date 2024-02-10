<?php
header('Content-Type: application/json');
include('../config/dbconnection.php');

$psid = $_POST['psid'];

$result = $db->prepare("SELECT examcandidate.setno,  candidate.*,
academicmaster.academicname, candidatephotomaster.photo,
MAX(CASE WHEN contacts.contact_type = 'email' THEN contacts.contact_value ELSE NULL END) email,
MAX(CASE WHEN contacts.contact_type = 'mob_student' THEN contacts.contact_value ELSE NULL END) mobile
FROM   
((((`examcandidate` INNER JOIN 
candidatephotomaster on examcandidate.enrollmentno = candidatephotomaster.candidateid)
inner join contacts on examcandidate.candidateid = contacts.candidateid )
inner join academicmaster on examcandidate.candidateid = academicmaster.candidateid )
inner join candidate on examcandidate.candidateid = candidate.id )
WHERE examcandidate.papershiftid = $psid
GROUP BY examcandidate.enrollmentno order by examcandidate.candidateid asc;");
$result->execute();
$spsp = $result->fetchAll(PDO::FETCH_ASSOC);
$photoarray = json_encode($spsp);

echo $photoarray;
?>
