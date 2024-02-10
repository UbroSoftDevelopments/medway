<?php
    include('../config/dbconnection.php');
    // $updt = $db->query("UPDATE `u937865059_medwayexam`.`QUESTION` SET `papershiftid` = 7 WHERE (`papershiftid`=3);"); 
    // if($updt){ 
    //     echo "New records created successfully";
    // }
$langid = $_POST['langid'];
$qid = $_POST['qid'];
$Qimgdata = $_POST['Qimgdata'];
    $updt = $db->query("UPDATE `questionimgbylanguage` SET `data`='$Qimgdata' WHERE `qid` = $qid and `langid` = $langid"); 
    if($updt){             
        echo "Question Added Successfully";    
    }
?>