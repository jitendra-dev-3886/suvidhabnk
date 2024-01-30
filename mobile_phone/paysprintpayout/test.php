<?php

    $path = '../../Dashboard/User/assets/images/payoutVerify/';

    //passbook
    $dataPB = base64_decode("dsnjdhfkjashjkfbaskjbfjas");
    $imageName = "_passbook_samar.jpeg";
    $insertion = $path.$imageName;
    file_put_contents("$insertion" ,$dataPB);

?>