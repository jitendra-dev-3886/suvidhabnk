  
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
         let tpin = $("#tpin").val();
         let typeMode = "ONLINE";
         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/Paysprint/payBill',
                 type:'post',
                 data:{num, billdata, op , lati , long , category , op_name , typeMode ,tpin},
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
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
             });
         }
         else{
             popup('error' , 'OOPS..!' , " Enter Number , amount or Select Operator");
         }
     });
     
     
     
    // bbps offline
    
     $("#offlineBillSubmit").submit(function(e){
          e.preventDefault();
         let num = $("#canumber").val();
         let op = $("#operator :selected").val();
         let category= $("#category :selected").text();
         let op_name = $("#operator :selected").text();
         let billdata = $("#billdata").val();
         let lati = $("#lati").val();
         let long = $("#long").val();
         let tpin = $("#tpin").val();
         let typeMode = "OFFLINE";
         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/Paysprint/payBill',
                 type:'post',
                 data:{num, billdata, op , lati , long , category , op_name, typeMode ,tpin},
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
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
         let billingUnit = $("#billingUnit").val();
         let op = $("#operator :selected").val();

         if(op != "" && num != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/Paysprint/fetchDetails',
                 type:'post',
                 data:{num, op , billingUnit},
                 
              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
                 url:'Backend/BBPS/Paysprint/fetchDetails',
                 type:'post',
                 data:{fetch_service_operators:service},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
                 url:'Backend/BBPS/Paysprint/fetchDetails',
                 type:'post',
                 data:{fetch_operator:opid},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
                 url:'Backend/BBPS/Paysprint/fetchDetails',
                 type:'post',
                 data: {ref_id , check_status},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
     