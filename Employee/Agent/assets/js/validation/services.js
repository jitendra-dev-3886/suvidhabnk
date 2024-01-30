$(document).ready(function(){


$('[type=checkbox]').attr('required',true);
$('.multiselect-dropdown-search').attr('required',true);
jQuery.validator.addMethod("letterSpacesonly", function(value, element) 
{
return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Please Type Letters & Space only !"); 

jQuery.validator.addMethod("NumberLetter", function(value, element) {
  return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
}, "Please Enter Number & Letter !");

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Please Type Only Letters !"); 

jQuery.validator.addMethod("EmailValid", function(value, element) {
  return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
}, "Please Enter Valid Email"); 

jQuery.validator.addMethod("ValidAadhar", function(value, element) {
  return this.optional(element) || /^[2-9]{1}[0-9]{11}$/.test(value);
}, "Please Enter Valid Aadhar Card No");

jQuery.validator.addMethod("ValidPan", function(value, element) {
  return this.optional(element) || /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/.test(value);
}, "Please Enter Valid Pan Card No");

jQuery.validator.addMethod("ValidIFSC", function(value, element) {
  return this.optional(element) || /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/.test(value);
}, "Please Enter Valid IFSC Code");

jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");



var $registrationForm = $('#recharge_form');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
          //username is the name of the textbox
          recharge_mobile: {
              required: true,
            //   phoneUS : true
          },
          recharge_operator: {
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


// BILL PAY

var $registrationForm1 = $('#bill_pay');
if($registrationForm1.length){
  $registrationForm1.validate({
      rules:{
          //username is the name of the textbox
          recharge_mobile: {
              required: true,
             
          },
          recharge_amount: {
              required: true
          },
          recharge_operator: {
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


// Pan PAY

var $registrationForm2 = $('#add_bene_form');
if($registrationForm2.length){
  $registrationForm2.validate({
      rules:{
          //username is the name of the textbox
          bene_name: {
              required: true,
              minlength : 8,
              maxlength : 25,
              letterSpacesonly : true
             
          },
          bene_acc: {
              required: true,
              minlength : 8,
              maxlength : 19
          },
          bene_bank: {
              required: true,
          },
          bene_ifsc : {
              required : true,
              ValidIFSC : true
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


// Pan PAY Valid

var $registrationForm3 = $('#send_amount_form');
if($registrationForm3.length){
  $registrationForm3.validate({
      rules:{
          //username is the name of the textbox
          send_am_acc: {
              required: true,
             
          },
          send_amount: {
              required: true
          },
          txn_type: {
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

//  AEPS Services


var $registrationForm3 = $('#aeps_form');
if($registrationForm3.length){
  $registrationForm3.validate({
      rules:{
          //username is the name of the textbox
          aadhar: {
              required: true,
              minlength : 12,
              maxlength : 12,
              ValidAadhar : true
             
          },
          mobile: {
              required: true
          },
          bankName: {
              required: true
          },
          transType:{
              required : true
          },
          
          
          
         
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

// DMT 



var $registrationForm4 = $('#dmt_form');
if($registrationForm4.length){
  $registrationForm4.validate({
      rules:{
          //username is the name of the textbox
          dob: {
              required: true,
             
          },
          otp: {
              required: true
          },
          str: {
              required: true
          },
          transType:{
              required : true
          },
          
          
          
         
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