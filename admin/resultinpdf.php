<?php   
    $pid = $_GET['psid'];
    //$cat = $_POST['cat'];
    include('config/dbconnection.php');
    ?>
<?php include "head.php"; ?>
<style>
@media print {
  #printPageButton {
    display: none;
  }
}
</style>
<!-- Main Content -->
<div class="container ">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Result</h4>
                    <button id="printPageButton" class="btn btn-info" onClick="window.print();">Download</button>

                  </div>                
                  <div class="card-body">
                  <table class="table table-bordered table-striped">
                        <thead style="background-color: black;color:white">
                                            <tr>
                                            <th scope="col" class="text-white">Sr</th>
                                            <th scope="col" class="text-white">Enrollment No.</th>
                                            <th scope="col" class="text-white">Name</th>
                                            <th scope="col" class="text-white">Dob</th>                          
                                            <th scope="col" class="text-white">Gender</th>
                                            <th scope="col" class="text-white">Category</th>
                                            <th scope="col" class="text-white">Marks</th>
                                            <th scope="col" class="text-white">Percentage</th>
                                            <!-- <th scope="col" class="text-white">Rank</th> -->
                                            <th scope="col" class="text-white">Status</th>

                                            </tr>
                        </thead>
                        <tbody >
                            <?php
                            $resul = $db->query("SELECT id, (SELECT sum(marks) FROM section where paperid = $pid) as ttlmark FROM `papershift` ps where paperid = $pid");
                            for($ji=1;$ro=$resul->fetch();$ji++){
                                $psid = $ro['id'];

                                $query = $db->query("SELECT *, (SELECT name from candidate where id=pr.candidateid) cname,
                            (SELECT dob from candidate where id=pr.candidateid) dob,
                            (SELECT gender from candidate where id=pr.candidateid) gender
                            FROM `processedresult` pr where papershiftid = $psid ORDER BY percentage DESC");
                            if($query->rowCount() >= 0){
                                // Output each row of the data
                                for($i=1;$row = $query->fetch();$i++){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['enrollment']; ?></td>
                                        <td><?php echo $row['cname']; ?></td>
                                        <td><?php echo $row['dob']; ?></td>
                                        <!-- <img src="<?php //echo 'data:image/png;base64,'.$row['photo'] ?>" style="width: 50px;height: 50px;"/>  -->        
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['markobtained'] . ' / ' . $ro['ttlmark']; ?></td>
                                        <td><?php echo $row['percentage'].'%'; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                    </tr>
                                <?php
                                }
                            }else{
                                echo '<script>swal("Sorry!", "No Record Found", "success");</script>';
                            }
                            }?>
                         </tbody>
                    </table>
                  </div>                
                </div>
              </div>
            </div>
          </div>
        </section>
</div>
</body>
</html>