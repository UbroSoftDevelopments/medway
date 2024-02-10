<?php
    include('../config/dbconnection.php');
    // $updt = $db->query("UPDATE `u937865059_medwayexam`.`QUESTION` SET `papershiftid` = 7 WHERE (`papershiftid`=3);"); 
    // if($updt){ 
    //     echo "New records created successfully";
    // }
$langid = $_POST['langid'];
$qid = $_POST['qid'];
$ExpImgdata = $_POST['ExpImgdata'];
    $updt = $db->query("UPDATE `question` SET `explanation`='$ExpImgdata' WHERE `id` = $qid"); 
    if($updt){             
        echo "Explanation Added Successfully";    
    }
?>