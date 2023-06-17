<?php
	class fetchrecord 
	{

function candi_detail(){      
  $userid = $_GET['reg_id'];
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT candidate.*, candidatephotomaster.photo, papermaster.papername FROM 
      ((`candidate` INNER JOIN candidatephotomaster on candidatephotomaster.candidateid = candidate.id)
       INNER JOIN papermaster on papermaster.id = candidate.pprid) WHERE candidate.id = $userid");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function candi_address(){      
  $userid = $_GET['reg_id'];
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT * FROM `address` WHERE candidateiid = $userid");
          $result->execute();
          for($i=0;$i<$row = $result->fetch();$i++){
            echo $row['addtype']. ' : ' . $row['address'] . ", " .$row['district']. ', '. $row['city'] . ', '. $row['pincode'] . ', '. $row['state']. ', '.$row['country'].'<br>';
          }
          
}

}
?>
