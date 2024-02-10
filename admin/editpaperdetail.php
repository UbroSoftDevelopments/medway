<?php 
 include('config/dbconnection.php');
 $pid = $_POST['pid'];
  $result = $db->prepare("SELECT * FROM `papermaster` WHERE id=$pid"); 
    $result->execute();
    while($row=$result->fetch()){
        echo '<label id="pname">'.$row['papername'].",".$row['papercode'].",".$row['duration'].",".$row['examdate'].
        ",".$row['ttlset'].",".$row['ttlquestions'].",".$row['ttlmarks'].'</label>';
     $result1 = $db->prepare("SELECT *, COUNT(id) as cnt FROM `papershift` WHERE paperid=$pid"); 
     $result1->execute();
     for($i=1;$row1=$result1->fetch();$i++){
        echo '<label id="cnt">'.$row1['cnt'].'</label><label id="papershift">'.$row1['shifttime'].",".$row1['password'].'</label>';
     }
    }
   
?>

   

