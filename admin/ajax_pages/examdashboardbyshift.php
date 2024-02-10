<!-- link from transacation -->
<?php 
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(*) cnt FROM `center` WHERE paperid=$pid"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>

   

