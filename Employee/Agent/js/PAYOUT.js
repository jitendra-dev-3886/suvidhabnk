// Send Otp for credit card payment 
     $("#payout").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
          $.ajax({
                 url:'Backend/PAYOUT/cashfree/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                      let rs_code = rslt.subCode; 
                      let msg = rslt.message; 
                      if(rs_code == 200){
                        popup_reload('success' , 'Congratulations' , " Account Added Msg: " + msg)
                            // location.reload();
                      } 
                      else if(rs_code == 409){
                      popup_reload('success' , 'Congratulations' , " Account Added")
                      }
                      else{
                         popup('error' , 'OOPS..!' ,msg);
                      }
                     }
                     else{
                         popup('error' , 'OOPS..!' ,rslt.message);
                     }
                      }
                     else{
                         popup('error' , 'OOPS..!' ,rslt.message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     })
     
    // transaction payout
     $("#payout_trans").submit(function(e){
         e.preventDefault();
         if($("#otp").val() != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/PAYOUT/cashfree/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rspns = JSON.parse(data);
                      if(rspns.rscode == undefined){
                  if(rspns.response_code == 1){
                      let rslt = rspns.receivableData;
                     if(rslt.subCode == "200" || rslt.subCode == "201" || rslt.subCode == "202"){
                          let st = rslt.status;
                          let msg = rslt.message;
                         msg = "Status: "+st+" Msg :"+msg;
                         Swal.fire({
                              title: st,
                              text:  msg,
                              icon: 'success',
                              button: "okay",
                              closeOnClickOutside: false, 
                            })
                            .then(function(){ 
                            //   location.replace("DMT_Report?MyLatestReport");
                            location.reload();
                              }
                            );
                      }
                      else{
                          msg = "Status: "+st+" Msg :"+msg;
                          popup('error' ,st  ,msg);
                      }
                 }
                 else{
                      popup('error' ,"OOPS.."  ,rspns.message);
                 }
                      
                      }
                     else{
                         popup('error' , 'OOPS..!' ,rspns.message);
                     }   
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
            popup('error' , 'OOPS..!' , "Please enter OTP");
         }
     })


     
     // check txn status
     function check_status(id){
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/PAYOUT/cashfree/main',
                 type:'post',
                 data: {ref_id , check_status},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rspns = JSON.parse(data);
                      let rslt = rspns.receivableData;
                      if(rspns.rscode == undefined){
                  if(rspns.response_code == 1){
                      
                      let status = rslt.data.transfer.status; 
                      let msg;
                      if(rslt.data.transfer.reason == undefined){
                          msg =  "UTR : "+rslt.data.transfer.utr;
                      }
                      else{
                          msg =  rslt.data.transfer.reason;
                      }
                      if(rslt.subCode == "200" || rslt.subCode == "201" || rslt.subCode == "202"){
                         Swal.fire({
                          title: "Congratulations",
                          text:  " \n Status : "+status+" \n Message : " + msg,
                          icon: 'success',
                          button: "Okay",
                          closeOnClickOutside: false, 
                        })
                        .then(function(){ 
                           location.replace("PayoutServiceReport?MyLatestReport");
                           }
                        );
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                   }
                   else{
                       popup('error' , 'OOPS..!' , rspns.message);
                   }
                      }
                     else{
                         popup('error' , 'OOPS..!' ,rspns.message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
     
     // send otp for verification 
     function sendotp(){
         
             $("#otpSendTime").val(Number($("#otpSendTime").val())+1);
             let otpSendTime = $("#otpSendTime").val();
           let sendotp = 'sendotp';
           let amount = $("#send_amount").val();
           if(amount != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/PAYOUT/cashfree/main',
                 type:'post',
                 data: { sendotp , amount ,otpSendTime},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                      if(rspns.rscode == undefined){
                          if(rspns.response_code == 1){
                              let msg = rslt.smsotpst;
                              popup('success' ,"OTP Send"  , "Email OTP : Success. \n Mobile OTP : "+ msg);
                               $("#verify").val(rslt.OTPHASH);
                            //   $("#otp_area").hide();
                              $("#send_otpbtn").text("Resend OTP");
                              $("#send_amount").attr("readonly" , "readonly");
                              $("#otp_enter").show();
                              $("#submit_area").show();
                          }
                          else{
                             popup('error' , 'OOPS..!' ,rspns.message);
                          }
                      }
                     else{
                         popup('error' , 'OOPS..!' ,rspns.message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
           }
           else{
                popup('error' , 'OOPS..!' , "Please enter amount");
           }
           }