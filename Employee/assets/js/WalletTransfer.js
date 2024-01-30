function popup(status , title , msg){
        swal({
          title: title,
          text: msg,
          icon: status,
          button: "Okay",
          closeOnClickOutside: false, 
        })
    }
    function popup_success(status , title , msg){
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
    
  $("#number").keyup(function(){
      let num = $('#number').val();
    $.ajax({
      url: "handler/wallet_transfer.php",
      method: "POST",
      data: {num,type:'fetchuser'},
      success: function (data) {
          let rslt = JSON.parse(data);
          
          $("#showusername").html(`${rslt.name} <i class="fas fa-check-circle" style="color:green"></i>`);
          $("#fetchuserid").val(rslt.userid);
      }
    });
  });
    
 // Ajax Request for Editing Data
   $("#Wtransfer").click(function (e) {
    e.preventDefault();
    // console.log("Edit Button Clicked");
    let w_type = $("#wallet_type").val();
    let w_amt = $("#w_amt").val();
    let userid = $("#fetchuserid").val();
    
   
    
    // console.log(w_type);
    // console.log(w_amt); 
    mydata = { wallet_type: w_type, amount: w_amt,fetchuserid:userid,type:'wallettrans'};

      $.ajax({
      url: "handler/wallet_transfer.php",
      method: "POST",
      data: mydata,
      success: function (data) {
          console.log(data);
          let rslt = JSON.parse(data);
          let rs_code = rslt.response_code; 
          let msg = rslt.message; 
          if(rs_code == 1){
            popup_reload('success' , 'Congratulations' , msg);
          } 
          else if(rs_code == 2){
             popup_reload('success' , 'Congratulations' , msg);
          }  
          else if(rs_code == 3){
             popup('error' , 'OOPS..!' ,msg);
          }  
          else if(rs_code == 4){
             popup('error' , 'OOPS..!' ,msg);
          }  
          else{
             popup('error' , 'OOPS..!' ,msg);
          }  
         },
          error:function(err){
                //  $("#Wtransfer").hide();
                  popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
             }  
    });
        $("#myform")[0].reset();
   });
     