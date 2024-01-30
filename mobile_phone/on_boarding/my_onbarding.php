<?php

//     include("../includes/config.php");
    
//     $time = date("Y-m-d g:i:s A");


//         $mobile = $_POST['mobile'];
//         $owner = $_POST['owner'];
//         $owner_id = $_POST['owner_id'];
//         $partner_id = $_POST['partner_id'];
//         $merchant_code = $_POST['merchant_code'];
            
            
//         $mysql_qry = "select * FROM aeps_merchant WHERE MOBILE ='$mobile'";
//         $result = mysqli_query($con ,$mysql_qry);
//         if(mysqli_num_rows($result) > 0) {
            
//             $sql = "UPDATE aeps_merchant SET STATUS='Active' WHERE MOBILE='$mobile'";
//             $check = mysqli_query($con, $sql);
            
//             if($check){
//                     echo "Data Updated";
//                 }
//             else{
                
//                  echo "Data Failed to update";
//             }
            
            
//         }
//         else{
            
            
            
//             $ref_no = generateRandomString(5);
//                 $trans_id = generateRandomString(8);
            
//             $query = "INSERT INTO `aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`, `IS_ICICI_KYC`, `TIMESTAMP`, `OWNER`, `OWNER_ID`)
//             VALUES ('$ref_no','$trans_id','Active','$mobile','$partner_id','$merchant_code','YES','$time','$owner','$owner_id')";
//             $run_query = mysqli_query($con , $query);
            
//             if($run_query){
                        
//                     echo "inserted";
//                 }
//             else{
                
//                  echo "Failed to insert";
//             }
            
            
            
//         }
        
        
// function generateRandomString($length) {
//     $characters = '0123456789';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
        


?>