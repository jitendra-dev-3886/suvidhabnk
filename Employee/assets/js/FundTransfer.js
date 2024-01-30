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
    $("#main_form").submit(function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'handler/FundTransfer',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup_reload('success' , 'Congratulations' , msg);
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
     
//   function payment_request(value){
//         //  value.preventDefault();
//         console.log(value);
//              $("#loading_ajax").show();
//              $.ajax({
//                  url:'handler/FundTransfer',
//                  type:'post',
//                  data: new FormData(document.querySelector('#'+value)),
//                  processData:false,
//                  contentType:false,
//                  success:function(data, status){
//                      $("#loading_ajax").hide();
//                      let rslt = JSON.parse(data);
//                       let rs_code = rslt.response_code; 
//                       let msg = rslt.message; 
//                       if(rs_code == 1){
//                         popup_reload('success' , 'Congratulations' , msg);
//                       } 
//                       else{
//                          popup('error' , 'OOPS..!' ,msg);
//                       }
//                  },
//                  error:function(err){
//                      $("#loading_ajax").hide();
//                       popup('error' , 'OOPS..!' ,"some internel error occured we are fixing it");
//                  }
//              })
//      }
