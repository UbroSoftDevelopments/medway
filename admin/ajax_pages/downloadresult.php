  <?php 
  $pid = $_POST['pid'];
  
  include('../config/dbconnection.php');

  $gmarkobt = 0;
  $ttmmark = 0;
  $per = 0;
  $sts = "";

  $resul = $db->prepare("SELECT papershift.id, examcandidate.candidateid, examcandidate.enrollmentno, candidate.category 
  FROM ((papershift
  INNER JOIN examcandidate ON papershift.id = examcandidate.papershiftid)
  INNER JOIN candidate ON examcandidate.candidateid = candidate.id) where papershift.paperid = $pid"); 
  $resul->execute();
  for($ji=1;$ro=$resul->fetch();$ji++){
    $psid = $ro['id'];
 
    $cid = $ro['candidateid'];
    $cenroll = $ro['enrollmentno'];
    $category = $ro['category'];


  $result = $db->prepare("SELECT * FROM `section` WHERE paperid=$pid"); 
  $result->execute();  

  // section wise result and total
  for($j=1;$row=$result->fetch();$j++){
    $id=$row['id'];
    $secmark=$row['marks'];    
    $ttmmark = $ttmmark + $secmark;

    $result3 = $db->prepare("SELECT sum(marks) as mo from `response` where enrollment= '$cenroll' and 
    qid in (SELECT id FROM `question` where secid = $id)"); 
      $result3->execute();
      $row3=$result3->fetch();
      $mo=$row3['mo'];
      $gmarkobt = $gmarkobt + $mo;
  }
  $per = $per + (($gmarkobt/$ttmmark)*100); 
  echo "Percentage:- ".$per."<br/>";
       if($per < 33){
         $sts = "Fail";
       }else{
         $sts =  "Pass";
       }
  // $per = $per + (($gmarkobt/$ttmmark)*100); 
  
  $sqlenroll = $db->prepare("SELECT enrollment FROM `processedresult` WHERE enrollment= '$cenroll'"); 
  $sqlenroll->execute(); 
  $rowsql=$sqlenroll->fetch();
  if($sqlenroll->rowCount() == 0){
  
  $sql = "INSERT INTO `processedresult`(`candidateid`, `enrollment`, `papershiftid`, `markobtained`,`percentage`, `rank`, `categoryrank`, `category`, `status`)
     VALUES (:cid,:enroll,:psid,:markobt,:per,:rank,:catrank,:cate,:sts) ";
        $r = $db->prepare($sql);  
        $insertvisitor = $r->execute(array(':cid'=>$cid,':enroll'=>$cenroll,':psid'=>$psid,
        ':markobt'=>$gmarkobt,':per'=>$per,':rank'=>1, ':catrank'=>1, ':cate'=> $category, ':sts'=>$sts));
      if($insertvisitor){
        echo "";
        $gmarkobt = 0;
        $ttmmark = 0;
        $per=0;
      }else{
        echo "Not Inserted";
      }
  }else{
    echo "Already Exist";
  }
}
?>
