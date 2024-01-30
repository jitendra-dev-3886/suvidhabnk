<?php
include('smtp/PHPMailerAutoload.php');
$html='Msg';
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = 'mail.suvidhabnk.com';
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "do-not-reply@suvidhabnk.com";
	$mail->Password = "RZC#taTl*,dz";
	$mail->SetFrom("do-not-reply@suvidhabnk.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
  //		echo $mail->ErrorInfo;
	}else{
 //		return 'Sent';
// echo 'Sent';
	}
}

//print_r(smtp_mailer("yasofaf612@in2reach.com","Test", "Password Change"));

?>