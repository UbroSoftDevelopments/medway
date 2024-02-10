<?php


include('../config/dbconnection.php');
$pid = $_POST['pid'];
$rimg = trim($_POST['imgrule']);
$exid = $_POST['exid'];

$update = $db->query("UPDATE `ub_status` SET `rule`= 1 WHERE examid = $exid");
$update->execute();
$insert = $db->query("UPDATE `examruleandterm` SET `imgrule`= '$rimg' WHERE `paperid` = $pid"); 
$insert->execute();
if($insert){ 
echo "Added Successfully";
}else{ 
echo "Something Went Wrong!!";
}
?>