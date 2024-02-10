<!-- link from transacation -->
<?php 
$shift = $_POST['shift'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(*) cnt FROM `papershift` WHERE paperid=$shift"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>

   

