//   var printbtn = document.querySelector("#printuserprof");
//           var selectpicker = document.querySelector(".selectpicker");
//           var content = document.getElementById("printmedia");
//           var backup = document.body.innerHTML;

//           printbtn.addEventListener("click", function () {

//               document.body.innerHTML = content.innerHTML;
//               window.print();
//               document.body.innerHTML = backup;
//               location.reload();
//           });
          
//           $("#qrdmlbtn").click(function(){
       
//         $("#qrcodemodal").modal("show");
//     });    
          
          
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src); // free memory
    }
  };
          

function updatestatus(id , type){
      $.ajax({
            url: "handler/updateuserstatus.php",
            type: "POST",
            data: {userid:id , usst:type },
            success: function(data) {
                console.log(data);
              if(data == "200"){
                // alert("Updated"); 
                location.reload();
              }
              else{
                  alert("Error");
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
      })
}


    $(document).on("submit","#prifilepicform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Profile Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Profile Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#adhaarpicform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Adhaar card Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Adhaar card Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    $(document).on("submit","#panpicform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Pan card Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Pan card Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#bankpicform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Bank Passbook Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Bank Passbook Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#agrpicform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Agreement Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Agreement Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $("#modalform").submit(function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Commission Package Updated Successfully",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Commission Package Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#user1form",function(e){
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "User deatils Updated Successfully",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "User deatils Updated Unsuccessfully..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#user2form",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "User deatils Updated Successfully",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "User deatils Updated Unsuccessfully..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    $(document).on("submit","#user3form",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Office Address Updated Successfully",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Office Address Updated Unsuccessfully..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    
    $(document).on("submit","#user4form",function(e) {
        console.log("hello");
        e.preventDefault();
         $.ajax({
            url: "../Agent/Backend/PAYOUT/cashfree/main.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            beforeSend:function(xhr){xhr.setRequestHeader('Token', $("#token").val())},            
            success: function(data) {
                console.log(data);
                let rslt = JSON.parse(data.trim());
                 let rs_code = rslt.subCode;
              let msg = rslt.message;
              if(rs_code == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: msg,
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: msg,
                  button: 'Close'
                }).then(()=>{
                    location.reload();
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    function createva(usid){
        let createAccount = "createAccount";
        $.ajax({
        url: "../Agent/Backend/VirtualAccount/main",
        type: "POST",
        data: {createAccount , usid },
        success: function(data) {
            console.log(data);
            let rslt = JSON.parse(data.trim());
             let rs_code = rslt.subCode;
          let msg = rslt.message;
          if(rs_code == "200"){
            Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: msg,
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
          }
          else{
              alert(msg);
          }
        },
        error:function(err){
            alert("Server Error. Try again later .");
        }
      })
    }
    function createupi(usid){
        let createupi = "createupi";
        $.ajax({
        url: "../Agent/Backend/VirtualAccount/main",
        type: "POST",
        data: {createupi , usid },
        success: function(data) {
            console.log(data);
            let rslt = JSON.parse(data.trim());
             let rs_code = rslt.subCode;
          let msg = rslt.message;
          if(rs_code == "200"){
            alert(msg); 
            location.reload();
          }
          else{
              alert(msg);
          }
        },
        error:function(err){
            alert("Server Error. Try again later .");
        }
      })
    }
    
    function createqr(usid){
        $.ajax({
        url: "../Agent/Backend/VirtualAccount/main",
        type: "POST",
        data: {pageid:1 , usid},
        success: function(data) {
            let rslt = JSON.parse(data);
             let rs_code = rslt.response_code;
          let msg = rslt.message;
          if(rs_code == "1"){
            Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: msg,
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
              }
              else{
                 Swal.fire({
                  icon: 'error',
                  title: 'OOPS..!',
                  text: msg,
                  button: 'Close'
                })
          }
        },
        error:function(err){
            alert("Server Error. Try again later .");
        }
      })
    }
    
    
$('.switch3 input').on('change', function(){
  var dad = $(this).parent();
  if($(this).is(':checked'))
    dad.addClass('switch3-checked');
  else
    dad.removeClass('switch3-checked');
});

$(document).on("submit","#usertboform",function(e) {
        e.preventDefault();
         $.ajax({
            url: "handler/udpatecompackage.php",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {
                console.log(data);
            //     let rslt = JSON.parse(data.trim());
            //      let rs_code = rslt.subCode;
            //   let msg = rslt.message;
              if(data == "200"){
                  
                Swal.fire({
                  icon: 'success',
                  title: 'Updated',
                  text: "Profile Updated Successfully...!",
                  button: 'Okay'
                }).then(()=>{
                    location.reload();
                });
                
              }
              else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Failed!',
                  text: "Profile Updated Unsuccessfull..!",
                  button: 'Close'
                });
              }
            },
            error:function(err){
                alert("Server Error. Try again later.");
            }
        })
    });
    
    