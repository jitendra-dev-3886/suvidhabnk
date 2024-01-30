<?php
 include("config.php");
    
    if(isset($_POST['add_white_label'])){
      
      $member_type = $_POST['member_type']; 
      $plan = $_POST['plan'];  
     
      $member_status = $_POST['member_status'];  
      $full_name = $_POST['full_name']; 
      $l_name = $_POST['l_name'];  
      $number = $_POST['number'];  
      $email = $_POST['email']; 
      $address = $_POST['address'];  
      $city = $_POST['city'];  
      $state = $_POST['state']; 
      $pin = $_POST['pin'];  
      $bank = $_POST['bank'];  
      $b_name = $_POST['b_name']; 
    
      $ac_hold_name = $_POST['ac_hold_name'];  
      $ac_num = $_POST['ac_num']; 
      $c_ac_num = $_POST['c_ac_num'];  
      $ifsc = $_POST['ifsc'];  
      $rc_com = $_POST['rc_com']; 
      $aeps_com = $_POST['aeps_com'];  
      $us_status = $_POST['us_status'];  
      $password = $_POST['password']; 
      $c_password = $_POST['c_password'];  
      $otp = $_POST['otp'];  
      $login = $_POST['login']; 
      
       //  image 2 upload
    $image2 = $_FILES['image2'];
    $img_name2 = $image2['name'];
    $img_tmp2 = $image2['tmp_name'];
    $dest2 = "../img/whitelabeldoc/" . $img_name2;

    // image 3 upload
    $image3 = $_FILES['image3'];
    $img_name3 = $image3['name'];
    $img_tmp3 = $image3['tmp_name'];
    $dest3 = "../img/whitelabeldoc/" . $img_name3;

    // image 4 upload
    $image4 = $_FILES['image4'];
    $img_name4 = $image4['name'];
    $img_tmp4 = $image4['tmp_name'];
    $dest4 = "../img/whitelabledoc/" . $img_name4;
    
      // image 5 upload
    $image5 = $_FILES['image5'];
    $img_name5 = $image5['name'];
    $img_tmp5 = $image5['tmp_name'];
    $dest5 = "../img/whitelabeldoc/" . $img_name5;
      
      $query = "INSERT INTO `add_white_lable`(`COMPANY_NAME`, `DOMAIN_NAME`, `LOGO`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE_NUMBER`, `EMAIL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `BANK`, `B_NAME`, `A_C_HOLDER_NAME`, `A_C_NUM`, `CONFIRM_A_C_NUM`, `IFSC_CODE`, `PASSBOOK`, `RECHARGE_COM_PACK`, `AEPS_COM_PACK`, `US_STATUS`, `PASSWORD`, `C_PASSWORD`, `OTP`, `LOGIN_AUTH`) 
      VALUES ('$c_name','$domain_name','$img_name5','$service','$f_name','$l_name','$number','$email','$address','$city','$state','$pin','$img_name2','$img_name3','$bank','$b_name','$ac_hold_name','$ac_num','$c_ac_num','$ifsc','$img_name4','$rc_com ','$aeps_com','$us_status','$password','$c_password','$otp','$login')";
      
      $run = mysqli_query($conn,$query);
      if($run){
          move_uploaded_file($img_tmp5, $dest5);
           move_uploaded_file($img_tmp2, $dest2);
            move_uploaded_file($img_tmp3, $dest3);
            move_uploaded_file($img_tmp4, $dest4);
             
        header("location:../add_white_label.php?status=add_white_label&msg=successfully&desc=User Has Been Created");
      }
      else{
       header("location:../add_white_label.php?status=add_white_label&error=Failed to Create");
     
      }
      }

?>

//----------------------------------------Add Member Code Here---------------------------------//

<?php


