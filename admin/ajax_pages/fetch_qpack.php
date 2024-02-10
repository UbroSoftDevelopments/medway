<?php
//fetch_images.php
header('Content-Type: application/json');
include('../config/dbconnection.php');
$pid = $_POST['pid'];
$set = $_POST['set'];
$psid = $_POST['psid'];   
$langid = $_POST['langid'];   

$SetSQPack = array(
  "SetNo"=>$set,
  "Sections"=>array()
);
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

$res1 = $db->prepare("SELECT question.*, questionimgbylanguage.data FROM ((`papersets` 
 INNER JOIN question ON papersets.qid = question.id) 
INNER JOIN questionimgbylanguage ON papersets.qid = questionimgbylanguage.qid) where 
papersets.papershiftid = $psid  and papersets.setno = $set and question.secid = $secid 
and questionimgbylanguage.langid = $langid ORDER by papersets.qno");
$res1->execute();

while($row1 = $res1->fetch()){
$qid = $row1['id'];
$qtype = $row1['type'];
$ques = $row1['data'];
$mm = $row1['mm'];
$nm = $row1['nm'];
$AllSetQuestion = array(
  "ID"=>$qid,
  "SectionID"=>$secid,
  "Type"=>$qtype,
  "Question"=>$ques,
  "MM"=>$mm,
  "NM"=>$nm,
  "response"=>"",
  "status"=>"",
  "optionModels"=>array()
);


$res2 = $db->prepare("SELECT optionimgbylanguage.* FROM options 
INNER JOIN optionimgbylanguage ON optionimgbylanguage.opid = options.id  where
 options.qid = $qid and optionimgbylanguage.langid = $langid");
$res2->execute();

while($row2 = $res2->fetch()){
$opid = $row2['opid'];
$option = $row2['data'];
$OptionModels = array(
  "ID"=>$opid,
  "QuestionID"=>$qid,
  "Option"=>$option
);
$AllSetQuestion['optionModels'][] = $OptionModels;
}
$Section['AllSetQuestion'][] = $AllSetQuestion;
}

//array_push($SetSQPack[0]['Sections'],$Section);
$SetSQPack['Sections'][] = $Section;
}
echo json_encode($SetSQPack);
