     function get_plans(){
        //   e.preventDefault();
             let op = $("#operator_id :selected").val();
             if(op != ""){
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'api/paysprint/recharge/recharge',
                     type:'post',
                     data: {browse_plan:"getplan",op},
                     success:function(data, st){
                         $("#loading_ajax").hide();
                             let rslt = JSON.parse(data);
                      let rs_code = rslt.status; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                          let tabs="";
                          let tabrows="";
                          let tabdata="";
                          let planinfo = rslt.info;
                          let info = Object.keys(planinfo);
                          let active;
                          if(info.length > 1){
                              for(let i=0; i<info.length; i++){
                                  tabrows="";
                                  let tabname = info[i];
                                  planId = info[i].replace("/" , "").replace(" " , "-");
                                  let plans = Object.keys(planinfo[tabname]);
                                  if(i === 0){
                                      active = "active show";
                                  }
                                  else{
                                      active = "";
                                  }
                                   for(let j=0; j<plans.length; j++){                                       
                                      let offer = planinfo[tabname][j];
                                      tabrows += '<div class="row" style="border: 2px solid grey;padding: 5px;margin: 5px;"><div class="col-2"><button class="btn btn-primary" onclick="rech('+offer['rs']+' , \' '+offer['desc']+' \')" >'+offer['rs']+'</button></div><div class="col-7">'+offer['desc']+'</div><div class="col-3">'+offer['validity']+'</div></div>';
                                   }
                                  tabs += '<li class="nav-item "><a class="nav-link '+active+'" id="custom-tabs-one-'+planId+'-tab" data-toggle="pill" href="#custom-tabs-one-'+planId+'" role="tab" aria-controls="custom-tabs-one-'+planId+'" aria-selected="false">'+info[i]+'</a </li>';
                                  tabdata += '<div class="tab-pane fade '+active+'" id="custom-tabs-one-'+planId+'" role="tabpanel" aria-labelledby="custom-tabs-one-'+planId+'-tab">'+tabrows+'</div>';
                              }
                            $("#custom-tabs-one-tabContent").html(tabdata);
                              
                              
                              $("#custom-tabs-one-tab").html(tabs);
                          }
                          else{
                              tabs = "Plan Not Found";
                              $("#custom-tabs-one-tab").html(tabs);
                          }
                        $("#offerModalCenter").modal("show");
                        
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                          popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                     }
                 })
             }
             else{
                  popup('error' , 'OOPS..!' ,"Opeartor or State could not be empty.");
             }
     }
     
     function rech(data){
         $("#recharge_amount").val(data);
         $("#offerModalCenter").modal("hide");
     }
     
   
       //  hlr check mobile op code here
     
    //  $("#recharge_mobile").on("change", function(){
    //     $("#loading_ajax").show();
    //      let num = $("#recharge_mobile").val();
    //      let hlr_check = "hlr_check";
    //          $.ajax({
    //              url:'api/paysprint/recharge/recharge.php',
    //              type:'post',
    //              data: {num,hlr_check},
    //              success:function(data, status){
    //                  $("#loading_ajax").hide();
    //                   let rslt = JSON.parse(data);
    //                   if(rslt.response_code == 1){
                        
    //                     //   $("#operator_id").html(`
    //                     //   <option selected value="${rslt.opcode}">${rslt.operator}</option>
    //                     //   `);
    //                   }
    //              },
    //              error:function(err){
    //                  $("#loading_ajax").hide();
    //                   popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
    //              }
    //          });
    // });
   
     //   DTH
    //   function roffer_plan_details_dth(){
    //       let vcnumber = $("#recharge_dth").val();
    //       let op = $("#dthOp :selected").val();
    //         $("#loading_ajax").show();
    //          $.ajax({
    //              url:'api/paysprint/recharge/recharge',
    //              type:'post',
    //              data: {dth_info:"dth_info",opt:op,vcnumber:vcnumber},
    //              success:function(data){
    //                  console.log(data);
    //                  $("#loading_ajax").hide();
    //                   let rslt = JSON.parse(data);
    //                 if(rslt.response_code == 1){  
    //                   let info = rslt.info[0];
    //                 $("#roffer_plan_list_dth").html(`
    //                 <td>Customer Name : ${info.customerName}</td>
    //                 <td>Next Recharge Date : ${info.NextRechargeDate}</td>
    //                 <td>Plan name : ${info.planname}</td>
    //                 <td>Monthly Recharge : ${info.MonthlyRecharge}</td>
    //                 `);
    //                 $("#ROFFER_DTH_PLAN").modal("show");
    //                 }else{
    //                     popup('error' , 'OOPS..!' ,rslt.message);
    //                 }
    //              },
    //              error:function(err){
    //                  $("#loading_ajax").hide();
    //                   popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
    //              }
             
    //          });
    //   }
     
       

     
       
       
    // document.addEventListener("DOMContentLoaded",()=>{
    //     const SelectOperator = document.getElementById("operator");
    //     const canumberField = document.getElementById("canumber");
        
    //     const amountField = document.getElementById("amount");
        
    //     let value = "null";
    //     let billDetails = null;
        
        // document.getElementById("fetchBtn").addEventListener('click', async()=>{
        //      $("#loading_ajax").show();
        //     console.log("selected", SelectOperator.value, canumberField.value);
        //     if(value != SelectOperator.value && SelectOperator.value!= "null" && canumberField.value.trim().length> 0){
        //     value = SelectOperator.value;
        //   let http = new XMLHttpRequest();
        //     let url = './api/paysprint/bbps/fetchDetails';
        //     let params = `operator=${value}&canumber=${canumberField.value.trim()}`;
        //     http.open('POST', url, true);
            
        //     //Send the proper header information along with the request
        //     http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
        //     http.onreadystatechange = function() {//Call a function when the state changes.
        //          $("#loading_ajax").hide();
        //         if(http.readyState == 4 && http.status == 200) {
        //             const res = JSON.parse(http.responseText);
        //             // console.log(res);
        //             console.log(res);
        //             alert("Data Fetch Completed");
        //             billDetails = res;
        //             document.getElementById("tableDetailBody").innerHTML = 
        //             `<th>${value}</th>
        //             <th>${res.amount}</th>
        //             <!--<th>Status</th>-->
        //             <th>${res.name}</th>
        //             <th>${res.bill_fetch.billdate}</th>
        //             <th>${res.duedate}</th>`
        //         }else{
        //             billDetails = null;
        //         }
        //     }
        //     http.send(params);
        //     }
        // });
        
        
    //         document.getElementById("bill_pay").addEventListener('submit', (e)=>{
    //         e.preventDefault();
    //         console.log("selected", SelectOperator.value, canumberField.value, billDetails);
    //         if( SelectOperator.value!= "null" && canumberField.value.trim().length> 0 &&billDetails != null){
    //             console.log(true)
    //         value = SelectOperator.value;
    //       let http = new XMLHttpRequest()
    //         let url = './api/paysprint/bbps/bill_pay';
    //         let body = "";
    //         for (const [key, value] of Object.entries(billDetails)) {
    //           body += (`&${key}=${value}`);
    //         }
    //         let params = `operator=${value}
    //             &canumber=${canumberField.value.trim()}
    //             &payamount=${amountField.value}`+body;
    //         http.open('POST', url, true);
            
    //         //Send the proper header information along with the request
    //         http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
    //         http.onreadystatechange = function() {//Call a function when the state changes.
    //             // 
    //             if(http.readyState == 4 && http.status == 200) {
                    
    //                 const res = (http.responseText);
                    
    //                 alert(JSON.parse(res).message);
                    
                    
    //             }
    //         }
    //         http.send(params);
    //         }
    //     });
        
    // });
    
    // lic bill submit
     $("#licBillSubmit").submit(function(e){
          e.preventDefault();
         let canum = $("#canumber").val();
         let ad1 = $("#email").val();
         let billDetails = $("#billdata").val();
         let lati = $("#lati").val();
         let long = $("#long").val();
         
         if(billDetails != "" && canum != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/lic/bill_pay',
                 type:'post',
                 data:{canum , ad1 ,billDetails , lati , long},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      let referenceid = rslt.response_code.refid;
                      if(rs_code == 1){
                          swal({
                          title: 'Congratulations',
                          html:  "<pre> Transaction Successfull : <br>" + msg + "</pre>",
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
                                location.replace(`Recipt/LicPaymentRecipt?refrence_id=${referenceid}`);
                              } else{
                                location.replace("LicPayment");
                              }
                            });
                          
                        // popup_reload('success' , 'Congratulations' , msg);
                         // location.reload();
                      } 
                      else{
                          popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
             popup('error' , 'OOPS..!' , "Sorry. Something went wrong. Please fetch bill again..");
         }
     })
    
    // lic fetchBill
    
     $("#licfetchBtn").click(function(){
         let num = $("#canumber").val();
         let op = $("#email").val();

         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/lic/fetchDetails',
                 type:'post',
                 data:{num:num, op:op},
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      let dt = rslt;
                       let details;
                        if(rs_code != ""){
                            details =  `<td>${num}</td>
                                        <td>${dt.name}</td>
                                        <td>${dt.amount}</td>
                                        <td>${dt.duedate}</td>`;
                        }
                        else{
                            details = msg + "Some error occured";
                        }
                        // console.log(dt);
                      if(rs_code == 1){
                        //   console.log(details);
                        $("#bill_details").html(details);
                          $("#billdata").val(data);
                          $("#exampleModalCenter2").modal("show");
                        // popup('success' , 'Congratulations' , details);
                      } 
                      else{
                          popup('error' , 'OOPS..!' , msg+" "+details);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
             popup('error' , 'OOPS..!' , " Enter Number or Select Operator")
         }
     })
    
    // bbps
     $("#BillpaySubmit").submit(function(e){
          e.preventDefault();
         let num = $("#canumber").val();
         let op = $("#operator :selected").val();
         let billdata = $("#billdata").val();
         let lati = $("#lati").val();
         let long = $("#long").val();
         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/bill_pay',
                 type:'post',
                 data:{num, billdata, op , lati , long },
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1 || rs_code == 0){
                        popup_reload('success' , 'Congratulations' , msg);
                        // location.reload();
                      } 
                      else{
                          popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
             popup('error' , 'OOPS..!' , " Enter Number , amount or Select Operator");
         }
     })
    
  
  
     
    // bbps fetchBill
     $("#fetchBtn").click(function(){
         let num = $("#canumber").val();
         let custnum = $("#customer_number").val();
         let op = $("#operator :selected").val();
         let tpin = $("#tpin").val();
         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/fetchDetails',
                 type:'post',
                   data:{num:num, op:op,tpin:tpin},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     console.log(rslt);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      let dt = rslt.bill_fetch;
                       let details;
                       
                        if(rs_code != ""){
                            
                             details =  `<td>${num}</td>
                                        <td>${rslt.bill_fetch.CustomerName}</td>
                                        <td>${rslt.amount}</td>
                                        <td>${rslt.duedate}</td>`;
                                         $("#bill_details").html(details);
                        
                           
                        }
                        else{
                            details = msg + "Some error occured";
                        }
                      if(rs_code == 1){
                          $("#fetchBtn").hide();
                          $("#billdata").val(data);
                          $("#customer_name").val(dt.CustomerName);
                          $("#recharge_number").val(num);
                          $("#recharge_amount").val(rslt.amount);
                          $("#recharge_operator").val(op);
                          $("#customer_number2").val(custnum);
                          $("#due_date").val(rslt.duedate);
                          $("#bbpsfetchBill").modal("show");
                      }
                      else{
                          popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
         }
         else{
             popup('error' , 'OOPS..!' , " Enter Number or Select Operator")
         }
     })
    

    function get_trans(val){
        //  console.log(val);
        if(val == "CW" || val == "M"){
            $("#aeps_amount_area").show();
        }
        else{
            $("#aeps_amount_area").hide();
        }
     }
     
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data:{dob, send_otp ,fname ,lname , mobile , pincode , Address},
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data: new FormData(document.querySelector('#dmt_form')),
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
                 url:'api/paysprint/dmt/register_user',
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
                 url:'api/paysprint/dmt/register_user',
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                      let rslt = JSON.parse(data);
                      console.log(rslt);
                        let txntype = rslt.TxnType; 
                      let txncount = rslt.txncount; 
                      let referenceid = rslt.response.referenceid; 
                   if(rslt.response_code == 1){
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
                     url:'api/paysprint/dmt/register_user',
                     type:'post',
                     data: {bene_delete ,bene_id , bene_acc ,senderMobile },
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
                      url:'api/paysprint/dmt/register_user',
                     type:'post',
                     data: {verify_bene ,beneid,bene_acc,bank_code,benename ,senderMobile},
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data: {ref_id:ref_id ,check_dmt_status:check_dmt_status},
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data: {ref_id ,resendRefundOTP ,akno},
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
                 url:'api/paysprint/dmt/register_user',
                 type:'post',
                 data: new FormData(this),
                 contentType:false,
                 processData:false,
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
  
     $("#roffer_plan_roffer").click(function(){
          let mobile = $("#recharge_mobile").val();
          if(mobile != "")
          {
           $("#ROFFERPLAN").modal("show");
           $("#r_mobile").val(mobile);
          }
          else
          {
           popup('error' , 'OOPS..!' ,"Please Enter Mobile No");
          }
         
     }); 
     
     function dthrech(amount){
         $("#dthRechAmount").addClass("fill");
         $("#dthRechAmount").val(amount);
         $("#dthRechAmount").attr("disabled" , "disabled");
         $("#dthRechAmount").attr("readonly" , "readonly");
        $("#ROFFER_DTH_PLAN").modal("hide");
         
     }
     
     
     function roffer_plan_details_roffer(){
         let op = $("#r_Operator :Selected").val();
          let mobile = $("#recharge_mobile").val();
        $("#loading_ajax").show();
             $.ajax({
                 url:'handler/roffer_plan.php',
                 type:'post',
                 data: {op:op,mobile:mobile},
                 success:function(data){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     let details;
                     
                               for(i=0;i<Object.keys(rslt.records).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.records[i].rs}&mobile=${mobile}'>Select</a></td>
                                        <td>${rslt.records[i].rs}</td>
                                        <td>${rslt.records[i].desc}</td>
                                       
                                        </tr>`;
                                        $("#roffer_plan_list_roffer").html(details);
                                        $("#ROFFERPLAN").modal("show");
                                      
                                }
                                
                                
                      
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             });
       }
     
     
          $("#roffer_plan_simple").click(function(){
           $("#ROFFERPLAN_SIMPLE").modal("show");
         
     }); 
     
     
     
     
     
      
       function roffer_plan_details(region){
         let op = $("#r_Operator_simple :Selected").val();
          if(op != "")
          {
        $("#loading_ajax").show();
             $.ajax({
                 url:'handler/roffer_plan.php',
                 type:'post',
                 data: {op:op,region:region},
                 success:function(data){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     
                     let details;
                     
                               for(i=0;i<Object.keys(rslt.FULLTT).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.FULLTT[i].rs}'>Select</a></td>
                                        <td>FULLTT</td>
                                        <td>${rslt.FULLTT[i].rs}</td>
                                        <td>${rslt.FULLTT[i].desc}</td>
                                        <td>${rslt.FULLTT[i].validity}</td>
                                        <td>${rslt.FULLTT[i].last_update}</td>
                                       
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                 for(i=0;i<Object.keys(rslt.TOPUP).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.TOPUP[i].rs}'>Select</a></td>
                                        <td>TOPUP</td>
                                        <td>${rslt.TOPUP[i].rs}</td>
                                        <td>${rslt.TOPUP[i].desc}</td>
                                        <td>${rslt.TOPUP[i].validity}</td>
                                        <td>${rslt.TOPUP[i].last_update}</td>
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                 for(i=0;i<Object.keys(rslt.DATAPLAN).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.DATAPLAN[i].rs}'>Select</a></td> 
                                        <td>DATAPLAN</td>
                                        <td>${rslt.DATAPLAN[i].rs}</td>
                                        <td>${rslt.DATAPLAN[i].desc}</td>
                                        <td>${rslt.DATAPLAN[i].validity}</td>
                                        <td>${rslt.DATAPLAN[i].last_update}</td>
                                       
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                 for(i=0;i<Object.keys(rslt.RATECUTTER).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.RATECUTTER[i].rs}'>Select</a></td>
                                        <td>RATECUTTER</td>
                                        <td>${rslt.RATECUTTER[i].rs}</td>
                                        <td>${rslt.RATECUTTER[i].desc}</td>
                                        <td>${rslt.RATECUTTER[i].validity}</td>
                                        <td>${rslt.RATECUTTER[i].last_update}</td>
                                        
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                for(i=0;i<Object.keys(rslt.R2G).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.R2G[i].rs}'>Select</a></td> 
                                        <td>2G</td>
                                        <td>${rslt.R2G[i].rs}</td>
                                        <td>${rslt.R2G[i].desc}</td>
                                        <td>${rslt.R2G[i].validity}</td>
                                        <td>${rslt.R2G[i].last_update}</td>
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                for(i=0;i<Object.keys(rslt.SMS).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.SMS[i].rs}'>Select</a></td> 
                                        <td>SMS</td>
                                        <td>${rslt.SMS[i].rs}</td>
                                        <td>${rslt.SMS[i].desc}</td>
                                        <td>${rslt.SMS[i].validity}</td>
                                        <td>${rslt.SMS[i].last_update}</td>
                                       
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                                
                                for(i=0;i<Object.keys(rslt.COMBO).length; i++){
                                        details +=  `
                                         <tr>
                                        <td><a class="btn btn-sm btn-info" href='Service?A=Prepaid&amount=${rslt.COMBO[i].rs}'>Select</a></td> 
                                        <td>COMBO</td>
                                        <td>${rslt.COMBO[i].rs}</td>
                                        <td>${rslt.COMBO[i].desc}</td>
                                        <td>${rslt.COMBO[i].validity}</td>
                                        <td>${rslt.COMBO[i].last_update}</td>
                                        </tr>`;
                                        $("#roffer_plan_list").html(details);
                                        $("#ROFFERPLAN_SIMPLE").modal("show");
                                      
                                }
                     
                      
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             });
             
          }
          
          else
          {
           popup('error' , 'OOPS..!' ,"Please Select Operator");
          }
             
       }
       
       
    //     $("#roffer_dth_plan").click(function(){
    //       let vcnumber = $("#recharge_dth").val();
    //       if(vcnumber != "")
    //       {
    //       $("#ROFFER_DTH_PLAN").modal("show");
    //       $("#r_dth").val(vcnumber);
    //       }
    //       else
    //       {
    //       popup('error' , 'OOPS..!' ,"Please Enter Vc Number");
    //       }
         
    //  }); 
     
     
       function roffer_plan_details_dth(){
          let vcnumber = $("#recharge_dth").val();
          let op = $("#dthOp :selected").val();
            $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/recharge/recharge.php',
                 type:'post',
                 data: {dthop:op,vcnumber:vcnumber,dth_info:'dth_info'},
                 success:function(data){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                    //  let info = rslt.info;
                     if(rslt.error == "0"){
                         
                    $("#roffer_plan_list_dth").html(`
                    <td>${rslt['DATA']['Name']}</td>
                    <td>${rslt['DATA']['Plan']}</td>
                    <td>${rslt['DATA']['Rmn']}</td>
                    <td>₹${rslt['DATA']['Balance']}</td>
                    <td>₹ ${rslt['DATA']['Monthly']}</td>
                    <td>₹${rslt['DATA']['Next Recharge Date']}</td>
                    <td>${rslt['DATA']['Address']}</td>
                    <td>${rslt['DATA']['PIN Code']}</td>
                    `);
                    $("#ROFFER_DTH_PLAN").modal("show");
                     }else{
                         popup('error' , 'OOPS..!' ,rslt.Message);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             });
       }
       
       function check_dth_plan_details(){
           let op = $("#dthOp :selected").val();
           let planlist = "";
              $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/recharge/recharge.php',
                 type:'post',
                 data: {dthop:op,dth_plan:'dth_plan'},
                 success:function(data){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     let plandata = rslt['RDATA']['Plan'];
                    //  let info = rslt.info;
                     if(rslt.ERROR == "0"){
                    
                    for(var i = 0; i<plandata.length;i++){
                    planlist += `<tr>
                    <td>${rslt['Operator']}</td>
                    <td>${rslt['RDATA']['Plan'][i]['rs']["1 MONTHS"]}</td>
                    <td>${rslt['RDATA']['Plan'][i]['desc']}</td>
                    <td>${rslt['RDATA']['Plan'][i]['plan_name']}</td>
                    <td>${rslt['RDATA']['Plan'][i]['last_update']}</td>
                    </tr>
                    `; 
                    }
                    $("#plan_list_dth").html(planlist);
                    $("#DTH_PLAN").modal("show");
                     }else{
                         popup('error' , 'OOPS..!' ,rslt.MESSAGE);
                     }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             });
       }
       
     //  recharge 
     $("#recharge_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/recharge/recharge',
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
                      let refernce_id = rslt.refid;
                      if(rs_code == 1){
                         
                           popup_reload('success' , 'Congratulations' , " Recharge Successfull. Msg: " + msg);
                       
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
     
  // check transaction status dmt 
     function check_rech_status(id){
        //   preventDefault();
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                  url:'api/paysprint/recharge/recharge',
                 type:'post',
                 data: {ref_id ,check_status},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.responsecode; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , "Transaction Msg: " + msg);
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
     
    //  pan agent create
       $("#pan_agent").click(function(e){
         e.preventDefault();
         let register_pan = 'register_pan';
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/pan/pan',
                 type:'post',
                 data: {register_pan:register_pan},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , " Agent register request accepted Msg: " + msg);
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
         

    //  pan check status
       $("#pan_check_status").click(function(e){
         e.preventDefault();
         let vle_id = $("#vle_id").val();
         if(vle_id != ""){
         let pan_check_status = 'pan_check_status';
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/pan/pan',
                 type:'post',
                 data: {pan_check_status:pan_check_status , vle_id:vle_id},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , "Agent Approved Msg: " + msg);
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
     })
     
     
     //aeps transfer 
     $("#aeps_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/aeps/aeps_init_req.php',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                 //   console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                     
                        if(rs_code == 1){
                          if($("#transType :selected").val() == "MS"){
                              let msm = rslt.ministatement;
                              let details;
                               for(i=0;i<Object.keys(msm).length; i++){
                                        details +=  `
                                         <tr>
                                         <td>${rslt.balanceamount}</td>
                                         <td>${msm[i].date}</td>
                                        <td>${msm[i].txnType}</td>
                                        <td>${msm[i].amount}</td>
                                        <td>${msm[i].narration}</td></tr>`;
                                        $("#aeps_ministatement").html(details);
                                        $("#exampleModalCenter2").modal("show");
                                      
                                }

                          }
                          
                          else if($("#transType :selected").val() == "BE"){
                               console.log(rslt);
                              let details;
                               details =  `
                                         <tr><td>${rslt.name}</td>
                                        <td>${rslt.amount}</td>
                                        <td>${rslt.balanceamount}</td>
                                        <td>${"XXXXXXXX"+rslt.last_aadhar}</td>
                                        <td>${msg}</td>
                                        </tr>`;
                                        $("#aeps_balance").html(details);
                                        $("#exampleModalCenter3").modal("show");
                              
                          }
                          
                           else if($("#transType :selected").val() == "CW"){
                               console.log(rslt);
                              let details;
                               details =  `
                                         <tr><td>${rslt.name}</td>
                                        <td>${rslt.amount}</td>
                                        <td>${rslt.balanceamount}</td>
                                        <td>${"XXXXXXXX"+rslt.last_aadhar}</td>
                                        <td>${msg}</td>
                                        </tr>`;
                                        $("#cash_cw").html(details);
                                        $("#exampleModalCenter4").modal("show");
                              
                          }
                          
                           else if($("#transType :selected").val() == "M"){
                               console.log(rslt);
                              let details;
                               details =  `
                                         <tr><td>${rslt.name}</td>
                                        <td>${rslt.amount}</td>
                                        <td>${rslt.balanceamount}</td>
                                        <td>${"XXXXXXXX"+rslt.last_aadhar}</td>
                                        <td>${msg}</td>
                                        </tr>`;
                                        $("#aadhaar_pay").html(details);
                                        $("#exampleModalCenter5").modal("show");
                              
                          }
                          

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
     
       
     // check transaction status dmt 
     function check_aeps_status(id){
        //   preventDefault();
          let check_aeps_status = 'check_aeps_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/aeps/aeps_init_req',
                 type:'post',
                 data: {ref_id:ref_id ,check_aeps_status:check_aeps_status},
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
     
     
     

  
  
  
     // get locaiton 
getLocation();
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    popup('error' , 'OOPS..!' , "Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
    $("#aeps_long").val(position.coords.longitude);
    $("#aeps_lat").val(position.coords.latitude);
    $("#long").val(position.coords.longitude);
    $("#lati").val(position.coords.latitude);
}

function showError(error) {
    $("button[type=submit]").attr("disabled" , "disabled")
    $("button[type=submit]").text("Please Enable Location")
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
        swal.fire({
          title: title,
          text: msg,
          icon: status,
          button: "Okay",
          closeOnClickOutside: false, 
        })
    }
    function popup_reload(status , title , msg){
           swal.fire({
        title: title,
        text: msg, 
        icon: status,
        button: "Okay",
        })
        .then(function(){ 
           location.reload();
           }
        );
    }
    
    //   console.log(confirm_user("Are you sure want to delete this?"));

    function confirm_user(msg){
        swal({
          title: "Are you sure?",
          text: msg,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            return true;
          } else {
            // swal("Your imaginary file is safe!");
            return false;
          }
        });
        // return false;
    }
  function discoverAvdm() {
        var GetCustomDomName = "127.0.0.1";
        var SuccessFlag = 0;
        var primaryUrl = "http://" + GetCustomDomName + ":";

        try {
          var protocol = window.location.href;
          if (protocol.indexOf("https") >= 0) {
            primaryUrl = "https://" + GetCustomDomName + ":";
          }
        } catch (e) {}

        url = "";
     
        SuccessFlag = 0;
        for (var i = 11100; i <= 11112; i++) {
          console.log("Discovering RD service on port : " + i.toString());
          var verb = "RDSERVICE";
          var err = "";

          var res;
          $.support.cors = true;
          var httpStaus = false;
          var jsonstr = "";
          var data = new Object();
          var obj = new Object();

          $.ajax({
            type: "RDSERVICE",
            async: false,
            crossDomain: true,
            url: primaryUrl + i.toString(),
            contentType: "text/xml; charset=utf-8",
            processData: false,
            cache: false,
            crossDomain: true,

            success: function (data) {
              httpStaus = true;
              res = {
                httpStaus: httpStaus,
                data: data
              };
              //alert(data);
              $("#txtDeviceInfo").val(data);
              finalUrl = primaryUrl + i.toString();
              var $doc = $.parseXML(data);//$data
			  debugger;
              var CmbData1 = $($doc).find('RDService').attr('status');
              var CmbData2 = $($doc).find('RDService').attr('info');

               if(RegExp('\\b'+ 'Mantra' +'\\b').test(CmbData2)==true  ||  RegExp('\\b'+ 'Morpho_RD_Service' +'\\b').test(CmbData2)==true  ||  RegExp('\\b'+ 'SecuGen India Registered device Level 0' +'\\b').test(CmbData2)==true ||  RegExp('\\b'+ 'Precision - Biometric Device is ready for capture' +'\\b').test(CmbData2)==true ||  RegExp('\\b'+ 'RD service for Startek FM220 provided by Access Computech' +'\\b').test(CmbData2)==true ||  RegExp('\\b'+ 'NEXT' +'\\b').test(CmbData2)==true  ){
			   
			   debugger;
							console.log($($doc).find('Interface').eq(0).attr('path'));
						
							if(RegExp('\\b'+ 'Mantra' +'\\b').test(CmbData2)==true){
							
        							if($($doc).find('Interface').eq(0).attr('path')=="/rd/capture")
        							{
        							  MethodCapture=$($doc).find('Interface').eq(0).attr('path');
        							}
        							if($($doc).find('Interface').eq(1).attr('path')=="/rd/capture")
        							{
        							  MethodCapture=$($doc).find('Interface').eq(1).attr('path');
        							}
        							if($($doc).find('Interface').eq(0).attr('path')=="/rd/info")
        							{
        							  MethodInfo=$($doc).find('Interface').eq(0).attr('path');
        							}
        							if($($doc).find('Interface').eq(1).attr('path')=="/rd/info")
        							{
        							  MethodInfo=$($doc).find('Interface').eq(1).attr('path');
        							}
							}else if(RegExp('\\b'+ 'Morpho_RD_Service' +'\\b').test(CmbData2)==true){
							        MethodCapture=$($doc).find('Interface').eq(0).attr('path');
							        MethodInfo=$($doc).find('Interface').eq(1).attr('path');
							}else if(RegExp('\\b'+ 'SecuGen India Registered device Level 0' +'\\b').test(CmbData2)==true){
							        MethodCapture=$($doc).find('Interface').eq(0).attr('path');
							        MethodInfo=$($doc).find('Interface').eq(1).attr('path');
							}else if(RegExp('\\b'+ 'Precision - Biometric Device is ready for capture' +'\\b').test(CmbData2)==true){
							        MethodCapture=$($doc).find('Interface').eq(0).attr('path');
							        MethodInfo=$($doc).find('Interface').eq(1).attr('path');
							}else if(RegExp('\\b'+ 'RD service for Startek FM220 provided by Access Computech' +'\\b').test(CmbData2)==true){
							        MethodCapture=$($doc).find('Interface').eq(0).attr('path');
							        MethodInfo=$($doc).find('Interface').eq(1).attr('path');
							}else if(RegExp('\\b'+ 'NEXT' +'\\b').test(CmbData2)==true){
							        MethodCapture=$($doc).find('Interface').eq(0).attr('path');
							        MethodInfo=$($doc).find('Interface').eq(1).attr('path');
							}

							if(CmbData1=='READY')
							{	
							 
							    $('#method').val( finalUrl+MethodCapture);
							    $('#info').val( finalUrl+MethodInfo);
							 
								SuccessFlag=1;
                                    popup('success' , 'Congratulations' , "Device detected successfully");
								
								    // alert("Device detected successfully");
								     
        					
								return false;
							}
							else if(CmbData1=='USED')
							{	
							   $('#method').val( finalUrl+MethodCapture);
							   $('#info').val( finalUrl+MethodInfo);
							 
								SuccessFlag=1;
								 popup('success' , 'Congratulations' , "Device detected successfully");
								//  alert("Device detected successfully");
								     
        					
								return false;
							}
							
							
							else if(CmbData1=='NOTREADY')
							{
								// alert("Device Not Discover");
								 popup('error' , 'OOPS' , "Device Not Discover");
								return false;								
							}	
						}

            },
            error: function (jqXHR, ajaxOptions, thrownError) {
              if (i == "8005" && OldPort == true) {
                OldPort = false;
                i = "11099";
              }
            },

          });

          if (SuccessFlag == 1) {
            break;
          }
        }

        if (SuccessFlag == 0) {
        //   alert("Connection failed Please try again.");
           popup('error' , 'OOPS' , "Connection failed Please try again.");
        } else {
          //alert("RDSERVICE Discover Successfully");
        }
        $("select#ddlAVDM").prop('selectedIndex', 0);
        return res;
      };
	  
	  
	  
	  
	  	function deviceInfoAvdm()
		{
		var GetCustomDomName = "127.0.0.1";
		var SuccessFlag = 0;
        var primaryUrl1 = "http://" + GetCustomDomName + ":";

        try {
          var protocol = window.location.href;
          if (protocol.indexOf("https") >= 0) {
            primaryUrl1 = "https://" + GetCustomDomName + ":";
          }
        } catch (e) {}

        url = "";
        SuccessFlag = 0;


		var finUrl=  $('#info').val();
        url = "";
		
			var err = "";

			var res;
			$.support.cors = true;
			var httpStaus = false;
			var jsonstr="";
			;
				$.ajax({

				type: "DEVICEINFO",
				async: false,
				crossDomain: true,
				url: finUrl,
				contentType: "text/xml; charset=utf-8",
				processData: false,
				success: function (data) {
					httpStaus = true;
					res = { httpStaus: httpStaus, data: data };
					$('#txtDeviceInfo').val(data);
				},
				error: function (jqXHR, ajaxOptions, thrownError) {
				alert(thrownError);
					res = { httpStaus: httpStaus, err: getHttpError(jqXHR) };
				},
			});

			return res;

		}

	  
	  
	  
	  function CaptureAvdm()
		{
		DString = '';
       device="mantra";


			var strWadh="";
		    var strOtp="";
	     
	   
	   var XML='<?xml version="1.0"?> <PidOptions ver="1.0"> <Opts fCount="1" fType="0" iCount="0" pCount="0" format="0" pidVer="2.0" timeout="10000" posh="UNKNOWN" env="P" /> '+DString+'<CustOpts><Param name="mantrakey" value="" /></CustOpts> </PidOptions>';
 	  

            var finUrl=  $('#method').val();
			

					 var verb = "CAPTURE";


                        var err = "";

						var res;
						$.support.cors = true;
						var httpStaus = false;
						var jsonstr="";
						
							$.ajax({

							type: "CAPTURE",
							async: false,
							crossDomain: true,
							url: finUrl,
							data:XML,
							contentType: "text/xml; charset=utf-8",
							processData: false,
							success: function (data) {
							
							 if(device == "morpho"){
							   var xmlString = (new XMLSerializer()).serializeToString(data);  //morpho
							}else if(device == "mantra"){
								var xmlString = data;  //mantra
							}else if(device == "secugen"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //secugen
							}else if(device == "precision"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //precision
							}else if(device == "startek"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //startek
							}else if(device == "nextrd"){
								  var xmlString = (new XMLSerializer()).serializeToString(data);  //next rd
							}
							httpStaus = true;
							res = { httpStaus: httpStaus, data: xmlString};
							
						

								$('#txtPidData').val(xmlString);                                  
								var $doc = data;
								var Message =  $($doc).find('Resp').attr('errInfo');
								var errorcode =	 $($doc).find('Resp').attr('errCode');
									if(errorcode==0)
									{

										var $doc = $.parseXML(data);
										var Message =  $($doc).find('Resp').attr('errInfo');
										 popup('success' , 'Congratulations' ,Message);
								// 		alert(Message);
								        if($('#txtPidData').val() != ""){
								            fingersuccess();
								        }
										
									}else{
										$('#loaderbala').css("display","none");
								// 		alert('Capture Failed');
										 popup('error' , 'OOPS' , "Capture Failed");
										window.location.reload();
									}	

							},
							error: function (jqXHR, ajaxOptions, thrownError) {
							//$('#txtPidOptions').val(XML);
							alert(thrownError);
								res = { httpStaus: httpStaus, err: getHttpError(jqXHR) };
							},
						});

						return res;
		}
		
		function getHttpError(jqXHR) {
		    var err = "Unhandled Exception";
		    if (jqXHR.status === 0) {
		        err = 'Service Unavailable';
		    } else if (jqXHR.status == 404) {
		        err = 'Requested page not found';
		    } else if (jqXHR.status == 500) {
		        err = 'Internal Server Error';
		    } else if (thrownError === 'parsererror') {
		        err = 'Requested JSON parse failed';
		    } else if (thrownError === 'timeout') {
		        err = 'Time out error';
		    } else if (thrownError === 'abort') {
		        err = 'Ajax request aborted';
		    } else {
		        err = 'Unhandled Error';
		    }
		    return err;
		}


   //   var body = $('body');
var clone = $('.clone');
var successIcon = $('.success');
var fingerprint = $('.fingerprint');

var finishedDrawing = function() {
  var drawStatus = animation.getStatus();

  if (drawStatus === "end") {
    successIcon.addClass('active');
  } else {
    successIcon.removeClass('active');
  }

};

var options = {
  duration: 80,
  type: 'scenario',
  animTimingFunction: Vivus.EASE_OUT
};

var animation = new Vivus('fingerprint', options, finishedDrawing);
animation.stop();

// ugh, I'm sorry 
fingerprint.hover(function() {
  clone.addClass('hover')
}, function() {
  clone.removeClass('hover');
})
// fingersuccess()
function fingersuccess() {
    console.log("finger captured");
  animation.reset();
  clone.addClass('active');
  animation.play(1);
};


 