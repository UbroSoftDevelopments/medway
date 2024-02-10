<?php 
 include('../config/dbconnection.php');
 $eid = $_POST['eid'];
  $result = $db->prepare("DELETE FROM `exam` WHERE id = $eid"); 
      $result->execute();
      echo "Delete Successfully";        
?>

   

