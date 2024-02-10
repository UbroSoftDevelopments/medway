<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$qid = $_POST['qid'];
$langid = $_POST['langid'];
$allid = array();
$results = $db->prepare("SELECT data as qdata, (SELECT explanation FROM question WHERE id = $qid) expl
 FROM questionimgbylanguage where qid = $qid and langid = $langid ");
      $results->execute();
      $qrow=$results->fetch();
      
      array_push($allid,$qrow['qdata']);


$result = $db->prepare("SELECT optionimgbylanguage.opid, optionimgbylanguage.data as opdata
 FROM options INNER JOIN optionimgbylanguage ON optionimgbylanguage.opid = options.id 
 where options.qid = $qid and optionimgbylanguage.langid = $langid ");
      $result->execute();

      for($j=1;$row=$result->fetch();$j++){
        array_push($allid,$row['opid']);
        array_push($allid,$row['opdata']);
      }
      //print_r($allid);
      array_push($allid,$qrow['expl']);
      $msg = array("status"=>true, "message"=>"Successfully Done","data"=>$allid);
      echo json_encode($msg);
?>
