<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$psid = $_POST['psid'];
$langid = $_POST['langid'];
$secid = $_POST['secid'];

$result = $db->prepare("SELECT question.*, questionimgbylanguage.data, (select name from section where id= $secid) secnm
 FROM question INNER JOIN questionimgbylanguage ON questionimgbylanguage.qid = question.id where papershiftid = $psid and 
 questionimgbylanguage.langid = $langid 
 and question.secid = $secid ");
      $result->execute();
      $output = '<div class="">';
      for($j=1;$row=$result->fetch();$j++){
        $qid = $row['id'];
        $output .= '<h4 >'.$row['secnm'].'</h4>
        <fieldset>
        <legend >Q.no. '.$j.'</legend>
        <span><img src="'.$row['data'].'" class="" /></span><hr>
        ';
        $results = $db->prepare("SELECT optionimgbylanguage.* FROM options INNER JOIN 
        optionimgbylanguage ON optionimgbylanguage.opid = options.id  where options.qid = $qid and optionimgbylanguage.langid = $langid");
        $results->execute();
        for($i=1;$rows=$results->fetch();$i++){
        $output .= '
           <fieldset>
           <legend>'.chr($i+64).'</legend>
           <span><img src="'.$rows['data'].'" class="" /></span>
           </fieldset>
          ';
    }
    $output .= '</fieldset><hr>';
    }
    $output .= '</div>';

echo $output;     
?>
