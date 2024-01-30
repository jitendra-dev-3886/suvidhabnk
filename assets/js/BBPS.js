$(document).ready(function(){
    getLocation();
})  
    // bbps
     $("#BillSubmit").submit(function(e){
          e.preventDefault();
         let num = $("#canumber").val();
         let op = $("#operator :selected").val();
         let category= $("#category :selected").text();
         let op_name = $("#operator :selected").text();
         let billdata = $("#billdata").val();
         let lati = $("#lati").val();
         let long = $("#long").val();
         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/bill_pay',
                 type:'post',
                 data:{num, billdata, op , lati , long , category , op_name},
                  
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let referenceid = rslt.referenceid;
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
                                location.replace(`bbps_report?refrence_id=${referenceid}`);
                              } else{
                                location.replace("BBPS");
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
             popup('error' , 'OOPS..!' , " Enter Number , amount or Select Operator");
         }
     })
    
    // bbps fetchBill
     $("#fetchBtn").click(function(){
         let num = $("#canumber").val();
         let billingUnit = $("#billingUnit").val();
         let op = $("#operator :selected").val();

         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/fetchDetails',
                 type:'post',
                 data:{num, op , billingUnit},
                 
              
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      let dt = rslt.bill_fetch;
                       let details;
                        if(rs_code != ""){
                            details =  `<td>${num}</td>
                                        <td>${rslt.name}</td>
                                        <td>${rslt.amount}</td>
                                        <td>${rslt.duedate}</td>`;
                        }
                        else{
                            details = msg + "Some error occured";
                        }
                        // console.log(dt);
                      if(rs_code == 1){
                          if(rslt.bill_fetch.status == 0){
                              popup('error' , 'OOPS..!' , rslt.bill_fetch.desc);
                          }
                          else{
                              $("#bill_details").html(details);
                              $("#billdata").val(data);
                              $("#offerModalCenter").modal("show");
                          }
                        // popup('success' , 'Congratulations' , details);
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
     
     
     function getOperator(service) {
           $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/fetchDetails',
                 type:'post',
                 data:{fetch_service_operators:service},
                 
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                     let options ="<option value=''>Select Operator</option>";
                      if(rslt.response_code == 1){
                        let allrslt = rslt.result;
                        let oparray = Object.keys(allrslt);
                        for(let i=0; i<oparray.length; i++){
                          options += "<option value='"+allrslt[i].ID+"'>"+allrslt[i].NAME+"</option>"; 
                        }
                        $("#operator").html(options);
                      }
                      else{
                          popup('error' , 'OOPS..!' , rslt.message);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     }
    
     function getOperatorInfo(opid) {
           $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/fetchDetails',
                 type:'post',
                 data:{fetch_operator:opid},
                 
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                      if(rslt.response_code == 1){
                        let allrslt = rslt.result;
                         $("#ca_num_area").show();
                         $("#canum_label").text(allrslt.displayname);
                         let addData = "";
                         if( allrslt.ad1_name != "" && allrslt.ad1_name != null){
                            addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad1_d_name+'</label><input pattern="'+allrslt.ad1_regex+'" name="ad1" id="'+allrslt.ad1_name+'" required="" class="form-control" autocomplete="false"></div>';
                         }
                         if( allrslt.ad2_name != "" && allrslt.ad2_name != null){
                            addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad2_d_name+'</label><input pattern="'+allrslt.ad2_regex+'" name="ad2" required="" class="form-control" autocomplete="false"></div>';
                         }
                         if( allrslt.ad3_name != "" && allrslt.ad3_name != null){
                            addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad3_d_name+'</label><input pattern="'+allrslt.ad3_regex+'" name="ad3" required="" class="form-control" autocomplete="false"></div>';
                         }
                         if(addData != "" && addData !=null){
                             $("#additionalData").html(addData);
                             $("#additionalData").show();
                         }
                        // let oparray = Object.keys(allrslt);
                        // for(let i=0; i<oparray.length; i++){
                        //   options += "<option value='"+allrslt[i].ID+"'>"+allrslt[i].NAME+"</option>"; 
                        // }
                        // $("#operator").html(options);
                      }
                      else{
                          popup('error' , 'OOPS..!' , rslt.message);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             })
     }
    
     // check DMT status
     function checkBBPSstatus(id){
        //   preventDefault();
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'api/paysprint/bbps/fetchDetails',
                 type:'post',
                 data: {ref_id , check_status},
                 
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rspns = JSON.parse(data);
                    //  let rslt = rspns.receivableData;
                     
                     if(rspns.rscode == undefined){
                   if(rspns.response_code == 1){
                       let st = rspns.status;
                       let stcode = rspns.data.status;
                       let msg = rspns.message;
                       let status;
                       if(stcode == 1){
                           status = "Success";
                       }
                       else if(stcode == 0){
                           status = "Failed";
                       }
                       else{
                           status = "Pending";
                       }
                      
                      if(stcode == 1){
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
                        popup('error' , 'OOPS..!' , "<br> Status : "+status+" <br> Message : " + msg);
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
    
    //   function popup(status , title , msg){
    //     new swal({
    //       title: title,
    //       text: msg,
    //       icon: status,
    //       button: "Okay",
    //       closeOnClickOutside: false, 
    //     })
    // }
    // function popup_reload(status , title , msg){
    //      new swal({
    //     title: title,
    //     text: msg, 
    //     icon: status,
    //     button: "Okay",
    //     })
    //     .then(function(){ 
    //       location.reload();
    //       }
    //     );
    // }
    
    function popup(status , title , msg){
    Swal.fire({
      icon: status,
      title: title,
      text: msg,
    });
    
}
      function popup_reload(status , title , msg){
    Swal.fire({
      icon: status,
      title: title,
      text: msg,
    }).then(function(){
        window.reload();
    });
    
}
     
// get locaiton 
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
 