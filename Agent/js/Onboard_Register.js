$(document).ready(function(){
    
    $("#onBoardUser").submit(function(e){
     e.preventDefault();
       $("#loading_ajax").show();
    //  alert('worked');
    //  console.log('worked');
    
    $.ajax({
    url:"Agent/Backend/Login/Onboard_Register.php",
    method:"POST",
    data:new FormData(this),
    contentType:false,
    cache:false,
    processData:false,
    beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
    success: function(data)
    {
  let reslt = JSON.parse(data);
  let status = reslt.status;
  console.log(status);
     $("#loading_ajax").hide();
      if(reslt.status == true){
         
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: reslt.message,
                    }).then(function(){ 
                        // $("#onBoardUser")[0].reset();
                        location.replace("Agent/Login.php");
            });
                              
          }else if(reslt.status == false){
                Swal.fire({
                      icon: "error",
                      title: "OOPS!",
                      button: "Close",
                      text: reslt.message,
                    }); 
          }
    },
});
            

});
});
