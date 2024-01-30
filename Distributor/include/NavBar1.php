<?php

// include_once("include/Auth.php");

?>

  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <div class="user-panel  d-flex">
            <div class="image">
              <a href="UserProfile.php"><img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"></a>
              
            </div>
            
             <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?>   <i class="fas fa-angle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="UserProfile.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> My Profile
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change Password
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change mPIN
            
          </a>
          <div class="dropdown-divider"></div>
    
    <a href="index.php?logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
            
          </a>
        </div>
      </li>
            
          </div>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">-->
      <!--    <i class="fas fa-th-large"></i>-->
      <!--  </a>-->
      <!--</li>-->
    </ul>
  </nav>