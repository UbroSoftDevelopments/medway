  <?php
  $pid = $_POST['pid'];
  header('Content-Type: application/json');
  include('../config/dbconnection.php');

  $res = array(
    'status' => false,
    'msg' => 'Inital',
    'data' => ''
  );

  $isAllCorrectGiven = true;
  $isUpdMarkSucess = true;
  $dataHtml = ' <div class="table-responsive">
  <table class="table table-striped table-bordered">
      <thead style="background-color: black;">
      <tr>
       <th class="text-white">#</th>
       <th class="text-white">Question Count</th>
       <th class="text-white">Correct Count</th>
       <th class="text-white">Section Name</th>
      </tr>
    </thead>
    <tbody>';

  //First check is Correct is added in Question or not;
  $sectionSql = $db->prepare("SELECT * from section where paperid = $pid");
  $sectionSql->execute();
  for ($i = 0; $section = $sectionSql->fetch(); $i++) {
    $secid = $section['id'];
    $iscorrectSql = $db->prepare("SELECT count(options.id) as iscorrectcount from question inner join 
    options on question.id = options.qid 
    where question.secid = $secid and options.iscorrect = 1");
    $iscorrectSql->execute();
    $iscorrectCount = $iscorrectSql->fetch();
    $correctCnt = $iscorrectCount['iscorrectcount'];

    $questionCountSql = $db->prepare("SELECT count(id) as questioncount from question where  secid = $secid");
    $questionCountSql->execute();
    $questionCount = $questionCountSql->fetch();
    $questionCnt = $questionCount['questioncount'];

    $dataHtml = $dataHtml .
      '<tr><td>' . $secid . '</td>
  <td>' . $questionCnt . '</td>
  <td>' . $correctCnt . '</td>
  <td>' . $section["name"] . '</td></tr>';

    if ($correctCnt != $questionCnt) {
      $isAllCorrectGiven = false;
    }
  }
  if (!$isAllCorrectGiven) {
    $dataHtml =  $dataHtml . '</tbody></table>';

    $res['msg'] = 'Please provide all correct Option of the question to process the result';
    $res['data'] = $dataHtml;
    echo json_encode($res);
    return;
  } else 
  {

    //section
    $sectionSql_1 = $db->prepare("SELECT * from section where paperid = $pid");
    $sectionSql_1->execute();
    for ($r = 0; $sectionSqlRow = $sectionSql_1->fetch(); $r++) {
      $sid = $sectionSqlRow['id'];
      //question with correct opt
      $questionSql_1 = $db->prepare("SELECT options.id as correctoptid,options.qid,question.mm,question.nm 
      from question inner join options on question.id = options.qid where question.secid = $sid and options.iscorrect = 1 
      ");
      $questionSql_1->execute();
      for ($u = 0; $questionSqlRow = $questionSql_1->fetch(); $u++) {
        $_correctoptid = $questionSqlRow['correctoptid'];
        $_qid = $questionSqlRow['qid'];
        $_mm = $questionSqlRow['mm'];
        $_nm = $questionSqlRow['nm'];

        $update1 = $db->prepare("UPDATE response SET marks = CASE WHEN response = $_correctoptid THEN $_mm ELSE $_nm 
        END WHERE qid =$_qid AND response !=0"); 
        $update1->execute();
        if(!$update1){
          $isUpdMarkSucess = false;
        
        }
      }
    }

    if(!$isUpdMarkSucess){
      $res['msg'] = 'Something Went Wrong While Updating Marks! Please Try Again...';
      echo json_encode($res);
      return;
    }else{
      $updatepprsts = $db->prepare("UPDATE papermaster SET resultstatus = 'PROCESSED' WHERE id = $pid "); 
      $updatepprsts->execute();
      $res['status'] = true;
      $res['msg'] = 'Successfully Result Processed !!!';
      echo json_encode($res);
      return;
    }
  }

  echo json_encode($res);
  ?>


