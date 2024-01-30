$(document).ready(function(){

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
    phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
}, "Please specify a valid phone number");

var $registrationForm = $('#add_user_form');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
        f_name:{
            required : true,
            lettersonly : true,
            minlength : 4,
            maxlength : 25
        },
        l_name:{
            required : true,
            lettersonly : true,
            minlength : 3,
            maxlength : 25
        },
        number:{
          required : true,
          minlength:10, 
          maxlength:10,
          
        },
        email: {
          required: true,
          email: true,
          EmailValid : true
          
        },
        shop_name :{
          required : true,
          letterSpacesonly:true,
          minlength:8, 
          maxlength:50
          
        },
        address:{
          required : true,
          minlength:10, 
          maxlength:50,
        },
        city:{
           required : true,
          letterSpacesonly:true,
          maxlength:25 
        },
        pin:{
          required : true,
          minlength : 6,
          maxlength:6,
          digits: true
        },
        adhaar :{
          required : true   
        },
        adhaar_no : {
           required : true,
           digits: true,
           minlength : 12,
           maxlength:12,
           ValidAadhar : true,
           
        },
        pan_no :{
           required : true,
           NumberLetter : true,
           minlength : 10,
           maxlength:10,
           ValidPan : true,
        },
        b_name:{
          required : true,
          letterSpacesonly : true,
          minlength : 4,
          maxlength:50,
          
        },
        ac_hold_name:{
          required : true,
          letterSpacesonly : true,
          minlength : 6,
          maxlength:50,
        },
        ac_num:{
          required : true,
          digits: true,
          minlength : 10,
          maxlength:20, 
        },
        c_ac_num:{
          required : true,
          digits: true,
          minlength : 10,
          maxlength:20, 
          equalTo : '#ac_num'
        },
        ifsc:{
          required : true,
          NumberLetter : true,
          minlength : 11,
          maxlength:11, 
          ValidIFSC : true
        },
        password:{
          required : true,
          NumberLetter : true,
          minlength : 5,
          maxlength:30,  
        },
        confirm_password:{
          required : true,
          NumberLetter : true,
          minlength : 5,
          maxlength:30, 
          equalTo : '#password'
        },
        otp: {
              required: true
          },
        login: {
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