<!-- link from transacation -->
<?php 
$pprid = $_POST['psid'];

 include('../config/dbconnection.php');
  $result = $db->prepare("SELECT * from `papershift` where `paperid` = $pprid"); 
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
        $psid=$row['id'];
        ?>
        <div class="card">    
          <div class="card-header">
            <h4>Shift Timing  <?php echo $row['shifttime'] ?></h4>
          </div>
          <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped table-bordered">
        <thead style="background-color: black;">
                          <tr>
                           <th class="text-white">#</th>
                           <th class="text-white">Name</th>
                           <th class="text-white">Code</th>
                           <th class="text-white">Counts</th>
                            <!-- <th>Submitted</th>
                            <th>Restricted</th>
                            <th>Absent</th>
                            <th>Allotted</th> -->
                          </tr>
                        </thead>
                        <tbody>                   
          <?php 
          $sql = $db->prepare("SELECT name, code FROM `center` where `paperid` = $psid"); 
          $sql->execute();
          for($i=1;$rowsql=$sql->fetch();$i++){
            $code = $rowsql['code'];
            ?>
                <tr class="table-border border mt-1">
                  <td><?php echo $i." ."; ?></td>
                  <td><?php echo $rowsql['name'] ?></td>
                  <td><?php echo $rowsql['code'] ?></td>
                  <?php 
                  $sqls = $db->prepare("SELECT (COUNT(`ubroStatus`)+ SUM(ISNULL(ubroStatus))) AS ubroStatusCount, ubroStatus
                  FROM  `examcandidate` WHERE centercode = $code and papershiftid = $psid GROUP BY `ubroStatus`
                  ORDER BY `ubroStatusCount`  DESC"); 
                  $sqls->execute();
                  $allotted = 0;
                  ?>
                  <td>
                  <table class="table table-striped">
                  <?php
                  for($k=1;$rowsqls=$sqls->fetch();$k++){
                    $allotted = $allotted + $rowsqls['ubroStatusCount'];
                    ?>
                    <td>
                    <th>
                      <?php
                       if ($rowsqls['ubroStatus'] != '') {
                        # code...
                        echo $rowsqls['ubroStatus']. ' : '. $rowsqls['ubroStatusCount'];
                      
                       } else {
                        # code...
                        echo 'Absent : '. $rowsqls['ubroStatusCount'];
                       }
                       
                       ?>
                       </th>
                     
                    </td>
                
                  <?php }
                  ?>
                   <td>
                        <th>Allotted : <?php echo $allotted ?></th>
                  </td>
                  </table>
                  </td>
                </tr>
          <?php }?>
                        </tbody>
                      </table>
                  </div>
          </div>
        </div> 
        <?php }?>





