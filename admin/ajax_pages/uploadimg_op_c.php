<?php
    include('../config/dbconnection.php');
$langid = $_POST['langid'];
$opid = $_POST['opid'];
$OpAimgdata = $_POST['opimgdata'];
    $updt = $db->query("UPDATE `optionimgbylanguage` SET `data`='$OpAimgdata' WHERE `opid` = $opid and `langid` = $langid"); 
    if($updt){             
        echo "Option C Added Successfully";    
    }
?>