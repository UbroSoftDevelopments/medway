<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$psid = $_POST['psid'];
$langid = $_POST['langid'];
$array = Array();
$result = $db->prepare("SELECT questionimgbylanguage.*, (select name from section where id= question.secid) secnm
FROM question INNER JOIN questionimgbylanguage ON questionimgbylanguage.qid = question.id 
where question.papershiftid = $psid AND questionimgbylanguage.langid = $langid ORDER by question.id asc");
      $result->execute();
      $output = '<div class="">';
      for($j=1;$row=$result->fetch();$j++){
        $qid = $row['qid'];
        $output .= '<h4 >'.$row['secnm'].'</h4>
        <fieldset>
        <legend >Q.no. '.$j.' , '.$qid.'</legend>
        <span><img src="'.$row['data'].'" class="img-fluid" /></span<hr>
        ';
        $results = $db->prepare("SELECT options.*, optionimgbylanguage.data FROM options INNER JOIN
         optionimgbylanguage ON optionimgbylanguage.opid = options.id where options.qid = $qid
          AND optionimgbylanguage.langid = $langid");
      $results->execute();
      for($i=1;$rows=$results->fetch();$i++){
        $tempSelect = $rows['iscorrect'] == 1 ? "checked" : "";
        $output .= '
           <fieldset class="ophover" onclick="opid('.$rows['id'].','.$qid.')">
           <legend>'.chr($i+64). ' , '.$rows['id'].'</legend>
           <input type="radio" '.$tempSelect.' name="'.$qid.'" id="correctoption'.$rows['id'].'" />
           <span><img src="'.$rows['data'].'" class="img-fluid" /></span>
           </fieldset>
          ';
    }
    $output .= '</fieldset><hr><br/>';
    }
    $output .= '</div>';

echo $output;
?>
