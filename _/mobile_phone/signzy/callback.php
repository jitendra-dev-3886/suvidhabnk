<?php
    include("../includes/configuration.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if($json!="" || $json!=null){

        $token = $data[token];
        $otp = $data[otp];
        $video = $data[video];
        // $matchImageFaceMatch-> json_encode($data[matchImageFaceMatch]);
    
    
    /*{"videoFaceMatch":[{"videoImages":["https://persist.signzy.tech/api/files/294584433/download/0bd77444f6b8471d9c025491ed1fa758a9b346bb8d2f48a0b26f4b5d5d8c7bbe.jpg","https://persist.signzy.tech/api/files/294584431/download/fe8f883736064cacbc51a58766f34868f8fb14790a334e5981024945659af42b.jpg","https://persist.signzy.tech/api/files/294584425/download/9f75074aec964b098fa1531e03d657cf434ab92e490d474f8276fcbf6ef6c6e5.jpg"],"matchStatistics":{"matchPercentage":"98.0%","coVariance":"0.00%"},"finalMatchImage":"https://paydeer.app/mobile_phone/signzy/videoVerification/First.png"},{"videoImages":["https://persist.signzy.tech/api/files/294584435/download/b931186c09b9440d97f5cf7d0dcbf2bedf0fe59872484e39b7dc369151e930f7.jpg","https://persist.signzy.tech/api/files/294584427/download/1e80a894e74047dcbd31843c729ea6d2352375ed209b49e7b5b22702871bb53c.jpg","https://persist.signzy.tech/api/files/294584429/download/f98be55b9953484bb7fccbae4e72c672d5f67cd60a934ee8919229ce01c67ca1.jpg"],"matchStatistics":{"matchPercentage":"98.0%","coVariance":"0.00%"},"finalMatchImage":"https://paydeer.app/mobile_phone/signzy/videoVerification/Second.png"}],"audioMatch":{"matchAudioScore":"67%"},"matchImageFaceMatch":{"verified":true,"message":"Verification completed with positive result","matchPercentage":"100.00%","maskDetections":[]},"videoForensics":{"staticRisk":"false","prerecordedRisk":"false","videoLandMarks":"","faceLandMarks":["https://persist.signzy.tech/api/files/294584457/download/054c5badb8324f6c8f932188617ffe88c24a11ecc05948889aacc1c8972ae945.png","https://persist.signzy.tech/api/files/294584463/download/4a71e319c38d4433acb7673373ec29975aea8f4a27ba4831b3f05cf06c218d68.png"],"liveliness":""},"otp":"684179","video":"https://preproduction-persist.signzy.tech/api/files/34655235/download/d644e02103164fed8741d5a0a5077b57ae25c12798974008b00627d738fe676d.mp4","faceFound":"yes","isAudioProcessed":"true","isVideoProcessed":"true","token":"pmqShruI30sFLcha3mHq"}
    
    */
    
        
        $insert_report = "INSERT INTO `test_callbacks`(`RESPONSE`, `TOKEN`, `OTP`, `VIDEO`, `RESULT`, `MOBILE`) VALUES ('$json','$token','$otp','$video','$matchImageFaceMatch','')";
            $con->query($insert_report);
    }


?>