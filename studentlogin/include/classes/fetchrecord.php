<?php
class fetchrecord
{

  function studentcard(){
    include('config/dbconnection.php');
    
   $enroll = $_SESSION['rollno'];
   $result = $db->prepare("SELECT examcandidate.papershiftid,papermaster.id,papermaster.papername FROM ((examcandidate inner join papershift on examcandidate.papershiftid = papershift.id) 
   inner join papermaster on papershift.paperid = papermaster.id) where enrollmentno = '$enroll' and examStartTime !=''");
    $result->execute();
    for($i = 0;$row = $result->fetch();$i++){
      echo '<div class="col-12 col-md-6 col-lg-4">
      <a href="answerkey.php?psid='.$row['papershiftid'].'&&pid='.$row['id'].'" target="_blank" style="text-decoration: none;">
        <div class="card card-warning">
        <div class="card-body">
          <div class="media">
            <img class="mr-3" src="../admin/assets/icons/Total Candidate.png" alt="Exam Image">
            <div class="media-body">
              <h6 class="mt-0">Answer key</h6>
              <h6 class="mt-0">'.$row['papername'].'</h6>              
            </div>
          </div>
        </div>
        </div>
      </a>
    </div>';
    }
  }

  
  function paperdatabyenrollment()
  {
    include('config/dbconnection.php');
    
    $enroll = $_SESSION['rollno'];
    $result = $db->prepare("SELECT distinct resp.papershiftid,
    resp.enrollment, examcandidate.candidateid,  papershift.paperid, papermaster.papername,
   papershift.shifttime FROM (((response as resp
   inner join examcandidate on resp.enrollment = examcandidate.enrollmentno)
   inner join papershift on resp.papershiftid = papershift.id)
   inner join papermaster on papershift.paperid = papermaster.id)
   where resp.enrollment = '$enroll'");
    $result->execute();
    for($i = 0;$row = $result->fetch();$i++){
      echo '<div class="col-12 col-md-6 col-lg-4">
      <a href="answerkey.php?psid='.$row['papershiftid'].'&&pid='.$row['paperid'].'" target="_blank" style="text-decoration: none;">
        <div class="card card-warning">
        <div class="card-body">
          <div class="media">
            <img class="mr-3" src="../admin/assets/icons/Total Candidate.png" alt="Exam Image">
            <div class="media-body">
              <h6 class="mt-0">Answer key</h6>
              <h6 class="mt-0">'.$row['papername'].'</h6>              
            </div>
          </div>
        </div>
        </div>
      </a>
    </div>';
    }
  }

  function examimg()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM `exam`");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function candidata(){
    $enroll = $_SESSION['rollno'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT candidate.name, papermaster.papername FROM `candidate`
     INNER JOIN papermaster on candidate.pprid = papermaster.id WHERE candidate.reg_no = $enroll");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  
  function candimarks(){
    $enroll = $_SESSION['rollno'];
    $psid = $_GET['psid'];
    include('config/dbconnection.php');
    $result = $db->prepare("select sum(marks) as marks from response where papershiftid = $psid and enrollment = $enroll");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }


  function examcount()
  {
    $userid = 1;
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT count(*) as cnt FROM `exam` where `userid` = $userid");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function centercount()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT count(*) as cnt FROM `center`");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function shiftcount()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT count(*) as cnt FROM `papershift`");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function papercount()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT count(*) as cnt FROM `papermaster`");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function candidatecount()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT count(*) as cnt FROM `candidate`");
    $result->execute();
    $row = $result->fetch();
    return $row;
  }

  function getlanguage()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM languagemaster ");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
?>
      <tr>
        <th scope="row"><?php echo $j ?></th>
        <td><?php echo $row['language']; ?></td>
        <!-- <td><button class="btn btn-primary" onclick="editlang(<?php //echo $row['id'] 
                                                                    ?>)">Edit</button></td>
          <td><button class="btn btn-primary" onclick="deletelang(<?php //echo $row['id'] 
                                                                  ?>)">Delete</button></td> -->
      </tr>
    <?php }
  }

  function languagedrop()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM languagemaster ");
    $result->execute(); ?>
    <option>Choose Language</option>
    <?php for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['language'] ?></option>
    <?php }
  }

  function getexam()
  {
    $userid = $_SESSION['id'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM exam where userid = $userid ");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <tr>
        <th scope="row"><?php echo $j ?></th>
        <td><?php echo $row['name']; ?></td>
        <?php echo '<td><img src="' . $row['logo'] . '" style="width: 50px;height:50px"/></td>'; ?>
        <!-- <td><img src="<?php echo $row['logo'] ?>" style="width: 50px;height:50px"/> </td> -->
        <td><button class="btn btn-primary" onclick="editexam(<?php echo $row['id'] ?>)">Edit</button></td>
        <td><button class="btn btn-primary" onclick="deleteexam(<?php echo $row['id'] ?>)">Delete</button></td>
      </tr>
    <?php }
  }

  function getcenter()
  {

    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM `center`");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <tr>
        <th><?php echo $j ?></th>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['landmark']; ?></td>
        <td><?php echo $row['pincode']; ?></td>
        <td><?php echo $row['city']; ?></td>
        <td><?php echo $row['state']; ?></td>
        <td><?php echo $row['capacity']; ?></td>
        <td><?php echo $row['paperid']; ?></td>
      </tr>
    <?php }
  }

  function examdropdown()
  {
    $userid = $_SESSION['id'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT id,name FROM `exam` where userid = $userid");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php }
  }

  function centercity()
  {
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT DISTINCT city FROM `center`");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['city'] ?>"><?php echo $row['city'] ?></option>
    <?php }
  }

  function shiftdropdown()
  {
    //$userid = $_SESSION['id']; 
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM `shiftmaster`");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['starttime'] ?></option>
    <?php }
  }

  function examdropdownforsection()
  {
    $userid = $_SESSION['id'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT id,name FROM `exam` where userid = $userid");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php }
  }

  function sectiondropdown()
  {
    // $userid = $_SESSION['id']; 
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM `section` where `examid` = 1");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php }
  }

  function centerdropdown()
  {
    //$userid = $_SESSION['id']; 
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT id,name FROM `center`");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php }
  }

  function examcandidate()
  {
    $userid = $_SESSION['id'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM `examcandidate`");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $row['candidateid']; ?></td>
        <td><?php echo $row['shiftid']; ?></td>
        <td><?php echo $row['enrollmentno']; ?></td>
        <td><?php echo $row['password']; ?></td>
        <td><?php echo $row['allotedtime']; ?></td>
      </tr>
    <?php }
  }

  function candidatelistforresult()
  {
    $userid = $_SESSION['id'];
    include('config/dbconnection.php');
    $result = $db->prepare("SELECT enrollmentno,(SELECT name from candidate where id=ex.candidateid) cname,(SELECT photo from candidatephotomaster where candidateid=ex.enrollmentno) photo FROM `examcandidate` ex");
    $result->execute();
    for ($j = 1; $row = $result->fetch(); $j++) {
    ?>
      <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $row['cname']; ?></td>
        <td>
          <img src="<?php echo 'data:image/png;base64,' . $row['photo'] ?>" style="width: 50px;height: 50px;" />
        </td>
        <td><?php echo $row['enrollmentno']; ?></td>
        <td><button class="btn btn-primary" onclick="getresult('<?php echo $row['enrollmentno'] ?>')">Get Result</button></td>
      </tr>
<?php }
  }


}
?>