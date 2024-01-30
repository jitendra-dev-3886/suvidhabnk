$(document).ready(function(){
    discoverAvdm();
})

//aeps onbaoord 
     $("#onboardForm").submit(async function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/AEPS/Instantpay/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.receivableData.statuscode; 
                      let msg = rslt.message; 
                   if(rs_code == "TXN"){
                       $("#otpReferenceID").val(rslt.data.otpReferenceID);
                       $("#hash").val(rslt.data.hash);
                     popup('success' , 'Hurray.' ,"OTP sent to your mobile number.");
                      $("#onboardForm").hide(); 
                      $("#onboardOTPForm").show(); 
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
     
//aeps otp submit 
     $("#onboardOTPForm").submit(async function(e){
         e.preventDefault();
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/AEPS/Instantpay/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, st){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.receivableData.statuscode; 
                      let msg = rslt.status; 
                   if(rs_code == "TXN"){
                     popup_reload('success' , 'Hurray.' ,"You are registered now.");
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
     
     
//aeps transfer 
     $("#aeps_form").submit(async function(e){
         e.preventDefault();
            let device = await aepssatrt();
            if($("#txtPidData").val() != ""){
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/AEPS/Instantpay/main',
                 type:'post',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                  beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                    console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.statuscode; 
                      let msg = rslt.status; 
                      if(rs_code == "TXN"){
                          if($("#transType :selected").val() == "MS"){
                              let msm = rslt.data.ministatement;
                               for(i=0;i<Object.keys(msm).length; i++){
                                      msg += "\n Date : "+msm[i].date+" TxnType : "+msm[i].txnType+" Amount : "+msm[i].amount+" Narration : "+msm[i].narration+" \n";
                                }
                              Swal.fire({
                              title: 'Congratulations',
                              html:  "<pre> Transaction Successfull. Statement : \n" + msg + "</pre>",
                              icon: 'success',
                              button: "Print",
                              closeOnClickOutside: false, 
                            })
                            .then(function(){ 
                               location.replace("AePsServiceReport?MyLatestReport");
                               }
                            );    
                            // popup('success' , 'Congratulations' , "<pre> Transaction Successfull. Statement : \n" + msg + "</pre>");
                          }
                          else  if($("#transType :selected").val() == "BE"){
                              msg += "\n Balance : "+rslt.data.bankAccountBalance;
                              Swal.fire({
                              title: 'Congratulations',
                              html:  "<pre> Transaction Successfull. Statement : \n" + msg + "</pre>",
                              icon: 'success',
                              button: "Okay",
                              closeOnClickOutside: false, 
                            })
                            .then(function(){ 
                               location.replace("AePsServiceReport?MyLatestReport");
                               }
                            );    
                            // popup('success' , 'Congratulations' , " Transaction Successfull. Statement : \n <br>" + msg);
                          }
                          else{
                              Swal.fire({
                              title: 'Congratulations',
                              html:  "<pre> Transaction Successfull. " + msg + "</pre>",
                              icon: 'success',
                              button: "Okay",
                              closeOnClickOutside: false, 
                            })
                            .then(function(){ 
                               location.replace("AePsServiceReport?MyLatestReport");
                               }
                            );   
                            // popup_reload('success' , 'Congratulations' , " Transaction Successfull. Msg: " + msg);
                          }
                        // location.reload();
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
             
            }
            else{
                 popup('error' , 'OOPS..!' ,"Finger not scanned.");
            }
     })
     
       
     // check transaction status dmt 
     function check_aeps_status(id){
        //   preventDefault();
          let check_aeps_status = 'check_aeps_status';
          let ref_id = id;
             $("#loading_ajax").show();
             $.ajax({
                 url:'Backend/AEPS/Instantpay/main',
                 type:'post',
                 data: {ref_id:ref_id ,check_aeps_status:check_aeps_status},
                 
              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     console.log(data);
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.message; 
                      if(rs_code == 1){
                        popup('success' , 'Congratulations' , "Transaction Msg: " + msg);
                        // location.reload();
                      } 
                      else{
                        popup('error' , 'OOPS..!' , msg);
                      }
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                 }
             })
     }
     
     
    

    function get_trans(val){
        //  console.log(val);
          if(val == "CW" || val == "M"){
            $("#aeps_amount_area").show();
        }
        else{
            $("#aeps_amount_area").hide();
        }
     }
     
//  =========== Finger print  scan =========
//  =========== Finger print  scan =========
var GetPIString='';
var GetPAString='';
var GetPFAString='';
var DemoFinalString='';
var select = '';
var finalUrl="";
var MethodInfo="";
var MethodCapture="";
var primaryUrl = "http://127.0.0.1:";// For HTTP	
function discoverAvdm(){
    var capturedata = $('#otp-validate-fingerprint-capture').val();
	var SuccessFlag=0;
	try {
		var protocol = window.location.href;
		if ((protocol.indexOf("http") >= 0) && ((capturedata) != "nextrd")) {
    		primaryUrl = "https://127.0.0.1:";
    	}else if((capturedata) == "nextrd"){
			primaryUrl = "https://127.0.0.1:";
    	}else{
    		primaryUrl = "https://127.0.0.1:";
    	}
	} catch (e){}
	url = "";
	var CmbData1 = '';
    var CmbData2 = '';
	for (var i = 11100; i <= 11101; i++)
	{
		var verb = "RDSERVICE";
		var err = "";
		SuccessFlag=0;
		var res;
		$.support.cors = true;
		var httpStaus = false;
		var jsonstr="";
		var data = new Object();
		var obj = new Object();
		$.ajax({
			type: "RDSERVICE",
			async: false,
			crossDomain: true,
			dataType: "xml",
			url: primaryUrl + i.toString(),
			contentType: "text/xml; charset=\"utf-8\"",
			processData: false,
			cache: false,
			success: function (data) {
				httpStaus = true;
				res = { httpStaus: httpStaus, data: data };
				finalUrl = primaryUrl + i.toString();
				var $doc = data;
				CmbData1 =  $($doc).find('RDService').attr('status');
				CmbData2 =  $($doc).find('RDService').attr('info');
				if(	RegExp('\\b'+ 'Mantra' +'\\b').test(CmbData2)==true  ||  
					RegExp('\\b'+ 'Morpho_RD_Service' +'\\b').test(CmbData2)==true  ||  
					RegExp('\\b'+ 'SecuGen India Registered device Level 0' +'\\b').test(CmbData2)==true ||  
					RegExp('\\b'+ 'Precision - Biometric Device is ready for capture' +'\\b').test(CmbData2)==true ||  
					RegExp('\\b'+ 'RD service for Startek FM220 provided by Access Computech' +'\\b').test(CmbData2)==true ||  
					RegExp('\\b'+ 'NEXT Biometrics L0 RDService for UIDAI AADHAAR' +'\\b').test(CmbData2)==true  ){
					if(RegExp('\\b'+ 'Mantra' +'\\b').test(CmbData2)==true){
						if($($doc).find('Interface').eq(0).attr('path')=="/rd/capture")
						{
							MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						}
						if($($doc).find('Interface').eq(1).attr('path')=="/rd/capture")
						{
							MethodCapture=$($doc).find('Interface').eq(1).attr('path');
						}
						if($($doc).find('Interface').eq(0).attr('path')=="/rd/info")
						{
							MethodInfo=$($doc).find('Interface').eq(0).attr('path');
						}
						if($($doc).find('Interface').eq(1).attr('path')=="/rd/info")
						{
							MethodInfo=$($doc).find('Interface').eq(1).attr('path');
						}
					}else if(RegExp('\\b'+ 'Morpho_RD_Service' +'\\b').test(CmbData2)==true){
						MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						MethodInfo=$($doc).find('Interface').eq(1).attr('path');
					}else if(RegExp('\\b'+ 'SecuGen India Registered device Level 0' +'\\b').test(CmbData2)==true){
						MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						MethodInfo=$($doc).find('Interface').eq(1).attr('path');
					}else if(RegExp('\\b'+ 'Precision - Biometric Device is ready for capture' +'\\b').test(CmbData2)==true){
						MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						MethodInfo=$($doc).find('Interface').eq(1).attr('path');
					}else if(RegExp('\\b'+ 'RD service for Startek FM220 provided by Access Computech' +'\\b').test(CmbData2)==true){
						MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						MethodInfo=$($doc).find('Interface').eq(1).attr('path');
					}else if(RegExp('\\b'+ 'NEXT Biometrics L0 RDService for UIDAI AADHAAR' +'\\b').test(CmbData2)==true){
						MethodCapture=$($doc).find('Interface').eq(0).attr('path');
						MethodInfo=$($doc).find('Interface').eq(1).attr('path');
					}
					if(CmbData1=='READY')
					{	
						SuccessFlag=1;
						alert("Device connected.");
        				// aepssatrt();
				// 		toastr["success"]("Device Info!",'Device detected successfully');
						$('#method').val( finalUrl+MethodCapture);
				// 		$('#datascan').prop('disabled',true);
				// 		$('#capturedata').prop('disabled',false);
						return;
					}
				// 	else if(CmbData1=='NOTREADY')
				// 	{
				// 		$.alert({
				// 			title: 'Device Info!',
				// 			content: 'Please connect the device first!!',
				// 		});
				// 		return false;								
				// 	}	
				}
			},
			error: function (jqXHR, ajaxOptions, thrownError) {
			},
		});
		if(SuccessFlag==1)
		{
			break;
		}		
	}
	if(CmbData1=='NOTREADY')
	{
// 		$.alert({
// 			title: 'Device Info!',
// 			content: 'Please connect the device first!!',
// 		});
alert('Please connect the device first!!');
		SuccessFlag==1
		return false;								
	}	
	if(SuccessFlag==0)
	{   
	    
alert('Unable to find the device!!');
// 		$.alert({
// 			title: 'Device Info!',
// 			content: 'Unable to find the device!!',
// 		});
		$('#method').val( finalUrl+MethodCapture);
		$('#datascan').prop('disabled',true);
		$('#datasubmit').prop('disabled',false);
	}
	return res;
}
	  
	  function aepssatrt()
		{
		    
		DString = '';
       device= $("#fingerdevice").val();


			var strWadh="";
		    var strOtp="";
	     
	   
	   var XML='<?xml version="1.0"?> <PidOptions ver="1.0"> <Opts fCount="1" fType="0" iCount="0" pCount="0" format="0" pidVer="2.0" timeout="10000" posh="UNKNOWN" env="P" /> '+DString+'<CustOpts><Param name="mantrakey" value="" /></CustOpts> </PidOptions>';
 	  
            var finUrl=  $('#method').val();
			

					 var verb = "CAPTURE";


                        var err = "";

						var res;
						$.support.cors = true;
						var httpStaus = false;
						var jsonstr="";
						
							$.ajax({

							type: "CAPTURE",
							async: false,
							crossDomain: true,
							url: finUrl,
							data:XML,
							contentType: "text/xml; charset=utf-8",
							processData: false,
							success: function (data) {
							
							 if(device == "morpho"){
							   var xmlString = (new XMLSerializer()).serializeToString(data)  //morpho
							 //  var xmlString = (new XMLSerializer()).serializeToString(data)  //morpho
							}else if(device == "mantra"){
								var xmlString = data;  //mantra
							}else if(device == "secugen"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //secugen
							}else if(device == "precision"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //precision
							}else if(device == "startek"){
								var xmlString = (new XMLSerializer()).serializeToString(data);  //startek
							}else if(device == "nextrd"){
								  var xmlString = (new XMLSerializer()).serializeToString(data);  //next rd
							}
							
							httpStaus = true;
							res = { httpStaus: httpStaus, data: xmlString};
							
						
                                    
								$('#txtPidData').val(xmlString);                                  
								// console.log(data);
								var $doc = data;
								var Message =  $($doc).find('Resp').attr('errInfo');
								var errorcode =	 $($doc).find('Resp').attr('errCode');
									if(errorcode==0)
									{

										var $doc = $.parseXML(data);
										var Message =  $($doc).find('Resp').attr('errInfo');
										
								// 		alert("Capture Success");
        								// fingersuccess();
										
									}else{
										$('#loaderbala').css("display","none");
										alert('Capture Failed. Reload the page and try again.');
										$("#loading_ajax").hide();
								// 		window.location.reload();
									}	

							},
							error: function (jqXHR, ajaxOptions, thrownError) {
							//$('#txtPidOptions').val(XML);
							alert(thrownError);
								res = { httpStaus: httpStaus, err: getHttpError(jqXHR) };
							},
						});

						return res;
		}
		
		
		function getHttpError(jqXHR) {
		    var err = "Unhandled Exception";
		    if (jqXHR.status === 0) {
		        err = 'Service Unavailable';
		    } else if (jqXHR.status == 404) {
		        err = 'Requested page not found';
		    } else if (jqXHR.status == 500) {
		        err = 'Internal Server Error';
		    } else if (thrownError === 'parsererror') {
		        err = 'Requested JSON parse failed';
		    } else if (thrownError === 'timeout') {
		        err = 'Time out error';
		    } else if (thrownError === 'abort') {
		        err = 'Ajax request aborted';
		    } else {
		        err = 'Unhandled Error';
		    }
		    return err;
		}
		
		
 