<?php 
$pid = $_POST['pid'];
 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * FROM `examruleandterm` WHERE paperid=$pid"); 
      $result->execute();
      $row=$result->fetch();
      $rule = $row['imgrule'];
      echo $rule;
?>

   

