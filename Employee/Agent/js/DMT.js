        //   send otp dmt 
     $("#send_otp_btn").click(function(){
         let dob = $("#dob").val();
         let fname = $("#fname").val();
         let lname = $("#lname").val();
         let mobile = $("#mobile").val();
         let pincode = $("#pincode").val();
         let Address = $("#Address").val();
         let send_otp = 'send_otp';
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data:{dob, send_otp ,fname ,lname , mobile , pincode , Address},
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide(); 
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message;
                      let status = rslt.status;
                      if(rs_code == 1){
                      let bank1_limit = rslt.data.bank1_limit;
                      let bank2_limit = rslt.data.bank2_limit;
                      let bank3_limit  = rslt.data.bank3_limit;
                        popup('success' , 'Congratulations' , " User Founded.. You registered with us now");
            
                        if(bank1_limit > 0)
                        {
                         
                          location.replace("?Mobile="+mobile+"&senderLimit="+bank1_limit+"&bankname=bank1");   
                        }
                        else if(bank2_limit > 0)
                            {
                            
                            location.replace("?Mobile="+mobile+"&senderLimit="+bank2_limit+"&bankname=bank2");   

                            }
                            else
                            {
                            location.replace("?Mobile="+mobile+"&senderLimit="+bank3_limit+"&bankname=bank3");   

                            }
            
                        // location.replace("?Mobile="+mobile+"&Bank1Limit="+bank1_limit+"&Bank2Limit="+bank2_limit+"&Bank3Limit="+bank3_limit);
                                                    //   window.history.replaceState({}, 'foo', '/foo');

                        // location.replace("?Mobile="+mobile);
                        
                        
                    //     $('#bnk1').val(bank1_limit);
                    //     $('#bnk2').val(bank2_limit);
                    //     $('#bnk3').val(bank3_limit);
                    //     $('#Mob').val(mobile);
                    //   document.getElementById("replace").submit();

                          
                          
                          
                      } 
                      else if(rs_code == 0){
                        popup('success' , 'Congratulations' , msg);
                        let str_code = rslt.stateresp;
                        $("#str_code").val(str_code);
                        $("#submit_btn_area").show();
                        $("#f_area").show();
                        $("#l_area").show();
                        $("#pin_area").show();
                        $("#address_area").show();
                        $("#dob_area").show();
                        $("#otp_area").show();
                        $("#send_otp_area").hide();
                        // $("#dob_area").hide();
                        // $("#address_area").hide();
                        // $("#pin_area").hide();
                        // $("#mobile_area").hide();
                        // $("#l_area").hide();
                        // $("#f_area").hide();
                        
                      }
                      else if(rs_code == 111){
                        popup('success' , 'Congratulations' , msg);
                        $("#str_code").val(111);
                        $("#f_area").show();
                        $("#l_area").show();
                        $("#pin_area").show();
                        $("#address_area").show();
                        $("#dob_area").show();
                        $("#submit_btn_area").show(); 
                        // $("#otp_area").show();
                        $("#send_otp_area").hide();
                        // $("#dob_area").hide();
                        // $("#address_area").hide();
                        // $("#pin_area").hide();
                        // $("#mobile_area").hide();
                        // $("#l_area").hide();
                        // $("#f_area").hide();
                        
                      }
                      else{
                         popup('error' , 'OOPS..!' ,msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     })
     
    //   register dmt user
     $("#register_user").click(function(e){
         e.preventDefault();
         
         let mobile = $("#mobile").val();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data: new FormData(document.querySelector('#dmt_form')),
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                   console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup('success' , 'Congratulations' , " You are registered with us Msg: " + msg);
                        location.replace("?Mobile="+mobile);
                        // location.reload();
                      } 
                      else{
                         popup('error' , 'OOPS..!' ,msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
        //  else{
        //      popup('success' , 'Congratulations' , " Enter Date of birth..!")
        //  }
     })
     
    //  add beneficiry dmt
     $("#add_bene_form").submit(function(e){
         e.preventDefault();
         let vrfybn = $("#verifybene:checked").val();
         let mobile = $("#sendermobile").val();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                          if(vrfybn == "verifybene"){
                              verify_bene(rslt.data.bene_id  ,rslt.data.bankid , rslt.data.name , rslt.data.accno , mobile);
                          }
                          else{
                            popup_reload('success' , 'Congratulations' , " Beneficiary Added Msg: " + msg)
                          }
                            // location.reload();
                      } 
                      else{
                         popup('error' , 'OOPS..!' ,msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     })
     
     // send otp for verification 
     function sendotp(){
           $("#otpSendTime").val(Number($("#otpSendTime").val())+1);
           let otpSendTime = $("#otpSendTime").val();
           let sendotp = 'sendotp';
           let amount = $("#send_amount").val();
           if(amount != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 type:'post',
                 data: { sendotp , send_am:amount ,otpSendTime},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                          let msg = rslt.smsotpst;
                          if(rslt.response_code == 1){
                             $("#hash_code").val(rslt.OTPHASH);
                                $("#submitBtn").show();
                                $("#amOtpArea").show();
                                $("#resendotp").show();
                                $("#sendotparea").hide();
                                $("#send_amount").attr("readonly" , "readonly");
                                popup('success' , 'Congratulations' , "OTP has been sent to your mobile and Email .");
                          }
                          else if(rslt.response_code == 13){
                             popup('error' , 'OOPS..!' ,"Server Error");
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
           else{
                popup('error' , 'OOPS..!' , "Please enter amount");
           }
       }
  
    //  send amount dmt
     $("#send_amount_form").submit(function(e){
         e.preventDefault();
         $("#exampleModalCenter2").modal("hide");
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                      let rslt = JSON.parse(data);
                      console.log(rslt);
                   if(rslt.response_code == 1){
                      let referenceid = rslt.response.referenceid; 
                          let txntype = rslt.TxnType; 
                          let txncount = rslt.txncount; 
                          let msg;
                          let recieptloc;
                          let st
                          if(txntype == "111"){
                              for(let i=0; i<txncount; i++){
                                   let rspns = rslt.response;
                                    switch(rspns[i].txn_status){
                                           case 0  : st = "Failed and Refunded";
                                           break;
                                           case 1  : st = "Transaction Successfull";
                                           break;
                                           case 2  : st = "Transaction In Process";
                                           break;
                                           case 3  : st = "Transaction Sent To Bank";
                                           break;
                                           case 4  : st = "Transaction on Hold";
                                           break;
                                           case 5  : st = "Transaction Failed";
                                           break;
                                      }
                                      if(rspns[i].response_code == 1){
                                          msg += "Status: "+status+" Msg :"+rspns[i].message+" Amount: "+rspns[i].txn_amount+"\n";
                                         recieptloc += location.replace(`DMT_recipt?refrence_id=${rspns[i].referenceid}`);
                                      }
                                      else if(rspns[i].response_code == 13){
                                            msg += "\n Status: Failed"+" Msg : Server Error";
                                       }
                                      else{
                                          msg += "\n Status: "+status+" Msg :"+rspns[i].message+"\n";
                                      }
                              }
                        //   popup_reload('success' , status  ,msg);
                                 new swal({
                              title: status,
                              html:  msg,
                              icon: 'success',
                             showCancelButton: true,
                          confirmButtonText: 'Print',
                          cancelButtonText: 'Okay',
                          customClass: {
                            actions: 'my-actions',
                            cancelButton: 'canbtn',
                            confirmButton: 'conbtn',
                          },
                              closeOnClickOutside: false, 
                            })
                            .then((result) => {
                              if (result.isConfirmed) {
                                recieptloc;
                              } else{
                                location.replace("dmt_trans");
                              }
                            });
                            
                          }
                          else{
                              let rspns = rslt.response;
                                switch(rspns.txn_status){
                                       case 0  : st = "Failed and Refunded";
                                       break;
                                       case 1  : st = "Transaction Successfull";
                                       break;
                                       case 2  : st = "Transaction In Process";
                                       break;
                                       case 3  : st = "Transaction Sent To Bank";
                                       break;
                                       case 4  : st = "Transaction on Hold";
                                       break;
                                       case 5  : st = "Transaction Failed";
                                       break;
                                  }
                                  if(rspns.response_code == 1){
                                      msg = "Status: "+status+" Msg :"+rspns.message+" Amount: "+rspns.txn_amount;
                                     swal.fire({
                                          title: status,
                                          text:  msg,
                                          icon: 'success',
                                          button: "Print",
                                          closeOnClickOutside: false, 
                                        }).then(function(){ 
                                              location.replace(`DMT_recipt?refrence_id=${referenceid}`);
                                           }
                                        );
                                  }
                                  else if(rspns.response_code == 13){
                                     popup('error' , 'OOPS..!' ,"Server Error");
                                  }
                                  else{
                                      msg = "Status: "+status+" Msg :"+rspns.message+" Remarks :"+rspns.remarks;
                                      popup('error' , status  ,msg);
                                  }
                      }
                      }
                      else if(rslt.response_code == 13){
                          
                          popup('error' , "OOPS."  ,"Server Down");
                      }
                      else{
                          popup('error' , "OOPS."  ,rslt.message);
                      }
                      
                      
                    //   let rs_code = rslt.response_code; 
                    //   let msg = rslt.message; 
                    //   let last_id = rslt.last_id; 
                    //   if(rs_code == 1){
                    //           let details =  `
                    //                      <tr><td>${rslt.benename}</td>
                    //                      <td>${rslt.remitter}</td>
                    //                      <td>${rslt.account_number}</td>
                    //                     <td>${rslt.txn_amount}</td>
                    //                     <td>${rslt.balance}</td>
                    //                     <td>${rslt.customercharge}</td>
                    //                     <td>${rslt.gst}</td>
                    //                      <td>${rslt.tds}</td>
                    //                     <td>${msg}</td>
                    //                     </tr>`;
                    //                     $("#dmt_send").html(details);
                    //                     $("#exampleModalCenter4").modal("show");
                    //                     $("#dmtprint").attr("href", "DMT_recipt.php?id="+last_id);
                    //   } 
                    //   else{
                    //      if(rs_code == 13)
                          
                    //       {
                    //         popup('error' , 'OOPS..!' ,"Server Down Please Contact To Admin!");
                    //       }
                          
                    //       else
                    //       {
                    //           popup('error' , 'OOPS..!' ,msg);
                    //       }
                    //   }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     })
     
     //   let cn = confirm_user("Are you sure want to delete this?");
    //  delete bene dmt
     function delete_bene(beneid , acc , mobile){
        //   preventDefault();
         new swal({
          title: "Are you sure?",
          text: "You want to delete this beneficiary",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              let bene_delete = 'delete_bene';
              let bene_id = beneid;
              let bene_acc = acc;
              let senderMobile = mobile;
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'Backend/DMT/paysprint/register_user.php',
                     type:'post',
                     data: {bene_delete ,bene_id , bene_acc ,senderMobile },
                     beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                     success:function(data, status){
                         $("#loading_ajax").hide();
                        console.log(data);
                         let rslt = JSON.parse(data);
                          let rs_code = rslt.response_code; 
                          let msg = rslt.message; 
                          if(rs_code == 1){
                            popup_reload('success' , 'Congratulations' , "Beneficiary Deleted Msg: " + msg)
                          } 
                          else{
                             popup('error' , 'OOPS..!' , msg);
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
     
     
      //  verify bene dmt
     function verify_bene(beneId  ,bankid , beneName ,acc , mobile){
              let verify_bene = 'verify_bene';
              let beneid = beneId;
              let bene_acc = acc;
              let bank_code = bankid;
              let benename = beneName;
              let senderMobile = mobile;
                 $("#loading_ajax").show();
                 $.ajax({
                      url:'Backend/DMT/paysprint/register_user.php',
                     type:'post',
                     data: {verify_bene ,beneid,bene_acc,bank_code,benename ,senderMobile},
                     beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                     success:function(data, status){
                         $("#loading_ajax").hide();
                        console.log(data);
                             let rslt = JSON.parse(data);
                              let rs_code = rslt.response_code; 
                              let msg = rslt.message; 
                              if(rs_code == 1){
                                popup_reload('success' , 'Congratulations' , "Transaction Msg: " + msg + "\nBene Name: " + rslt.benename+ "\nUTR : " + rslt.utr);
                                // location.reload();
                              } 
                              else{
                                popup('error' , 'OOPS..!' , msg);
                              }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                          popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
                })
          
     }
     // check transaction status dmt 
     function check_dmt_status(id){
        //   preventDefault();
          let check_dmt_status = 'check_dmt_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data: {ref_id:ref_id ,check_dmt_status:check_dmt_status},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup('success' , 'Congratulations' , "Transaction Msg: " + msg);
                        // location.reload();
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
     // resend otp for refund in dmt 
     function resendRefundOTP(){
        //   preventDefault();
          let resendRefundOTP = 'resendRefundOTP';

         let ref_id = $("#ref_id").val();
         let akno = $("#akno").val();
         if(ref_id != "" && akno != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data: {ref_id ,resendRefundOTP ,akno},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup('success' , 'Congratulations' , "Msg: " + msg);
                        // location.reload();
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })   
         }
         else{
                     popup('error' , 'OOPS..!' , "Reffrence or aknowlege number is required");
         }
     }
     
     
     // refund transaction dmt 
      $("#refundTrans_form").submit(function(e){
         e.preventDefault();
         let refundDmt = 'refundDmt';
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/DMT/paysprint/register_user.php',
                 type:'post',
                 data: new FormData(this),
                 contentType:false,
                 processData:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup('success' , 'Congratulations' , "Transaction Msg: " + msg);
                        // location.reload();
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     });
     
     
    //  refundTrans function dmt
     function refundTrans(ref_id , acc){
         $("#ref_id").val(ref_id);
         $("#akno").val(acc);
     }
     
    //  send amount function dmt
     function send_amount(bene_id , acc){
         $("#send_account").focus();
         $("#send_bene_id").val(bene_id);
         $("#send_account").val(acc);
     }
  
     
     
     