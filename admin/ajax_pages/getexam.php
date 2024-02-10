<?php 
 include('../config/dbconnection.php');
 $eid = $_POST['eid'];
  $result = $db->prepare("SELECT * FROM `exam` WHERE id=$eid"); 
      $result->execute();
      $row=$result->fetch();
      echo '<label id="nm">'.$row['name'].'</label><label id="logo">'.$row['logo'].'</label>';        
?>

   

