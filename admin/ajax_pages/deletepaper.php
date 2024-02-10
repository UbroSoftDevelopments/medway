<?php 
 include('../config/dbconnection.php');
 $pid = $_POST['pid'];
  $result = $db->prepare("DELETE FROM `papermaster` WHERE id = $pid"); 
      $result->execute();
      echo "Delete Successfully";        
?>

   

