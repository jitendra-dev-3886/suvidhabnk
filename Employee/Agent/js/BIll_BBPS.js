
     function getOperatorInfo(opid) {
           $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/billAvenue/main',
                 type:'post',
                 data:{fetch_operator:opid},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      if(rslt.responseCode == "000"){
                        let allrslt = rslt.biller;
                        //  $("#ca_num_area").show();
                         let addData = "";
                         
                        //  $("#canum_label").text(allrslt.displayname);
                        //  if( allrslt.ad1_name != "" && allrslt.ad1_name != null){
                        //     addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad1_d_name+'</label><input pattern="'+allrslt.ad1_regex+'" name="ad1" id="'+allrslt.ad1_name+'" required="" class="form-control" autocomplete="false"></div>';
                        //  }
                        //  if( allrslt.ad2_name != "" && allrslt.ad2_name != null){
                        //     addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad2_d_name+'</label><input pattern="'+allrslt.ad2_regex+'" name="ad2" required="" class="form-control" autocomplete="false"></div>';
                        //  }
                        //  if( allrslt.ad3_name != "" && allrslt.ad3_name != null){
                        //     addData += '<div class="form-group form-primary col-md-3 "><label class="float-label" id="canum_label">'+allrslt.ad3_d_name+'</label><input pattern="'+allrslt.ad3_regex+'" name="ad3" required="" class="form-control" autocomplete="false"></div>';
                        //  }
                        
                        let oparray = Object.keys(allrslt.billerInputParams.paramInfo);
                        
                        for(let i=0; i<oparray.length; i++){
                            let prmdata = allrslt.billerInputParams.paramInfo;
                            addData += '<div class="form-group form-primary col-md-2"><label class="float-label" id="canum_label">'+prmdata[i].paramName+'</label><input pattern="'+prmdata[i].regEx+'" name="ad1" id="'+prmdata[i].paramName+'" required="" class="form-control" autocomplete="false"></div>';
                        }
                        
                         if(addData != "" && addData !=null){
                             $("#additionalData").html(addData);
                             $("#additionalData").show();
                         }
                         
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
    
    
  function isArray(arr) {
  return arr.constructor.toString().indexOf("Array") > -1;
}  
    
    // bbps fetchBill
     $("#fetchBtn").click(function(){
         let fetchbill = "fetchbill";
         let billerid = $("#operator").val();
         let add_data= $("#additionalData");
        var inputs = add_data.find("input");
        let allprms = [];
        inputs.each(function(i){
            let arr = {
                prmname:inputs[i].id,
                prmval:inputs[i].value
            };
           allprms.push(arr);
        })
        
         if(fetchbill != "" && billerid != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/billAvenue/main',
                 type:'post',
                 data:{fetchbill , billerid , inputdata : allprms},
                 
              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let msg="";
                     let rspns = JSON.parse(data);
                     let rslt = rspns.response;
                     if(rslt.response_code != undefined){
                          popup('error' , 'OOPS..!' , rslt.message);
                          return false;
                     }
                     
                     if(rslt.responseCode != "000"){
                         let er = rslt.errorInfo.error;
                      
                        if(isArray(er)){
                              let erarray = Object.keys(er);
                                for(let i=0; i<erarray.length; i++){
                                    msg += er[i].errorMessage+"<br>";
                                }
                        }
                        else{
                            msg += er.errorMessage+"<br>";
                        }
                          
                          popup('error' , 'OOPS..!' ,msg);
                          return false;
                     }
                    //   let rs_code = rslt.response_code; 
                    //   let msg = rslt.message; 
                    //   let dt = rslt.bill_fetch;
                    //   let details;
                        if(rslt.responseCode != ""){
                            $("#billdata").val(data);
                            $("#billfetchrefid").val(rspns.refid);
                            
                            details =  `<td>${$("#operator :selected").text()}</td>
                                        <td>${rslt.billerResponse.customerName}</td>
                                        <td>9898990084</td>
                                        <td>${rslt.billerResponse.billDate}</td>
                                        <td>${rslt.billerResponse.billPeriod}</td>
                                        <td>${rslt.billerResponse.billNumber}</td>
                                        <td>${rslt.billerResponse.dueDate}</td>
                                        <td>${rslt.billerResponse.billAmount}</td>
                                        <td>0</td>
                                        <td>${rslt.billerResponse.billAmount}</td>
                                        <td><select>
                                            <option value="">Select Method</option>
                                            <option value="cash">Cash</option>
                                        </select></td>`;
                        }
                        else{
                            details = msg + "Some error occured";
                        }
                    //     // console.log(dt);
                    //   if(rs_code == 1){
                    //       if(rslt.bill_fetch.status == 0){
                    //           popup('error' , 'OOPS..!' , rslt.bill_fetch.desc);
                    //       }
                    //       else{
                              $("#bill_details").html(details);
                              $("#billdata").val(data);
                              $("#offerModalCenter").modal("show");
                    //       }
                    //     // popup('success' , 'Congratulations' , details);
                    //   }
                    //   else{
                    //       popup('error' , 'OOPS..!' , msg);
                    //   }
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
     $("#BillSubmit").submit(function(e){
          e.preventDefault();
         let paybill = "paybill";
         let billerid = $("#operator").val();
         let op_name = $("#operator :selected").text();
         let category = $("#category").val();
         let billfetchrefid = $("#billfetchrefid").val();
         let billdata= $("#billdata").val();
         let add_data= $("#additionalData");
        var inputs = add_data.find("input");
        let allprms = [];
        inputs.each(function(i){
            let arr = {
                prmname:inputs[i].id,
                prmval:inputs[i].value
            };
           allprms.push(arr);
        })
        
     if(paybill != "" && billerid != ""){
             $("#loading_ajax").show();
             $.ajax({
                  url:'Backend/BBPS/billAvenue/paybill',
                 type:'post',
                 data:{paybill , billerid , op_name, category , billdata, billfetchrefid ,inputdata : allprms },
                 
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     
                     let msg="";
                       let rslt = JSON.parse(data);
                     if(rslt.response_code != undefined){
                          popup('error' , 'OOPS..!' , rslt.message);
                          return false;
                     }
                     
                     if(rslt.responseCode != "000"){
                         let er = rslt.errorInfo.error;
                      
                        if(isArray(er)){
                              let erarray = Object.keys(er);
                                for(let i=0; i<erarray.length; i++){
                                    msg += er[i].errorMessage+"<br>";
                                }
                        }
                        else{
                            msg += er.errorMessage+"<br>";
                        }
                          
                          popup('error' , 'OOPS..!' ,msg);
                          return false;
                     }
                     
                     if(rslt.responseCode == "000"){ 
                         msg = rslt.responseReason;
                          popup_reload('success' , 'Congratulations' , msg);
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
     
    
    // bbps
     $("#quickpayBtn").click(function(){
         let paybill = "paybill";
         let billerid = $("#operator").val();
         let op_name = $("#operator :selected").text();
         let category = $("#category").val();
         let billfetchrefid = $("#billfetchrefid").val();
         let billdata= $("#billdata").val();
         let quickpayamount= $("#quickpayamount").val();
         let add_data= $("#additionalData");
        var inputs = add_data.find("input");
        let allprms = [];
        inputs.each(function(i){
            let arr = {
                prmname:inputs[i].id,
                prmval:inputs[i].value
            };
           allprms.push(arr);
        })
        
     if(paybill != "" && billerid != ""){
             $("#loading_ajax").show();
             $.ajax({
                  url:'Backend/BBPS/billAvenue/quickpaybill',
                 type:'post',
                 data:{paybill , billerid , op_name, category , billdata, billfetchrefid ,inputdata : allprms , quickpayamount },
                 
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     
                     let msg="";
                       let rslt = JSON.parse(data);
                     if(rslt.response_code != undefined){
                          popup('error' , 'OOPS..!' , rslt.message);
                          return false;
                     }
                     
                     if(rslt.responseCode != "000"){
                         let er = rslt.errorInfo.error;
                      
                        if(isArray(er)){
                              let erarray = Object.keys(er);
                                for(let i=0; i<erarray.length; i++){
                                    msg += er[i].errorMessage+"<br>";
                                }
                        }
                        else{
                            msg += er.errorMessage+"<br>";
                        }
                          
                          popup('error' , 'OOPS..!' ,msg);
                          return false;
                     }
                     
                     if(rslt.responseCode == "000"){ 
                         msg = rslt.responseReason;
                          popup_reload('success' , 'Congratulations' , msg);
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
     
    
     function checkBBPSstatus(id){
        //   preventDefault();
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/BBPS/billAvenue/main',
                 type:'post',
                 data: {ref_id , check_status},
                 beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                    //  let rslt = rspns.receivableData;
                     
                     if(rslt.rscode == undefined){
                     let msg="";
                       let rslt = JSON.parse(data);
                     if(rslt.response_code != undefined){
                          popup('error' , 'OOPS..!' , rslt.message);
                          return false;
                     }
                     
                     if(rslt.responseCode != "000"){
                         let er = rslt.errorInfo.error;
                      
                        if(isArray(er)){
                              let erarray = Object.keys(er);
                                for(let i=0; i<erarray.length; i++){
                                    msg += er[i].errorMessage+"<br>";
                                }
                        }
                        else{
                            msg += er.errorMessage+"<br>";
                        }
                          
                          popup('error' , 'OOPS..!' ,msg);
                          return false;
                     }
                     
                     if(rslt.responseCode == "000"){ 
                         msg = rslt.responseReason;
                          popup_reload('success' , 'Congratulations' , msg);
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
     