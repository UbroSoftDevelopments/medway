<!-- link from transacation -->
<?php 
$cid = $_POST['cid'];
$sid = $_POST['sid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(*) cnt FROM `examcandidate` WHERE centercode=$cid and papershiftid=$sid"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>