<!-- link from transacation -->
<?php
$uid = $_POST['userid'];
$note = $_POST['note'];

include('../config/dbconnection.php');
$result = $db->prepare("UPDATE `siteuser` SET `note` = '$note' WHERE `siteuser`.`id` =$uid");
$result->execute();
echo "Saved";
?>