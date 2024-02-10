<?php

//fetch_images.php

include('../config/dbconnection.php');

$qid = $_POST['qid'];

$result = $db->prepare("SELECT question FROM question where id = $qid ");
      $result->execute();
      $output = '<div class="">';
      for($j=1;$row=$result->fetch();$j++){
        $output .= 
        '<fieldset>
        <legend>
        <img src="data:image/jpeg;base64,'.$row['question'].'" class="qclass" />
        <label id="opid"></label>
        </legend>
        ';
        $results = $db->prepare("SELECT * FROM options where qid = $qid ");
      $results->execute();
      for($i=1;$rows=$results->fetch();$i++){
        $output .= '<fieldset>
          <legend class="ophover" onclick="opid('.$rows['id'].')">
           <input type="radio" /><img src="data:image/jpeg;base64,'.$rows['oPtion'].'" class="" />
          </legend>
          </fieldset>
          ';
    }
    $output .= '</fieldset>';
    }
    $output .= '</div>';

echo $output;
?>
