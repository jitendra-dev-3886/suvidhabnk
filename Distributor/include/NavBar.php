<?php

include_once("include/Auth.php");
include("../../Db/config.php");

$sql2=$con->query("select * from user where ID='$my_id'")->fetch_assoc();
$sql_user_profile=$con->query("select * from user_profile where ID='$my_id'")->fetch_assoc();
$type2=$sql2['USER_TYPE'];
if($type2=='46'){
    $abc="RETAILER_ID='$my_id'";
}else if($type2=='47'){
    $abc="DISTRIBUTOR_ID='$my_id'";
}else{
    $abc="EMPLOYEE_ID='$my_id'";
}
$result = $con->query("SELECT COUNT(*) AS `count` FROM `notification` WHERE $abc or USER_TYPE='all user'")->fetch_assoc();
$count = $result['count'];

?>

<style>
    
    section.content {
        margin-top:5% !important;
}

span.searchicon {
   position: absolute;
    top: 48%;
    left: 0;
    background: #6c757d;
    color: #fff;
    padding: 4px 6px;
    border-radius: 3px;
}
    
</style>

  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">-->
      <!--  <a href="#" class="nav-link">Contact</a>-->
      <!--</li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $count ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <?php
                $sql1=$con->query("select * from user where ID='$my_id'")->fetch_assoc();
                $type1=$sql1['USER_TYPE'];
                if($type1=='46'){
                    $xyz="RETAILER_ID='$my_id'";
                }else if($type1=='47'){
                    $xyz="DISTRIBUTOR_ID='$my_id'";
                }else{
                    $xyz="EMPLOYEE_ID='$my_id'";
                }
                $notification = $con->query("SELECT * FROM `notification` where $xyz or USER_TYPE='all user'");
                while($row1 = mysqli_fetch_array($notification)){
                    // $usertype = $row['USER_TYPE'];
                    // $distributor = $row['DISTRIBUTOR_ID'];
                    // $retailer = $row['RETAILER_ID'];
                    // $employee = $row['EMPLOYEE_ID'];
                    ?>
                    <a href="#" class="dropdown-item">
                    <?php
                    // if($usertype == 'all user'){
                    //     $anotify = $row['TEXT'];
                    //     echo $anotify;
                    // }else if($usertype == 'Retailer'){
                    //     if($retailer == $my_id){
                    //         $rnotify = $row['TEXT'];
                    //         echo $rnotify;
                    //     }
                    // }else if($usertype == 'Employee'){
                    //     if($employee == $my_id){
                    //         $enotify = $row['TEXT'];
                    //         echo $enotify;
                    //     }
                    // }else if($usertype == 'Distributor'){
                    //     if($distributor == $my_id){
                    //         $dnotify = $row['TEXT'];
                    //         echo $dnotify;
                    //     }
                    // }
                    ?>
                    <span><img src="../../admin/assets/Notification/<?php echo $row1['IMAGE']?>" width="20">&nbsp</span>
                    <?php
                    echo $row1['TEXT'];
                }
            ?>
          </a>
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-envelope mr-2"></i> 4 new messages-->
        <!--    <span class="float-right text-muted text-sm">3 mins</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-users mr-2"></i> 8 friend requests-->
        <!--    <span class="float-right text-muted text-sm">12 hours</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-file mr-2"></i> 3 new reports-->
        <!--    <span class="float-right text-muted text-sm">2 days</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>-->
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
          <a href="AgentChangePassword.php" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change Password
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="AgentChangeMPIN.php" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change mPIN
            
          </a>
          <div class="dropdown-divider"></div>
            <a href="index?logout" class="dropdown-item">
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