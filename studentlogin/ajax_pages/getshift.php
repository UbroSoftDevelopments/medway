<?php 
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `papershift` where `paperid` = $pid"); 
      $result->execute();?>
      <option value="choose">Choose Shift</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['id'].'">'.$row['shifttime'].'</option>';
        } 
?>
   

