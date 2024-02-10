<!-- link from transacation -->
<?php 
$eid = $_POST['eid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT SUM(capacity) cnt FROM `center` WHERE examid=$eid"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>

   

