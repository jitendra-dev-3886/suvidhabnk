<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Paydeer</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

 <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7WCG9NYPN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T7WCG9NYPN');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-221712912-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-221712912-1');
</script>
  
</head>

<style>
    .logbox {
    text-align: center;
    background: #96eae5;
    padding: 20px;
    margin: 5%;
    border-radius: 10px;
}

.logbox a{
    background:#18A3AE !important;
}

#forgotbox{
    display:none;
}

#otpbox{
    display:none;
}

#changepassbox{
     display:none;
}

.errormsg{
    font-weight:700;
    text-align:center;
    color:red;
    
}

.successmsg{
     font-weight:700;
    text-align:center;
    color:#2ecc71;
}

</style>

<body  class="hold-transition login-page" onload="LocateUser()">
    
     <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>

  <!-- ======= Top Bar ======= -->
  
  <!-- ======= Header ======= -->
  <?php // include('../topheader.php');?>
    <!--<br><br><br>-->

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact pt-0">
        <div class="row d-flex justify-content-between" data-aos="fade-up" data-aos-delay="100">
            
        <div class="col-lg-8">
            <img src="https://paydeer.in/Agent/docs/assets/img/Login.jpg" class="img-fluid">
        </div>    

         <div style="margin: auto;" id="loginbox" class="col-lg-4">
             <h3 class="text-center mt-4" style="color:#18A3AE;">Welcome to Paydeer</h3>
             <h4 class="text-center mt-2" style="color:#18A3AE;">Login to Continue</h4>
            
             
             <form id="login_form" class="php-email-form" method="post" autocomplete="off">
           <input type="hidden" id="long" name="long">
                                    <input type="hidden" id="lati" name="lati">
        <div class="input-group mb-3">
          <input type="number" name="mobile" onkeypress="return this.value.length < 10;" id="mobile" class="form-control" placeholder="Mobile">
          
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password"  id="password" class="form-control" placeholder="Password">
          
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary">
             
                <div style="display: flex;
    align-items: center;" class="col-md-12">
                <input style="width: 16px;
    margin: 0;
    padding: 0;
    display: inline;" type="checkbox" class="form-control" name="check" id="checkterms" required/>
                <label style="margin-left: 10px;">I agree to usage <a href="https://paydeer.in/privacy-policy" class="text-priamry">Terms & Conditions</a></label>
                </div>
                <div class="validate"></div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button  type="submit" id="disable_btn" name="login" class="btn btn-primary btn-block">Sign In</button>
            <!--<a href="https://paydeer.in/Distributor/" class="btn btn-primary btn-block">Login As Distributor</a>-->
            <button  type="button" id="frgtpass" name="fgpass" class="btn btn-primary btn-block">Forgot Password?</button>
            <p class="text-center" style="color:#18A3AE;">  Sign Up</p>
          </div>
        </div>
      </form>
      
            <div class="errormsg" id="response1"></div>  
            

          </div>
          
           <div style="margin: auto;" id="forgotbox" class="col-lg-4">
             <h3 class="text-center mt-4" style="color:#18A3AE;">Forgot Password</h3>
            
             <form id="forgot_form" class="php-email-form" method="post" autocomplete="off">
           
        <div class="input-group mb-3">
          <input type="number" name="fmobile" onkeypress="return this.value.length < 10;" id="fmobile" class="form-control" placeholder="Mobile Number" required>
          
        </div>
        
        <div class="row">
          <div class="col-12">
            <button  type="button" id="forgotbtn" class="btn btn-primary btn-block">Send OTP</button>
          </div>
        </div>
      </form>
      
            <div class="errormsg" id="response2"></div>  
            
          </div>
          
          <div style="margin: auto;" id="otpbox" class="col-lg-4">
             <h3 class="text-center mt-4" style="color:#18A3AE;">OTP Verificatiion</h3>
            
             <form id="otp_form" class="php-email-form" method="post" autocomplete="off">
           
        <div class="input-group mb-3">
          <input type="number" name="otp" id="otp" onkeypress="return this.value.length < 5;" class="form-control" placeholder="Enter OTP" required>
          <input type="hidden" name="sotp" id="smsotp">
          
        </div>
        
        <div class="row">
          <div class="col-12">
            <button  type="button" id="otpbtn" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>
      </form>
      
            <div class="errormsg" id="response3"></div>  
            
          </div>
          
          
           <div style="margin: auto;" id="changepassbox" class="col-lg-4">
             <h3 class="text-center mt-4" style="color:#18A3AE;">Change Password</h3>
            
             <form id="resetpass_form" class="php-email-form" method="post">
           
        <div class="input-group mb-3">
          <input type="hidden" id="unum">
          <input type="text" name="currentpass" id="newpass" class="form-control" placeholder="New Password" required>
          
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="newpassword"  id="confirmpass" class="form-control" placeholder="Confirm Password" required>
          
        </div>
        
        <div class="row">
          <div class="col-12">
            <button  type="button" id="rbtn" class="btn btn-primary btn-block">Reset Password</button>
          </div>
        </div>
      </form>
      
            <div class="errormsg" id="response4"></div>  
            <div class="successmsg" id="response5"></div>  
            
          </div>
          
           <div class="col-md-8">
           <div class="row">
                
                <div class="col-md-6">

            <div class="logbox">
        
                <h6>Apni Local Shop Ko Banaye Digital Shop</h6>
                <a href="#" class="btn btn-primary">JOIN US</a>
            </div>
            </div>
            <div class="col-md-6">
            <div class="logbox">
                <h6>Work Anywhere & Anytime With Paydeer App</h6>
                <a href="Paydeer.apk" download="Paydeer.apk" class="btn btn-primary">DOWNLOAD NOW</a>
            </div>
            </div>
            
            </div>
            </div>

          

        </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php // include('../Footer.php');?>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <!--<script src="../assets/vendor/php-email-form/validate.js"></script>-->
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>


