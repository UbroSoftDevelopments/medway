<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$psid = $_POST['psid'];
$sid = $_POST['sid'];
$langid = $_POST['langid'];
$btndiv = "";
//$allid = array();

$result = $db->prepare("SELECT question.*, questionimgbylanguage.data FROM question INNER JOIN questionimgbylanguage 
    ON questionimgbylanguage.qid = question.id where papershiftid = $psid and secid=$sid and questionimgbylanguage.langid = $langid");
      $result->execute();
      $output = '<table class="table table-bordered"><thead><tr><th>S.No.</th><th>Question</th><th>Action</th></thead><tbody>';
      for($j=1;$row=$result->fetch();$j++){
        $qid = $row['id'];        
        $type=$row['type'];
        if($row['type'] == 2){
          $btndiv .= '<a href="previewquestion.php?qid='.$qid.'&&langid='.$langid.'" target="_blank"> 
          <button class="btn btn-primary">View</button></a>';
        }
        
        $output .= '<tr style="border:2px solid"><td><b>'.$j.'.</b></td><td><img class="img-fluid" alt="queston image" src="'.$row['data'].'"/></td><td>'.$btndiv.'
        </td></tr>';
        $btndiv = "";
        
      }
    $output .= '</tbody></table>';
echo $output;     
?>
