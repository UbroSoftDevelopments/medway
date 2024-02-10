<!-- link from transacation -->
<?php 
$pprid = $_POST['pid'];
$city = $_POST['city'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT SUM(capacity) cnt FROM `center` WHERE city='$city' and paperid = $pprid"); 
      $result->execute();
     $row=$result->fetch();
      echo $row['cnt'];
     ?>

   

