<?php 
header('Content-Type: application/json');
$psid = $_POST['psid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT COUNT(questionimgbylanguage.id) as count, question.secid FROM `question` INNER JOIN questionimgbylanguage on question.id = questionimgbylanguage.qid where papershiftid = $psid GROUP by secid"); 
      $result->execute();
      $spsp = $result->fetchAll(PDO::FETCH_ASSOC);
      $photoarray = json_encode($spsp,JSON_NUMERIC_CHECK);

      echo $photoarray;

?>

    

   


