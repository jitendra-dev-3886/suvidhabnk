<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	                                                                                                                                                                                                                                                  
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!--<link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">-->
  <!--<link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">-->
  <!--<link href="../assets/vendor/aos/aos.css" rel="stylesheet">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
	    *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    /*overflow: hidden;*/
}

.wave{
	position: fixed;
	bottom: 0;
	left: 0;
	height: 100%;
	z-index: -1;
}

.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.img{
	display: flex;
	justify-content: flex-end;
	align-items: center;
}

.login-content{
	display: flex;
	justify-content: flex-start;
	align-items: center;
	text-align: center;
}

.img img{
	width: 500px;
}

form{
	width: 360px;
}

.login-content img{
    height: 100px;
}

.login-content h2{
	margin: 15px 0;
	color: #333;
	text-transform: uppercase;
	font-size: 2.9rem;
}

.login-content .input-div{
	position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
}

.login-content .input-div.one{
	margin-top: 0;
}

.i{
	color: #d9d9d9;
	display: flex;
	justify-content: center;
	align-items: center;
}

.i i{
	transition: .3s;
}

.input-div > div{
    position: relative;
	height: 45px;
}

.input-div > div > h5{
	position: absolute;
	left: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #999;
	font-size: 18px;
	transition: .3s;
}

.input-div:before, .input-div:after{
	content: '';
	position: absolute;
	bottom: -2px;
	width: 0%;
	height: 2px;
	background-color: #38d39f;
	transition: .4s;
}

.input-div:before{
	right: 50%;
}

.input-div:after{
	left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
	width: 50%;
}

.input-div.focus > div > h5{
	top: -5px;
	font-size: 15px;
}

.input-div.focus > .i > i{
	color: #38d39f;
}

.input-div > div > input{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}

.input-div.pass{
	margin-bottom: 4px;
}

a{
	display: block;
	text-align: right;
	text-decoration: none;
	color: #999;
	font-size: 0.9rem;
	transition: .3s;
}

a:hover{
	color: #38d39f;
}

.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	font-family: 'Poppins', sans-serif;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
}
.btn:hover{
	background-position: right;
}


@media screen and (max-width: 1050px){
	.container{
		grid-gap: 5rem;
	}
}

@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}

	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}

	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 900px){
	.container{
		grid-template-columns: 1fr;
	}

	.img{
		display: none;
	}

	.wave{
		display: none;
	}

	.login-content{
		justify-content: center;
	}
}

#otp_form , #pass_form{
  display:none;
}
	</style>
</head>
<body class="hold-transition login-page" onload="LocateUser()">
         <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>

	<img class="wave" src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/bg.svg">
		</div>
		<div class="login-content">
		   <form method="post" id="check_account" class="formBlock">
			    <input type="hidden" id="long" name="long">
                <input type="hidden" id="lati" name="lati">
				<img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg"><br><br>
				<h3 class="title">Reset Password</h3>
           		
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fa fa-mobile" aria-hidden="true"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Mobile</h5>
           		   		<input type="number" name="mobile" id="mobile2" onkeypress="return this.value.length < 10;" class="input fill" autocomplete="off" maxlength="10">
           		   </div>
           		</div>
                  <button type="submit" name="reset" class="btn btn-primary btn-block">Check Account</button>
            </form>
		   <form method="post" id="otp_form" class="formBlock">
				<h5>OTP has been sent to your mail id</h5>
				<div class="input-div one">
           		   <div class="i">
           		   		<i class="fa fa-mobile" aria-hidden="true"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Enter OTP</h5>
           		   		<input type="number" name="otp" onkeypress="return this.value.length < 10;" class="input fill" autocomplete="off" maxlength="10">
                   		    <input type="hidden" name="verifymobile" id="mobile" >
                            <input type="hidden" name="verify" id="verify" >
                            <input type="hidden" name="user" id="user" >
           		   </div>
           		   
           		</div>
				
                  <button type="submit" name="reset" class="btn btn-primary btn-block">verify Otp</button>
            </form>
		   <form method="post" id="pass_form" class="formBlock">
			    <h5>New Password (Mixture of alphabet numeric and speacial character)</h5>
           		
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fa fa-mobile" aria-hidden="true"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Enter Password</h5>
           		   		<input type="password" name="pass" id="pass" onkeypress="return this.value.length < 10;" class="input fill" autocomplete="off" maxlength="10">
           		   </div>
           		</div>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fa fa-mobile" aria-hidden="true"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Confirm Password</h5>
           		   		<input type="text" name="c_pass" id="c_pass" onkeypress="return this.value.length < 10;" class="input fill" autocomplete="off" maxlength="10">
           		        <input type="hidden" name="verifymobile" id="mobile3" > 
           		   </div>
           		</div>
                  <button type="submit" name="login" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>

  <!-- Vendor JS Files -->
  <script src="assetslogin/vendor/jquery/jquery.min.js"></script>
  <script src="assetslogin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
    <script>
        const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

</script>
  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
   <script>
          $("#check_account").submit(function(e){
            e.preventDefault();
            $("#loading_ajax").show();
            $.ajax({
                url:'handler/reset_password.php',
                type:'post',
                data:new FormData(this),
                processData: false,
                contentType:false,
                success:function(data , staus){
                    $("#loading_ajax").hide();
                    // alert(data);
                    let user_dt = JSON.parse(data);
                    if(user_dt.User_exist == "Yes"){
                        $("#check_account").hide();
                        $("#otp_form").show();
                        $("#mobile").val($("#mobile2").val());
                        $("#password").val($("#password2").val());
                        $("#verify").val(user_dt.otp);
                        $("#user").val(user_dt.User);
                         document.cookie = "verify="+user_dt.otp;
                    }
                    else{
                        alert("Invaild Details.");
                    }
                    // alert(data);
                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                    alert("Some internel server error occuered. We are fixing it.")
                    $("#loading_ajax").hide();
                }
            })
        })
        
        
        $("#otp_form").submit(function(e){
             e.preventDefault();
            let otp = readCookie("verify");
            $("#loading_ajax").show();
                $.ajax({
                    url:'handler/reset_password.php',
                    type:'post',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data , staus){
                        $("#loading_ajax").hide();
                        // alert(data);
                        let redirectTo;
                        let user_dt = JSON.parse(data);
                        if(user_dt.otp == otp){
                                $("#otp_form").hide();
                                $("#pass_form").show();
                                $("#mobile3").val($("#mobile2").val());
                        }else{
                            alert("OTP Not matched");
                        }
                        // console.log(data);
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Some internel server error occuered. We are fixing it.")
                        $("#loading_ajax").hide();
                    }
                })
        })
        
        
        
        
        $("#pass_form").submit(function(e){
             e.preventDefault();
             let pas = $("#pass").val();
             let c_pas = $("#c_pass").val();
                if(pas === c_pas){
                $("#loading_ajax").show();
                    $.ajax({
                        url:'handler/reset_password.php',
                        type:'post',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data , staus){
                            $("#loading_ajax").hide();
                            let user_dt = JSON.parse(data);
                             if(user_dt.User_exist == "Yes"){
                                    location.replace("Login");
                                    alert("You password reset successfully. Please login")
                            }else{
                                alert("User not found.. Unauthorized entry");
                            }
                            // console.log(data);
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown){
                            alert("Some internel server error occuered. We are fixing it.")
                            $("#loading_ajax").hide();
                        }
                    })
                }
                else{
                    alert("Password not matched");
                }
        })
        
        
             function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
    </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

