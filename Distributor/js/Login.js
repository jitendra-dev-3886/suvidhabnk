$("#login_form").submit(function(e){
    LocateUser();
    
        if($('#long').val() != "" && $('#lati').val() != ""){
             e.preventDefault();
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'Backend/Login/Login.php',
                     type:'post',
                     data: new FormData(this),
                     processData:false,
                     contentType:false,
                     success:function(data, status){
                         $("#loading_ajax").hide();
                     
                         let rslt = JSON.parse(data);
                          let User_found = rslt.User_Exist; 
                          let User_verification = rslt.Login_Auth;
                          let path;
                          if(User_found == "Yes"){
                              if(rslt.Login_Auth == 1){
                                  localStorage.setItem("Token", rslt.Token);
                                  if(rslt.User_Type == 46){
                                      path = ""; // rt path
                                  }
                                  else if(rslt.User_Type == 47){
                                      path = "";  // ds path
                                  }
                                  else if(rslt.User_Type == 48){
                                      path = ""; //ms path
                                  }
                                  Swal.fire({
                                      icon: "success",
                                      title: "Hurray!",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("index.php");
                                       }
                                    );
                              }
                              else if(User_verification == 2){
                                  if(rslt.rs_code == 200){
                                      localStorage.setItem("Token", rslt.Token);
                                        Swal.fire({
                                      icon: "success",
                                      title: "Hurray!",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("index.php");
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
        e.preventDefault();
     })
 
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
                 url:'Backend/Login/Login',
                 type:'post',
                 data: {otp_verify:otp_verify , otp_mobile:otp_mobile, otp_password:otp_password ,  long:long , lati:lati , otp_store:otp_store ,enteredOtp:enteredOtp},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     let User_found = rslt.User_Exist;
                     let otp = rslt.OTP_VERIFY;
                     let path;
                      if(User_found == "Yes"){
                          if(otp == otp_store){
                                if(rslt.User_Type == 46){
                                      path = ""; // rt path
                                  }
                                  else if(rslt.User_Type == 47){
                                      path = "";  // ds path
                                  }
                                  else if(rslt.User_Type == 48){
                                      path = ""; //ms path
                                  }
                              localStorage.setItem("Token", rslt.Token);
                               Swal.fire({
                                      icon: "success",
                                      title: "Hurray!",
                                       button: "Okay",
                                      text: 'Welcome. You are logged in.',
                                    }) .then(function(){ 
                                          location.replace("index.php");
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
     $("#login_form").hide();
    $("#otp_area").show();
    $("#otp_msg").text(msg);
}