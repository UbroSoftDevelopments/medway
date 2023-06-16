<?php
	class fetchrecord 
	{

function examcount(){      
  $userid = 1;
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT count(*) as cnt FROM `exam` where `userid` = $userid");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function centercount(){      
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT count(*) as cnt FROM `center`");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function shiftcount(){      
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT count(*) as cnt FROM `papershift`");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function papercount(){      
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT count(*) as cnt FROM `papermaster`");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function candidatecount(){      
     include('config/dbconnection.php');     
      $result = $db->prepare("SELECT count(*) as cnt FROM `examcandidate`");
          $result->execute();
          $row = $result->fetch();
          return $row;
}

function getlanguage(){	
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT * FROM languagemaster ");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
      	?>
      	<tr>
          <th scope="row"><?php echo $j ?></th>
          <td><?php echo $row['language']; ?></td>
          <!-- <td><button class="btn btn-primary" onclick="editlang(<?php //echo $row['id'] ?>)">Edit</button></td>
          <td><button class="btn btn-primary" onclick="deletelang(<?php //echo $row['id'] ?>)">Delete</button></td> -->
        </tr>
      <?php }
}

function languagedrop(){
  include('config/dbconnection.php');
	$result = $db->prepare("SELECT * FROM languagemaster ");
      $result->execute();?>
      <option>Choose Language</option>
      <?php for($j=1;$row=$result->fetch();$j++){
      	?>
      	<option value="<?php echo $row['id']?>"><?php echo $row['language']?></option>
      <?php }
}

function getexam(){
	$userid = $_SESSION['id']; 
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT * FROM exam where userid = $userid ");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
      	?>
      	<tr>
          <th scope="row"><?php echo $j ?></th>
          <td><?php echo $row['name']; ?></td>
      <?php echo '<td><img src="'.$row['logo'].'" style="width: 50px;height:50px"/></td>'; ?>
          <!-- <td><img src="<?php echo $row['logo'] ?>" style="width: 50px;height:50px"/> </td> -->
          <td><button class="btn btn-primary" onclick="editexam(<?php echo $row['id'] ?>)">Edit</button></td>
          <td><button class="btn btn-primary" onclick="deleteexam(<?php echo $row['id'] ?>)">Delete</button></td>
        </tr>
      <?php }
}

function getcenter(){
	
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT * FROM `center`");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
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

function examdropdown(){
	$userid = $_SESSION['id']; 
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT id,name FROM `exam` where userid = $userid");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
      	?>
        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
      <?php }
}

function centercity(){
  include('config/dbconnection.php');
  $result = $db->prepare("SELECT DISTINCT city FROM `center`");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
        ?>
        <option value="<?php echo $row['city']?>"><?php echo $row['city']?></option>
      <?php }
}

function shiftdropdown(){
  //$userid = $_SESSION['id']; 
  include('config/dbconnection.php');
  $result = $db->prepare("SELECT * FROM `shiftmaster`");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
        ?>
        <option value="<?php echo $row['id']?>"><?php echo $row['starttime']?></option>
      <?php }
}

function examdropdownforsection(){
  $userid = $_SESSION['id']; 
  include('config/dbconnection.php');
  $result = $db->prepare("SELECT id,name FROM `exam` where userid = $userid");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
        ?>
        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
      <?php }
}

function sectiondropdown(){
  // $userid = $_SESSION['id']; 
  include('config/dbconnection.php');
  $result = $db->prepare("SELECT * FROM `section` where `examid` = 1");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
        ?>
        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
      <?php }
}

function centerdropdown(){
	//$userid = $_SESSION['id']; 
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT id,name FROM `center`");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
      	?>
        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
      <?php }
}

function examcandidate(){
	$userid = $_SESSION['id']; 
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT * FROM `examcandidate`");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
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

function candidatelistforresult(){
	$userid = $_SESSION['id']; 
	include('config/dbconnection.php');
	$result = $db->prepare("SELECT enrollmentno,(SELECT name from candidate where id=ex.candidateid) cname,(SELECT photo from candidatephotomaster where candidateid=ex.enrollmentno) photo FROM `examcandidate` ex");
      $result->execute();
      for($j=1;$row=$result->fetch();$j++){
      	?>
        <tr>
        	<td><?php echo $j; ?></td>
        	<td><?php echo $row['cname']; ?></td>
        	<td>
            <img src="<?php echo 'data:image/png;base64,'.$row['photo'] ?>" style="width: 50px;height: 50px;"/> 
           </td>
        	<td><?php echo $row['enrollmentno']; ?></td>
        	<td><button class="btn btn-primary" onclick="getresult('<?php echo $row['enrollmentno'] ?>')">Get Result</button></td>
        </tr>
      <?php }
}

function gcandibasicdetail(){
	$canid = $_GET['cid'];
	include('config/dbconnection.php');
	$sql = 'CALL gcandibasicdetail(:a)';
	$statement = $db->prepare($sql);
	$statement->bindParam(':a', $canid, PDO::PARAM_STR);
	$statement->execute();
	$rows = $statement->fetch(PDO::FETCH_ASSOC);
	return $rows;
}

function gcandieligibility(){
	$canid = $_GET['cid'];
	include('config/dbconnection.php');
	$sql = 'CALL gcandieligibility(:a)';
	$statement = $db->prepare($sql);
	$statement->bindParam(':a', $canid, PDO::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function gcandiaddress(){
	$canid = $_GET['cid'];
	$tblname = "candidate";
	include('config/dbconnection.php');
	$sql = 'CALL gcandiaddress(:a, :b)';
	$statement = $db->prepare($sql);
	$statement->bindParam(':a', $canid, PDO::PARAM_INT);
	$statement->bindParam(':b', $tblname, PDO::PARAM_STR,10);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function gcandidocument(){
	$canid = $_GET['cid'];
	include('config/dbconnection.php');
	$sql = 'CALL gcandidoc(:a)';
	$statement = $db->prepare($sql);
	$statement->bindParam(':a', $canid, PDO::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	return $row;
}

}
?>
