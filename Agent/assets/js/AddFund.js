 function popup(status , title , msg){
        new swal({
          title: title,
          text: msg,
          icon: status,
          button: "Okay",
          closeOnClickOutside: false, 
        })
    }
    function popup_reload(status , title , msg){
           new swal({
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
                 url:'handler/Fund',
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
     
    jQuery(document).on('click', '#razor-pay-now', function (e) {
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = ""; 
    var store_name = '';
    var store_description = 'Online Fund';
    var store_logo = '';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    
    jQuery('.text-danger').remove();
    var razorpay_options = {
    key: key_id,
    amount: merchant_total,
    name: store_name,
    description: store_description,
    image: store_logo,
    netbanking: true,
    currency: currency_code_id,
    prefill: {
        name: card_holder_name_id,
        email: email,
        contact: phone
    },
    notes: {
        soolegal_order_id: merchant_order_id,
    },
handler: function (transaction) {
    jQuery.ajax({
        url:'api/payment_gateway/razorpay/callback.php',
        type: 'post',
        data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id},
        dataType: 'json',
        success: function (res) {
            console.log(res);
            if(res.msg){
                alert(res.msg);
                return false;
            }
            if(res.rs_code == 200){
                popup_reload( 'success' , 'congratulation' , "Payment Success");
                // console.log('wokr');
                // location.reload();
            }
            else{
               popup( 'error' , 'OOPS..!' , "Payment failed Contact to admin");
            }
            // window.location = res.redirectURL;
        }
    });
},
"modal": {
    "ondismiss": function () {
        // code here
    }
}
};
// obj     
var objrzpv1 = new Razorpay(razorpay_options);
objrzpv1.open();
e.preventDefault();
 
});