<script>
   $(document).ready(function(){
       $("#frgtpass").click(function(){
           $("#loginbox").hide();
           $("#forgotbox").show();
           
       });
       
       $("#forgotbtn").click(function(){
           
            if($("#forgot_form")[0].checkValidity()){
                $(this).html("Please Wait...");
               var fnum = $("#fmobile").val();
               $.ajax({
                   url : "Backend/Login/forgot_pass.php",
                   method : "POST",
                   data : {forgotnum:fnum,pageid:1},
                   success : function(response){
                      
                       let rslt = JSON.parse(response);
                       if(rslt.response_code == 1){
                       $("#smsotp").val(rslt.otp);
                       $("#unum").val(rslt.number);
                       $("#forgotbtn").html("Send OTP");
                       $("#forgotbox").hide();
                       $("#otpbox").show();
                       }else if(rslt.response_code == 3){
                            $("#forgotbtn").html("Send OTP");
                           $("#response2").html("Something went wrong please enter your valid details.");
                       }else if(rslt.response_code == 4){
                           $("#forgotbtn").html("Send OTP");
                           $("#response2").html("User Does Not Exist");
                           
                       }
                   }
               });
           }
       });
       
       
      $("#otpbtn").click(function(){
           
            if($("#otp_form")[0].checkValidity()){
                $("#otpbtn").html("Please Wait...");
               var otp = $("#otp").val();
               var smsotp = $("#smsotp").val();
               $.ajax({
                   url : "Backend/Login/forgot_pass.php",
                   method : "POST",
                   data : {uotp:otp,sotp:smsotp,pageid:2},
                   success : function(response){
                        let rslt = JSON.parse(response);
                       if(rslt.response_code == 1){
                       $("#otpbtn").html("Submit");
                       $("#otpbox").hide();
                       $("#changepassbox").show();
                       }else if(rslt.response_code == 3){
                            $("#otpbtn").html("Submit");
                           $("#response3").html("Wrong OTP Please Enter Correct OTP!");
                       }
                   }
               });
           }
      });
      
      
$("#rbtn").click(function(){
   
    if($("#resetpass_form")[0].checkValidity()){
        $("#rbtn").html("Please Wait...");
        
       var unum = $("#unum").val();
       var newpass = $("#newpass").val();
       var cpass = $("#confirmpass").val();
       
       if(cpass === newpass){
       $.ajax({
           url : "Backend/Login/forgot_pass.php",
           method : "POST",
           data : {usernum:unum,npass:newpass,pageid:3},
           success : function(response){
               let rslt = JSON.parse(response);
               if(rslt.response_code == 1){
               $("#rbtn").html("Submit");
               $("#response5").html("Your Password has been changed <a href='https://paydeer.in/Agent/Login'>Go to login page</a>");
               }else if(rslt.response_code == 3){
                    $("#rbtn").html("Submit");
                   $("#response4").html("Somthing went wrong please check your details");
               }
           }
       });
       
       }else{
            $(this).html("Submit");
                   $("#response4").html("Password Does Not Matched!");
       }
   }
});
       
   }); 
    
    
</script>




  <!-- Template Main JS File -->
  <script src="js/Login.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="js/Main.js"></script>
  
  
</body>

</html>