if(isset($_POST['AddMember'])){
      
    //   echo"<pre>";
    //   print_r($_POST);
    //   print_r($_FILES);
    //   exit();
      $member_type = $_POST['member_type']; 
      $member_plan = $_POST['plan'];  
     
      $member_status = $_POST['member_status'];
      $member_id = $_POST['member_id'];
      $full_name = $_POST['full_name']; 
      $div = explode(" ",$full_name);
      $first =$div[0];
      $last =$div[1];
      $number = $_POST['mobile'];  
      $email = $_POST['email']; 
      $fulladdress = $_POST['full_address'];  
      $city = $_POST['p_city'];  
      $state = $_POST['state']; 
      $pin_code = $_POST['p_pincode'];  
      $joining_date = $_POST['joining_date'];
      
      $office_address  = $_POST['f_address'];
      $office_state  = $_POST['o_state'];
      $office_city  = $_POST['o_city'];
      $office_pincode  = $_POST['o_pincode'];
      $adhar_number  = $_POST['adhar_number'];
      $pan_number  = $_POST['pan_number'];
      $gst_number  = $_POST['gst_number'];
      
    
      $bank_name = $_POST['bank'];
      $acc_hold_name = $_POST['ac_name'];  
      $acc_number = $_POST['ac_num']; 
      $ifsc_code = $_POST['ifsc_code'];  
      $password = $_POST['pass']; 
      $c_password = $_POST['c_pass'];  
      
       //  Profile pic upload
    $profile_pic = $_FILES['profile_pic'];
    $pic_name = $profile_pic['name'];
    $pic_tmp = $profile_pic['tmp_name'];
    $dest = "../img/whitelabeldoc/" . $profile_pic;
    
    $t=time();
    $par_id = PDR.substr($t,5);
      
      $query = "INSERT INTO `member`(`MEMBERIDSTATUS`, `SUBSCRIPTIONPLANNAME`, `MEMBERIDTYPE`, `MEMBERNAME`, `MOBILE`, `EMAILID`, `MEMBERID`, `PROFILEPICTURE`, `JOININGDATE`, `PARMANENTFULLADDRESS`, `PARMANENTCITY`, `PARMANENTSTATE`, `PARMANENTPINCODE`, `OFFICEFULLADDRESS`, `OFFICECITY`, `OFFICESTATE`, `OFFICEPINCODE`, `ADHARNUMBER`, `PANNUMBER`, `GSTNUMBER`, `ADHARCARD`, `PANCARD`, `GSTCARD`, `VIDEOKYC`, `BANKACHOLDERNAME`, `BANKACNUMBER`, `BANKIFSCCODE`, `BANKNAME`, `SERVICEMANAGEMENT`, `COMMISSIONPACKAGE`, `PASSWORD`) VALUES ('$member_status','$member_plan','$member_type','$full_name','$number','$email','$member_id','$pic_name','$joining_date','$fulladdress','$city','$state','$pin_code','$office_address','$office_city','$office_state','$office_pincode','$adhar_number','$pan_number','$gst_number','','','','','$acc_hold_name','$acc_number','$ifsc_code','$bank_name','','','$password')
";
      $run = mysqli_query($conn,$query);
      if($run){
            // move_uploaded_file($img_tmp5, $dest5);
            // move_uploaded_file($img_tmp2, $dest2);
            // move_uploaded_file($img_tmp3, $dest3);
            // move_uploaded_file($img_tmp4, $dest4);
        $user_sql = "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`, `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `AADHAR_COMM`, `DMT_COMM`, `PAYOUT_COMM`, `M_ATM_COMM`, `USER_LIMIT`, `CMS_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, `LOGIN_AUTH`) VALUES (
        
        'Admin', '1', 'TOKEN_ID', 'USER_TYPE', '$par_id', 'ADMIN', 'SERVICES', '$first', '$last', '$number', '$email', '0', '0', '$fulladdress', '$city', '$state', '$pin_code', '$adhar_number', '$pan_number', 'RC_COMM', 'AEPS_COMM', 'AADHAR_COMM', 'DMT_COMM', 'PAYOUT_COMM', 'M_ATM_COMM', 'USER_LIMIT', 'CMS_COMM', 'Active', '$password', '3', '1'
        )";
        $run1 = mysqli_query($conn,$user_sql);
        if($run1)
        {
           echo"<script>alert('Add Successfully Done')</script>";
          // header("location:../add_white_label.php?status=add_white_label&msg=successfully&desc=User Has Been Created"); 
        }
        else{
       header("location:../add_white_label.php?status=add_white_label&error=Failed to Create");
     
      }
        
        
      }
      else{
       header("location:../add_white_label.php?status=add_white_label&error=Failed to Create");
     
      }
      }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | Dashboard </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Member</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Member</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action = "<?php $_SERVER["PHP_SELF"] ?>"  method="post">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member Type</label>
                         <select class="form-control select2" name="member_type" style="width: 100%;">
                            <option>Select Member Type</option>
                          <option>Distributor</option>
                          <option value="1" selected>Retailer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Subscription Plan Name</label>
                         <select class="form-control select2" name="plan" disable style="width: 100%;">
                            <option value="">Plan 1</option>
                          <option value="">Plan 2</option>
                          <option value="">Plan 3</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member Status</label>
                         <select class="form-control select2" name="member_status" style="width: 100%;">
                            <option>Select Member Status</option>
                          <option value="Active" selected>Active</option>
                          <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="">
                      </div>
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Mobile Number </label>
                        <input type="number" class="form-control" name="mobile" placeholder="">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Email ID </label>
                        <input type="email" class="form-control" name="email" placeholder="">
                      </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member ID</label>
                        <input type="text" class="form-control" placeholder="" name="member_id">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Upload Profile Picture</label>
                        <input type="file" class="form-control" placeholder="" name="profile_pic">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Joining Date</label>
                        <input type="date" class="form-control" placeholder="" name="joining_date">
                    </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Permanent Address</u></label>
                        </div>
                        </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Full Address:</label>
                        <input type="text" class="form-control" placeholder="" name="full_address">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">State </label>
                         <select class="form-control select2" name="state" style="width: 100%;">
                            <option value="Andhra Pradesh" selected="selected">Andhra Pradesh</option>
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
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">City </label>
                        <input type="text" class="form-control" placeholder="" name="p_city">
                        <!-- <select class="form-control select2" style="width: 100%;">-->
                        <!--    <option selected="selected">Alabama</option>-->
                        <!--    <option>Alaska</option>-->
                        <!--    <option>California</option>-->
                        <!--    <option>Delaware</option>-->
                        <!--    <option>Tennessee</option>-->
                        <!--    <option>Texas</option>-->
                        <!--    <option>Washington</option>-->
                        <!--</select>-->
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Pin Code</label>
                        <input type="number" class="form-control" placeholder="" name="p_pincode">
                        <!-- <select class="form-control select2" style="width: 100%;">-->
                        <!--    <option selected="selected">712222</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--</select>-->
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Office Address</u></label>
                        </div>
                        </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Full Address</label>
                        <input type="text" class="form-control" placeholder="" name="f_address" autocomplete="off">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">State </label>
                         <select class="form-control select2" name="o_state" style="width: 100%;">
                            <option value="Andhra Pradesh" selected="selected">Andhra Pradesh</option>
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
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">City </label>
                        <input type="text" class="form-control" placeholder="" name="o_city">
                        <!-- <select class="form-control select2" style="width: 100%;">-->
                        <!--    <option selected="selected">Alabama</option>-->
                        <!--    <option>Alaska</option>-->
                        <!--    <option>California</option>-->
                        <!--    <option>Delaware</option>-->
                        <!--    <option>Tennessee</option>-->
                        <!--    <option>Texas</option>-->
                        <!--    <option>Washington</option>-->
                        <!--</select>-->
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Pin Code</label>
                        <input type="number" class="form-control" placeholder="" name="o_pincode">
                        <!-- <select class="form-control select2" style="width: 100%;">-->
                        <!--    <option selected="selected">712222</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--    <option>823003</option>-->
                        <!--</select>-->
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Aadhar Number : </label>
                        <input type="number" class="form-control" placeholder="" name="adhar_number">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">PAN Number :</label>
                        <input type="text" class="form-control" placeholder=""  name="pan_number">
                    </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">GST Number :</label>
                        <input type="text" class="form-control" placeholder=""  name="gst_number">
                    </div>
                </div>

                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Bank Account Details</u></label>
                        </div> 
                </div>
                <div class="form-row d-flex justify-content-around">
                     <div class="form-group col-md-3">
                  <label >Bank Name</label>
                    <select class="form-control select2" name="bank" style="width: 100%;">
                        <option value="Allahabad Bank" selected="selected">Allahabad Bank</option>
                        <option value="Andhra Bank">Andhra Bank</option>
                        <option value="Axis Bank">Axis Bank</option>
                        <option value="Bank of Bahrain and Kuwait">Bank of Bahrain and Kuwait</option>
                        <option value="Bank of Baroda - Corporate Banking">Bank of Baroda - Corporate Banking</option>
                        <option value="Bank of Baroda - Retail Banking">Bank of Baroda - Retail Banking</option>
                        <option value="Bank of India">Bank of India</option>
                        <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                        <option value="Canara Bank">Canara Bank</option>
                        <option value="Central Bank of India">Central Bank of India</option>
                        <option value="City Union Bank">City Union Bank</option>
                        <option value="Corporation Bank">Corporation Bank</option>
                        <option value="Deutsche Bank">Deutsche Bank</option>
                        <option value="Development Credit Bank">Development Credit Bank</option>
                        <option value="Dhanlaxmi Bank">Dhanlaxmi Bank</option>
                        <option value="Federal Bank">Federal Bank</option>
                        <option value="ICICI Bank">ICICI Bank</option>
                        <option value="IDBI Bank">IDBI Bank</option>
                        <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                        <option value="IndusInd Bank">IndusInd Bank</option>
                        <option value="ING Vysya Bank">ING Vysya Bank</option>
                        <option value="Jammu and Kashmir Bank">Jammu and Kashmir Bank</option>
                        <option value="Karnataka Bank Ltd">Karnataka Bank Ltd</option>
                        <option value="Karur Vysya Bank">Karur Vysya Bank</option>
                        <option value="Kotak Bank">Kotak Bank</option>
                        <option value="Laxmi Vilas Bank">Laxmi Vilas Bank</option>
                        <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                        <option value="Punjab National Bank - Corporate Banking">Punjab National Bank - Corporate Banking</option>
                        <option value="Punjab National Bank - Retail Banking">Punjab National Bank - Retail Banking</option>
                        <option value="Punjab & Sind Bank">Punjab & Sind Bank</option>
                        <option value="Shamrao Vitthal Co-operative Bank">Shamrao Vitthal Co-operative Bank</option>
                        <option value="South Indian Bank">South Indian Bank</option>
                        <option value="State Bank of Bikaner & Jaipur">State Bank of Bikaner & Jaipur</option>
                        <option value="State Bank of Hyderabad">State Bank of Hyderabad</option>
                        <option value="State Bank of India">State Bank of India</option>
                        <option value="State Bank of Mysore">State Bank of Mysore</option>
                        <option value="State Bank of Patiala">State Bank of Patiala</option>
                        <option value="State Bank of Travancore">State Bank of Travancore</option>
                        <option value="Syndicate Bank">Syndicate Bank</option>
                        <option value="Tamilnad Mercantile Bank Ltd.">Tamilnad Mercantile Bank Ltd.</option>
                        <option value="UCO Bank">UCO Bank</option>
                        <option value="Union Bank of India">Union Bank of India</option>
                        <option value="United Bank of India">United Bank of India</option>
                        <option value="Vijaya Bank">Vijaya Bank</option>
                        <option value="Yes Bank Ltd">Yes Bank Ltd</option>
                    </select>
                </div>
                
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Account Holder Name</label>
                        <input type="text" class="form-control" placeholder="" name="ac_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Account Number</label>
                        <input type="number" class="form-control" placeholder="" name="ac_num">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">IFSC Code</label>
                        <input type="text" class="form-control" placeholder="" name="ifsc_code">
                    </div>
                   
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="">
                      </div>
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Confirm password </label>
                        <input type="password" class="form-control" name="c_pass" placeholder="">
                      </div>
                </div>
      
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" name="AddMember" class="btn btn-primary">Add Member</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          
      
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          <!-- right column -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


  <!-- Main Footer -->
 <?php
    include("include/BottomBar.php");
 ?>
  
  
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<!--State / Distric / Block Filter -->
<script>
var stateObject = {
"India": { "Delhi": ["new Delhi", "North Delhi"],
"Kerala": ["Thiruvananthapuram", "Palakkad"],
"Goa": ["North Goa", "South Goa"],
},
"Australia": {
"South Australia": ["Dunstan", "Mitchell"],
"Victoria": ["Altona", "Euroa"]
}, "Canada": {
"Alberta": ["Acadia", "Bighorn"],
"Columbia": ["Washington", ""]
},
}
window.onload = function () {
var countySel = document.getElementById("countySel"),
stateSel = document.getElementById("stateSel"),
districtSel = document.getElementById("districtSel");
for (var country in stateObject) {
countySel.options[countySel.options.length] = new Option(country, country);
}
countySel.onchange = function () {
stateSel.length = 1; // remove all options bar first
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
for (var state in stateObject[this.value]) {
stateSel.options[stateSel.options.length] = new Option(state, state);
}
}
countySel.onchange(); // reset in case page is reloaded
stateSel.onchange = function () {
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
var district = stateObject[countySel.value][this.value];
for (var i = 0; i < district.length; i++) {
districtSel.options[districtSel.options.length] = new Option(district[i], district[i]);
}
}
}
</script>
<!--State / Distric / Block Filter -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>

</body>
</html>
