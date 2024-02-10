<?php
include('../config/dbconnection.php');
$psid = $_POST['psid'];
$exid = $_POST['exid'];
$result = $db->prepare("SELECT count(iscorrect) as count, 
           (SELECT count(id) from question where papershiftid = $psid) ttl from options
            inner join question on options.qid = question.id where 
          question.papershiftid = $psid and iscorrect = 1");
$result->execute();
$row = $result->fetch();
if ($row['count'] == $row['ttl']) {
     $update = $db->query("UPDATE `ub_status` SET `correctanswer`= 1 WHERE examid = $exid");
     $update->execute();
}
echo $row['count'] . ' / ' . $row['ttl'];
?>