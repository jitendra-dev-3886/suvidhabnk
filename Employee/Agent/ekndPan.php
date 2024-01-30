<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Userinfo/getuserinfo.php");
include("Backend/Functions/all_function.php"); // for create token
$status = "PAN";
// echo fetch_bene(filterThis($_GET['Mobile']));
// // exit;
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

   if(isset($_POST['apply_agent']))
   {
     $name = $_POST['name'];
     $address = $_POST['address'];
     $pin = $_POST['pincode'];
     $state = $_POST['state'];
     $phone = $_POST['phone'];
     $phone1 = $_POST['phone1'];
     $email = $_POST['email'];
     $pan = $_POST['pan'];
     $dob = date("d-m-Y", strtotime($_POST['dob']));
     $adhaar = $_POST['adhaar'];
     $us_id = $_SESSION["rt_id"];
    $vleid = substr($name , 0 , 3).$phone;
   $txn_id = mt_rand(9999 , 1000000);
            
            $arr = array(
                        'api_key' => '25eaef-e595a5-fe91ab-3130dc-e7df8d',
                        'vle_id' => $vleid,
                        'vle_name' => $name,
                        'vle_mob' => $phone,
                        'vle_email' =>$email,
                        'vle_shop' => 'RECHPAY INFOTECH',
                        'vle_loc' =>$address,
                        'vle_state' => 32,
                        'vle_pin' => $pin,
                        'vle_uid' => $adhaar,
                        'vle_pan' =>$pan
                        );
                                        
            // $data_string = json_encode($arr , true);
            foreach($arr as $pair=>$val){
                $data .= "$pair"."=".urlencode($val)."&";
            }
            // echo ($data);
            
            $url = "https://ekendra.co.in/api/add_vle.php?".$data;
            $ch = curl_init($url);
            $header = array('Content-Type:application/json');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            
            
            
            //response of request 
            $result = curl_exec($ch);
            //close curl
            echo $result; 
            curl_close($ch);
            $result_arr =  json_decode($result , true);
           
                $status = $result_arr['status'];
                $msg = $result_arr['message'];
                $ps_id = $result_arr['vle_id'];
                $vlstatus = $result_arr['vle_status'];
                
                if($ps_id != "" && strtolower($status) == "success"){
                $con->query("INSERT INTO `pan_agent`(`NAME`, `ADDRESS`, `PINCODE`, `STATE`, `PHONE`, `PHONE1`, `EMAIL`, `PAN`, `DOB`, `ADHAAR` , `REQ_ID` , `PSA_ID` ,`CREATEDBY` , 
                `STATUS` , `MSG` ,`US_TYPE` , `US_ID`) VALUES ('$name','$address','$pin','$state','$phone','$phone1','$email','$pan','$dob','$adhaar' ,
                '$rqst_id' ,'$ps_id','$created_by' , '$vlstatus' , '$msg', '46' , '$usid')");
                }
          echo '<script>alert("'.$status.' '.$msg.'  Agent Status : '.$vlstatus.' ")
          location.replace("ekndPan.php");
          </script>';
        //   exit;     
            
  }




