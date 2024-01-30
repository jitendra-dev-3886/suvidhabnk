<?php
session_start();
include("../Db/config.php");
include("Backend/Functions/all_function.php");


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>New Onboarding</title>
    
     <!-- Vendor CSS Files -->
  
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
    
    <style>
        .form-control {
    box-shadow: none;
    border: none;
    background: #eee;
    padding: 10px 5px;
}

.form-control:focus{
    box-shadow:none;
    border: none;
    background: #eee;
    padding: 10px 15px;
    
}

button.btn.btn-primary {
    background: #18A3AE;
    outline:none;
    border:none;
}

button.btn.btn-primary:hover{
    background:#01a3a4;
}

button.btn.btn-primary:focus {
    background: #18A3AE;
    border:none;
    box-shadow:none;
    outline:none;
}

button.btn-lg {
    padding: 8px 30px;
    border-radius: 12px;
    letter-spacing: 0.8px;
}

button.btn-lg {
    padding: 8px 30px;
    border-radius: 12px;
    letter-spacing: 1px;
    background-color: #eee;
    color: #000;
    border: none;
    font-weight: 700;
}

.active{
    background-color: #18A3AE !important;
    color:#fff !important;
    border: none;
    outline: none;
}
    </style>
    
  </head>
  <body oncontextmenu="return false;">
      
      <?php include('../topheader.php');?>
<br><br><br><br><br>
      
      <div class="container my-5">
          
          <div class="row mb-4">
              <div class="col-2">
              <button type="button" class="btn btn-lg active" id="step1" disabled>STEP - I</button>
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-lg" id="step2" disabled>STEP - II</button>
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-lg" id="step3" disabled>STEP - III</button>
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-lg" id="step4" disabled>STEP - IV</button>
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-lg" id="step5" disabled>STEP - V</button>
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-lg" id="step6" disabled>STEP - VI</button>
              </div>
          
          </div>
          
      <?php
      
      if(isset($_GET['step1'])){
          $requestId = $_GET['requestId'];
           $user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
            $ID = $user['USER_ID'];
        
        $userdata = $con->query("select * FROM user WHERE ID='$ID'  ORDER BY ID DESC LIMIT 1")->fetch_assoc();
          ?>
          <h1>Adhaar Details</h1>
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Partner ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Adhaar Pic</th>
                  <th scope="col">Adhaar Num</th>
                  <th scope="col">Address</th>
                  <th scope="col">City</th>
                  <th scope="col">State</th>
                  <th scope="col">Pin</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $userdata['PARTNER_ID']; ?></th>
                  <td><?php echo $userdata['FIRST_NAME']; ?></td>
                  <td><img src="<?php echo $userdata['ADHAAR_PIC']; ?>"></td>
                  <td><?php echo $userdata['ADHAAR']; ?></td>
                  <td><?php echo $userdata['ADDRESS']; ?></td>
                  <td><?php echo $userdata['CITY']; ?></td>
                  <td><?php echo $userdata['STATE']; ?></td>
                  <td><?php echo $userdata['PIN']; ?></td>
                </tr>
              </tbody>
            </table>
             <form id="PanForm">
              <div class="mb-3">
                <label for="" class="form-label">Enter Name in Pan </label>
                <input type="text"  id="pannname" class="form-control" >
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Enter Pan </label>
                <input type="text"  id="pannum" class="form-control" >
              </div>
              
                <input type="hidden" id="reqid" value="<?php echo $_GET['requestId'] ?>">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <?php
      }
      else if(isset($_GET['step2'])){
      $requestId = $_GET['requestId'];
           $user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
            $ID = $user['USER_ID'];
            
        $userdata = $con->query("select * FROM user WHERE ID='$ID'  ORDER BY ID DESC LIMIT 1")->fetch_assoc();
          ?>
          <h1>Pan Details</h1>
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Partner ID</th>
                  <th scope="col">Pan Name</th>
                  <th scope="col">Pan Number</th>
                  <th scope="col">View</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $userdata['PARTNER_ID']; ?></th>
                  <td><?php echo $user['PAN_NAME']; ?></td>
                  <td><?php echo $user['PAN_NO']; ?></td>
                  <td><a href="<?php echo $user['PAN_PDF']; ?>" target="_blank">View</a></td>
                </tr>
              </tbody>
            </table>
            
             <form id="BankForm">
              <div class="mb-3">
                <label for="" class="form-label">Enter Account Number </label>
                <input type="text"  id="accountNum" class="form-control" >
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Enter IFSC </label>
                <input type="text"  id="bankifsc" class="form-control" >
              </div>
              
                <input type="hidden" id="reqid" value="<?php echo $_GET['requestId'] ?>">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
   <?php
      }
      else if(isset($_GET['step3'])){
        $requestId = $_GET['requestId'];
           $user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
            $ID = $user['USER_ID'];
            
        $userdata = $con->query("select * FROM user WHERE ID='$ID'  ORDER BY ID DESC LIMIT 1")->fetch_assoc();
        $bankuserdata = $con->query("select * FROM payout_users WHERE US_ID='$ID'  ORDER BY ID DESC LIMIT 1")->fetch_assoc();
          ?>
          <h1>Bank Details</h1>
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Partner ID</th>
                  <th scope="col">Ac Holder Name</th>
                  <th scope="col">Acc. Number</th>
                  <th scope="col">IFSC </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $userdata['PARTNER_ID']; ?></th>
                  <td><?php echo $bankuserdata['NAME']; ?></td>
                  <td><?php echo $bankuserdata['ACCOUNT']; ?></td>
                  <td><?php echo $bankuserdata['IFSC']; ?></td>
                </tr>
              </tbody>
            </table>
            
             <form id="PassForm">
              <div class="mb-3">
                <label for="" class="form-label">Enter MPIN </label>
                <input type="text" id="mpin" class="form-control">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Enter Password </label>
                <input type="text"  id="password" class="form-control" >
              </div>
                <input type="hidden" id="reqid" value="<?php echo $_GET['requestId'] ?>">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            
          <?php
      }
      else{
      ?>
             <form class="row" id="checkCredentialForm">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Enter Mobile</label>
                <input type="number" id="mobile" class="form-control">
                <span class="text-danger">Required*</span>
              </div>
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Enter Email</label>
                <input type="email"  id="email" class="form-control" >
                <span class="text-danger">Required*</span>
              </div>
              <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            
             <form class="row" id="mobileotpForm" style="display:none;">
              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Mobile OTP</label>
                <input type="number" id="mobileOTP" class="form-control">
                <input type="hidden" id="rmobile">
                <span class="text-danger">Required*</span><button style="background:none;color:#18A3AE;" type="button" id="resendotpbtn" class="btn btn-primary">Resend OTP</button>
              </div>
              <div style="margin-top: 3%;" class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit OTP</button>
              </div>
            </form>
            
             <form class="row" id="emailotpForm" style="display:none;">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Email OTP</label>
                <input type="number" id="emailOTP" class="form-control">
                <input type="hidden" id="remail">
                <span class="text-danger">Required*</span><button style="background:none;color:#18A3AE;" type="button" id="eresendotpbtn" class="btn btn-primary">Resend OTP</button>
              </div>
                <input type="hidden" id="usid">
                <div style="margin-top: 3%;" class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit OTP</button>
              </div>
            </form>
            
     <?php
         }
      ?>
      </div>
     
   
  
   <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
      
      <script>   
      
