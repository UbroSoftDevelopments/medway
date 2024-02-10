<?php 
 include('../config/dbconnection.php');
 $eid = $_POST['eid'];
  $result = $db->prepare("SELECT * FROM `languagemaster` WHERE pid=$eid"); 
      $result->execute();?>
        <option value="">Select Language</option>
      <?php for($i=0;$row=$result->fetch();$i++){
      echo '<option value="'.$row['id'].'">'.$row['language'].'</option>';
      }
?>

   

