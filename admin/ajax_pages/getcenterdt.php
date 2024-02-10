<!-- link from transacation -->
<?php 
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `center` where `paperid` = $pid"); 
      $result->execute();?>
      <option value="">Choose Center</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['code'].'">'.$row['name']."&nbsp;&nbsp;|&nbsp;&nbsp;".$row['code']."&nbsp;&nbsp;|&nbsp;&nbsp;".$row['capacity'].'</option>';
        } 
?>
   

