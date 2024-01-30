<?php
require_once('../Db/config.php');
session_start();

$id = $_GET['mid'];
$sql = "SELECT * FROM user WHERE ID = '$id'";
$result = mysqli_query($con, $sql) or die('SQL Query Failed.');



$row = mysqli_fetch_assoc($result);
$userid = $row['ID'];
$ownerid = $row['OWNER_ID'];
$tkn = $row['TOKEN_ID'];
// echo "<script>alert('$tkn')</script>";
$userdt = $row;
$usermaincom = $con->query("SELECT * FROM user_comm WHERE USER_ID = '$userid'");
if($usermaincom->num_rows == 0){
    $con->query("INSERT INTO `user_comm` ( `USER_ID`)
    VALUES ('$userid')");
}


$usermaincomdt = $con->query("SELECT * FROM user_comm WHERE USER_ID = '$userid'")->fetch_assoc();
$userType = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
// $userplan = $con->query("SELECT * FROM plan_subscription WHERE USER_ID = '$id'")->fetch_assoc();
// $usersubs = $con->query("SELECT * FROM manual_subscription_plan WHERE ID = '{$userplan['PLAN_ROW_ID']}'")->fetch_assoc();
$ownername = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
// $registerUser = $con->query("SELECT * FROM register_user_data WHERE USER_ID = '$id'")->fetch_assoc();
// $userdoc = $con->query("SELECT * FROM full_kyc WHERE USER_ID = '$id'")->fetch_assoc();
$row_bank = $con->query("SELECT * FROM `payout_users` WHERE `US_ID` = '$id' ORDER BY ID DESC LIMIT 3")->fetch_assoc();

if($ownerid == "ADMIN"){
    $ownername = "Admin";
}
else{
    $ownername = $ownername['FIRST_NAME'].$ownername['LAST_NAME'];            
}
      
$filteredJson =  trim(str_replace(": " , "-" ,$registerUser['AADHAAR_DATA']));
$filteredJson =  trim(str_replace("\n" , "-" ,$filteredJson));
$filteredJson =  rtrim($filteredJson);
$adhdata = json_decode($filteredJson , true);
$profilepath = $row['ADHAAR_PIC'];
          

//check virtual account exist or not;
$vaus = $con->query("SELECT * FROM `virtual_account` where USER_ID='$id' ");
      
if($vaus->num_rows == 0){
    $vaexist = false;
}
else{
    $vaexist = true;
    
    $vausdata = $vaus->fetch_assoc();
    $vid = $vausdata["ID"];
    $qrres = json_decode($vausdata["QR_RESPONSE"],true);
    $qrimg = $qrres["qrCode"];
    
    if($vausdata['UPI'] == ""){
                 $vadetailsinfo = "
               <span class='qrname'>Your UPI Id is not created click below button to create your UPI Id</span>
             <button type='button' class='btn btn-primary' onclick='createupi($id)' style='background: #17A7AE;border-color: #17A7AE;' >Create UPI Now</button>
               " ;
            }else if($vausdata['QR_RESPONSE'] == ""){
               $vadetailsinfo .= "
               <div class='row'>
                 <div class='col-md-12'>
                     <span class='qrname'>Your QR Code is not created click below button to create your QR code</span>
               <button type='button' class='btn btn-primary' onclick='createqr($vid)' style='background: #17A7AE;border-color: #17A7AE;' >Create QR Now</button>
                 </div>
                 </div>
               ";
               }else{
               $vadetailsinfo .= "<img src='$qrimg' class='qrcodeimg' id='qrcodeimg'>
             <div class='row'>
                 <div class='col-md-12'>
                     <span class='qrname'>QR Code</span>
                 </div>
                 <div class='col-md-12'>
                     <span class='qrdmlbtn' id='qrdmlbtn'>Download QR Code</span>
                 </div>
                 <div class='col-md-12'>
                     <span class='qrdesc'>anyone can scan this qr code or send money to your bank account</span>
                 </div>
             </div>";
                
               }
}


$selectsubplan = $con->query("SELECT * FROM subscription WHERE ID = '{$row['SUBSCRIPTION']}'")->fetch_assoc();
          
          
          
$aeps = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Aeps'");
$recharge = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Recharge'");
$dmt = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'DMT'");
$upicom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'UPI'");
$xdmtcom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'XDMT'");
$adharpay = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'AadharPay'");
$payout = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Payout'");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Member Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/style.css">
  <!--<link rel="stylesheet" href="css/style.css">-->
  <style>
      label{
  margin: 0px 15px;
}

body{
  margin-top: 50px;
}

h1{
  font-family: 'Segoe UI';
  font-weight: lighter;
  font-size: 28px;
 }
 
/*SWITCH 3 ------------------------------------------------*/

.switch3{
  position: relative;
  display: inline-block;
  width: 90px;
  height: 37px;
  border-radius: 37px;
  background-color: #f30010;
  cursor: pointer;
  transition: all .3s;
  overflow: hidden;
  box-shadow: 0px 0px 2px rgba(0,0,0, .3);
}
.switch3 input{
  display: none;
}
.switch3 input:checked + div{
  left: calc(80px - 23px);
  box-shadow: 0px 0px 0px white;
}
.switch3 div{
  position: absolute;
  width: 27px;
  height: 27px;
  border-radius: 27px;
  background-color: white;
  top: 5px;
  left: 5px;
  box-shadow: 0px 0px 1px rgb(150,150,150);
  transition: all .3s;
}
.switch3 div:before, .switch3 div:after{
  position: absolute;
  content: 'ON';
  width: calc(80px - 40px);
  height: 37px;
  line-height: 37px;
  font-family: 'Varela Round';
  font-size: 14px;
  font-weight: bold;
  top: -5px;
}
.switch3 div:before{
  content: 'Inactive';
  color: white;
  left: 120%;
}
.switch3 div:after{
  content: 'Active';
  right: 120%;
  color: white;
}

.switch3-checked{
  background-color : #69CCA4;
  box-shadow: none;
}
  </style>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    
  <!--  <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
  <!--  <div class="modal-dialog" role="document">-->
  <!--    <div class="modal-content">-->
  <!--      <div class="modal-header">-->
  <!--        <h5 class="modal-title" id="exampleModalLabel">Update</h5>-->
  <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
  <!--        <span aria-hidden="true">&times;</span>-->
  <!--      </button>-->
  <!--      </div>-->
  <!--      <div class="container">-->
  <!--       <div class="container">-->
  <!--        <div class="container">-->
  <!--         <div class="modal-body1" >-->
  <!--          <div id='edit_modal'> -->

  <!--          </div>-->
  <!--      </div>-->
  <!--     </div>-->
  <!--     </div>-->
  <!--     </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">-->
  <!--  <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
  <!--</div>-->

  <!-- Navbar -->
   <?php
    include("include/NavBar.php");
     ?>
  <!-- /.navbar -->

 <?php
    include("include/SideBar.php");
 ?>
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container px-3" id="printmedia">
        <div class="row mb-3 px-3">
         <div class="col-md-4" id="profilesec">
             <i class="fas fa-pencil-alt profileedit" id="peditbtn"></i>
             <img src="<?php echo ($profilepath != "")  ? $profilepath :  "assets/image 16.png" ?>" class="userimg" id="userimg">
             <!--<div class="useradbtn">-->
             <!--    <button type="button" class="btn btn-primary mr-3" id="activebtn">Activate</button>-->
             <!--    <button type="button" class="btn btn-danger" id="deactivebtn">Deactivate</button>-->
             <!--</div>-->
             <?php if($permission || $newpermission){ ?>
             <div class="userstatus">
                <label class="<?php echo (strtolower($row['US_STATUS']) == "active") ? "switch3 switch3-checked" :"switch3";  ?>" >
                  <input type="checkbox" onchange="updatestatus(<?php echo $row['ID']?> , '<?php echo $row['US_STATUS']?>' )" <?php echo (strtolower($row['US_STATUS']) == "active") ? "checked" :"";  ?> />
                  <div></div>
                </label>
             </div>
             <?php }else{ ?>
                <div class="userstatus">
                    <label class="<?php echo (strtolower($row['US_STATUS']) == "active") ? "switch3 switch3-checked" :"switch3";  ?>" >
                      <input type="checkbox" disabled <?php echo (strtolower($row['US_STATUS']) == "active") ? "checked" :"";  ?> />
                      <div></div>
                    </label>
                 </div>
             
             <?php } ?>
             
             
             <?php
             $user_querry=$con->query("SELECT * FROM user WHERE ID='$id'")->fetch_assoc();
             
             
             
             ?>
             
              <div class="col-md-12">
                    <label>API Access</label>
                      <select id='api_access' name='api_access' onchange="myFunction()">
                          <option value='<?php echo $user_querry['API_ACCESS']?>' selected><?php echo $user_querry['API_ACCESS'] ?> (Already Selected)</option>
                          <option value='YES'>YES</option>
                          <option value='NO'>NO</option>
                        </select>
                        
              </div>
         </div>
         
        <!-- <div class="col-md-4" id="usersubsec">
             <h2 class="subsremaiday"><?php //echo $remaining_days ?></h2>
             <h2 class="subsnametext"><?php //echo $usersubs['PLAN_NAME']?></h2>
             <h2 class="usertypetext"><?php //echo $userType['NAME'] ?></h2>
             <!--<h5 class="updatedaystext">update days <span class="updatdasint">69</span></h5>-->
             <!--<button type="button" class="btn btn-warning edit_btn" id="edit_plan">Update</button>-->
             <!--<button type="button" class="btn btn-success">Update Plan</button>
         </div>-->
     </div>
     <div class="row my-3 text-right"><span class="editdetailsbtn" id="userform1">Edit Details</span></div> 
        <div class="row mb-3 px-3" id="usermaindetails">
         <div class="col-md-4">
             <span class="labelnametext">Name</span>
             <h2 class="userdeatls"><?php echo $row['FIRST_NAME']." ".$row['LAST_NAME']; ?></h2>
         </div>
         <div class="col-md-4">
             <span class="labelnametext">Member ID</span>
             <h2 class="userdeatls"><?php echo $row['PARTNER_ID']; ?></h2>
         </div>
         <div class="col-md-4">
             <span class="labelnametext">Owner ID</span>
             <h2 class="userdeatls"><?php echo $row['OWNER_ID']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Owner Name</span>
             <h2 class="userdeatls"><?php echo $ownername; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Mobile NO</span>
             <h2 class="userdeatls"><?php echo $row['MOBILE']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Joining Date & Time</span>
             <h2 class="userdeatls"><?php echo $row['DATE']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Email ID</span>
             <h2 class="userdeatls"><?php echo $row['EMAIL']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Aadhaar NO</span>
             <h2 class="userdeatls"><?php echo $row['ADHAAR']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">PAN No</span>
             <h2 class="userdeatls"><?php echo $row['PAN']; ?></h2>
         </div>
     </div>
     
        <div class="row mb-3 px-3" id="usermaindetails">
            <?php 
                if($vaexist == false){
            ?>
                <div class='form-group'>
                     <h4>No account found. </h4>
                     <button type='button' class='btn btn-primary' onclick='createva(<?php echo $id ?>)' >Create Va Now</button>
                </div>
            <?php 
                } else{
            ?>
         <div class="col-md-4">
             <span class="labelnametext">Virtual ID</span>
             <h2 class="userdeatls"><?php echo $vausdata['VA_ID']; ?></h2>
         </div>
         <div class="col-md-4">
             <span class="labelnametext">Virtual Account Number</span>
             <h2 class="userdeatls"><?php echo $vausdata['ACCOUNT_NUM']; ?></h2>
         </div>
         <div class="col-md-4">
             <span class="labelnametext">Virtual Account IFSC</span>
             <h2 class="userdeatls"><?php echo $vausdata['IFSC']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Virtual Account UPI</span>
             <h2 class="userdeatls"><?php echo $vausdata['UPI']; ?></h2>
         </div>
         <?php } ?>
     </div>
     
     <div class="row my-3 text-right"><span class="editdetailsbtn" id="userform2">Edit Details</span></div>
    
        <div class="row mb-3 px-3" id="usermaindetails">
         <div class="col-md-8">
             <span class="labelnametext">Permanent Address</span>
             <h2 class="userdeatls"><?php echo $row['ADDRESS']; ?> </h2>
         </div>
         <div class="col-md-4">
             <span class="labelnametext">State</span>
             <h2 class="userdeatls"><?php echo $row['STATE']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">District</span>
             <h2 class="userdeatls"><?php echo $row['CITY']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Block</span>
             <h2 class="userdeatls"><?php echo $row['BLOCK']; ?></h2>
         </div>
         <div class="col-md-4 mt-3">
             <span class="labelnametext">Pin Code</span>
             <h2 class="userdeatls"><?php echo $row['PIN']; ?></h2>
         </div>
         
     </div>
     
 
     <div class="row my-3 text-right"><span class="editdetailsbtn" id="userform4">Edit Details</span></div>
   
            <div class="row mb-3 px-3" id="usermaindetails">
                <div class="col-md-12">Payout Bank <?php echo $i++ ?></div>
             <div class="col-md-4">
                 <span class="labelnametext">Account No</span>
                 <h2 class="userdeatls"><?php echo $row_bank['ACCOUNT'] ?> </h2>
             </div>
             <div class="col-md-4">
                 <span class="labelnametext">Account Holder Name</span>
                 <h2 class="userdeatls"><?php echo $row_bank['NAME'] ?></h2>
             </div>
             <div class="col-md-4">
                 <span class="labelnametext">Bank Name</span>
                 <h2 class="userdeatls"><?php echo $row_bank['BANK_NAME'] ?></h2>
             </div>
             <div class="col-md-4 mt-3">
                 <span class="labelnametext">IFSC Code</span>
                 <h2 class="userdeatls"><?php echo $row_bank['IFSC'] ?></h2>
             </div>
         </div>

        <div class="row mb-3 px-3" id="usermaindetails">
         <div class="col-md-3">
             <img src="<?php echo $row['ADHAAR_CARD'] ?>" class="usergovtimg">
             <div class="row">
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/upload 1.svg" class="duicon">
                     <span class="usergovtdeatils" id="uploadadhaarbtn">Upload Aadhar Card</span>
                     </div>
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/download 1.svg" class="duicon">
                     <a href="<?php echo $row['ADHAAR_CARD'] ?>" download="<?php echo $row['PARTNER_ID'] ?> ADHAAR_CARD" class="usergovtdeatils">Download Aadhar Card</a>
                     </div>
                 
             </div>
             
         </div>
         <div class="col-md-3">
             <img src="<?php echo $row['PAN_PIC'] ?>" class="usergovtimg">
             <div class="row">
                 
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/upload 1.svg" class="duicon">
                     <span class="usergovtdeatils" id="uploadpanbtn">Upload PAN Card</span>
                     </div>
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/download 1.svg" class="duicon">
                     <a href="<?php echo $row['PAN_PIC'] ?>" download="<?php echo $row['PARTNER_ID'] ?> PAN CARD" class="usergovtdeatils">Download PAN Card</a>
                     </div>
             </div>
         </div>
         <div class="col-md-3">
             <img src="<?php echo $row['BANKPASSBOOK_PIC'] ?>" class="usergovtimg">
             <div class="row">
                 
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/upload 1.svg" class="duicon">
                     <span class="usergovtdeatils" id="uploadbankpassbtn">Upload Bank Passbook</span>
                     </div>
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/download 1.svg" class="duicon">
                     <a href="<?php echo $row['BANKPASSBOOK_PIC'] ?>" download="<?php echo $row['PARTNER_ID'] ?> BANK PASSBOOK" class="usergovtdeatils">Download Bank Passbook</a>
                     </div>
             </div>
         </div>
         <div class="col-md-3">
             <img src="<?php echo $row['AGREEMENT_PIC'] ?>" class="usergovtimg">
             <div class="row">
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/upload 1.svg" class="duicon">
                     <span class="usergovtdeatils" id="uploadagrbtn">Upload Agreement</span>
                     </div>
                 <div class="col-sm-12 duuserdoc">
                     <img src="assets/download 1.svg" class="duicon">
                     <a href="<?php echo $row['AGREEMENT_PIC'] ?>" download="<?php echo $row['PARTNER_ID'] ?> AGREEMENT" class="usergovtdeatils">Download Agreement</a>
                     </div>
             </div>
           
         </div>
         
     </div>
   
     <h2 class="commhedding my-5"><?php echo $userType['NAME'] ?> Commission Setup</h2>
          <form id="modalform" method="post">
         <div class="row mb-3 px-3">
             <div class="col-md-3">
                 <span class="commservicetext">AePS (Cash withdrawal)</span>
             </div>
             <div class="col-md-3">
                 <select class='selectpicker' aria-label="Default select example" id="aeps" style="width: 200px;" name="aepspack"  data-live-search="true" >
                      <option selected value=''>select package</option> 
                      <?php
                       while($aepsdt = mysqli_fetch_assoc($aeps)){
                             if($userdt['AEPS_COMM'] == $aepsdt['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                             echo "<option value = '{$aepsdt['ID']}' $slected >{$aepsdt['PACKAGE_NAME']}</option>";
                         }
                      ?>
                </select>
             </div>
        
            <div class="col-md-3">
                 <span class="commservicetext"> Money Transfer (DMT)</span>
             </div>
             <div class="col-md-3">
                 <select class='selectpicker' aria-label="Default select example" style="width: 200px;" name="dmtpack"  data-live-search="true" >
                      <option selected value=''>select package</option>   
                      <?php
                      while($dmtcomdt = mysqli_fetch_assoc($dmt)){
                        if($userdt['DMT_COMM'] == $dmtcomdt['ID']){
                             $slected = "selected";
                         }
                         else{
                             $slected = "";
                         }
                         echo "<option value = '{$dmtcomdt['ID']}' $slected >{$dmtcomdt['PACKAGE_NAME']}</option>";
                     }
                      ?>
                </select>
             </div>
             
             <div class="col-md-3 mt-5">
                 <span class="commservicetext">Aadhaar Pay</span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' id="aeps" style="width: 200px;" name="adhaarpaypack"  data-live-search="true" >
                      <option selected value=''>select package</option>                    
                      <?php
                          while($adharpaydata = mysqli_fetch_assoc($adharpay)){
                            if($userdt['AADHAR_COMM'] == $adharpaydata['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                              echo "<option value = '{$adharpaydata['ID']}' $slected>{$adharpaydata['PACKAGE_NAME']}</option>";
                         }
                      ?>              
                </select>
             </div>
             
              <div class="col-md-3 mt-5">
                 <span class="commservicetext">Payout</span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' id="payout" style="width: 200px;" name="payoutpack"  data-live-search="true" >
                      <option selected value=''>select package</option>                    
                      <?php
                          while($pydata = mysqli_fetch_assoc($payout)){
                            if($userdt['PAYOUT_COMM'] == $pydata['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                              echo "<option value = '{$pydata['ID']}' $slected>{$pydata['PACKAGE_NAME']}</option>";
                         }
                      ?>              
                </select>
             </div>
             
             <div class="col-md-3 mt-5">
                 <span class="commservicetext">Recharge</span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' id="rc" style="width: 200px;" name="rcpack"  data-live-search="true" >
                      <option selected value=''>select package</option>                    
                      <?php
                          while($rcdata = mysqli_fetch_assoc($recharge)){
                            if($userdt['RC_COMM'] == $rcdata['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                              echo "<option value = '{$rcdata['ID']}' $slected>{$rcdata['PACKAGE_NAME']}</option>";
                         }
                      ?>              
                </select>
             </div>
             <div class="col-md-3 mt-5">
                 <span class="commservicetext">UPI Money Transfer</span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' aria-label="Default select example" style="width: 200px;" name="upipack"  data-live-search="true" >
                      <option selected value=''>select package</option>   
                      <?php
                      while($upicomdt = mysqli_fetch_assoc($upicom)){
                        if($userdt['UPI_COMM'] == $upicomdt['ID']){
                             $slected = "selected";
                         }
                         else{
                             $slected = "";
                         }
                         echo "<option value = '{$upicomdt['ID']}' $slected >{$upicomdt['PACKAGE_NAME']}</option>";
                     }
                      ?>
                </select>
             </div>
             
             <input type="hidden" name="userid" value="<?php echo $id ?>">
             <!--<div class="">BBPS offline</div>-->
             <div class="col-md-3 mt-5">
                 <span class="commservicetext"> (BBPS offline) water bill </span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' aria-label="Default select example" style="width: 200px;" name="offlinewaterpack"  data-live-search="true" >
                      <option selected value=''>select package</option>   
                      <?php
                       $comms = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'OFFLINE_ELECTRICITY' ");
                           while($comdt = mysqli_fetch_assoc($comms)){
                            if($usermaincomdt["OFFLINE_WATER"] == $comdt['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                             echo "<option value = '{$comdt['ID']}' $slected >{$comdt['PACKAGE_NAME']}</option>";
                         }
                      ?>
                </select>
             </div>
             <div class="col-md-3 mt-5">
                 <span class="commservicetext"> (BBPS offline) electricity bill</span>
             </div>
             <div class="col-md-3 mt-5">
                 <select class='selectpicker' aria-label="Default select example" style="width: 200px;" name="offlineelcpack"  data-live-search="true" >
                      <option selected value=''>select package</option>
                      <?php
                       $comms = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'OFFLINE_ELECTRICITY' ");
                           while($comdt = mysqli_fetch_assoc($comms)){
                            if($usermaincomdt["OFFLINE_ELECTRICITY"] == $comdt['ID']){
                                 $slected = "selected";
                             }
                             else{
                                 $slected = "";
                             }
                             echo "<option value = '{$comdt['ID']}' $slected >{$comdt['PACKAGE_NAME']}</option>";
                         }
                      ?>
                </select>
             </div>
             
             
             
            
             
         </div>
     
         <div class="row my-5 text-right">
             <input type="submit" name="updatecommpack" class="btn btn-primary btn-rounded btn-sm" value="Update">
             <img src="assets/print 1.svg" class="printprofilebtn" id="printuserprof">
         </div>
     </form>
     
<!-- image upload Modal -->
<div class="modal fade" id="updateuserimagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
    </div>
  </div>
</div>

<!-- qr code Modal -->
<div class="modal fade" id="qrcodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body1" id="agentqr" style="background: #F5F5F5;padding: 40px 0 0 0;">
    <div class="row" id="qrcode-maincontent">
            <img src="<?php echo ($profilepath != "")  ? $profilepath :  'assets/image 16.png' ?>" class="agentimg">
        <div class="col-sm-12" id="profile-content">
            <h6 class="agentnametext"><?php echo $row['FIRST_NAME']." ".$row['LAST_NAME']; ?> <img src="assets/Group 39.svg" class="arrowimg"></h6>
            <span class="agentupi_id"><?php echo $vausdata['UPI']; ?></span> <br>
            <span class="cname">Paydeer</span>
            
            <div class="qr-content">
                <img src="assets/logo 2.svg" class="logoimg">
                <img src="<?php echo $qrimg ?>" class="qrimg">
            </div>
        </div>
        
        <div class="col-sm-12" id="footer-content">
            <p class="qrname">QR Code</p>
            <a class="downloadqrbtn">Download QR Code</a>
            <p class="qrdesc">anyone can scan this qr code or send money to your bank account</p>
            <button type="button" class="sharebtn" id="shareqrbtn"><img src="assets/shareicon.svg" class="qrshareicon"> Share QR</button>
      </div>
        
        
    </div>
    <div class="row" id="upiapps">
        <img src="assets/phonepe.svg" class="img-fluid">
        <img src="assets/gpay.svg" class="img-fluid">
        <img src="assets/bhim.svg" class="img-fluid">
        <img src="assets/paytm.svg" class="img-fluid">
</div>
      </div>
      
    </div>
  </div>
</div>

     
     
 </div>
 
 
 <?php
    include("include/BottomBar.php");
 ?>
 
</div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
 <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>-->
  <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>-->
  <script src="js/pagination.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/myscript.js"></script>


<script>

$(document).ready(function(){

    $(".downloadqrbtn").click(function(){
        html2canvas($("#agentqr")[0]).then((canvas) => {
               let imagedata = canvas.toDataURL("image/jpg");
               let newdata = imagedata.replace(/^data:image\/jpg/,"data:application/octet-stream");
               $(".downloadqrbtn").attr("download","<?php echo $row['PARTNER_ID']; ?>_QR_image").attr("href",newdata);
       }) ;
    });
    
   $('.selectpicker').selectpicker('refresh'); 
});
permission = "<?php echo $permission; ?>";
modatBodu = `<form method="post" id="user1form">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $row['FIRST_NAME']." ".$row['LAST_NAME']; ?>">
          </div>
         </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Member ID</label>
          <input type="text" name="memberid" class="form-control" value="<?php echo $row['PARTNER_ID']; ?>">
          </div>
         </div>`;
         if(permission){
        modatBodu += `<div class="col-md-4">
          <div class="form-group">
          <label>Select Owner</label>
          <select class='selectpicker lstate' aria-label="Default select example" name="owner" id="owner" style="width: 200px;" data-live-search="true">
          <option value="ADMIN">Admin</option>
                <?php
                $query = $con->query("SELECT * FROM `user` WHERE USER_TYPE = '47' AND FIRST_NAME != '' AND US_STATUS = 'Active'");
                while($row1 = $query->fetch_assoc()){
                    if($row1["ID"] == $row["OWNER_ID"]){
                        $seleted = "selected";
                    }else{
                        $seleted = "";
                        
                    }
                ?>
                    <option <?php echo $seleted ?> value='<?php echo $row1['ID'] ?>'><?php echo $row1['FIRST_NAME'].' '.$row1['LAST_NAME'] ?></option>
               <?php }
                ?>
            </select>
          </div>
         </div>`;
         }
        modatBodu += `<div class="col-md-4">
          <div class="form-group">
          <label>Mobile Number</label>
          <input type="text" name="mobile" class="form-control" value="<?php echo $row['MOBILE']; ?>">
          </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Email Id</label>
          <input type="text" name="email" class="form-control" value="<?php echo $row['EMAIL']; ?>">
          </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Adhaar No</label>
          <input type="text" name="adhaarno" class="form-control" value="<?php echo $row['ADHAAR']; ?>">
          </div>
         </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Pan No</label>
          <input type="text" name="panno" class="form-control" value="<?php echo $row['PAN']; ?>">
          </div>
         </div>
        </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="updateuser1" class="btn btn-primary pull-right">Update</button>
        </div>
      </div>
    </div>
</section>
</form>`
  $("#userform1").click(function(){
   $(".modal-body").html(modatBodu); 
$('.selectpicker').selectpicker('refresh');
$(".modal-title").html("Update User");
$("#updateuserimagemodal").modal("show");

});
  $("#userform2").click(function(){
   $(".modal-body").html(`
   <form method="post" id="user2form">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
          <label>Permanent Address</label>
          <input type="text" name="address" class="form-control" value="<?php echo $row['ADDRESS']; ?>">
          </div>
         </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>State</label>
          <input type="text" name="state" class="form-control" value="<?php echo $row['STATE']; ?>">
          </div>
         </div>
        
        <div class="col-md-4">
          <div class="form-group">
          <label>District</label>
          <input type="text" name="city" class="form-control" value="<?php echo $row['CITY']; ?>">
          </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Block</label>
          <input type="text" name="block" class="form-control" value="<?php echo $row['BLOCK']; ?>">
          </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Pin Code</label>
          <input type="text" name="pincode" class="form-control" value="<?php echo $row['PIN']; ?>">
          </div>
         </div>
         </div>
        
      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="updateuser2" class="btn btn-primary pull-right">Update</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 
$('.selectpicker').selectpicker('refresh');
$(".modal-title").html("Update User");
$("#updateuserimagemodal").modal("show");

});


  $("#userform4").click(function(){
   $(".modal-body").html(`
   <form method="post" id="user4form">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <input type="hidden" id="token" name="token" value="<?php echo $tkn ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
          <label>Account No</label>
          <input type="text" name="beneAcc" class="form-control" >
          </div>
         </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Account Holder Name</label>
          <input type="text" name="beneName" class="form-control" >
          </div>
         </div>
        
        <div class="col-md-4">
          <div class="form-group">
          <label>Bank Name</label>
          <input type="text" name="bankName" class="form-control">
          <input type="hidden" name="beneEmail" class="form-control" value="<?php echo $row['EMAIL']; ?>">
          <input type="hidden" name="beneMobile" class="form-control" value="<?php echo $row['MOBILE']; ?>">
          <input type="hidden" name="beneAdd" class="form-control" value="<?php echo $row['CITY']; ?>">
          </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>IFSC Code</label>
          <input type="text" name="beneIFSC" class="form-control">
          </div>
          </div>
        </div>
         </div>
        
      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="updateuser4" class="btn btn-primary pull-right">Update</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 
$('.selectpicker').selectpicker('refresh');
$(".modal-title").html("Update Bank Deatails");
$("#updateuserimagemodal").modal("show");

});
  $("#peditbtn").click(function(){
   $(".modal-body").html(`
   <form method='post' id="prifilepicform">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="box-body">
                <img id="output" />
                </div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file.</p>
              </div>
              <input type="file" name="profilepic" onchange="loadFile(event)" class="dropzone">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="uploadpic" class="btn btn-primary pull-right">Upload</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 

$(".modal-title").html("Profile Upload");
$("#updateuserimagemodal").modal("show");

});

  $("#uploadadhaarbtn").click(function(){
   $(".modal-body").html(`
   <form method='post' id="adhaarpicform">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="box-body">
                <img id="output" />
                </div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file.</p>
              </div>
              <input type="file" name="aadharpic" onchange="loadFile(event)" class="dropzone">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="uploadpic" class="btn btn-primary pull-right">Upload</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 

$(".modal-title").html("Aadhar Card Upload");
$("#updateuserimagemodal").modal("show");

});

  $("#uploadpanbtn").click(function(){
   $(".modal-body").html(`
   <form method='post' id="panpicform">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="box-body">
                <img id="output" />
                </div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file.</p>
              </div>
              <input type="file" name="panpic" onchange="loadFile(event)" class="dropzone">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="uploadpic" class="btn btn-primary pull-right">Upload</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 

$(".modal-title").html("Pan Card Upload");
$("#updateuserimagemodal").modal("show");

});

  $("#uploadbankpassbtn").click(function(){
   $(".modal-body").html(`
   <form method='post' id="bankpicform">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="box-body">
                <img id="output" />
                </div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file.</p>
              </div>
              <input type="file" name="bankpasspic" onchange="loadFile(event)" class="dropzone">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="uploadpic" class="btn btn-primary pull-right">Upload</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 

$(".modal-title").html("Bank Passbook Upload");
$("#updateuserimagemodal").modal("show");

});

  $("#uploadagrbtn").click(function(){
   $(".modal-body").html(`
   <form method='post' id="agrpicform">
   <input type="hidden" name="userid" value="<?php echo $id ?>">
   <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="box-body">
                <img id="output" />
                </div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file.</p>
              </div>
              <input type="file" name="agreementpic" onchange="loadFile(event)" class="dropzone">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="submit" name="uploadpic" class="btn btn-primary pull-right">Upload</button>
        </div>
      </div>
    </div>
</section>
</form>
`); 

$(".modal-title").html("Agreement Upload");
$("#updateuserimagemodal").modal("show");

});
</script>


<script>
    $(document).on("click", "#edit_plan",function(){
  // alert("btn worked");
  // open modal
  $('#update_user_modal').modal("show");

  var edit_id = $(this).data("mid");
  // console.log(edit_id)
  $.ajax({
     url:"Edit_Profile.php",
     type:'POST',
     data :{pageid:9,sid:<?php echo $id ;?>},
     success: function(data){
        $('#edit_modal').html(data); 
        // alert(data);
     },
 });
});


$(document).on("click", "#update",function(){
  var up_id = $("#update_id").val();
  var expiry_old_date = $("#exdate_old").val();
  var expiry_new_date = $("#exdate_new").val();
  var up_plan_name = $("#up_plan_name").val();
  var up_plan_status = $("#up_plan_status").val();

  $.ajax({
     url:"Update_Profile.php",
     type:'POST',
     data :{id:7,updates_id:up_id,expiry_old_date:expiry_old_date,expiry_new_date:expiry_new_date,up_plan_name:up_plan_name,up_plan_status:up_plan_status},
     success: function(data){
         if(data == 1){
          //  alert("Update Data Successfully");
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Profile Update Successfully!',
          }).then (function(){
           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }else{
            Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }
          //  load_data();
         

     },
 });
})

$(document).on("click", "#new_plan_update",function(){
  var up_id = $("#updates_id").val();
  var expiry_new_date = $("#exdate_new").val();
  var up_plan_name = $("#up_plan_name").val();
  var up_plan_status = "Success";

  $.ajax({
     url:"Update_Profile.php",
     type:'POST',
     data :{id:17,updates_id:up_id,expiry_new_date:expiry_new_date,up_plan_name:up_plan_name,up_plan_status:up_plan_status},
     success: function(data){
        //  console.log(data);
         if(data == 1){
          //  alert("Update Data Successfully");
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Profile Update Successfully!',
          }).then (function(){
          location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }else{
            Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
          location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }
          //  load_data();
         

     },
 });
})





// Status Update
$(document).on("click", "#update1",function(){
  // alert("btn worked");
  var upp_id = $("#updates_id").val();
  var up_plan_status = $("#up_plan_status").val();

  
  $.ajax({
     url:"Update_Profile.php",
     type:'POST',
     data :{pageid:8,update_id:upp_id,up_plan_status:up_plan_status},
     success: function(data){
         if(data == 1){
          //  alert("Update Data Successfully");
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Status Update Successfully!',
          }).then (function(){
           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }else{
            Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
          });
          }
          //  load_data();
         

     },
 });
})

// function createcashe(id){
  
//   $.ajax({
//      url:"Update_Profile.php",
//      type:'POST',
//      data :{pageid:321,id:id},
//      success: function(data){
//          if(data == 1){
//           //  alert("Update Data Successfully");
//           Swal.fire({
//             icon: 'success',
//             title: 'Success...',
//             text: 'Cash E Account Created Successfully!',
//           }).then (function(){
//           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
//           });
//           }else{
//             Swal.fire({
//           icon: 'error',
//           title: 'Oops...',
//           text: 'Something went wrong!',
//         }).then (function(){
//           location.replace('ViewMemberProfile.php?mid=<?php echo $id;?>');
//           });
//           }
//           //  load_data();
         

//      },
//  });
// }
</script>

<script>
function myFunction() {
  var selectedOption = document.querySelector('select').value;
  var userr_id = <?php echo $id?>;
           $.ajax({
            url: "handler/api_access_update.php",
            type: "POST",
            data: {selectedOption:selectedOption , pageid:1234 , userr_id:userr_id},
            
            success: function(data) {
            
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "API Access Updated Successfully",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Something Went Wrong!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })

}
</script>


</body>
</html>