if(isset($_POST['update_agent'])){
   $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and STATUS<>''");
    if($res->num_rows == 0){
        echo '<script>alert("Pan id not found for check status please apply pan first");
        location.replace("ekndPan.php");
        </script>';
        exit;
    }
    $pandt = $res->fetch_assoc();
       $url =  "https://ekendra.co.in/api/vle_status.php?api_key=25eaef-e595a5-fe91ab-3130dc-e7df8d&vle_id=".$pandt['PSA_ID'];
     
            $ch = curl_init($url);
            $header = array('Content-Type:application/json');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
           $result_arr =  json_decode($result , true);
           
                $status = $result_arr['status'];
                $msg = $result_arr['message'];
                $ps_id = $result_arr['vle_id'];
                $vlstatus = $result_arr['vle_status'];
                
                if($ps_id != "" && strtolower($status) != ""){
                    $con->query("update pan_agent set STATUS='$vlstatus' , MSG='$msg'  where ID='".$pandt['ID']."'");
                }
         echo '<script>alert("'.$status.' '.$msg.'  Agent Status : '.$vlstatus.' ")
         location.replace("ekndPan.php");
         </script>';
}


    
//   if(isset($_POST['update_reject_agent']))
//   {
//      $name = $_POST['name'];
//      $address = $_POST['address'];
//      $pin = $_POST['pincode'];
//      $state = $_POST['state'];
//      $phone = $_POST['phone'];
//      $phone1 = $_POST['phone1'];
//      $email = $_POST['email'];
//      $pan = $_POST['pan'];
//      $dob = date("d-m-Y", strtotime($_POST['dob']));
//      $adhaar = $_POST['adhaar'];
//      $ps_id = $_POST['ps_id'];
//   $id = $_POST['row_id'];
//   $txn_id = mt_rand(9999 , 1000000);
//             $url = "uat.dhansewa.com/UTI/UATUpdateRejectedRequest";
//             $arr = array(
//                     "securityKey"=>"A24GJJUI8098700807BVFR44567800998I",
//                     "createdby"=>"MM000900",
//                     "psaname"=>"$name",
//                     "contactperson"=>"$name",
//                     "location"=>"$address",
//                     "pincode"=>"$pin",
//                     "state"=>"$state",
//                     "phone1"=>"$phone",
//                     "phone2"=>"$phone1",
//                     "emailid"=>"$email",
//                     "pan"=>"$pan",
//                     "dob"=>"$dob",
//                     "adhaar"=>"$adhaar",
//                     "udf1"=>"$txn_id",
//                     "udf2"=>"",
//                     "udf3"=>"",
//                     "udf4"=>"",
//                     "udf5"=>"",
//                     "psaid"=>"$ps_id",
//                 );
                
//             $data_string = json_encode($arr , true);
//             // echo $data_string; 
//             $ch = curl_init($url);
//             $header = array('Content-Type:application/json');
//             curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             //response of request 
//             $result = curl_exec($ch);
//             //close curl
//             // echo $result; 
//             curl_close($ch);
//             $result_arr =  json_decode($result);
//             foreach($result_arr as $rspns){
//                 $rqst_id = $rspns->RequestId;
//                 $ps_id = $rspns->psaid;
//                 $created_by = $rspns->createdby;
//                 $status = $rspns->Status;
//                 $msg = $rspns->Message;
//                  $con->query("update pan_agent set STATUS='$status' where ID='$id'");
//               echo '<script>alert("'.$msg.' '.$status.'")</script>';
//             }
//   }


if(isset($_POST['coupenpurchase'])){
    $type = strip_tags($_POST['coupentype']);
    $num = strip_tags($_POST['coupennum']);
    if($num >= 1){
       
      $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and PSA_ID<>''");
      if($res->num_rows != 0){
          $data = $res->fetch_assoc();
          $req_id = $data['PSA_ID'];
          
          $ds_id = $user['OWNER_ID'];
            $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
            $ms_id = $ds_data['OWNER_ID'];
            $ms_data =  $con->query("select * from user where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
            
            //fetch balance of all
            $ds_main_bal = $ds_data['MAIN_BAL'];
            $ms_main_bal = $ms_data['MAIN_BAL'];
        
        
          $panch = $con->query("SELECT * FROM `pan_charge` where ID=1")->fetch_assoc();
          if($type == "1"){
              $pr = $num*$panch['E_PAN'];
              $dpr = $num*$panch['DS_COM'];
              $mpr = $num*$panch['MS_COM'];
          }
          else{
              $pr = $num*$panch['P_PAN'];
              $dpr = $num*$panch['DS_COM'];
              $mpr = $num*$panch['MS_COM'];
          }
          $user_bal = $user['MAIN_BAL']-$pr;
          $dsuser_bal = $ds_main_bal+$dpr;
          $msuser_bal = $ms_main_bal+$mpr;
          
        if($user_bal >= 0){
          $odid = substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNMASDFGHJKLqwQWERTYUIOPrewrctfgyuhtrdfghjiogtvuybhyvbDERTFUGYDEXCBYDRSDXertyuiopasdfghjklzxcvbnm") , 0 ,8);
          $url = "https://ekendra.co.in/api/coupon_req.php?api_key=25eaef-e595a5-fe91ab-3130dc-e7df8d&vle_id=$req_id&qty=$num&type=$type";
        //   echo $url;
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
            curl_setopt($ch, CURLOPT_URL, $url);   
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);   
            $response = curl_exec($ch);   

            $rslt =  json_decode($response , true);
            // $rslt['status']  = "success";
            if($rslt['status'] != ""){
                $con->query("INSERT INTO `pan_coupen`(`USID`, `TYPE`, `NUM`, `PSA_ID`, `OD_ID`, `RESPONSE`  , `STATUS`) VALUES ('$usid','$type','$num','$req_id','".$rslt['order_id']."','$response' , '".$rslt['status']."')");
            }
            
            if(strtolower($rslt['status']) == "success"){
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$usid' ");
                   insert_allreport($usid  ,$req_id , "PAN COUPEN CHARGE" , $user['MAIN_BAL']  , $user_bal ,$pr , "Debit" , "PAN COUPEN CHARGE");
               
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$ds_id' ");
                   insert_allreport($ds_id  ,$req_id , "PAN COUPEN COMMISSION" , $ds_data['MAIN_BAL']  , $dsuser_bal ,$dpr , "Credit" , "PAN COUPEN COMMISSION");
               
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$ms_id' ");
                   insert_allreport($ms_id  ,$req_id , "PAN COUPEN COMMISSION" , $ms_data['MAIN_BAL']  , $msuser_bal ,$mpr , "Credit" , "PAN COUPEN COMMISSION");
               
            }
            
                  echo '<script>alert("'.$rslt['status'].' '.$rslt['message'].'")
                        location.replace("ekndPan.php");
                  </script>';
            }
            else{
              echo '<script>alert("You have no balance to purchase enough coupen. ")</script>';
            }
      }
      else{
          echo '<script>alert("Your account not found for use pan service . ")</script>';
      }
    }
    else{
          echo '<script>alert("Enter coupen graeter or equal than 1. ")</script>';
    }
            
}



