<!-- link from transacation -->
<?php 
$pid = $_POST['psid'];



 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT ttlset from `papermaster` where `id` = $pid"); 
      $result->execute();
      $row=$result->fetch();
      for($j=1; $j<=$row['ttlset']; $j++){
        echo '<div class="col-sm-2" onclick="set('.$j.')"><label style="width:100%" class="btn btn-primary">Set : '.$j.'</label>
        <select id="abc'.$j.'" style="display:none;" class="form-control" onchange="createset('.$pid.",".$j.')">
        <option value="choose">Choose</option>
        <option value="random">Generate Qpack</option>
        <option value="preview">View Qpack</option>
        </select>
        </div>';
        } 
?>
   

