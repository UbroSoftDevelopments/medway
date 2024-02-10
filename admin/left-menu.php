<!-- Left Menu -->
<div class="main-sidebar sidebar-style-2">

        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.php"> 
            
                  <div class="card-header">
                    <h4>EXAM ADMIN </h4>
                  </div>            
                  
              <!-- <img alt="image" src="assets/img/ubrologo.png" class="header-logo" /> -->
            </a>
          </div>
          <ul class="sidebar-menu">            
            <li class="dropdown active">
              <a href="dashboard.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Master</span></a>
              <ul class="dropdown-menu">
                <!-- <li><a href="exam.php" class="nav-link">Exam</a></li> -->
                <li><a href="paper.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Paper</a></li>
                <li><a href="ruleimage.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Rule Image</a></li>
                <li><a href="section.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Section</a></li>
                <li><a href="language.php?ubexid=<?php echo $_GET['ubexid']?>" class="nav-link">Language</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Exam Configuration</span></a>
              <ul class="dropdown-menu">
                <li><a href="question.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Question Paper</a></li>
                <li><a href="correctanswer.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Correct Answer</a></li>
                <li><a href="createset.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Question Set</a></li>
                <li><a href="examcenter.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Assign Manager</a></li>                 
                <li><a href="assignsettocandidate.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Assign Sets to Candidate</a></li>
                <li><a href="uploadcandidateimage.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Upload Candidade Image</a></li>    
                <li><a href="result.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Result</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>View & Modify</span></a>
              <ul class="dropdown-menu">
                <li><a href="paperlist.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Paper List</a></li>
                <!-- <li><a href="sectionlists.php" class="nav-link">Section</a></li>-->
                <li><a href="centerlist.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Center List</a></li>
                <li><a href="registercandidatelist.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Registered Candidate</a></li> 
                <li><a href="candidatelist.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Candidate List</a></li> 
                <li><a href="editqpack.php?ubexid=<?php echo $_GET['ubexid'];?>" class="nav-link">Edit QPack</a></li> 
              </ul>
            </li>
            <!-- <li class="dropdown">
                <a href="centershift.php" class="nav-link"><i data-feather="monitor"></i><span>Shift Configuration</span></a>
            </li>
            <li class="dropdown active">
                <a href="feedback.php" class="nav-link"><i data-feather="monitor"></i><span>Feedback Form </span></a>
            </li>
            <li class="dropdown active">
                <a href="contactdata.php" class="nav-link"><i data-feather="monitor"></i><span>Contact Form</span></a>
            </li> -->
          </ul>
        </aside>
</div>
<!-- left Menu End -->