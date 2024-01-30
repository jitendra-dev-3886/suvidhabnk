//mobile number

$("#mobile_verify").click(function() {

	$(".error").html("").hide();
   	$("#mobile_verify").text("Please wait...");
   	// $("#smsverifyModal").css("display", "none");
   	//  $("#smsverifyModal").modal("show");
   	$("#mobile_verify").css("display", "none");
     var number = $("#mobile").val();
	 var phoneRegex = /^[0-9]{10}$/;
 if(phoneRegex.test(number)) {
		var input = {
			"mobile_number" : number,
			"action" : 1
		};
		$.ajax({
			url : 'Agent/Backend/Login/user_mobileVerify.php',
			type : 'POST',
			data : input,
			success : function(response) {
			     $("#mobile_verify").html("Verify Mobile");
         	let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
				    $("#smsverifyModal").css("display", "block");

					$("#userotp").val(rslt.otp);
					$(".error").hide();
					$(".success").show();
				}else{
				    $("#smsverifyModal").css("display", "none");
					$(".error").show();
					$(".error").html("Mobile Number Already Exists");
					$("#mobile_verify").css("display", "block");
				}	
			}
		});
	} else {
		$(".error").html('Please enter a valid number!')
		$(".error").show();
		$("#mobile_verify").css("display", "block");
	}
});
// }

function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();

	$("#verifyOtp").text("Please wait...");
// 	$("#verifyOtp").prop("disabled", true);
	
	var otp = $("#mobile_otp_verify").val();
	var cmpinotp = $("#mobile_otp_verify").val();
	var uotp = $("#userotp").val();
	var input = {
	    cmotp: cmpinotp,
	    userotp: uotp,
		"otp" : otp,
		"action" : 2
	};
	if (otp.length == 6 && otp != null) {
		$.ajax({
			url : 'Agent/Backend/Login/user_mobileVerify.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				var rscode = response.response_code == 1;
					if (rscode==true) {
				// 		$(".error").hide();
				         if(response.message == "Mobile Number Verified Successfully"){
    					      $("#smsverifyModal").css("display", "none");
    						  $(".modal-backdrop.fade.show").remove();
    			              $(".verified").show();
    						  $(".verified").html(`<p style="color: black;text-align: end;font-size: 12px;font-weight: bold;">Mobile Number Verified Successfully <i class='fa fa-check'></i></p>`);
    						  $("#mobile_verify").css("display", "none");
    						  $("#mobile").prop("readonly", true);
    						  $("#sms_btn").css("display", "block"); 
    						  $("#gender_details").css("display", "block"); 
    						  $(".email").html(`<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Id">`);

				         }      

					} else if (response.response_code == 3) {
						$(".errors").show();
						$(".errors").html("Wrong OTP Please Enter Valid OTP !");
						$("#verifyOtp").html("Submit");
					}
			},
			error : function() {
				// alert("ss");
			}
		});
	} else {
		$(".errors").html('You have entered wrong OTP.')
		$(".errors").show();
	}
}
