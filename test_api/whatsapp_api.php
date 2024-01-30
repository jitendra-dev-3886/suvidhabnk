<?php

    //  if (isset($_POST['msg'])  && isset($_POST['reciver']) )
     
    //  {
      
    //   $reciver=$_POST['reciver'];
    //   $msg=$_POST['msg'];
      
      
      
// OTP Send      
     function whatsapp_msg($reciver,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$reciver",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
    //  }  
     }
     
    //  $reciver='919007742088';
    //  $msg='hello hii';
    //  whatsapp_msg($reciver,$msg)
    
    
    
//  New Password Send   
    function New_Passsword_msg($mobile,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$mobile",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
    
    
    
    
//   Login Message  
    function Login_msg($mobile1,$msgg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$mobile1",
                    'message' => "$msgg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
     
     
     
//   Recharge Message Success
     function recharge_msg_success($mobile,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$mobile",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
     
     
     
     
     
//   Recharge Message Failed
     function recharge_msg_failed($mobile,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$mobile",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
    
    
    
    
    
    
    //User Profile password OTP Send      
     function pass_otp_msg($reciver,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$reciver",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
     
     
     
     
     
     
    //User  mPIN OTP Send      
     function mpin_otp_msg($reciver,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$reciver",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
    
     function login_otp_msg($reciver,$msg){ 
      
                $data = [
                    'api_key' => 'qVcD3ghp4MRJVqrXePuD8sVmOv9e8h',
                    'sender' => '919199426249',
                    'number' => "$reciver",
                    'message' => "$msg"
                ];
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://smsbox.co.in/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                // echo $response;
     }
    
?>