//       document.onkeydown = function(e) {
// if(event.keyCode == 123) {
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
// return false;
// }
// }

// document.addEventListener('contextmenu', function(e) {
//   e.preventDefault();
// });
      
      
          $("#checkCredentialForm").submit(async function(e){
              e.preventDefault();
              let reqdata = {information: {mobile:$("#mobile").val()  , email:$("#email").val()} , event: "areAllCredentialsFine"};
            let options = {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json;charset=utf-8'
              },
              body: JSON.stringify(reqdata)
            }
            let fetchRes =await fetch("Backend/Onboard/checkDetails", options);
            let rspns = await fetchRes.json();
            console.log(rspns);
            if(rspns.status == true)
            {
                $("#rmobile").val($("#mobile").val());
                $("#remail").val($("#email").val());
                $("#usid").val(rspns.usid);
                if(rspns.response_code == "1123"){
                    
                    alert(rspns.message);
                    create_url();
                }
                else  if(rspns.response_code == "1223"){
                 alert(rspns.message);
                 location.replace("?step1&requestId="+rspns.reqid);
                }
                else  if(rspns.response_code == "1323"){
                 alert(rspns.message);
                 location.replace("?step2&requestId="+rspns.reqid);
                }
                else  if(rspns.response_code == "1423"){
                 alert(rspns.message);
                 location.replace("?step3&requestId="+rspns.reqid);
                }
                else{
                    $("#step1").removeClass("active");
                    $("#step2").addClass("active");
                    $("#checkCredentialForm").hide();
                    $("#mobileotpForm").show();
                    alert(rspns.message);
                }
            }
            else{
                alert(rspns.message);
            }
          });
          
          
          
          $("#mobileotpForm").submit(async function(e){
              e.preventDefault();
              let reqdata = {event: "verify-mobile-otp", information: {mobile:$("#mobile").val()  , email:$("#email").val() , email_otp:$("#emailOTP").val() , mobile_otp: $("#mobileOTP").val()} };
            let options = {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json;charset=utf-8'
              },
              body: JSON.stringify(reqdata)
            }
            let fetchRes =await fetch("Backend/Onboard/checkOTP", options);
            let rspns = await fetchRes.json();
            console.log(rspns);
            if(rspns.status == true)
            {
                $("#step2").removeClass("active");
                    $("#step3").addClass("active");
                 $("#mobileotpForm").hide();
                $("#emailotpForm").show();
                alert(rspns.message);
                
            }
            else{
                alert(rspns.message);
            }
          });
          
          
          $("#emailotpForm").submit(async function(e){
              e.preventDefault();
              let reqdata = {event: "verify-email-otp", information: {mobile:$("#mobile").val()  , email:$("#email").val() , email_otp:$("#emailOTP").val() , mobile_otp: $("#mobileOTP").val()} };
            let options = {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json;charset=utf-8'
              },
              body: JSON.stringify(reqdata)
            }
            let fetchRes =await fetch("Backend/Onboard/checkOTP", options);
            let rspns = await fetchRes.json();
            console.log(rspns);
            if(rspns.status == true)
            {
                $("#usid").val(rspns.usid);
                $("#step2").removeClass("active");
                    $("#step3").addClass("active");
                $("#emailotpForm").hide();
                $("#adhaarForm").show();
                alert(rspns.message);
                create_url();
            }
            else{
                alert(rspns.message);
            }
          });
          
          $("#resendotpbtn").click(function(){
              $.ajax({
                  url : "Backend/Onboard/checkDetails",
                  method : "POST",
                  data : {action:2,rmb:$("#rmobile").val()},
                  success : function(data){
                      let rslt = JSON.parse(data);
                      let rscode = rslt.response_code;
                      
                      if(rscode == 1){
                          Swal.fire({
                                      icon: "success",
                                      title: "Hurray!",
                                       button: "Okay",
                                      text: 'Resend OTP has been sent to your mobile number successfully.',
                                    });
                      }else{
                          Swal.fire({
                                      icon: "error",
                                      title: "OOPS!",
                                       button: "Close",
                                      text: 'Error,Resend OTP Not Sent.',
                                    })
                      }
                  }
              });
          });
          
          $("#eresendotpbtn").click(function(){
              $.ajax({
                  url : "Backend/Onboard/checkDetails",
                  method : "POST",
                  data : {action:3,rem:$("#remail").val()},
                  success : function(data){
                      let rslt = JSON.parse(data);
                      let rscode = rslt.response_code;
                      
                      if(rscode == 1){
                          Swal.fire({
                                      icon: "success",
                                      title: "Hurray!",
                                       button: "Okay",
                                      text: 'Resend OTP has been sent to your email id successfully.',
                                    });
                      }else{
                          Swal.fire({
                                      icon: "error",
                                      title: "OOPS!",
                                       button: "Close",
                                      text: 'Error,Resend OTP Not Sent.',
                                    })
                      }
                  }
              });
          });
          
          $("#PanForm").submit(function(e){
              $("#step3").removeClass("active");
              $("#step4").addClass("active");
              e.preventDefault();
             $.ajax({
                url:"Backend/Onboard/getPan",
                method:'POST',
                data:{pull_document:"pull_document" , requestId:$("#reqid").val()  , pannname:$("#pannname").val(), panNumber:$("#pannum").val()},
                success:function(data , st){
                    console.log(data);
                    let rspns = JSON.parse(data);
                    if(rspns.status == true){
                        // $("#PanForm").hide();
                        // $("#BankForm").show();
                        alert("Success");
                        location.replace("NewOnboard?step2&requestId="+$("#reqid").val());
                    }
                    else{
                        if(rspns.response_code == 123){
                            if(confirm(rspns.message) === true){
                                location.replace("NewOnboard");
                            }
                        }
                        else{
                            
                            alert(rspns.message)
                        }
                    }
                }
            })
          })
          
          $("#BankForm").submit(async function(e){
               $("#step4").removeClass("active");
               $("#step5").addClass("active");
              e.preventDefault();
                let reqdata = {beneName:$("#benename").val()  , beneAcc:$("#accountNum").val() , beneMobile:$("#benemobile").val() , beneIFSC: $("#bankifsc").val(), requestId:$("#reqid").val() };
                let options = {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                  },
                  body: JSON.stringify(reqdata)
                }
                let fetchRes =await fetch("Backend/Onboard/AddBank", options);
                let rspns = await fetchRes.json();
                console.log(rspns);
                if(rspns.status == true)
                {
                    alert(rspns.message);
                    location.replace("NewOnboard?step3&requestId="+$("#reqid").val());
                }
                else{
                    alert(rspns.message);
                   
                }
          })
          
          $("#PassForm").submit(async function(e){
               $("#step5").removeClass("active");
               $("#step6").addClass("active");
              e.preventDefault();
              let reqdata = {event: "finalRegistration", information: {requestId:$("#reqid").val() , mpin:$("#mpin").val() , password:$("#password").val()} };
                let options = {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                  },
                  body: JSON.stringify(reqdata)
                }
                let fetchRes =await fetch("Backend/Onboard/FinalSubmit", options);
                let rspns = await fetchRes.json();
                console.log(rspns);
                if(rspns.status == true)
                {
                    alert(rspns.message);
                    location.replace("../Distributor/Login");
                    
                }
                else{
                   
                    alert(rspns.message);
                }
          })
          
          
        function  create_url(){
            $.ajax({
                url:"Backend/Onboard/CreateURL",
                method:'POST',
                data:{redirect_url:"redirect_url" , information: {mobile:$("#mobile").val()  , email:$("#email").val(), usid:$("#usid").val()}},
                success:function(data , st){
                    let rspns = JSON.parse(data);
                    if(rspns.status == true){
                        location.replace(rspns.receivableData.result.url);
                    }
                    else{
                        alert(rspns.message)
                    }
                }
            })
         }
          
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>