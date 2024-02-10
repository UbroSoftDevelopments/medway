<?php
$pid = $_POST['pid'];
include('../config/dbconnection.php');

?>
  
<?php
$resul = $db->prepare("SELECT id FROM `papershift` ps where paperid = $pid"); 
  $resul->execute();
  for($ji=1;$ro=$resul->fetch();$ji++){
    $psid = $ro['id'];

$result = $db->prepare("SELECT processedresult.*,  candidate.name, candidate.dob, candidate.gender,
(select sum(marks) from section where paperid = $pid) ttlmark FROM (processedresult
  INNER JOIN candidate ON processedresult.candidateid = candidate.id) where processedresult.papershiftid = $psid
  ORDER BY percentage DESC;");
  $result->execute();
  
  
  for($j=1;$row=$result->fetch();$j++){
      ?>
    <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $row['enrollment']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['dob']; ?></td>
        <!-- <img src="<?php //echo 'data:image/png;base64,'.$row['photo'] ?>" style="width: 50px;height: 50px;"/>  -->        
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['markobtained'] . ' / ' . $row['ttlmark']; ?></td>
        <td><?php echo $row['percentage'].'%'; ?></td>
        <td><?php 
        if($row['status'] == "Fail"){
            echo '-';
        }else{
            echo $j;
        }
             ?></td>
        <td><?php echo $row['status']; ?></td>
        <!-- <td><button class="btn btn-primary" onclick="getresult('<?php //echo $row['enrollmentno'] ?>')">Get Result</button></td> -->
    </tr>
  <?php }
  }
?>