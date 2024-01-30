
    //  add beneficiry dmt
     $("#upi_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/UPI/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                     if(rspns.rscode == undefined){
                         if(rspns.response_code == 1){
                          let rs_code = rslt.subCode; 
                          let msg = rslt.message; 
                             msg = "\n Bene Name : "+rslt.data.nameAtBank;
                             $("#showupiid").text($("#upiid").val());
                             $("#showbenemobile").text($("#mobile").val());
                             $("#sendupi_mobile").val($("#mobile").val());
                             $("#showbenename").text(rslt.data.nameAtBank);
                             $("#sendupi_name").val(rslt.data.nameAtBank);
                             $("#sendupi_id").val($("#upiid").val());
                             $("#sendAmModalCenter").modal("show");
                            // popup_reload('success' , 'Congratulations' , msg);
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
     
     
     
     
    //  send amount dmt
     $("#send_amount_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/UPI/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                      console.log(rspns);
                      
                     if(rspns.rscode == undefined){
                       if(rspns.response_code == 1){
                              let txntype = rspns.TxnType; 
                              let txncount = rspns.txncount; 
                              let st = rslt.status;
                              let msg = rslt.message;
                                  if(rslt.subCode == "200" || rslt.subCode == "201" || rslt.subCode == "202"){
                                     msg = "Status: "+st+"\n Msg :"+msg+"\n UTR :"+rslt.data.utr;
                                    Swal.fire({
                                          title: st,
                                          text:  msg,
                                          icon: 'success',
                                          button: "Okay",
                                          closeOnClickOutside: false, 
                                        })
                                        .then(function(){ 
                                        //   location.replace("DMT_Report?MyLatestReport");
                                        location.reload();
                                          }
                                        );
                                  }
                                  else{
                                      msg = "Status: "+st+"\n Msg :"+msg;
                                      popup('error' ,st  ,msg);
                                  }
                          }
                      else{
                          popup('error' , "OOPS."  ,rslt.message);
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
     
     
     function sendamountotp(){
         let send_amount = $("#send_amount").val();
         let sendamountotp= "send_otp";
         
         $("#otpSendTime").val(Number($("#otpSendTime").val())+1);
         let otpSendTime = $("#otpSendTime").val();
           if(send_amount != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/UPI/main',
                 type:'post',
                 data:{sendamountotp,send_amount , otpSendTime},
              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                      if(rspns.rscode == undefined){
                          let rs_code = rslt.rs_code;
                          let msg = rslt.message;
                          if(rslt.rs_code == "111"){
                             if(rslt.smsotpst == "Success"){
                                let hash_code = rslt.OTPHASH;
                                $("#hash_code").val(hash_code);
                                $("#submitBtn").show();
                                $("#amOtpArea").show();
                                $("#resendotp").show();
                                $("#sendotparea").hide();
                                $("#send_amount").attr("readonly" , "readonly");
                                popup('success' , 'Congratulations' , "OTP has been sent to your mobile number.");
                             }
                             else{
                                 popup('error' , 'OOPS..!' , "OTP Not Sent. "+rslt.smsotpst);
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
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
             popup('error' , 'OOPS..!' , " Enter Amount. !")
         }
     }
     
     
     
     
     
     
     
     
     // check DMT status
     function check_upi_status(id){
        //   preventDefault();
          let check_upi_status = 'check_upi_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/UPI/main',
                 type:'post',
                 data: {ref_id , check_upi_status},
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
                        // popup_reload('success' , 'Congratulations' , " <br> Status : "+status+" <br> Message : " + msg);
                         Swal.fire({
                              title: "Congratulations",
                              html:   "<br> Status : "+status+" <br> Message : " + msg,
                              icon: 'success',
                              button: "Print",
                              closeOnClickOutside: false, 
                            })
                            .then(function(){ 
                            //   location.replace("MoneyTransferDMTReport?MyLatestReport");
                               }
                            );
                        // location.reload();
                      }
                      else{
                        popup('error' , 'OOPS..!' , rslt.message);
                      }
                   }
                   else{
                       popup('error' , 'OOPS..!' , rspns.message);
                   }
                     }
                     else{
                         popup('error' , 'OOPS..!' , rspns.message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
     