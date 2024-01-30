<?php
include("Agent/Backend/PAYOUT/paysprint/payout_function.php");
echo getbank();
    $jsn_data = json_decode(getbank() , true);
    // print_r($jsn_data);
    $banklist = $jsn_data['banklist'];
    $bank_data = $banklist['data'];
    foreach($bank_data as $bank){
        echo '<option value="'.$bank['bankName'].'">'.$bank['bankName'].'</option>';
    }

?>