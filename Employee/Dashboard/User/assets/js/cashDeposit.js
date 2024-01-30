    $("#sendOtp").click(function(){
        //   e.preventDefault();
          let fetchBill = "fetchBill";
         let fname = $("#name").val();
         let accNum = $("#accNum").val();
         let amount = $("#amount").val();
         let mobile = $("#mobile").val();
         let long = $("#long").val();
         let lati = $("#lati").val();
         
         if(fname != "" && accNum!="" && mobile != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/cashDeposit/main',
                 type:'post',
                 data:{fname, accNum, fetchBill,mobile,amount ,long , lati},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     var rs_code;
                     let rslt = JSON.parse(data);
                     let status = rslt.status;
                     if(status == true){
                        rs_code = rslt.responsecode; 
                     }
                     else{
                        rs_code = rslt.response_code; 
                     }
                      let msg = rslt.message; 
                      if(rs_code == "1"){
                        popup('success' , 'Congratulations' , msg);
                        // location.reload();
                        $("#beneficiaryName").val(rslt.beneficiaryName);
                        $("#onetimetoken").val(rslt.onetimetoken);
                        $("#txnreferenceno").val(rslt.txnreferenceno);
                        $("#merchanttxnid").val(rslt.merchanttxnid);
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
             let mobile = $("#mobile").val();
             let amount = $("#amount").val();
             let acc = $("#accNum").val();
             
             $.ajax({
                 url:'api/paysprint/cashDeposit/main',
                 type:'post',
                 data:new FormData(this),
                 processData: false,
                 contentType:false,
               success:function(data, stats){
                     $("#loading_ajax").hide();
                     console.log(data);
                      var rs_code;
                     let rslt = JSON.parse(data);
                     let status = rslt.status;
                     if(status == true){
                        rs_code = rslt.responsecode; 
                     }
                     else{
                        rs_code = rslt.response_code; 
                     }
                      let msg = rslt.message; 
                    if(rs_code == 1){
                        details =  `<td>${rslt.beneficiaryName}</td>
                                        <td>${acc}</td>
                                        <td>${mobile}</td>
                                        <td>${amount}</td>`;
                        
                      $("#onetimetoken").val(rslt.onetimetoken);
                      $("#bill_details").html(details);
                      $("#exampleModalCenter2").modal("show");
                      
                    //   popup('sucess' , 'Hurray.' , msg);

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
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     var rs_code;
                     let rslt = JSON.parse(data);
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
  