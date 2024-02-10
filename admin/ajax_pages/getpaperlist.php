<?php

header('Content-Type: application/json');
include('../config/dbconnection.php');
$examid = $_POST['eid'];
$res = array(
  'status' => true,
  'msg' => 'Result List',
  'data' => ''
);
$output = '<div class="card">
<div class="card-body">
  <div class="table-responsive">
    <table id="mainTable" class="table table-bordered table-striped">
      <thead  style="background-color: black;">
        <tr>
          <th class="text-white">#</th>
          <th class="text-white">Name</th>
          <th class="text-white">Code</th>
          <th class="text-white">Duration</th>
          <th class="text-white">Date</th>
          <th class="text-white">Sets</th>
          <th class="text-white">Questions</th>
          <th class="text-white">Marks</th>
          <th class="text-white">Timing / Password</th>      
        </tr>
      </thead>
      <tbody>';
$result = $db->prepare("SELECT * from `papermaster` where `examid` = $examid");
$result->execute();
for ($j = 1; $row = $result->fetch(); $j++) {
  $pid = $row['id'];

  $output .= '<tr>
              <td>' . $j . '</td>
              <td>' . $row['papername'] . '</td>
              <td>' . $row['papercode'] . '</td>
              <td>' . $row['duration'] . '</td>
              <td>' . $row['examdate'] . '</td>
              <td>' . $row['ttlset'] . '</td>
              <td>' . $row['ttlquestions'] . '</td>
              <td>' . $row['ttlmarks'] . '</td>
              <td>';
  $result1 = $db->prepare("SELECT * from `papershift` where `paperid` = $pid");
  $result1->execute();
  for ($i = 1; $row1 = $result1->fetch(); $i++) {
    $output .= '<table>
                      <tr>
                        <td>' . $row1['shifttime'] . '</td>
                        <td>' . $row1['password'] . '</td>
                      </tr>                    
                </table>';
  }
  $output .= '</td></tr>';
}
$output .= '</tbody>
      </table>
    </div>
  </div>
</div>';

$res['data'] = $output;
echo json_encode($res);
?>