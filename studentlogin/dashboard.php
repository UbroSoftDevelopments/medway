<?php   
   session_start();
    ob_start();
    $userid = $_SESSION['id']; 
    if(isset($userid) && $userid != "")
    {
        require_once('include/function/spl_autoload_register.php');
        //  $userObj = new user;
         $fetchrecordobj = new fetchrecord;
         
        // $centercnt = $fetchrecordobj->centercount();
         //$pprcnt = $fetchrecordobj->papercount();
        // $shiftcnt = $fetchrecordobj->shiftcount();
        // $candidatecnt = $fetchrecordobj->candidatecount();

    } else {
        echo"ABC".$userid;
        // header('Location: index.php'); //redirect URL
    }
    ?>
<?php  include 'head.php';          ?>
<?php  include 'header.php';          ?>
<?php  include 'left-menu.php';          ?>




<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
          <?php $fetchrecordobj->studentcard() ?>
        </div>        
      </div> 
    </section>   
</div>
<?php  include 'footer.php';?>