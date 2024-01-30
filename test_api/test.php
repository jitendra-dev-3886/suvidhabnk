<?php
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
                echo $response;
     }
     
    //  $reciver='919330576214';
    //  $msg='hello Rinka Pol';
    //  whatsapp_msg($reciver,$msg)
?>