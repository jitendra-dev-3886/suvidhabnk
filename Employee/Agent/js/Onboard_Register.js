$(document).ready(function(){
    
    $("#onBoardUser").submit(function(e){
     e.preventDefault();
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
   
      if(reslt.response_code == 1){
         
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: reslt.message,
                    }).then(function(){ 
                        $("#onBoardUser")[0].reset();
                        location.replace("Agent/Login");
            });
                              
          }else if(reslt.response_code == 3){
                Swal.fire({
                      icon: "error",
                      title: "OOPS!",
                      button: "Close",
                      text: reslt.message,
                    }); 
          }else{
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
