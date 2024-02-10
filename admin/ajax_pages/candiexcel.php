<?php

//fetch_candi_data.php

include('../config/dbconnection.php');

$pid = $_POST['pid'];

            // Get Candidate Deatil and fill in Excel.
            $CandidateData = $db->prepare("SELECT *  FROM `candidate` WHERE pprid = $pid");
            $CandidateData->execute();
                        
            $AllSectionCandidate = array();

            while($row1 = $CandidateData->fetch()){
                  $cid = $row1['id'];
                  $c_name = $row1['name'];
                  $roll_no = $row1['reg_no'];
                  $dob = $row1['dob'];

                 array_push($AllSectionCandidate,array(
                  "Candidate Id"=>$cid,
                  "Candidate Name"=>$c_name,
                  "Roll Number"=>$roll_no,
                  "Dob"=>$dob,
                  "Center Code"=>"",
                  
                  ));     
            }       
      
           echo json_encode($AllSectionCandidate);
            // print_r($AllSectionCandidate);

