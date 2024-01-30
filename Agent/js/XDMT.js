     //   send otp dmt
     $("#send_otp_btn").click(function(){
         $("#otpSendTime").val(Number($("#otpSendTime").val())+1);
         let otpSendTime = $("#otpSendTime").val();
         let address = $("#address").val();
         let mobile = $("#mobile").val();
         let pincode = $("#pincode").val();
         let name = $("#name").val();
         let send_otp = 'send_otp';
          if(name.length>=5 || name ==""){  
         if(mobile != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/XDMT/cashfree/main',
                 type:'post',
                 data:{address, send_otp , mobile , name ,pincode , otpSendTime},
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
                            popup('success' , 'Congratulations' , "Successfully fetched.");
                            location.replace("?Mobile="+mobile);
                          }
                          else{
                             if(rslt.smsotpst == "Success"){
                                let hash_code = rslt.OTPHASH;
                                $("#hash_code").val(hash_code);
                                $("#submit_btn_area").show();
                                // $("#resendOtp").show();
                                $("#otp_area").show();
                                $("#pin_area").show();
                                $("#add_area").show();
                                $("#name_area").show();
                                
                                $("#send_otp_btn").text("Resend OTP");
                                $("#mobile").attr("readonly" , "readonly");
                                popup('success' , 'Congratulations' , "OTP has been sent to your mobile number.");
                             }
                             else{
                                 popup('error' , 'OOPS..!' , "OTP Not Sent. "+rslt.smsotpst);
                             }
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
         }
         else{
             popup('error' , 'OOPS..!' , " Enter mobile number!")
         }
          }
         else{
             popup('error' , 'OOPS..!' , " Enter name minimum 5 Character atleast!")
         }
     })
     
         
    //   register dmt user
     $("#register_user").click(function(e){
         e.preventDefault();
            let mobile = $("#mobile").val();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/XDMT/cashfree/main',
                 type:'post',
                 data: new FormData(document.querySelector('#dmt_form')),
                 processData:false,
                 contentType:false,
                 
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                   console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                        if(rspns.rscode == undefined){
                          let rs_code = rslt.rs_code;
                          let msg = rslt.message;
                          if(rslt.rs_code == "111"){
                            popup('success' , 'Congratulations' , " You are registered with us Msg: " + msg);
                              location.replace("?Mobile="+mobile);
                          } 
                          else{
                             popup('error' , 'OOPS..!' ,msg);
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
     
         
    //  add beneficiry dmt
     $("#add_bene_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/XDMT/cashfree/main',
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
                      let rs_code = rslt.subCode; 
                      let msg = rslt.message; 
                      if(rs_code == 200){
                        popup_reload('success' , 'Congratulations' , " Beneficiary Added Msg: " + msg)
                            // location.reload();
                      } 
                      else if(rs_code == 409){
                      popup_reload('success' , 'Congratulations' , " Beneficiary Added")
                      }
                      else{
                         popup('error' , 'OOPS..!' ,msg);
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
                 url:'Backend/XDMT/cashfree/main',
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
                              let msg;
                              if(txntype == "111"){
                                  for(let i=0; i<txncount; i++){
                                       let rspns = rslt.response;
                                        let st = rspns[i].status;
                                      let mssg = rspns[i].message;
                                      let txnam = rspns[i].txn_amount;
                                      msg += "<br> Status: "+st+" Msg :"+mssg+" Amount: "+txnam+"<br>";
                                      
                                        //   if(rspns[i].subCode == 1){
                                        //   }
                                        //   else if(rspns[i].subCode == 13){
                                        //         msg += "<br> Status: Failed"+" Msg : Server Error";
                                        //   }
                                        //   else{
                                        //       msg += "<br> Status: "+status+" Msg :"+rspns[i].message+"<br>";
                                        //   }
                                  }
                             Swal.fire({
                                  title: status,
                                  text:  msg,
                                  icon: 'success',
                                  button: "Okay",
                                  closeOnClickOutside: false, 
                                })
                                .then(function(){ 
                                   location.reload();
                                   }
                                );
                              }
                              else{
                                  if(rslt.subCode == "200" || rslt.subCode == "201" || rslt.subCode == "202"){
                                      let st = rslt.status;
                                      let msg = rslt.message;
                                     msg = "Status: "+st+" Msg :"+msg;
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
                                      msg = "Status: "+st+" Msg :"+msg;
                                      popup('error' ,st  ,msg);
                                  }
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
     
     
    //  send amount function dmt
     function send_amount(bene_id , acc  , ifsc , name , mobile){
         $("#beneId").val(bene_id);
         $("#send_am_acc").val(acc);
         $("#sendbeneMobile").val(mobile);
         
         
         $("#showbeneid").text(bene_id);
         $("#showbeneifsc").text(ifsc);
         $("#showbeneacc").text(acc);
         $("#showbenename").text(name);
         $("#showbenemobile").text(mobile);
     }
     
     function sendamountotp(){
         let send_amount = $("#send_amount").val();
         let sendamountotp= "send_otp";
         
         $("#otpSendTime").val(Number($("#otpSendTime").val())+1);
         let otpSendTime = $("#otpSendTime").val();
           if(send_amount != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/XDMT/cashfree/main',
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
     
     //  delete bene dmt
     function delete_bene(beneid){
        //   preventDefault();
        Swal.fire({
          title: "Are you sure?",
          text: "You want to delete this beneficiary",
          icon: "warning",
           showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Delete',
        })
        .then((result) => {
          if (result.isConfirmed) {
              let bene_delete = 'delete_bene';
              let beneID = beneid;
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'Backend/XDMT/cashfree/main',
                     type:'post',
                     data: {bene_delete ,beneID},
                     beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                     success:function(data, status){
                         $("#loading_ajax").hide();
                        console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                     if(rspns.rscode == undefined){
                         let rs_code = rslt.subCode; 
                          let msg = rslt.message; 
                          if(rs_code == 200){
                            popup_reload('success' , 'Congratulations' , "Beneficiary Deleted Msg: " + msg)
                          } 
                          else{
                             popup('error' , 'OOPS..!' , msg);
                          }
                     }
                     else{
                         popup('error' , 'OOPS..!' ,rslt.message);
                     }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                          popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
                 })
          }
        });
          
     }
     
     
     // check DMT status
     function check_dmt_status(id){
        //   preventDefault();
          let check_dmt_status = 'check_dmt_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/XDMT/cashfree/main',
                 type:'post',
                 data: {ref_id , check_dmt_status},
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
                               location.replace("MoneyTransferDMTReport?MyLatestReport");
                               }
                            );
                        // location.reload();
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
                         popup('error' , 'OOPS..!' , rspns.message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
     
      //  verify bene dmt
     function verify_bene(id){
              let verify_bene = 'verify_bene';
              let beneid = id;
              
                 $("#loading_ajax").show();
                 $.ajax({
                      url:'Backend/XDMT/signzy/main',
                     type:'post',
                     data: {beneid,verify_bene},
                     beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                     success:function(data, status){
                         $("#loading_ajax").hide();
                            console.log(data);
                     let rspns = JSON.parse(data);
                     let rslt = rspns.receivableData;
                            
                     if(rspns.rscode == undefined){
                             let msg;
                             let beneName;
                             let bankrrn;
                             if(rslt.error == undefined){
                                 let Activenes = rslt.result.active;
                                 if(Activenes == "yes"){
                                     beneName = rslt.result.bankTransfer.beneName;
                                     bankrrn = rslt.result.bankTransfer.bankRRN;
                                 }
                                 else{
                                     beneName = "";
                                     bankrrn = ""
                                 }
                                 msg = "<br> Bene Name : "+beneName + "<br> Active : "+Activenes+" <br> Bank RRN : "+bankrrn;
                                popup_reload('success' , 'Congratulations' , msg);
                             }
                             else{
                              let error = rslt.error.message;
                              popup('error' , 'OOPS..!' , error);
                             }
                            //   if(rs_code == 1){
                                // popup_reload('success' , 'Congratulations' , "Transaction Msg: " + msg + "<br>Bene Name: " + rslt.benename+ "<br>UTR : " + rslt.utr);
                                // location.reload();
                            //   } 
                            //   else{
                                // popup('error' , 'OOPS..!' , msg);
                            //   }
                     }
                     else{
                         popup('error' , 'OOPS..!' ,rslt.message);
                     }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                          popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
                })
          
     }