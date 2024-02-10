<?php
//fetch_images.php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$pid = $_POST['pid'];
$set = $_POST['set'];
$psid = $_POST['psid'];   
// $langid = $_POST['langid']; 
$regno = $_POST['regno'];   

$SetSQPack = array(
  "SetNo"=>$set,
  "Sections"=>array()
);

$resppr = $db->prepare("SELECT * FROM `papermaster`where id = $pid");
$resppr->execute();
$rowpp = $resppr->fetch();
if($rowpp['resultstatus'] == "" || $rowpp['resultstatus'] == null){
echo "1";
}else{

$res = $db->prepare("SELECT * FROM `section`where paperid = $pid");
$res->execute();

while($row = $res->fetch()){
$secid = $row['id'];
$sname = $row['name'];
$Section = array(
  "ID"=>$secid,
  "SectionName"=>$sname,
  "AllSetQuestion"=>array()
);

$res1 = $db->prepare("SELECT  distinct question.id,  question.*, questionimgbylanguage.data FROM ((`papersets` 
 INNER JOIN question ON papersets.qid = question.id) 
 INNER JOIN questionimgbylanguage ON papersets.qid = questionimgbylanguage.qid) where 
 papersets.papershiftid = $psid   ORDER by papersets.qno");
 $res1->execute();


  while($row1 = $res1->fetch()){
  $qid = $row1['id'];
  $qtype = $row1['type'];
  $ques = $row1['data'];
  $mm = $row1['mm'];
  $nm = $row1['nm'];
  $explain = $row1['explanation'];

  $ans1 = $db->prepare("SELECT response,rstatus FROM `response` where enrollment = '$regno'
   and qid = $qid AND papershiftid = $psid");
  $ans1->execute();
  $ansrow1 = $ans1->fetch();

  $resp = $ansrow1['response'];
  $rstatus = $ansrow1['rstatus'];




$AllSetQuestion = array(
  "ID"=>$qid,
  "SectionID"=>$secid,
  "Type"=>$qtype,
  "Question"=>$ques,
  "MM"=>$mm,
  "NM"=>$nm,
  "Explain"=>$explain,
  "response"=>$resp ,
  "status"=>$rstatus,
  "optionModels"=>array()
);


$res2 = $db->prepare("SELECT optionimgbylanguage.*, options.iscorrect FROM options 
INNER JOIN optionimgbylanguage ON optionimgbylanguage.opid = options.id 
 where options.qid = $qid ");
$res2->execute();

while($row2 = $res2->fetch()){
$opid = $row2['opid'];
$option = $row2['data'];
$iscorrect = $row2['iscorrect'];

$OptionModels = array(
  "ID"=>$opid,
  "QuestionID"=>$qid,
  "Option"=>$option,
  "Iscorrect"=>$iscorrect
);
$AllSetQuestion['optionModels'][] = $OptionModels;
}
$Section['AllSetQuestion'][] = $AllSetQuestion;
}


//array_push($SetSQPack[0]['Sections'],$Section);
$SetSQPack['Sections'][] = $Section;
}
echo json_encode($SetSQPack);
}
?>
