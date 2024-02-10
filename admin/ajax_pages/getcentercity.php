<!-- link from transacation -->
<?php 
$city = $_POST['city'];
$sid = $_POST['sid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `center` where `city` = '$city' and `paperid`=$sid"); 
      $result->execute();?>
      <option value="">Choose Center</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['code'].'">'.$row['name']."&nbsp;&nbsp;|&nbsp;&nbsp;".$row['code']."&nbsp;&nbsp;|&nbsp;&nbsp;".$row['capacity'].'</option>';
        } 
?>
   

