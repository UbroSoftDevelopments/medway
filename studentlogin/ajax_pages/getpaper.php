<!-- link from transacation -->
<?php 
$examid = $_POST['eid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `papermaster` where `examid` = '$examid'"); 
      $result->execute();?>
      <option value="choose">Choose Paper</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['id'].'">'.$row['papername']."&nbsp;&nbsp;|&nbsp;&nbsp;".date('d-m-Y', strtotime($row['examdate'])).'</option>';
        } 
?>
   