if(isset($_GET['updatestatus'])){
 $odid = $_GET['id'];   
     $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and PSA_ID<>''");
      if($res->num_rows != 0){
          
          $data = $res->fetch_assoc();
          $req_id = $data['PSA_ID'];
          
           $url = "https://ekendra.co.in/api/coupon_status?api_key=2022052512004761NJDBV186EYCSQ3DGM6LDZCX&vle_id=$req_id&order_id=$odid";
        //   echo $url;
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
            curl_setopt($ch, CURLOPT_URL, $url);   
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);   
            $response = curl_exec($ch);   

            $rslt =  json_decode($response , true);
            if($rslt['status'] != ""){
                $con->query("update `pan_coupen` set `STATUS` ='".$rslt['status']."' , CHECK_RESPONSE='$response'   where OD_ID='$odid' ");
            }
          echo '<script>alert("'.$rslt['status'].' '.$rslt['message'].'")
                location.replace("ekndPan.php");
          </script>';
      }
      else{
          echo '<script>alert("Your account not found for use pan service . ")</script>';
      }
      
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Pan Card </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
      #otp_area,#submit_btn_area,#name_area,#pin_area,#add_area {
            display: none;
        }
        
        
</style>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
          <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
   
<div class="wrapper">

  <!-- Preloader -->
  <?php
    include("include/preloader.php");
  ?>

  <!-- Navbar -->
   <?php
    include("include/NavBar.php");
  ?>
  <!-- /.navbar -->

 <?php
    include("include/SideBar.php");
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Domestic Money Transfer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Domestic Money Transfer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
       <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                     <!-- Page body start -->
                                   
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">

                                               <?php
                                                $us_id = $_SESSION["id"];
                                                $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and STATUS<>''");
                                                // echo "SELECT * FROM `pan_agent` WHERE MSG='Success' and US_TYPE='retailer' and US_ID='$us_id' and STATUS<>''";
                                                //if user is not register with pan
                                                // echo "rows is ".$res->num_rows;
                                                if($res->num_rows != 1){
                                               ?>
                                                <div class="card">
                                                        <div class="card-header">
                                                            <h5>Apply For Pan Agent</h5>
                                                            <div class="card-header-right">
                                                                <i class="icofont icofont-rounded-down"></i>
                                                                <i class="icofont icofont-refresh"></i>
                                                                <i class="icofont icofont-close-circled"></i>
                                                            </div>
                                                        </div>
                                                        <div class="card-block">
                                                            <form action="" id="main_form" method="post" enctype="multipart/form-data">
                                                                   
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <label for="">Full Name</label>
                                                                        <input type="text" required class="form-control" value="<?php echo $row['WEBSITENAME']; ?>" name="name">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <label for="">Full Address</label>
                                                                        <input type="text" required class="form-control" value="<?php echo $row['SNUMBER']; ?>" name="address">
                                                                        <span class="messages"></span>
                                                                    </div>
                    
                                                                </div>
                                                               
    
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <label class="">Pin Code</label>
                                                                        <input type="text" required class="form-control" value="<?php echo $row['FACEBOOK']; ?>" name="pincode">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                            <label for="">Select State</label>
                                                                              <select name="state" id="state" required class="form-control">
                                                                                <option value="">--Select State--</option>
                                                                                <option value="1">ANDAMAN AND NICOBAR ISLANDS</option>
                                                                                <option value="2">ANDHRA PRADESH</option>
                                                                                <option value="3">ARUNACHAL PRADESH</option>
                                                                                <option value="4">ASSAM</option>
                                                                                <option value="5">BIHAR</option>
                                                                                <option value="6">CHANDIGARH</option>
                                                                                <option value="33">CHHATTISGARH</option>
                                                                                <option value="7">DADRA AND NAGAR HAVELI</option>
                                                                                <option value="8">DAMAN AND DIU</option>
                                                                                <option value="9">DELHI</option>
                                                                                <option value="10">GOA</option>
                                                                                <option value="11">GUJARAT</option>
                                                                                <option value="12">HARYANA</option>
                                                                                <option value="13">HIMACHAL PRADESH</option>
                                                                                <option value="14">JAMMU AND KASHMIR</option>
                                                                                <option value="35">JHARKHAND</option>
                                                                                <option value="15">KARNATAKA</option>
                                                                                <option value="16">KERALA</option>
                                                                                <option value="17">LAKSHADWEEP</option>
                                                                                <option value="18">MADHYA PRADESH</option>
                                                                                <option value="19">MAHARASHTRA</option>
                                                                                <option value="20">MANIPUR</option>
                                                                                <option value="21">MEGHALAYA</option>
                                                                                <option value="22">MIZORAM</option>
                                                                                <option value="23">NAGALAND</option>
                                                                                <option value="24">ODISHA</option>
                                                                                <option value="99">OTHER</option>
                                                                                <option value="25">PONDICHERRY</option>
                                                                                <option value="26">PUNJAB</option>
                                                                                <option value="27">RAJASTHAN</option>
                                                                                <option value="28">SIKKIM</option>
                                                                                <option value="29">TAMILNADU</option>
                                                                                <option value="36">TELANGANA</option>
                                                                                <option value="30">TRIPURA</option>
                                                                                <option value="31">UTTAR PRADESH</option>
                                                                                <option value="34">UTTARAKHAND</option>
                                                                                <option value="32">WEST BENGAL</option>

                                                                            </select>
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Phone Number</label>
                                                                        <input type="text" class="form-control" required value="<?php echo $row['TWITTER']; ?>" name="phone">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                  
                                                                </div>
                                                                <div class="form-group row">
                                                                      <div class="col-sm-4">
                                                                        <label for="">Alternate Phone Number</label>
                                                                        <input type="text" class="form-control" required value="<?php echo $row['YOUTUBE']; ?>" name="phone1">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Email Address</label>
                                                                        <input type="text" class="form-control" required value="<?php echo $row['LINKEDIN']; ?>" name="email">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">PAN Number</label>
                                                                        <input type="text" class="form-control" required value="<?php echo $row['LINKEDIN']; ?>" name="pan">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row justify-content-center">
                                                                      <div class="col-sm-4">
                                                                        <label for="">Date Of Birth</label>
                                                                        <input type="date" class="form-control" required value="<?php echo $row['YOUTUBE']; ?>" name="dob" >
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Adhaar Number</label>
                                                                        <input type="text" class="form-control" required value="<?php echo $row['LINKEDIN']; ?>" name="adhaar">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                   
                                                                </div>
                                                                
                                                              
                                                                <div class="form-group row text-center">
                                                                    <div class="col-sm-10">
                                                                        <button type="submit" name="apply_agent" class="btn btn-primary m-b-0">Submit
                                                                        </button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary m-b-0">Cancel
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                    </div>
                                                      </div>
                                                    <?php  }else{
                                                        //user register with pan uti
                                                    $row = $res->fetch_assoc();
                                                    //user status is pending
                                                    if(strtolower($row['STATUS']) == "pending"){
                                                        ?> 
                                                        <div class="card">
                                                        <div class="card-header">
                                                            <h5>You already applied. Please update you status</h5>
                                                            <div class="card-header-right">
                                                                <i class="icofont icofont-rounded-down"></i>
                                                                <i class="icofont icofont-refresh"></i>
                                                                <i class="icofont icofont-close-circled"></i>
                                                            </div>
                                                        </div>
                                                         <div class="card-block">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <label for="">Full Name</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['NAME']; ?>" name="name">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <label for="">Full Address</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['ADDRESS']; ?>" name="address">
                                                                        <span class="messages"></span>
                                                                    </div>
                    
                                                                </div>
                                                               
    
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <label class="">Pin Code</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['PINCODE']; ?>" name="pincode">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                            <label for="">Select State</label>
                                                                            
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['STATE']; ?>" name="state">
                                                                            <!--  <select name="state" id="state" class="form-control">-->
                                                                            <!--    <option value="Andhra Pradesh">Andhra Pradesh</option>-->
                                                                            <!--    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>-->
                                                                            <!--    <option value="Arunachal Pradesh">Arunachal Pradesh</option>-->
                                                                            <!--    <option value="Assam">Assam</option>-->
                                                                            <!--    <option value="Bihar">Bihar</option>-->
                                                                            <!--    <option value="Chandigarh">Chandigarh</option>-->
                                                                            <!--    <option value="Chhattisgarh">Chhattisgarh</option>-->
                                                                            <!--    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>-->
                                                                            <!--    <option value="Daman and Diu">Daman and Diu</option>-->
                                                                            <!--    <option value="Delhi">Delhi</option>-->
                                                                            <!--    <option value="Lakshadweep">Lakshadweep</option>-->
                                                                            <!--    <option value="Puducherry">Puducherry</option>-->
                                                                            <!--    <option value="Goa">Goa</option>-->
                                                                            <!--    <option value="Gujarat">Gujarat</option>-->
                                                                            <!--    <option value="Haryana">Haryana</option>-->
                                                                            <!--    <option value="Himachal Pradesh">Himachal Pradesh</option>-->
                                                                            <!--    <option value="Jammu and Kashmir">Jammu and Kashmir</option>-->
                                                                            <!--    <option value="Jharkhand">Jharkhand</option>-->
                                                                            <!--    <option value="Karnataka">Karnataka</option>-->
                                                                            <!--    <option value="Kerala">Kerala</option>-->
                                                                            <!--    <option value="Madhya Pradesh">Madhya Pradesh</option>-->
                                                                            <!--    <option value="Maharashtra">Maharashtra</option>-->
                                                                            <!--    <option value="Manipur">Manipur</option>-->
                                                                            <!--    <option value="Meghalaya">Meghalaya</option>-->
                                                                            <!--    <option value="Mizoram">Mizoram</option>-->
                                                                            <!--    <option value="Nagaland">Nagaland</option>-->
                                                                            <!--    <option value="Odisha">Odisha</option>-->
                                                                            <!--    <option value="Punjab">Punjab</option>-->
                                                                            <!--    <option value="Rajasthan">Rajasthan</option>-->
                                                                            <!--    <option value="Sikkim">Sikkim</option>-->
                                                                            <!--    <option value="Tamil Nadu">Tamil Nadu</option>-->
                                                                            <!--    <option value="Telangana">Telangana</option>-->
                                                                            <!--    <option value="Tripura">Tripura</option>-->
                                                                            <!--    <option value="Uttar Pradesh">Uttar Pradesh</option>-->
                                                                            <!--    <option value="Uttarakhand">Uttarakhand</option>-->
                                                                            <!--    <option value="West Bengal">West Bengal</option>-->
                                                                            <!--</select>-->
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Phone Number</label>
                                                                        <input type="text" class="form-control"readonly value="<?php echo $row['PHONE']; ?>" name="phone">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                  
                                                                </div>
                                                                <div class="form-group row">
                                                                      <div class="col-sm-4">
                                                                        <label for="">Alternate Phone Number</label>
                                                                        <input type="text" class="form-control"readonly value="<?php echo $row['PHONE1']; ?>" name="phone1">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Email Address</label>
                                                                        <input type="text" class="form-control"readonly value="<?php echo $row['EMAIL']; ?>" name="email">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">PAN Number</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['PAN']; ?>" name="pan">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row justify-content-center">
                                                                      <div class="col-sm-4">
                                                                        <label for="">Date Of Birth</label>
                                                                        <input type="date" class="form-control" readonly value="<?php echo $row['DOB']; ?>" name="dob" >
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Adhaar Number</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['ADHAAR']; ?>" name="adhaar">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label class="">Status</label>
                                                                        <input type="text" class="form-control" readonly value="<?php echo $row['STATUS']; ?>" name="status">
                                                                        <span class="messages"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row text-center">
                                                                    <div class="col-sm-10">
                                                                        <button type="submit" name="update_agent" class="btn btn-primary m-b-0">Update Status
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                    </div>
                                                    </div>
                                                        <?php
                                                        //if user status is rejected 
                                                    }else if(strtolower($row['STATUS']) == "rejected"){
                                                    ?> 
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>You Status is rejected. Please apply new one.</h5>
                                                            <div class="card-header-right">
                                                                <i class="icofont icofont-rounded-down"></i>
                                                                <i class="icofont icofont-refresh"></i>
                                                                <i class="icofont icofont-close-circled"></i>
                                                            </div>
                                                        </div>
                                                        <div class="card-block">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                       
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <label for="">Full Name</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['WEBSITENAME']; ?>" name="name">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <label for="">Full Address</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['SNUMBER']; ?>" name="address">
                                                                            <span class="messages"></span>
                                                                        </div>
                        
                                                                    </div>
                                                                   
        
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <label class="">Pin Code</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['FACEBOOK']; ?>" name="pincode">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                                <label for="">Select State</label>
                                                                                  <select name="state" id="state" class="form-control">
                                                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                                    <option value="Assam">Assam</option>
                                                                                    <option value="Bihar">Bihar</option>
                                                                                    <option value="Chandigarh">Chandigarh</option>
                                                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                                    <option value="Daman and Diu">Daman and Diu</option>
                                                                                    <option value="Delhi">Delhi</option>
                                                                                    <option value="Lakshadweep">Lakshadweep</option>
                                                                                    <option value="Puducherry">Puducherry</option>
                                                                                    <option value="Goa">Goa</option>
                                                                                    <option value="Gujarat">Gujarat</option>
                                                                                    <option value="Haryana">Haryana</option>
                                                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                                    <option value="Jharkhand">Jharkhand</option>
                                                                                    <option value="Karnataka">Karnataka</option>
                                                                                    <option value="Kerala">Kerala</option>
                                                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                                    <option value="Maharashtra">Maharashtra</option>
                                                                                    <option value="Manipur">Manipur</option>
                                                                                    <option value="Meghalaya">Meghalaya</option>
                                                                                    <option value="Mizoram">Mizoram</option>
                                                                                    <option value="Nagaland">Nagaland</option>
                                                                                    <option value="Odisha">Odisha</option>
                                                                                    <option value="Punjab">Punjab</option>
                                                                                    <option value="Rajasthan">Rajasthan</option>
                                                                                    <option value="Sikkim">Sikkim</option>
                                                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                                                    <option value="Telangana">Telangana</option>
                                                                                    <option value="Tripura">Tripura</option>
                                                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                                                    <option value="West Bengal">West Bengal</option>
                                                                                </select>
                                                                                <span class="messages"></span>
                                                                            </div>
                                                                        <div class="col-sm-4">
                                                                            <label class="">Phone Number</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['TWITTER']; ?>" name="phone">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    <div class="form-group row">
                                                                          <div class="col-sm-4">
                                                                            <label for="">Alternate Phone Number</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['YOUTUBE']; ?>" name="phone1">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label class="">Email Address</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['LINKEDIN']; ?>" name="email">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label class="">PAN Number</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['LINKEDIN']; ?>" name="pan">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row justify-content-center">
                                                                          <div class="col-sm-4">
                                                                            <label for="">Date Of Birth</label>
                                                                            <input type="date" class="form-control" value="<?php echo $row['YOUTUBE']; ?>" name="dob" >
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label class="">Adhaar Number</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['LINKEDIN']; ?>" name="adhaar">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                        <input type="hidden"name="ps_id" value="<?php echo $row['PSA_ID'] ?>">
                                                                        <input type="hidden"name="row_id" value="<?php echo $row['ID'] ?>">
                                                                    </div>
                                                                    
                                                                  
                                                                    <div class="form-group row text-center">
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" name="update_reject_agent" class="btn btn-primary m-b-0">Resubmit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                    </div>
                                                    </div>
                                                    <?php
                                                    //if user status is approved
                                                    }else if(strtolower($row['STATUS']) == "approved" || strtolower($row['STATUS']) == "success"){ ?>
                                                          <div class="card">
                                                        <div class="card-header">
                                                            <h5>You approved for PAN UTI. Purchase coupen</h5>
                                                            <div class="card-header-right">
                                                                <i class="icofont icofont-rounded-down"></i>
                                                                <i class="icofont icofont-refresh"></i>
                                                                <i class="icofont icofont-close-circled"></i>
                                                            </div>
                                                        </div>
                                                        <div class="card-block">
                                                                <form action="" method="post" onsubmit='$("#cpbtn").hide();' enctype="multipart/form-data">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <label for="">coupen type</label>
                                                                             <select name="coupentype" id="coupentype" required class="form-control">
                                                                                <option value="1">Both Physical and E-Pan</option>
                                                                                <!--<option value="2">E - Coupen</option>-->
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <label for="">Number of coupen</label>
                                                                            <input type="text" class="form-control" value="1" name="coupennum">
                                                                            <span class="messages"></span>
                                                                        </div>
                        
                                                                    </div>
                                                                    <div class="form-group row text-center">
                                                                        <div class="col-sm-10">
                                                                           <button type="submit" name="coupenpurchase" id="cpbtn" class="btn btn-primary m-b-0">Submit
                                                                        </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card">
                                                        <div class="card-header">
                                                            <h5>Last 10 Transaction List</h5>
                                                            <span>My last 10 transaction</span>
                                                            <div class="card-header-right">
                                                                <ul class="list-unstyled card-option">
                                                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                                                    <li><i class="fa fa-trash close-card"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-block table-border-style">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped" id="example">
                                                                  <thead>
                                                                    <tr>
                                                                       <th>SL No</th>
                                                                        <th>Type</th>
                                                                        <th>Ref Id</th>
                                                                        <th>QTY</th>
                                                                        <th>Status</th>
                                                                        <th>Update Status</th>
                                                                        <th>Msg</th>
                                                                    </tr>
                                                                  </thead>
                                                                 <tbody> 
                                                              <?php

                                                                   $dmt_trans_q = $con->query("select * from pan_coupen where USID='$usid' order by ID Desc");
                                                                   while($row = $dmt_trans_q->fetch_assoc()){
                                                                       $rspns = json_decode($row['RESPONSE'] , true);
                                                                  ?>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td><?php echo $row['TYPE'] ?></td>
                                                                        <td><?php echo $row['OD_ID'] ?></td>
                                                                        <td><?php echo $row['NUM'] ?></td>
                                                                        <td><?php echo $row['STATUS'] ?></td>
                                                                        <?php
                                                                        if(strtolower($row['STATUS']) == "pending"){
                                                                            ?>
                                                                                <td><a href="ekndPan.php?updatestatus&id=<?php echo $row['OD_ID'] ?>" >Update</a></td>
                                                                            <?php
                                                                        }
                                                                        else{
                                                                            echo" <td>Not avail</td>";
                                                                            
                                                                        }
                                                                        ?>
                                                                            <td><?php echo $rspns['message'] ?></td>
                                                                   </tr>
                                                                   <?php  }?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                               <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
    </section>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<script>
      function GetBankIFSC(val) {
                let getbankIfsc = "getbankIfsc";
                let bankcode = val;
                $.ajax({
                    url: 'api/paysprint/dmt/register_user',
                    type: 'post',
                    data: {
                        bankcode,
                        getbankIfsc
                    },
                    success: function(data, status) {
                        // console.log(data);
                        $("#bene_ifsc").addClass("fill");
                        $("#bene_ifsc").val(data.trim());
                    },
                    error: function(err) {
                        $("#loading_ajax").hide();
                        popup('error', 'OOPS..!', "some internel error occured we are fixing it");
                    }
                })
            }
            

</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="js/DMT.js"></script>
<script src="js/Main.js"></script>


   <script>
      $(document).ready(function () {
          $('#example').DataTable();
     });
    </script>
</body>
</html>
