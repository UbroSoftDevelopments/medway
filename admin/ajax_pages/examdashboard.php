<!-- link from transacation -->
<?php 
$examid = $_POST['eid'];
$examdt = $_POST['exdt'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(*) cnt,(SELECT COUNT(*) from `examcenter` where `examid`=$examid) centercnt FROM `exam` WHERE id=$examid and date='$examdt'"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'].",".$row['centercnt'] ;
     ?>

   

