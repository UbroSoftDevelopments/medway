<!-- link from transacation -->
<?php 
$pid = $_POST['pid'];

 include('config/dbconnection.php');
  $result = $db->prepare("SELECT * FROM `papershift` WHERE paperid=$pid"); 
      $result->execute();?>
      <?php for($j=1;$row=$result->fetch();$j++){ 
        echo '';
         } ?>

   

