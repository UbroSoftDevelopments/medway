<?php 
header('Content-Type: application/json');
$pid = $_POST['pid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT *, (SELECT COUNT(*) from questionimgbylanguage WHERE langid = languagemaster.id) cnt
   FROM `languagemaster` WHERE pid=$pid"); 
      $result->execute();
      $spsp = $result->fetchAll(PDO::FETCH_ASSOC);
      $photoarray = json_encode($spsp,JSON_NUMERIC_CHECK);

      echo $photoarray;

?>

    

   


