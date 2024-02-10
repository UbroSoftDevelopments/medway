  <?php 
  $pid = $_POST['pid'];

  include('../config/dbconnection.php');

  $sql = $db->prepare("SELECT processedresult.id FROM `papershift` INNER JOIN
   processedresult ON papershift.id = processedresult.papershiftid  where paperid = $pid"); 
  $sql->execute();
  if($sql->rowCount() > 0){
    echo "Found";
  }else{
  $resul = $db->prepare("SELECT response.* FROM `papershift` INNER JOIN response
   ON papershift.id = response.papershiftid where paperid = $pid"); 
  $resul->execute();
  for($ji=1;$ro=$resul->fetch();$ji++){
    $id=$ro['id'];
    $qid=$ro['qid'];
    $resp=$ro['response'];
    if($resp!="0"){
      $result2 = $db->prepare("SELECT question.mm,question.nm, options.iscorrect  FROM `options`
       INNER JOIN question ON $qid = question.id where options.id=$resp"); 
      $result2->execute();
      $row2=$result2->fetch();
      $iscorrect=$row2['iscorrect'] ?? 'default value';
      
      $marks=0;

      $nm=$row2['nm']?? 'default value';
      $mm=$row2['mm']?? 'default value';
      if($iscorrect == 0){
       $marks=0-$nm;  
      }else{
        $marks=$mm;  
      }
      $update1 = $db->prepare("UPDATE `response` set `marks` = '$marks' where `id` = $id"); 
      $update1->execute();
      if($update1){
        echo "up";
      }else{
        echo "down";
      }
    }
  }
}
?>


