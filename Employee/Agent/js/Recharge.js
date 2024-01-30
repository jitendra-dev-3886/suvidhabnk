
       
    //  //  recharge 
    //  $("#rc_form").submit(function(e){
    //      e.preventDefault();
    //     $("#").val();
    //     $("#").text();
    //  })
       
       function showconfirm(offclick){
         
        //   if(!offclick){
        //       check_plan(true);
        //   }
        //   else{
        //       $("#sendAmModalCenter").modal("show");
        //   }
          $("#sendAmModalCenter").modal("show");
               check_plan(true);
           $("#showam").text($("#recharge_amount").val());
           $("#showop").text($("#rc_operator :selected").text());
           $("#showmobile").text($("#recharge_mobile").val());
           $("#showlongi").text($("#longi").val());
           $("#showlati").text($("#lati").val());
       }
     //  recharge 
     $("#recharge_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
           
           
             $.ajax({
                 url:'Backend/Recharge/recharge',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
               beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                         console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , " Recharge Successfull. Msg: " + msg);
                         Swal.fire({
                                  title: "Congratulations",
                                  text:  " Recharge Successfull. Msg: " + msg,
                                  icon: 'success',
                                  button: "Print",
                                  closeOnClickOutside: false, 
                                })
                                .then(function(){ 
                                   location.replace("RechargeServicesRechargeReport?MyLatestReport");
                                   }
                                );
                        // location.reload();
                      } 
                      else{
                          
                          if(rs_code == 16)
                          
                          {
                            popup('error' , 'OOPS..!' ,"Server Down Please Contact To Admin!");
                          }
                          
                          else
                          {
                              popup('error' , 'OOPS..!' ,msg);
                          }
                          
                         
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                      popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                 }
             });
             
           
             
     });
     
     
    //  hlr check mobile
    
    // $("#recharge_mobile").on("change", function(){
    //     $("#loading_ajax").show();
    //      let num = $("#recharge_mobile").val();
    //      let hlr_check = "hlr_check";
    //          $.ajax({
    //              url:'Backend/Recharge/recharge',
    //              type:'post',
    //              data: {num,hlr_check},
    //              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
    //              success:function(data, status){
    //                  $("#loading_ajax").hide();
                     
    //                   let rslt = JSON.parse(data);
    //                   if(rslt.response_code == 1){
                        
    //                       $("#rc_operator").html(`
    //                       <option selected value="${rslt.opcode}">${rslt.operator}</option>
    //                       `);
    //                   }
    //              },
    //              error:function(err){
    //                  $("#loading_ajax").hide();
    //                   popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
    //              }
    //          });
    // });
     
  // check transaction status dmt 
     function check_rech_status(id){
        //   preventDefault();
          let check_status = 'check_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                  url:'Backend/Recharge/recharge',
                 type:'post',
                 data: {ref_id ,check_status},
                   beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
     
  // check transaction status dmt 
     function check_plan(submit){
        //   preventDefault();
        
        
        
          let check_plan = 'check_plan';
          let op = $("#rc_operator :selected").text();
             $("#loading_ajax").show();
             
             $.ajax({
                  url:'Backend/Recharge/recharge',
                 type:'post',
                 data: {op ,check_plan},
                   beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    //  console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                          let tabs="";
                          let tabrows="";
                          let tabdata="";
                          let planinfo = rslt.info;
                          let info = Object.keys(planinfo);
                          let active;
                          let breakCheck = false;
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
                                      if(submit){
                                          if($("#recharge_amount").val() == offer['rs']){
                                            breakCheck = true;
                                            $("#showam").text(offer['rs']);
                                            $("#recharge_amountt").val(offer['rs']);
                                            $("#showplandesc").text(offer['desc']);
                                            $("#showlongi").text($("#longi").val());
                                            $("#offerModalCenter").modal("hide");
                                           $("#sendAmModalCenter").modal("show");
                                            break;
                                          }
                                          else if(plans.length == j+1){
                                            $("#showplandesc").text("Plan Not Found With This Amount");
                                           $("#sendAmModalCenter").modal("show");
                                          }
                                      }
                                      tabrows += '<div class="row" style="border: 2px solid grey;padding: 5px;margin: 5px;"><div class="col-2"><button class="btn btn-primary" onclick="planamount('+offer['rs']+' , \' '+offer['desc']+' \')" >'+offer['rs']+'</button></div><div class="col-7">'+offer['desc']+'</div><div class="col-3">'+offer['validity']+'</div></div>';
                                   }
                                   if (breakCheck){
                                       break;
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
                          if(!submit){
                            $("#offerModalCenter").modal("show");
                          }
                        // console.log(rslt.info);
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
var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})


function planamount(amount , text){
    $("#showam").text(amount);
    $("#recharge_amount").val(amount);
    $("#showplandesc").text(text);
    $("#offerModalCenter").modal("hide");
    showconfirm(true);
}