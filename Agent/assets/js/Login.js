
var long = document.getElementById("long");
var lati = document.getElementById("lati");
$(document).ready(function(){
    LocateUser();
})
LocateUser();

function LocateUser() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    popup('error' , 'OOPS..!' , "Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
    
var long = document.getElementById("long");
var lati = document.getElementById("lati");
  long.value =   position.coords.longitude;
  lati.value =   position.coords.latitude;
}

function showError(error) {
    $("#disable_btn").attr("disabled" , "disabled")
    $("#disable_btn").text("Please Enable Location")
  switch(error.code) {
    case error.PERMISSION_DENIED:
     popup('error' , 'OOPS..!' , "User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      popup('error' , 'OOPS..!' ,"Location information is unavailable.");
      break;
    case error.TIMEOUT:
     popup('error' , 'OOPS..!' ,"The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      popup('error' , 'OOPS..!' ,"An unknown error occurred.");
      break;
  }
}

function popup(status , title , msg){
    Swal.fire({
      icon: status,
      title: title,
      text: msg,
    });
}

$("#login_form").submit(function(e){
    LocateUser();
        if($('#long').val() != "" && $('#lati').val() != ""){
             e.preventDefault();
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'handler/login',
                     type:'post',
                     data: new FormData(this),
                     processData:false,
                     contentType:false,
                     success:function(data, status){
                         $("#loading_ajax").hide();
                         $("#mobileno").val($("#mobile").val());
                        //  alert(data);
                         // console.log(data);
                         let rslt = JSON.parse(data);
                          let User_found = rslt.User_Exist; 
                          let User_verification = rslt.Login_Auth;
                          if(User_found == "Yes"){
                              if(rslt.Login_Auth == 1){
                                  Swal.fire({
                                      icon: "success",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("Dashboard/User/Home");
                                       }
                                    );
                              }
                              else if(User_verification == 2){
                                  if(rslt.rs_code == 200){
                                        Swal.fire({
                                      icon: "success",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("Dashboard/User/Home");
                                       }
                                    );
                                  }
                                  else{
                                       if(rslt.OTP_AUTH == 1) {
                                           var msgee = 'OTP Send to your mobile';
                                       }
                                       else if(rslt.OTP_AUTH== 2){
                                             var msgee = 'OTP Send to your email';
                                       }
                                       else if(rslt.OTP_AUTH ==3 ){
                                             var msgee = 'OTP Send to your email and mobile';
                                       }
                                       else{
                                             var msgee = 'OTP Send to your email and mobile';
                                       }
                                        document.cookie ="Verify="+rslt.OTP;
                                        verify(msgee);     
                                  }
                              }
                              else if(User_verification == 3){
                                      if(rslt.OTP_AUTH == 1) {
                                           var msgee = 'OTP Send to your mobile';
                                       }
                                       else if(rslt.OTP_AUTH== 2){
                                             var msgee = 'OTP Send to your email';
                                       }
                                       else if(rslt.OTP_AUTH ==3 ){
                                             var msgee = 'OTP Send to your email and mobile';
                                       }
                                       else{
                                             var msgee = 'OTP Send to your email and mobile';
                                       }
                                    //   console.log(msgee);
                                        document.cookie ="Verify="+rslt.OTP;
                                        verify(msgee);
                              }
                          } 
                          else{
                            popup('error' , 'OOPS..!' ,"Invaild Details.. Or Reset Your Password..!");
                          }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                         popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
                 })
        }
        else{
            LocateUser();
        }
     })
     
     
    function resendotp(){
        let otpresend = "otpresend";
         let mobile = $("#mobileno").val();
        $("#loading_ajax").show();
                 $.ajax({
                     url:'handler/otp_resend.php',
                     type:'post',
                     data: {otpresend:otpresend,mobile:mobile},
                     success:function(data){
                         $("#loading_ajax").hide();
                          $("#resend_otp").hide();
                         // console.log(data);
                          let rslt = JSON.parse(data);
                          let status = rslt.status;
                          let msg = rslt.msg;
                          if(status == true)
                          {
                            popup('success' ,  msg ,'Success');
                            document.cookie ="Verify="+rslt.otp;
                          }
                          else
                          {
                            popup('error' , 'OOPS..!' ,"OTP Send Failed..")   
                          }
                     }
                 })
       
    }
     
 
$("#otp_submit").click(function(e){
     e.preventDefault();
    let otp_verify = "otp_verify";
    let otp_mobile = $("#mobile").val();
    let enteredOtp = $("#otp").val();
    let otp_password = $("#password").val();;
    let long = $("#long").val();
    let lati = $("#lati").val();
    let otp_store = readCookie("Verify");
    if(enteredOtp != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'handler/login',
                 type:'post',
                 data: {otp_verify:otp_verify , otp_mobile:otp_mobile, otp_password:otp_password ,  long:long , lati:lati , otp_store:otp_store ,enteredOtp:enteredOtp},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    //  alert(data);
                    //  console.log(data);
                     let rslt = JSON.parse(data);
                     let User_found = rslt.User_Exist;
                     let otp = rslt.OTP_VERIFY;
                      if(User_found == "Yes"){
                          if(otp == otp_store){
                               Swal.fire({
                                      icon: "success",
                                      title: "",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("Dashboard/User/Home");
                                       }
                                    );
                            document.cookie ="Verify=";
                          }
                          else{
                              popup('error' , 'OOPS..!' ,"You have entered wrong OTP.. Try again.")
                          }
                      }
                      else{
                         popup('error' , 'OOPS..!' ,"Your details are incorrect..")
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
            }
            else{
               popup('error' , 'OOPS..!' , "OTP couldn't be empty");
            }
     })
     
 
 
    function verify(msg){
         $("#main_area").hide();
        $("#otp_area").show();
        $("#otp_msg").text(msg);
    }
    
    
     function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        
