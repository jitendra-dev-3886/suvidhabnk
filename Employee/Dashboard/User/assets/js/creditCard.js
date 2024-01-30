    $("#sendOtp").click(function(){
        //   e.preventDefault();
          let fetchBill = "fetchBill";
         let fname = $("#name").val();
         let cardNum = $("#cardNum").val();
         let amount = $("#amount").val();
         let mobile = $("#mobile").val();
         let card_type = $("#card_type").val();
         
         if(fname != "" && cardNum!="" && mobile != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/creditcard/main',
                 type:'post',
                 data:{fname, cardNum, fetchBill,mobile,amount,card_type},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let response = JSON.parse(data);
                     let ref_id = response.ref_id;
                     let rslt = response.response;
                      let rs_code = rslt.response_code; 
                      
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        
                        popup('success' , 'Congratulations' , msg);
                        // location.reload();
                         $("#name").attr("readonly", "readonly");
                         $("#cardNum").attr("readonly", "readonly");
                         $("#amount").attr("readonly", "readonly");
                         $("#mobile").attr("readonly", "readonly");
                         $("#card_type").attr("readonly", "readonly");
                        $("#ref_id").val(ref_id);
                        $("#otpArea").show();
                        $("#send_otp_area").hide();
                        $("#submitArea").show();
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
             popup('error' , 'OOPS..!' , " Enter Number , amount , card");
         }
     })
    
    // Send Otp for credit card payment 
     $("#formSubmit").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/creditcard/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let referenceid = rslt.response_code.referenceid;
                      let msg = rslt.message; 
                    if(rs_code == 1){
                          new swal({
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
                                location.replace(`Recipt/creditCardPay?refrence_id=${referenceid}`);
                              } else{
                                location.replace("creditCardPay");
                              }
                            }); 
                        
                    //   popup_reload('sucess' , 'Hurray.' , msg);

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
     })
   
  // resend OTP  
     function resendOTP(){
        //   preventDefault();
          let resendOTP = 'resendOTP';
                 
         let ref_id = $("#refund_ref_id").val();
         let akno = $("#rakno").val();
         if(ref_id != "" && akno != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/creditcard/main',
                 type:'post',
                 data: {ref_id ,resendOTP , akno},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , "Msg: " + msg);
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
     
   //  refundTrans function cc
     function refundTxn(ref_id , acc){
         $("#refund_ref_id").val(ref_id);
         $("#rakno").val(acc);
     }
     
       $("#refundTrans_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/creditcard/main',
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
  // check transaction status  
     function check_status(id){
        //   preventDefault();
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/creditcard/main',
                 type:'post',
                 data: {ref_id ,check_status},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
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
     

      function popup(status , title , msg){
        swal({
          title: title,
          text: msg,
          icon: status,
          button: "Okay",
          closeOnClickOutside: false, 
        })
    }
    function popup_reload(status , title , msg){
           swal({
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