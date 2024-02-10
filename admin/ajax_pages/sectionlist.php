<?php 
header('Content-Type: application/json');
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT *, 0 as count FROM `section` WHERE paperid=$pid order by id asc"); 
      $result->execute();
      $spsp = $result->fetchAll(PDO::FETCH_ASSOC);
      $photoarray = json_encode($spsp,JSON_NUMERIC_CHECK);

      echo $photoarray;

?>

    

   


