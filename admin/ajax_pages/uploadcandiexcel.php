<?php

include('../config/dbconnection.php');

$pshifttime = $_POST['pshifttime'];
$jsondt = $_POST['jsondt'];
//print_r($jsondt);
$status = 1;
$msgdt = "";
$exid = $_GET['ubexid'];

// Extracting row by row
foreach($jsondt as $row) {
        // $city=$row['City'];
        $candi_id=$row['Candidate Id'];
        // $candiname=$row['Candidate Name'];
        $enroll = $row['Roll Number'];
        $originalDate = $row['Dob'];
        $passdob = date("d-m-Y", strtotime($originalDate));
        //echo $row['Dob'];
        //$phpexcepDate = $row['Dob']-25569; //to offset to Unix epoch
        // $passdob=date('d-m-Y' ,strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970)));
        //$passdob = $row['Dob'];
        // $category=$row['Category'];
        // $gender=$row['Gender'];
        $centercode=$row['Center Code'];

        $query = $db->query("SELECT examcandidate.*, candidate.* FROM (`examcandidate`
        INNER JOIN candidate ON `examcandidate`.candidateid = candidate.id) where `enrollmentno` = '$enroll' and `papershiftid` = $pshifttime and
         `centercode` = '$centercode'");
        if($query->rowCount() > 0){ 
          $msgdt = "Not";
        }else{
        // if( $city!=''){
        // $sql = "INSERT INTO `candidate`(`name`, `dob`, `gender`, `category`, `city`, `state`) VALUES (:cname,:dob,:gender,:category,:city,:state)";
        // $r = $db->prepare($sql);
        // $insertvisitor = $r->execute(array(':cname'=>$row['Candidate Name'], ':dob'=>$passdob, ':gender'=>$row['Gender'],
        //  ':category'=> $row['Category'], ':city'=>$row['City'], ':state'=>$row['State']));       
        // if($insertvisitor){ 
        //     $last_id = $db->lastInsertId();
        //     $insert = $db->query("INSERT INTO `candidatephotomaster`(`photo`, `signature`, `candidateid`) VALUES ('','','$enroll')"); 
        //      if($insert){ 
            $result = $db->prepare("SELECT (SELECT `duration` FROM `papermaster` where id=cen.paperid) altime FROM `center` cen WHERE code='$centercode'");
            $result->execute();
            $rows = $result->fetch();
            $duration = $rows['altime'];

          $sql2 = "INSERT INTO `examcandidate`(`candidateid`, `centercode`, `papershiftid`, `enrollmentno`, `password`, `allotedtime`, `setno`, `status`)
            VALUES (:lastid,:centercode,:pshifttime,:enroll,:passdob,:duration,:setno,:sts)";
          $rs = $db->prepare($sql2);
          $insertexamcandi = $rs->execute(array(':lastid'=>$candi_id, ':centercode'=>$centercode, ':pshifttime'=>$pshifttime, 
          ':enroll'=> $enroll, ':passdob'=>$passdob, ':duration'=>$duration, ':setno'=>$status, ':sts'=>$status));       
            if($insertexamcandi){ 
              $msgdt = "Candidate Data Uploaded Successfully";
            }else{
              $msgdt = "Candidate Data Not Uploaded";
            }            
      //     }else{ 
      //         echo "<div class='list-group-item list-group-item-danger'>Data not successfully Inserted.</div>" ;
      //      }
      //     }else{ 
      //     echo 'Not Inserted'; 
      // }
    }
  // }
}
$update = $db->query("UPDATE `ub_status` SET `examcandidate`= 1 WHERE examid = $exid");
$update->execute();
echo $msgdt;
   
?>