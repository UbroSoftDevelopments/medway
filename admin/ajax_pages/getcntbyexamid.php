<!-- link from transacation -->
<?php 
$shift = $_POST['eid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(*) cnt FROM `papermaster` WHERE examid=$shift"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>

   

