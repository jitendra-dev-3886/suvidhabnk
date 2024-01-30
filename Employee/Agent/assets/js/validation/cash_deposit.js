$(document).ready(function(){


$('[type=checkbox]').attr('required',true);
$('.multiselect-dropdown-search').attr('required',true);
jQuery.validator.addMethod("lettersonly", function(value, element) 
{
return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Letters only please"); 
var $registrationForm = $('#formSubmit');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
          //username is the name of the textbox
          accnumber: {
              required: true,
             
          },
          amount: {
              required: true
          },
          mobile: {
              required: true
          },
          otp: {
              required: true
          }
         
      },
      errorPlacement: function(error, element) 
      {
        if (element.is(":radio")) 
        {
            error.appendTo(element.parents('.gender'));
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