$(document).ready(function(){

jQuery.validator.addMethod("letterSpacesonly", function(value, element) 
{
return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Letters & Space only please"); 

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 

var $registrationForm = $('#main_form');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
        service: {
              required: true
          },
        u_type: {
              required: true
          },
        pack_name: {
              required: true
          },
        status: {
              required: true
          }
          
      },
      errorPlacement: function(error, element) 
      {
        if (element.is(":radio")) 
        {
            error.appendTo(element.parents('.otp'));
            error.appendTo(element.parents('.login'));
        }
        else if(element.is(":checkbox")){
            error.appendTo(element.parents('.hobbies'));
        }
        else 
        { 
            error.insertAfter( element );
        }
        
       },
       submitHandler: function(form,event) {
          return true;
        }
  });
}


// TAB 2
var $registrationForm1 = $('#tab_two_form');
if($registrationForm1.length){
  $registrationForm1.validate({
      rules:{
        amount: {
              required: true
          },
        wallet_type :{
            required : true
        },
        fund_type: {
            required : true
        },
        remark : {
           required : true  
        },
        select: {
              required: true
          }
      },
      errorPlacement: function(error, element) 
      {
        if (element.is(":radio")) 
        {
            error.appendTo(element.parents('.otp'));
            error.appendTo(element.parents('.login'));
        }
        else if(element.is(":checkbox")){
            error.appendTo(element.parents('.hobbies'));
        }
        else 
        { 
            error.insertAfter( element );
        }
        
       },
       submitHandler: function(form,event) {
          return true;
        }
  });
}
 







});