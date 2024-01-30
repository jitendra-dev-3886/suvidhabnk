<?php
   function SendMessage($mobile, $message){
            $curl = curl_init();
                global $con;
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A"); 
          $s_api = $con->query("select * from smsApi where STATUS='Activate'")->fetch_assoc();
          $s_url = $s_api['APIURL'];
          $s_snder = $s_api['SENDERNAME'];
          $s_apikey = $s_api['APIKEY'];
          
        // $live_url = "http://sms.afgoparrot.com/app/smsapi/mobile-recharge.php?key=2606C3C0920662&campaign=12625&routeid=101011&type=text&contacts=$mobile&senderid=TESTIN&msg=$message";
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, $live_url);
            
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            
            // curl_exec() executes the started curl session
            // $output contains the output string
            $output = curl_exec($curl);
            // echo $output;
            if($output == FALSE){
                die('Failed'.curl_error($curl));
            }
            $outputObj = json_decode($output, true);
            // print_r($outputObj);
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
            curl_close($curl);
                    // print_r($data);
          }
          
function SendMail($email,$message , $subject){
    // Mailid from email will send
    $headers = 'From: do-not-reply@suvidhabnk.com' . "\r\n" .
      'Reply-To: do-not-reply@suvidhabnk.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
    
    // Send the email
    if(mail($email, $subject, $message, $headers)) {
        // echo "work";
      return true;
    }
    else {
        return false;
    }
}
// SendMail("samratssce@gmail.com","Hi Haider","hohohoho");

function filterThis($value){
        global $con;
        $filterVal = trim($value);
        $filterVal = strip_tags($filterVal);
        $filterVal = mysqli_real_escape_string($con , $filterVal);
        $filterVal = substr($filterVal  , 0 , 15);
        return $filterVal;
}

?>