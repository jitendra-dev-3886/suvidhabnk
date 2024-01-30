<?php

session_start();
$my_id = $_SESSION["UsId"];

include("../../Db/config.php");
include_once("include/Auth.php");

$admin_bnk=$con->query("SELECT * FROM `admin_bank_acc` WHERE `ID`='1'")->fetch_assoc();
$acc_hol_name=$admin_bnk['ACCOUNT_HOLDER_NAME'];
$bnk_name=$admin_bnk['BANK_NAME'];
$acc_number=$admin_bnk['ACCOUNT_NO'];
$acc_ifsc=$admin_bnk['IFSC_CODE'];
$upi_id=$admin_bnk['UPI_ID'];
$qr_img=$admin_bnk['QR_CODE'];


$sql123=$con->query("SELECT * FROM `company_contact` WHERE `ID`='1'")->fetch_assoc();
$mobile=$sql123['MOBILE'];
$email=$sql123['EMAIL'];

$sql=$con->query("select * from user where ID='$my_id'")->fetch_assoc();
$sql_name=$sql['FIRST_NAME']." ". $sql['LAST_NAME'] ;
$sql_email=$sql['EMAIL'];
$sql_number=$sql['MOBILE'];

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
      <li class="nav-item d-none d-sm-inline-block">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Online Add Balance</button>
      </li> &nbsp
      <li class="nav-item d-none d-sm-inline-block">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModaloffline">Offline Add Balance</button>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">-->
      <!--  <a href="#" class="nav-link">Contact</a>-->
      <!--</li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link"  data-toggle="modal" data-target="#exampleModalupi" href="javascript:void(0)">
          <i class="nav-icon fas fa-qrcode"></i>
        </a>
     </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link"  data-toggle="modal" data-target="#exampleModalContact" href="javascript:void(0)">
          <i class="nav-icon fas fa-headset"></i>
        </a>
     </li>
      <li class="nav-item dropdown">
        <a href="TicketRise" class="nav-link" href="javascript:void(0)">
          <i class="fas fa-question-circle"></i>
        </a>
     </li>
     
      <li class="nav-item dropdown">
        
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
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
                    
                    ?>
                    <a href="#" class="dropdown-item">
                    
                    <span><img src="../../admin/assets/Notification/<?php echo $row1['IMAGE']?>" width="20">&nbsp</span>
                    <?php
                    echo $row1['TEXT'];
                }
            ?>
          </a>
          <!--<a href="#" class="dropdown-item">-->
          <!--  <i class="fas fa-envelope mr-2"></i> 4 new messages-->
          <!--  <span class="float-right text-muted text-sm">3 mins</span>-->
          <!--</a>-->
          <!--<div class="dropdown-divider"></div>-->
          <!--<a href="#" class="dropdown-item">-->
          <!--  <i class="fas fa-users mr-2"></i> 8 friend requests-->
          <!--  <span class="float-right text-muted text-sm">12 hours</span>-->
          <!--</a>-->
          <!--<div class="dropdown-divider"></div>-->
          <!--<a href="#" class="dropdown-item">-->
          <!--  <i class="fas fa-file mr-2"></i> 3 new reports-->
          <!--  <span class="float-right text-muted text-sm">2 days</span>-->
          <!--</a>-->
          <!--<div class="dropdown-divider"></div>-->
          <!--<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>-->
        </div>
      </li>
      <li class="nav-item">
          
          <?php if($user["US_STATUS"] == 'Active'){ ?>
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
          
          <?php }else{ ?>
          
          <div class="user-panel  d-flex">
            <div class="image">
              <a href="javascript:void(0)" class="nav-link"><img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"></a>
              
            </div>
            
             <li class="nav-item dropdown">
        <a data-toggle="dropdown" href="javascript:void(0)" class="nav-link">
          <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?>   <i class="fas fa-angle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="dropdown-item duser">
            <i class="fas fa-user mr-2"></i> My Profile
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="dropdown-item duser">
            <i class="fas fa-key mr-2"></i> Change Password
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="dropdown-item duser">
            <i class="fas fa-key mr-2"></i> Change mPIN
            
          </a>
          <div class="dropdown-divider"></div>
    
    <a href="index?logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
            
          </a>
        </div>
      </li>
            
          </div>
          
          <?php } ?>
          
      </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">-->
      <!--    <i class="fas fa-th-large"></i>-->
      <!--  </a>-->
      <!--</li>-->
    </ul>
  </nav>
  
  <!-- QR Modal -->
