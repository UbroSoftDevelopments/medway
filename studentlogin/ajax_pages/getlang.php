<!-- link from transacation -->
<?php 
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `languagemaster` where `pid` = $pid"); 
      $result->execute();?>
      <option value="choose">Choose Language</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['id'].'">'.$row['language'].'</option>';
        } 
?>
   

