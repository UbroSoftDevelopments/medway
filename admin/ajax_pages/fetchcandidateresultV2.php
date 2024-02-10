  <?php
  $pid = $_POST['pid'];
  header('Content-Type: application/json');
  include('../config/dbconnection.php');
  $res = array(
    'status' => true,
    'msg' => 'Result List',
    'data' => ''
  );
  $SecArray = array();

  $dataHtml = ' <div class="table-responsive">
  <table class="table table-striped table-bordered " id="example">
      <thead style="background-color: black;">
        <tr>
          <th class="text-white">#</th>
          <th class="text-white">Name</th>
          <th class="text-white">Dob</th>
          <th class="text-white">Email Id</th>
          <th class="text-white">Mobile No.</th>
          <th class="text-white">Gender</th>
          <th class="text-white">Category</th>
          <th class="text-white">Enrollment</th>
          <th class="text-white">Status</th>
        ';



  $sectionSql = $db->prepare("SELECT * from section where paperid = $pid");
  $sectionSql->execute();
  for ($i = 0; $section = $sectionSql->fetch(); $i++) {
    $SecArray[] = array('id' => $section['id'], 'secName' =>  $section['name'], 'secmarks' => $section['marks']);

    $dataHtml = $dataHtml . '<th class="text-white">' . $section['name'] . '</th>';
  }
  $dataHtml = $dataHtml . '  <th class="text-white">Total Marks</th>
          <th class="text-white">Percentage</th></tr>
          </thead>
          <tbody>';

  $candidateSql = $db->prepare("SELECT DISTINCT examcandidate.ubroStatus, papershift.id, examcandidate.candidateid,
   examcandidate.enrollmentno, candidate.name, candidate.category,candidate.dob,candidate.gender
  FROM ((papershift
  INNER JOIN examcandidate ON papershift.id = examcandidate.papershiftid)
  INNER JOIN candidate ON examcandidate.candidateid = candidate.id)
   where papershift.paperid = $pid
");
  $candidateSql->execute();
  for ($j = 1; $candiRow = $candidateSql->fetch(); $j++) {
    $papershift = $candiRow['id'];
    $enroll = $candiRow['enrollmentno'];
    $candiid = $candiRow['candidateid'];
    $candiname = $candiRow['name'];
    $candidob = $candiRow['dob'];
    $candi_email = $db->prepare("SELECT contact_value FROM contacts where candidateid = $candiid and contact_type = 'email'");
    $candi_email->execute();
    $row_email = $candi_email->fetch();
    $candiemail = $row_email['contact_value'];
    $candi_mob = $db->prepare("SELECT contact_value FROM contacts where candidateid = $candiid and contact_type = 'mob_student'");
    $candi_mob->execute();
    $row_mob = $candi_mob->fetch();
    $candimob = $row_mob['contact_value'];
    $candigender = $candiRow['gender'];
    $candicategory = $candiRow['category'];
    $candistatus = $candiRow['ubroStatus'];
    if ($candistatus == "") {
      $candistatus = "Absent";
    }
    $stautsHtml = '';
    if ($candistatus == "Absent") {
      $stautsHtml = '<div class="badge badge-warning badge-shadow">' . $candistatus . '</div>';
    } else {
      $stautsHtml = '<div class="badge badge-success badge-shadow">Submitted</div>';
    }

    $dataHtml = $dataHtml .
      '<tr class="table-border border" ><td>' . $j . '</td>
      <td>' . $candiname . '</td>
      <td>' . $candidob . '</td>
      <td>' . $candiemail . '</td>
      <td>' . $candimob . '</td>
      <td>' . $candigender . '</td>
      <td>' . $candicategory . '</td>
      <td>' . $enroll . '</td>
      <td>' . $stautsHtml . '</td>';

    $totalmarks = 0;
    $ttlpprmarks = 0;

    foreach ($SecArray as $sec) {

      $secid = $sec['id'];
      $markSql = $db->prepare("SELECT sum(response.marks) as marks from question inner join response on question.id = response.qid 
  where question.secid =$secid and response.enrollment = $enroll and `response`.`papershiftid` = $papershift");
      $markSql->execute();
      $marksRow = $markSql->fetch();
      $_marks = $marksRow['marks'];
      if ($_marks == "") {
        $_marks = 0;
      }

      $dataHtml = $dataHtml . '<td>' . $_marks . '</td>';
      $ttlpprmarks = $ttlpprmarks + $sec['secmarks'];
      $totalmarks = $totalmarks + $_marks;
    }
    $percentage =  number_format((float)($totalmarks/$ttlpprmarks)*100, 2, '.', '');
    $dataHtml = $dataHtml .
      '<td>' . $totalmarks . '</td>
   <td>' . $percentage . '%</td> </tr>';
  }

  $dataHtml =  $dataHtml . '</tbody></table>';

  $res['data'] = $dataHtml;
  echo json_encode($res);
  ?>
 