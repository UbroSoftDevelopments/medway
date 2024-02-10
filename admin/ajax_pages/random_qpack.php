<?php

//fetch_images.php

include('../config/dbconnection.php');

 $pid = $_POST['pid'];
 $set = $_POST['set'];
 $sid = $_POST['sid'];

  $result = $db->prepare("SELECT question.id as qid FROM section
   INNER JOIN question ON section.id = question.secid where section.paperid = $pid"); 
      $result->execute();
       $qcount = $result->rowCount();     
       $randQno = randmonarray($qcount);
      foreach($randQno as $qno){
        $row2=$result->fetch();
      insertIntoPaperSet($row2['qid'],$qno);
      }
     

  function insertIntoPaperSet($qid,$qno){
  //  $pid = $_POST['pid'];
 $set = $_POST['set'];
 $sid = $_POST['sid'];

    include('../config/dbconnection.php');
   
$sql = "INSERT INTO `papersets`(`papershiftid`, `setno`, `qid`, `qno`) VALUES (:psid,:setno,:qid,:qno) ON
 DUPLICATE KEY UPDATE qno=$qno";
            $r = $db->prepare($sql);  
            $sql = $r->execute(array(':psid'=>$sid, ':setno'=>$set, ':qid'=>$qid,':qno'=>$qno));             
  }   
  echo "Successfully Randomised";

  function randmonarray($qcount){
    $randarr = array();
    for ($i = 0; $i < $qcount; $i++) {
        $x =  rand(1,$qcount);
       
        if(in_array($x, $randarr) == 1){        
            $i=$i-1;
        } else {
            if($x > $qcount == 0){
            array_push($randarr,$x); 
            }
        }
    }
    return $randarr;
 }
?>
