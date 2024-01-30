<?php
    include("../../includes/configuration.php");
    
    if(isset($_POST['us_mobile']) && isset($_POST['us_token'])){
        $us_token = $_POST['us_token'];
        $us_email = $_POST['us_email'];
        $us_mobile = $_POST['us_mobile'];
        $partnerid = "PDRT".substr($us_mobile,0,5);
        
        sleep(20);
        
        $rows = $con->query("SELECT * FROM `test_callbacks` WHERE TOKEN='$us_token' ORDER BY ID DESC")->num_rows;
        if($rows < 1){
            echo json_encode(["message"=>"Video Kyc Failed", "response_code"=>9, "status"=>false, "receivableData"=>null]);
            exit;
        }
        else{
            $videoData = $con->query("SELECT * FROM `test_callbacks` WHERE TOKEN='$us_token' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
            $response = json_decode($videoData['RESPONSE']);
            
            $videoFaceMatch = $response->videoFaceMatch;
            $percentageF = $videoFaceMatch[0]->matchStatistics->matchPercentage;
            //$percentageS = $videoFaceMatch[1]->matchStatistics->matchPercentage;
            
            $prF = (int)clean($percentageF);
            // $prS = (int)clean($percentageS);
            if($prF>75){
            
            $query = "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`,
            `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `DMT_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, 
            `LOGIN_AUTH`, `SUBSCRIPTION`) VALUES ('Admin','1','','46', '$partnerid','ADMIN','','$fname','$lname','$us_mobile','$us_email','0','0',
            '','','','','','','','','','Deactive','$password','1','1','-1')";
            
                
            $sql = "UPDATE `test_callbacks` SET MOBILE='$us_mobile' WHERE TOKEN='$us_token'";
            if(mysqli_query($con, $sql) &&  mysqli_query($con , $query)){
            
                echo json_encode(["message"=>"$percentageF matched", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
                exit;
            }
            else{
                echo json_encode(["message"=>"Some Internal Error, Contact Admin.", "response_code"=>200, "status"=>false, "receivableData"=>null]);
                exit;
            }
            
                
            }
            else{
                echo json_encode(["message"=>"Reupload Images and Verify Again, The Face didn't match perfectly.", "response_code"=>9, "status"=>false, "receivableData"=>null]);
                exit;
            }

        }
        
        
    }
    
function clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('%', '', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[A-Za-z]/', '', $string); // Removes special chars.
}


function checkingXX(){
    /*
    
    {"videoFaceMatch":[{"videoImages":["https://persist.signzy.tech/api/files/294902629/download/e6b9acd532bf450fabedafab186fe10d35fde13652cc4740b1331ffbb2112471.jpg","https://persist.signzy.tech/api/files/294902625/download/8cef4fa9a0174af0969ab10c8c057a08fade6e14b2924e2aa79d305b95556386.jpg","https://persist.signzy.tech/api/files/294902631/download/6bfc59e896ba477b842e64ebbe8fc06ae94d35b0be6742d0bc6a3833e7c72643.jpg"],"matchStatistics":{"matchPercentage":"0.0%","coVariance":"0.00%"},"finalMatchImage":"https://paydeer.app/mobile_phone/signzy/videoVerification/Second.png"},{"videoImages":["https://persist.signzy.tech/api/files/294902635/download/6f16c66e948e4dbf9f08f946744a05885518b946e7934206a54f05f91cce17f4.jpg","https://persist.signzy.tech/api/files/294902633/download/1048ea4f9f8c4fc8b0c1a4c1fb59b7fa9fa6062782324ae696fd30b6c9aecffb.jpg","https://persist.signzy.tech/api/files/294902627/download/bb9c9abd8bcb4d8587263bd434bb2dbd42e30ed49bc0419abb31be8627cd3047.jpg"],"matchStatistics":{"matchPercentage":"0.0%","coVariance":"0.00%"},"finalMatchImage":"https://paydeer.app/mobile_phone/signzy/videoVerification/First.png"}],"audioMatch":{"matchAudioScore":"0%"},"matchImageFaceMatch":{"verified":true,"message":"Verification completed with positive result","matchPercentage":"100.00%","maskDetections":[]},"videoForensics":{"staticRisk":"false","prerecordedRisk":"true","videoLandMarks":"","faceLandMarks":["https://persist.signzy.tech/api/files/294902641/download/242bc027a2034a01b7e0c5408e1b1c00f7622746c7864ac897537dfb84aa6bac.png","https://persist.signzy.tech/api/files/294902643/download/155554ae935946f2ad46f727fce69b44039d6ccc5817494ab4280e56171f4999.png"],"liveliness":""},"otp":"204659","video":"https://preproduction-persist.signzy.tech/api/files/34657735/download/7482bd634b8b49eeb2674c6c32d90af9e8b56382fb584a7193a2dc28143b3d36.mp4","faceFound":"yes","isAudioProcessed":"true","isVideoProcessed":"true","token":"HGEYkax2pK6FkRWfP99O"}
    
    
    */
}

    
?>