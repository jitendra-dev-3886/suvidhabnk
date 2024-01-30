
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
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , " Recharge Successfull. Msg: " + msg);
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
     // roffer 
     
     function get_roffer(){
        //   e.preventDefault();
             let num = $("#recharge_mobile").val();
             let op = $("#rc_operator :selected").val();
             if(num != "" && op != ""){
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'api/roffer/roffer',
                     type:'post',
                     data: {num:num , op:op},
                     success:function(data, status){
                         $("#loading_ajax").hide();
                             $('#r_data').html(data);
                             $('#exampleModalCenter').modal('show');
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                          popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
                     }
                 })
             }
             else{
                  popup('error' , 'OOPS..!' ,"Opeartor or Mobile could not be empty.");
             }
     }

   // check transaction status recharge 
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
     

function rech(value){
    $("#recharge_amount").val(value)
    $('#exampleModalCenter').modal('hide');
}
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
    