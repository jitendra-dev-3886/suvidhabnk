    // Send Otp for credit card payment 
     $("#payout").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             let mobile = $("#mobile").val();
             let amount = $("#amount").val();
             let acc = $("#accNum").val();
             
             $.ajax({
                 url:'Backend/PAYOUT/paysprint/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                      var rs_code;
                   let rslt = JSON.parse(data);
                    if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                         let status = rslt.status;
                        rs_code = rslt.response_code; 
                          let msg = rslt.message; 
                        if(rs_code == 1 || rs_code == 2){
                        //     details =  `<td>${rslt.beneficiaryName}</td>
                        //                     <td>${acc}</td>
                        //                     <td>${mobile}</td>
                        //                     <td>${amount}</td>`;
                            
                        //   $("#onetimetoken").val(rslt.onetimetoken);
                        //   $("#bill_details").html(details);
                        //   $("#exampleModalCenter2").modal("show");
                          
                        //   popup('sucess' , 'Congratulations' , msg);
                         Swal.fire({
                          icon: 'success',
                          title: 'Congratulations',
                          html: msg,
                        })
                            .then(function(){ 
                               location.replace("Payout_new.php?selectAcc="+rslt.bene_id);
                               }
                            );
    
                        }
                        else{
                          popup('error' , 'OOPS..!' , msg);
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
    
    // verify payout
     $("#payout_verify").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/PAYOUT/paysprint/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                      var rs_code;
                       let rslt = JSON.parse(data);
                      if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                     let status = rslt.status;
                     if(status == true){
                        rs_code = rslt.response_code; 
                     }
                     else{
                        rs_code = rslt.response_code; 
                     }
                      let msg = rslt.message; 
                    if(rs_code == 1 || rs_code == 2){
                    //     details =  `<td>${rslt.beneficiaryName}</td>
                    //                     <td>${acc}</td>
                    //                     <td>${mobile}</td>
                    //                     <td>${amount}</td>`;
                        
                    //   $("#onetimetoken").val(rslt.onetimetoken);
                    //   $("#bill_details").html(details);
                    //   $("#exampleModalCenter2").modal("show");
                      
                      popup_reload('sucess' , 'Congratulations' , msg);

                    }
                    else{
                      popup('error' , 'OOPS..!' , msg);
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
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/PAYOUT/paysprint/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                      var rs_code;
                       let rslt = JSON.parse(data);
                      if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                     let status = rslt.status;
                     if(status == true){
                        rs_code = rslt.response_code; 
                     }
                     else{
                        rs_code = rslt.response_code; 
                     }
                      let msg = rslt.message; 
                    if(rs_code == 1 || rs_code == 2){
                    //     details =  `<td>${rslt.beneficiaryName}</td>
                    //                     <td>${acc}</td>
                    //                     <td>${mobile}</td>
                    //                     <td>${amount}</td>`;
                        
                    //   $("#onetimetoken").val(rslt.onetimetoken);
                    //   $("#bill_details").html(details);
                    //   $("#exampleModalCenter2").modal("show");
                      
                      popup_reload('success' , 'Congratulations' , msg);

                    }
                    else{
                      popup('error' , 'OOPS..!' , msg);
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

    
  // check transaction status dmt 
     function check_trans_status(id , ack){
        //   preventDefault();
          let check_status = 'check_status';
          let ack_no = ack;
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                  url:'Backend/PAYOUT/paysprint/main',
                 type:'post',
                 data: {ref_id ,ack_no , check_status},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                       let rslt = JSON.parse(data);
                      if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                      let rs_code = rslt.responsecode; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , "Transaction Msg: " + msg);
                        // location.reload();
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
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
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
// transact now
 $("#transactCD").click(function(){
         let acc = $("#accNum").val();
         let amount = $("#amount").val();
         let mcid = $("#merchanttxnid").val();
         let txntoken = $("#onetimetoken").val();
         let ref = $("#txnreferenceno").val();
         
         if(mcid != "" && txntoken !="" && ref != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/cashDeposit/main',
                 type:'post',
                 data:{mcid, acc, txntoken,ref,amount},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     var rs_code;
                       let rslt = JSON.parse(data);
                      if(rslt.rscode == undefined){
                     if(rslt.rscode == undefined){
                     let status = rslt.status;
                     if(status == true){
                        rs_code = rslt.response_code; 
                     }
                     else{
                        rs_code = rslt.response_code; 
                     }
                      let msg = rslt.message; 
                      if(rs_code == "1"){
                      let bankrrn = rslt.bankrrn; 
                      let ackno = rslt.ackno; 
                        popup_reload('success' , 'Congratulations' , msg+"\n RRN : "+bankrrn+"\n Acknowledege Number : "+ackno);
                      } 
                      else{
                          popup('error' , 'OOPS..!' , msg);
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
         }
         else{
             popup('error' , 'OOPS..!' , "Something went wrong");
         }
     })
     
        function getdoctype(val){
        if(val == "PAN"){
            $("#abackImg").hide();
            $("#afrontImg").hide();
            $("#panImg").show();
        }
        else{
            $("#panImg").hide();
               $("#abackImg").show();
            $("#afrontImg").show();
        }
    }
    
    