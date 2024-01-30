$("#login_form").submit(function(e){
    
             e.preventDefault();
                 $("#loading_ajax").show();
                 $.ajax({
                     url:'Backend/Login/Login.php',
                     type:'POST',
                     data: new FormData(this),
                     processData:false,
                     contentType:false,
                     success:function(data, status){
                         $("#loading_ajax").hide();
                          let rslt = JSON.parse(data);
                          let User_found = rslt.User_Exist; 
                          let User_verification = rslt.Login_Auth;
                          if(User_found == "Yes"){
                              Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                   button: "Okay",
                                  text: 'Welcome. You are logged in.',
                                }) .then(function(){ 
                                      location.replace("index.php");
                                   }
                                );
                          } 
                          else{
                            popup('error' , 'OOPS..!' ,"Invaild Details.. Or Reset Your Password..!");
                          }
                     },
                     error:function(err){
                         $("#loading_ajax").hide();
                         popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
                 })
    
     })
 
function verify(msg){
     $("#login_form").hide();
    $("#otp_area").show();
    $("#otp_msg").text(msg);
}