<div class="modal fade" id="exampleModalupi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><a href="javascript:void(0)" onclick="Generate();">Bank Details<i class="ti-cloud-down"></i></a></h5>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
    <div class="modal-body" id="reciept">
    <div class="d-flex justify-content-center">                                                
	   <img src="../admin/assets/bank_qr/<?php echo $qr_img?>" class="navbar-brand-img img-fluid" alt="..." style="width:220px;">
	</div>
	<div class="d-flex justify-content-center">
           <div id="output"style="text-align:center;" ></div>
           
    </div>
    <div class="d-flex justify-content-center">
        <img src="assets/icons/Google-Pay-PhonePe-Paytm.jpg" class="img-fluid" style="width:280px;"/>
    </div>
    <div>
        <!--<p class="text-center" style="font-size:18px; font-weight:bold;">Auto Wallet Update</p>-->
    </div>
	<p style="text-align:center;"><b>Account Holder Name : <span style="color:red;"><?php echo $acc_hol_name?></span></b></p>
	<p style="text-align:center;"><b>Bank Name : <span style="color:red;"><?php echo $bnk_name?></span></b></p>
	<p style="text-align:center;"><b>Account Number : <span style="color:red;"><?php echo $acc_number?></span></b></p>
	<p style="text-align:center;"><b>IFSC Code : <span style="color:red;"><?php echo $acc_ifsc?></span></b></p>
	<p style="text-align:center;"><b>UPI : <span style="color:red;"> <?php echo $upi_id?></span></b></p>
    <p style="text-align:center;"><b>Minimum Rs.100 Request will be Valid.</b></p>
   </div>
		</div>
     
    </div>
  </div>
 
  <!-- Customer Support Modal -->
<div class="modal fade" id="exampleModalContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><a href="javascript:void(0)" onclick="Generate();">Instant Customer Support  <i class="ti-cloud-down"></i></a></h5>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
    <div class="modal-body" id="reciept">
        <h3 class="text-center">Contact Number : +91 <?php echo $mobile ?></h3>                                                                                          
        <h3 class="text-center">Email : <?php echo $email ?></h3>                                                                                          
   </div>
		</div>
     
    </div>
  </div>
  
 <div>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <!--<form id="add_data" name="add_dataa" method="post" action="../api/php-pg-integration-master/checkout/request.php">-->
    <form id="add_dataa" method="post" action="api/php-pg-integration-master/checkout/request.php">
       <input type="text" name="orderAmount" class="form-control" placeholder="Enter Amount Here"><br>
       <input type="text" name="orderNote" class="form-control" placeholder="Remarks">
       <input type="hidden" name="usid" value="<?php echo $my_id ?>">
       <input type="hidden" name="customerName" value="<?php echo $sql_name ?>">
       <input type="hidden" name="customerEmail" value="<?php echo $sql_email ?>">
       <input type="hidden" name="customerPhone" value="<?php echo $sql_number ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="submit" class="btn btn-success" id="save" value="Pay">Recharge</button>-->
        <button type="submit" class="btn btn-success" id="saveee" value="Pay">Recharge</button>
      </div>
    </form>    
    </div>
  </div>
</div>
 </div>
  <div>
      <div class="modal fade" id="exampleModaloffline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ofline Fund</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card-block my-3">
            <form class="form-material" id="main_form" method="post" enctype="multi-part/formData">
                <div class="form-row d-flex justify-content-around">
                <div class="form-group form-primary col-md-3">
                    <input type="number"  required name="amount" class="form-control">
                    <span class="form-bar"></span>
                    <label class="float-label">Amount</label>
                </div>
                <div class="form-group form-primary col-md-3">
                    <input type="file" name="recipt" class="form-control fill">
                    <span class="form-bar"></span>
                    <label class="float-label">Recipt</label>
                </div>
                 <div class="form-group form-primary col-md-3">
                    <input type="number"  name="refrenceid" class="form-control">
                    <span class="form-bar"></span>
                    <label class="float-label">Refrence Id</label>
                </div>
           
                <div class="form-group form-primary col-md-3">
                    <select name="payment_mode" required class="form-control fill">
                        <option value="" disabled selected>Select Payment options</option>
                        <option value="Bank">Bank</option>
                        <option value="NEFT">NEFT</option>
                        <option value="IMPS">IMPS</option>
                        <option value="Gpay">Gpay</option>
                        <option value="Phone pe">Phone pe</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                </div>
                <!--<div class="form-row mt-4 d-flex justify-content-center">-->
                    <!--<div class="col-md-8">-->
                    <!--    <button type="submit" name="ofline_bal_req" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-wallet"></i>Request Wallet</button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</form>-->
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-success" id="save">Recharge</button>-->
        <div class="col-md-8">
            <button type="submit" name="ofline_bal_req" id="ofline_bal_req" class="btn waves-effect waves-light btn-primary btn-block"><i class="ti-wallet"></i>Request Wallet</button>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>    
    </div>
  </div>
</div>
 </div>
  

  
  
 