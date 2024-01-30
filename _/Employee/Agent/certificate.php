<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token



$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

$user=$con->query("SELECT * FROM `user` WHERE ID='$usid' ORDER BY ID DESC")->fetch_assoc();
$usname=$user['FIRST_NAME']." ".$user['LAST_NAME'];
$mobile=$user['MOBILE'];
$email=$user['EMAIL'];
$mobile=$user['MOBILE'];
$date=$user['DATE'];
$address=$user['ADDRESS']." ".$user['CITY']." ".$user['STATE']."-".$user['PIN'];
$city=$user['CITY'];
$state=$user['STATE'];
$pin=$user['PIN'];
$usertype=$user['USER_TYPE'];
if($usertype='46'){
    $type="Retailer";
}else if($usertype='47'){
    $type="Distributor";
}else{
    $type="Admin";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Certificate</title>
<meta charset="UTF-8">
<meta name="description" content="Free Web tutorials">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="author" content="John Doe">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    @font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  font-stretch: normal;
  src: url(https://fonts.gstatic.com/s/opensans/v34/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsjZ0B4gaVc.ttf) format('truetype');
}
@font-face {
  font-family: 'Pinyon Script';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/pinyonscript/v17/6xKpdSJbL9-e9LuoeQiDRQR8WOXaPw.ttf) format('truetype');
}
@font-face {
  font-family: 'Rochester';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/rochester/v18/6ae-4KCqVa4Zy6Fif-UC2FHS.ttf) format('truetype');
}
.cursive {
  font-family: 'Pinyon Script', cursive;
}
.sans {
  font-family: 'Open Sans', sans-serif;
}
.bold {
  font-weight: bold;
}
.block {
  display: block;
}
.underline {
  border-bottom: 1px solid #777;
  padding: 5px;
  margin-bottom: 15px;
}
.margin-0 {
  margin: 0;
}
.padding-0 {
  padding: 0;
}
.pm-empty-space {
  height: 40px;
  width: 100%;
}
body {
  padding: 20px 0;
  background: #ccc;
}
.pm-certificate-container {
    position: relative;
    width: 766px;
    height: 558px;
    background-color: #4f29c3;
    padding: 30px;
    color: #333;
    font-family: 'Open Sans', sans-serif;
    box-shadow: 0 0 5px rgb(0 0 0 / 50%);
  /*background: -webkit-repeating-linear-gradient(
    45deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );
  background: repeating-linear-gradient(
    90deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );*/
}
.pm-certificate-container .outer-border {
    width: 764px;
    height: 555px;
    position: absolute;
    left: 54%;
    margin-left: -413px;
    top: 50%;
    margin-top: -277px;
    border: 2px solid #fff;
}
.pm-certificate-container .inner-border {
  width: 730px;
  height: 530px;
  position: absolute;
  left: 50%;
  margin-left: -365px;
  top: 50%;
  margin-top: -265px;
  border: 2px solid #fff;
}
.pm-certificate-container .pm-certificate-border {
  position: relative;
  width: 720px;
  height: 520px;
  padding: 0;
  border: 1px solid #E1E5F0;
  background-color: #ffffff;
  background-image: none;
  left: 50%;
  margin-left: -360px;
  top: 50%;
  margin-top: -260px;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-block {
  width: 650px;
  height: 200px;
  position: relative;
  left: 50%;
  margin-left: -325px;
  top: 70px;
  margin-top: 0;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-header {
  margin-bottom: 10px;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-title {
  position: relative;
  top: 40px;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-title h2 {
  font-size: 34px !important;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-body {
  padding: 20px;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-body .pm-name-text {
  font-size: 20px;
}
.pm-certificate-container .pm-certificate-border .pm-earned {
  margin: 15px 0 20px;
}
.pm-certificate-container .pm-certificate-border .pm-earned .pm-earned-text {
  font-size: 20px;
}
.pm-certificate-container .pm-certificate-border .pm-earned .pm-credits-text {
  font-size: 15px;
}
.pm-certificate-container .pm-certificate-border .pm-course-title .pm-earned-text {
  font-size: 20px;
}
.pm-certificate-container .pm-certificate-border .pm-course-title .pm-credits-text {
  font-size: 15px;
}
.pm-certificate-container .pm-certificate-border .pm-certified {
  font-size: 12px;
}
.pm-certificate-container .pm-certificate-border .pm-certified .underline {
  margin-bottom: 5px;
}
.pm-certificate-container .pm-certificate-border .pm-certificate-footer {
  width: 650px;
  height: 100px;
  position: relative;
  left: 50%;
  margin-left: -325px;
  bottom: -105px;
}
.dotted{
    text-decoration-line: underline;
    text-decoration-style: dotted;
}
@media print{
    .pprint{
    display:none;
}
}
@media print{
    .pprintcolor{
   color:blue;
}
}
</style>
</head>
<body>

<div class="container pm-certificate-container">
    <div class="outer-border"></div>
    <div class="inner-border"></div>
    
    <div class="pm-certificate-border col-xs-12">
            <div class="pm-certificate-title col-xs-6 text-center" style="margin-top: -6%;">
            <div style="float: left;">
                <img src="../../assets/images/<?php echo $row['I_LOGO']?>" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="120">
                </div>
            </div>
            <div class="pm-certificate-title col-xs-6 text-center" style="margin-top: -2%;">
        <div style="float: right;">
        <?php echo $type?> ID: <i class="dotted"><b>SUVID<?php echo $usid?></b></i>
        </div>
            
            </div>

      <div class="row pm-certificate-header">
        <div class="pm-certificate-title cursive col-xs-12 text-center">
            
          <!--<h2>Suvidhabnk</h2>-->
          <img src="assets/Capture67-removebg-previeew.png" style="width: 45%; margin-top: -5%;">
        </div>
      </div>

      <!--<div class="row">-->
        
        <div class="pm-certificate-block">
            <!--<div class="col-xs-12">-->
              <!--<div class="row">-->
                <!--<div class="col-xs-2">-->
                    <!-- LEAVE EMPTY -->
                    <!--</div>-->
                <!--<div class="pm-certificate-name underline margin-0 col-xs-8 text-center">-->
                  <!--<span class="pm-name-text bold"><?php echo $usname?></span>-->
                <!--</div>-->
                <!--<div class="col-xs-2">-->
                    <!-- LEAVE EMPTY -->
                    <!--</div>-->
              <!--</div>-->
            <!--</div>          -->

            <!--<div class="col-xs-12">-->
              <!--<div class="row">-->
                <div class="col-xs-2">
                    <!-- LEAVE EMPTY -->
                    </div>
                <!--<div class="pm-earned col-xs-8 text-center">-->
                  <!--<span class="pm-earned-text padding-0 block cursive">Mobile No.: <?php echo $mobile?></span>-->
                  <!--<span class="pm-credits-text block bold sans">Email : <?php echo $email?></span>-->
                <!--</div>-->
                <!--<div class="col-xs-2">-->
                    <!-- LEAVE EMPTY -->
                    <!--</div>-->
                <!--<div class="col-xs-12"></div>-->
              <!--</div>-->
            <!--</div>-->
            
            
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                <div class="pm-course-title col-xs-8 text-center">
                  <span class="pm-earned-text block pprintcolor"><b><?php echo strtoupper($type)?> CERTIFICATE</b></span>
                </div>
                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
              </div>
            </div>
            
            <div>
                   <!--<span class="pm-credits-text block bold sans"><?php echo $usname?> has successfully joined https://suvidhabnk.com On behalf of https://suvidhabnk.com, we would like to thank you for being a <?php echo $type?>. We value the trust you have put in the service of https://suvidhabnk.com and would like to thank you for that its always a pleasure serving you and we certainly look forward to doing that in future.</span>-->
             <div class="pm-earned col-xs-12 text-left"> 
             <span class="pm-credits-text block bold sans" style="margin-left: 10%;">This is to Certify that <u><i>............... <?php echo strtoupper($usname)?> .............</i></u><br><br></span>
             <span class="pm-credits-text block bold sans" style="margin-left: 10%;">Address : <u><i>............... <?php echo strtoupper($address)?> .............</i></u><br><br></span>
             <span class="pm-credits-text block bold sans" style="margin-left: 10%;">is an authorized <?php echo $type?> for suvidhabnk.</span>
             
            </div>
            </div>

            <!--<div class="col-xs-12">-->
              <!--<div class="row">-->
                <!--<div class="col-xs-2">-->
                    <!-- LEAVE EMPTY -->
                    <!--</div>-->
                <!--<div class="pm-course-title underline col-xs-4 text-center">-->
                  <!--<span class="pm-credits-text block bold sans">BPS PGS Initial PLO for Principals at Cluster Meetings</span>-->
                <!--</div>-->
                <!--<div class="col-xs-2">-->
                    <!-- LEAVE EMPTY -->
                    <!--</div>-->
              <!--</div>-->
            <!--</div>-->
        </div>       
        
        <div class="col-xs-12">
          <div class="row">
            <div class="pm-certificate-footer" style="/*margin-top: -5%;*/"><b>
                <div class="col-xs-4 pm-certified col-xs-4 text-left">
                  <span class="pm-credits-text block sans">Active From</span><br>
                  <span class="pm-credits-text block sans">Date: <i class="dotted"><?php echo $date?></i></span>
                  <!--<span class="block underline"></span>-->
                  <!--<span class="bold block">Crystal Benton Instructional Specialist II, Staff Development</span>-->
                </div>
                <div class="col-xs-4">
                  <!-- LEAVE EMPTY -->
                </div>
                <div class="col-xs-4 pm-certified col-xs-4 text-center">
                  <!--<span class="pm-credits-text block sans">City: <?php echo $city?></span>-->
                  <!--<span class="pm-credits-text block sans">State: <?php echo $state?></span>-->
                  <!--<span class="pm-credits-text block sans">PIN: <?php echo $pin?> </span>-->
                  Signature
                  <span class="block underline"></span>
                  <span class="pm-credits-text block sans">Your name</span>
                  <span class="pm-credits-text block sans">Your Post</span>
                </div>
                  </b>
            </div>
          </div>
        </div>

      <!--</div>-->

    </div>
  </div>
<br><br>
<button onclick="window.print()" style="margin-left: 45%;" class="pprint">Print Certificate</button>
</body>
</html>