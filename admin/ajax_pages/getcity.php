<!-- link from transacation -->
<?php 
$examid = $_POST['eid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT Distinct city from `center` where `examid` = '$examid'"); 
      $result->execute();?>
      <option value="choose">Choose City</option>
      <?php
      for($j=1;$row=$result->fetch();$j++){
        echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
        } 
?>
   

