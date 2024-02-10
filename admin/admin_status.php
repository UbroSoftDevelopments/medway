<!--Admin CRUD Status -->
<?php 
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
?>
<div class="row">
  <div class="col-12">
    <div class="card card-danger">
      <div class="card-body">
        <div class="progress">
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Paper
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Rule
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Section
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Language
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Question
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Correct Answer
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Question Set
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Center
          </div>
          <div class="progress-bar bg-dark bor-right-clr" style="width:20%">
            Candiadte
          </div>
        </div>
        
        <div class="progress mt-1">
          
            <?php 
            if($ubstatus['paper'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
          
            <?php 
            if($ubstatus['rule'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
          
            <?php 
            if($ubstatus['section'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
          
            <?php 
            if($ubstatus['language'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>

            <?php 
            if($ubstatus['question'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
          
            <?php 
            if($ubstatus['correctanswer'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
            <?php 
            if($ubstatus['questionset'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }
            ?>
          
          
            <?php 
            if($ubstatus['center'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }

            if($ubstatus['examcandidate'] == 0){
              echo '<div class="progress-bar bor-right-clr bg-danger" style="width:20%">False</div>';
            }else{
              echo '<div class="progress-bar bor-right-clr bg-info" style="width:20%">True</div>';
            }

            ?>
          
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Admin CRUD Status End -->