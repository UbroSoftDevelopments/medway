<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$psid = $_POST['pshiftid'];
$secid = $_POST['secid'];

$result = $db->prepare("SELECT totalquestion FROM `section` where id = $secid");

      $result->execute();
      $resq = $result->fetch();
      if($resq['totalquestion'] > 0){
      $sql = $db->prepare("SELECT COUNT(id) as cnt  FROM `question` WHERE papershiftid = $psid and secid = $secid");
      $sql->execute();
      $row=$sql->fetch();
            $ttlques = $row['cnt'];
            $howMuchtoInsert = $resq['totalquestion'] - $ttlques;
            if($howMuchtoInsert > 0){
                  for($j=1;$j<=$howMuchtoInsert;$j++){  
                        $insertques = "INSERT INTO `question`(`type`, `secid`, `papershiftid`) VALUES (:type,:sid,:pprshiftid)";
                        $rq = $db->prepare($insertques);
                        $insertquessql = $rq->execute(array( ':type'=> 1,':sid'=>$secid , ':pprshiftid'=>$psid));             
                        if($insertquessql){ 
                              $last_qid = $db->lastInsertId();
                              for($i=0;$i<4;$i++){
                                    $insertop = "INSERT INTO `options`(`qid`) VALUES (:qid)";
                                    $ro = $db->prepare($insertop);
                                    $insertoption = $ro->execute(array(':qid'=>$last_qid));
                              }
                        }
                  }
            }
             

            // Get Question Deatil and fill in Excel.
            $questionData = $db->prepare("SELECT *  FROM `question` WHERE papershiftid = $psid and secid = $secid");
            $questionData->execute();
                        
            $AllSectionQuestion = array();

            while($row1 = $questionData->fetch()){
                  $qid = $row1['id'];
                  $types = $row1['type'];
                  $mm = $row1['mm'];
                  $nm = $row1['nm'];
                  $opt1 = "";$opt2 = "";$opt3 = "";$opt4 = "";
                  $res2 = $db->prepare("SELECT id FROM `options` WHERE qid = $qid");
                  $res2->execute();

                  $OptionCount = 0;
                  while($row2 = $res2->fetch()){
                        $OptionCount = $OptionCount +1;
                        switch ($OptionCount) {
                              case 1:
                                    $opt1 = $row2['id'];
                                    break;
                              case 2:
                                    $opt2 = $row2['id'];
                                    break;
                              case 3:
                                    $opt3 = $row2['id'];
                                    break;
                              case 4:
                                    $opt4 = $row2['id'];
                                   break;
                        }

                  }
                 array_push( $AllSectionQuestion,array(
                  "QID"=>$qid,
                  "TYPE"=>$types,
                  "MM"=>"",
                  "NM"=>"",
                  "Question"=>"",
                  "Option_A"=>"",
                  "Option_B"=>"",
                  "Option_C"=>"",
                  "Option_D"=>"",
                  "Op_Id_1"=>$opt1,
                  "Op_Id_2"=>$opt2,
                  "Op_Id_3"=>$opt3,
                  "Op_Id_4"=>$opt4,
                  "Explanation"=>"",
                  ));     
            }       
      
           echo json_encode($AllSectionQuestion);
            // print_r($AllSectionQuestion);

      }     
      else{
            echo "not";
      }
