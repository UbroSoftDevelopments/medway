<?php
header('Content-Type: application/json');
    include('../config/dbconnection.php');
    $psid = $_POST['psid'];
    $center = $_POST['center'];

    $res = array(
      'status' => true,
      'msg' => 'Result List',
      'data' => ''
    );
  $output = ' <div class="card">
              <div class="card-body">
              <table class="table table-bordered table-striped" id="canditable">
               <thead style="background-color: black;">
                <tr>                
                  <th class="text-white">#</th>
                  <th class="text-white">Name</th>
                  <th class="text-white">Enrollmentno</th>
                  <th class="text-white">Alloted Time</th>
                  <th class="text-white">Set No</th>
                  <th class="text-white">Shift</th>
                </tr>
                </thead>
                <tbody>';

    $result = $db->prepare("SELECT ex.enrollmentno,ex.allotedtime,ex.setno,
     (Select name from candidate where id=ex.candidateid) cname,  
    (Select shifttime from papershift where id=ex.papershiftid) shifttime FROM `examcandidate` ex 
    where ex.papershiftid = $psid and ex.centercode = '$center'");
      $result->execute();
      
      for($j=1;$row=$result->fetch();$j++){
        $output .="
        <tr>
            <td>".$j."</td>
            <td>".$row['cname']."</td>
            <td>".$row['enrollmentno']."</td>
            <td>".$row['allotedtime']."</td>
            <td>".$row['setno']."</td>
            <td>".$row['shifttime']."</td>
        </tr>";
      }  
      $output .= '</tbody></table></div></div>';

  $res['data'] = $output;
  echo json_encode($res);
?>