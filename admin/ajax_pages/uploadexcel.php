<?php
include('../config/dbconnection.php');
$exid = $_POST['exid'];
$langid = $_POST['langid'];
$list = $_POST['dt'];
$secid = $_POST['secid'];
$psid = $_POST['psid'];
$pid = $_POST['pid'];
$ques_count = 0;

$resultcount = $db->prepare("SELECT count(questionimgbylanguage.id) as count, 
(SELECT ttlquestions from papermaster where id = $pid ) ttlques FROM (`question` 
INNER JOIN questionimgbylanguage on question.id = questionimgbylanguage.qid )
 where papershiftid = $psid  GROUP BY secid");
$resultcount->execute();
for ($j = 1; $rowcnt = $resultcount->fetch(); $j++) {
    $ques_count = $ques_count + $rowcnt['count'];
    if ($ques_count == $rowcnt['ttlques']) {
        $update = $db->query("UPDATE `ub_status` SET `question`= 1 WHERE examid = $exid");
        $update->execute();
        echo "201";
        return;
    }
}


$result = $db->prepare("SELECT COUNT(questionimgbylanguage.id) as count, section.totalquestion, section.name FROM ((`question` 
INNER JOIN questionimgbylanguage on question.id = questionimgbylanguage.qid )
INNER JOIN section on question.secid = section.id ) where papershiftid = $psid and question.secid=$secid GROUP BY secid;");
$result->execute();
$row = $result->fetch();

if ($row['count'] == $row['totalquestion']) {
    echo "404";
    return;
} else {
    for ($i = 0; $i < count($list); $i++) {

        $qid = $list[$i]['qid'];
        $type = $list[$i]['types'];
        $mms = $list[$i]['mms'];
        $nms = $list[$i]['nms'];
        $ol1 = $list[$i]['ol1'];
        $ol2 = $list[$i]['ol2'];
        $ol3 = $list[$i]['ol3'];
        $ol4 = $list[$i]['ol4'];
        $question = $list[$i]['question'];
        $opt1 = $list[$i]['opt1'];
        $opt2 = $list[$i]['opt2'];
        $opt3 = $list[$i]['opt3'];
        $opt4 = $list[$i]['opt4'];
        $explain = $list[$i]['explain'];

        $insert = $db->query("UPDATE `question` SET `explanation`='$explain', `type`=$type, `mm`=$mms, `nm`=$nms WHERE id = $qid");
        if ($insert) {
            // echo "Data Inserted".$i;
            $sql = "INSERT INTO `questionimgbylanguage`(`qid`, `langid`, `data`) VALUES (:qid,:langid,:qdata)";
            $r = $db->prepare($sql);
            $insertvisitor = $r->execute(array(':qid' => $qid, ':langid' => $langid, ':qdata' => $question));
            if ($insertvisitor) {

                // begin the transaction
                $db->beginTransaction();
                // our SQL statements
                $db->exec("INSERT INTO `optionimgbylanguage`(`opid`,`langid`,`data`)
                        VALUES ($ol1, $langid, '$opt1')");
                $db->exec("INSERT INTO `optionimgbylanguage`(`opid`,`langid`,`data`)
                        VALUES ($ol2, $langid, '$opt2')");
                $db->exec("INSERT INTO `optionimgbylanguage`(`opid`,`langid`,`data`)
                        VALUES ($ol3, $langid, '$opt3')");
                $db->exec("INSERT INTO `optionimgbylanguage`(`opid`,`langid`,`data`)
                        VALUES ($ol4, $langid, '$opt4')");
                // commit the transaction
                $db->commit();
                //echo "New records created successfully";                            
            }
        }
    }
    echo "200";
}
