<?php
session_start();
include("../Db/config.php");
include("Backend/Userinfo/getuserinfo.php");
include("Backend/Functions/all_function.php"); // for create token
include("Backend/Auth/userdata.php");
$status = "PAN";


$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

   if(isset($_POST['apply_agent']))
   {
     $name = $_POST['name'];
     $address = $_POST['address'];
     $pin = $_POST['pincode'];
     $state = $_POST['state'];
     $phone = $_POST['phone'];
     $phone1 = $_POST['phone1'];
     $email = $_POST['email'];
     $pan = $_POST['pan'];
     $dob = date("d-m-Y", strtotime($_POST['dob']));
     $adhaar = $_POST['adhaar'];
     $us_id = $user['ID'];
    $vleid = substr($name , 0 , 3).$phone;
   $txn_id = mt_rand(9999 , 1000000);
            
            $arr = array(
                        'api_key' => '25eaef-e595a5-fe91ab-3130dc-e7df8d',
                        'vle_id' => $vleid,
                        'vle_name' => $name,
                        'vle_mob' => $phone,
                        'vle_email' =>$email,
                        'vle_shop' => 'RECHPAY INFOTECH',
                        'vle_loc' =>$address,
                        'vle_state' => 32,
                        'vle_pin' => $pin,
                        'vle_uid' => $adhaar,
                        'vle_pan' =>$pan
                        );
                        
                                        
            // $data_string = json_encode($arr , true);
            foreach($arr as $pair=>$val){
                $data .= "$pair"."=".urlencode($val)."&";
            }
 
            $ur = 'api_key=25eaef-e595a5-fe91ab-3130dc-e7df8d&vle_id='.$vleid.'&vle_name='.$name.'&vle_mob='.$phone.'&vle_email='.$email.'&vle_shop=RECHPAY INFOTECH&vle_loc='.$address.'&vle_state=32&vle_pin='.$pin.'&vle_uid='.$adhaar.'&vle_pan='.$pan;
            
            $url = "https://ekendra.co.in/api/add_vle.php?".urlencode($ur);
            $ch = curl_init($url);
            $header = array('Content-Type:application/json');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            
            
            
            //response of request 
            $result = curl_exec($ch);
            //close curl
            curl_close($ch);
            $result_arr =  json_decode($result , true);
           
                $status = $result_arr['status'];
                $msg = $result_arr['message'];
                $ps_id = $result_arr['vle_id'];
                $vlstatus = $result_arr['vle_status'];
                
                if($ps_id != "" && strtolower($status) == "success"){
                
                echo json_encode(['status'=>true, 'response_code'=>1, "message"=>$status]);
                    
                $con->query("INSERT INTO `pan_agent`(`NAME`, `ADDRESS`, `PINCODE`, `STATE`, `PHONE`, `PHONE1`, `EMAIL`, `PAN`, `DOB`, `ADHAAR` , `REQ_ID` , `PSA_ID` ,`CREATEDBY` , 
                `STATUS` , `MSG` ,`US_TYPE` , `US_ID`) VALUES ('$name','$address','$pin','$state','$phone','$phone1','$email','$pan','$dob','$adhaar' ,
                '$rqst_id' ,'$ps_id','$created_by' , '$vlstatus' , '$msg', '46' , '$usid')");
                }
                else{
                    echo json_encode(['status'=>false, 'response_code'=>32, "message"=>$status]);
                }
  }


if(isset($_POST['update_agent'])){
    
   $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and STATUS<>''");
    if($res->num_rows == 0){
        echo json_encode(["status"=>false ,"message"=>"Pan id not found for check status please apply pan first", "response_code"=>232]);
        exit();
    }
    $pandt = $res->fetch_assoc();
       $url =  "https://ekendra.co.in/api/vle_status.php?api_key=25eaef-e595a5-fe91ab-3130dc-e7df8d&vle_id=".$pandt['PSA_ID'];
     
            $ch = curl_init($url);
            $header = array('Content-Type:application/json');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
           $result_arr =  json_decode($result , true);
           
                $status = $result_arr['status'];
                $msg = $result_arr['message'];
                $ps_id = $result_arr['vle_id'];
                $vlstatus = $result_arr['vle_status'];
        
                
                if($ps_id != "" && strtolower($status) != ""){
                    echo json_encode(['status'=>true, 'response_code'=>1, "message"=>$vlstatus]);
                    $con->query("update pan_agent set STATUS='$vlstatus' , MSG='$msg'  where ID='".$pandt['ID']."'");
                }
                else{
                    echo json_encode(['status'=>false, 'response_code'=>32, "message"=>$vlstatus]);
                }
                
}


if(isset($_POST['coupenpurchase'])){
    $type = strip_tags($_POST['coupentype']);
    $num = strip_tags($_POST['coupennum']);
    if($num >= 1){
       
      $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and PSA_ID<>''");
      if($res->num_rows != 0){
          $data = $res->fetch_assoc();
          $req_id = $data['PSA_ID'];
          
          $ds_id = $user['OWNER_ID'];
            $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
            $ms_id = $ds_data['OWNER_ID'];
            $ms_data =  $con->query("select * from user where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
            
            //fetch balance of all
            $ds_main_bal = $ds_data['MAIN_BAL'];
            $ms_main_bal = $ms_data['MAIN_BAL'];
        
        
          $panch = $con->query("SELECT * FROM `pan_charge` where ID=1")->fetch_assoc();
          if($type == "1"){
              $pr = $num*$panch['E_PAN'];
              $dpr = $num*$panch['DS_COM'];
              $mpr = $num*$panch['MS_COM'];
          }
          else{
              $pr = $num*$panch['P_PAN'];
              $dpr = $num*$panch['DS_COM'];
              $mpr = $num*$panch['MS_COM'];
          }
          $user_bal = $user['MAIN_BAL']-$pr;
          $dsuser_bal = $ds_main_bal+$dpr;
          $msuser_bal = $ms_main_bal+$mpr;
          
        if($user_bal >= 0){
          $odid = substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNMASDFGHJKLqwQWERTYUIOPrewrctfgyuhtrdfghjiogtvuybhyvbDERTFUGYDEXCBYDRSDXertyuiopasdfghjklzxcvbnm") , 0 ,8);
          $url = "https://ekendra.co.in/api/coupon_req.php?api_key=25eaef-e595a5-fe91ab-3130dc-e7df8d&vle_id=$req_id&qty=$num&type=$type";
        //   echo $url;
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
            curl_setopt($ch, CURLOPT_URL, $url);   
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);   
            $response = curl_exec($ch);   

            $rslt =  json_decode($response , true);
            // $rslt['status']  = "success";
            if($rslt['status'] != ""){
                $con->query("INSERT INTO `pan_coupen`(`USID`, `TYPE`, `NUM`, `PSA_ID`, `OD_ID`, `RESPONSE`  , `STATUS`) VALUES ('$usid','$type','$num','$req_id','".$rslt['order_id']."','$response' , '".$rslt['status']."')");
            }
            
            if(strtolower($rslt['status']) == "success"){
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$usid' ");
                   insert_allreport($usid  ,$req_id , "PAN COUPEN CHARGE" , $user['MAIN_BAL']  , $user_bal ,$pr , "Debit" , "PAN COUPEN CHARGE");
               
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$ds_id' ");
                   insert_allreport($ds_id  ,$req_id , "PAN COUPEN COMMISSION" , $ds_data['MAIN_BAL']  , $dsuser_bal ,$dpr , "Credit" , "PAN COUPEN COMMISSION");
               
                $con->query("update user set MAIN_BAL='$user_bal' where ID='$ms_id' ");
                   insert_allreport($ms_id  ,$req_id , "PAN COUPEN COMMISSION" , $ms_data['MAIN_BAL']  , $msuser_bal ,$mpr , "Credit" , "PAN COUPEN COMMISSION");
               
            }
                  echo $response;
            }
            else{
              echo json_encode(["status"=>false , "message"=>"You have no balance to purchase enough coupen. ", "response_code"=>200]);
              exit();
            }
      }
      else{
          echo json_encode(["status"=>false ,"message"=>"Your account not found for use pan service . ", "response_code"=>200]);
          exit();
      }
    }
    else{
          echo json_encode(["status"=>false ,"message"=>"Enter coupen graeter or equal than 1. ", "response_code"=>200]);
          exit();
    }
            
}



if(isset($_POST['updatestatus'])){
 $odid = $_POST['id'];   
     $res = $con->query("SELECT * FROM `pan_agent` WHERE US_TYPE='46' and US_ID='$usid' and PSA_ID<>''");
      if($res->num_rows != 0){
          
          $data = $res->fetch_assoc();
          $req_id = $data['PSA_ID'];
          
           $url = "https://ekendra.co.in/api/coupon_status?api_key=2022052512004761NJDBV186EYCSQ3DGM6LDZCX&vle_id=$req_id&order_id=$odid";
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
            curl_setopt($ch, CURLOPT_URL, $url);   
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);   
            $response = curl_exec($ch);   

            $rslt =  json_decode($response , true);
            if($rslt['status'] != ""){
                echo json_encode(["status"=>true ,"message"=>$rslt['status'], "response_code"=>1]);
                $con->query("update `pan_coupen` set `STATUS` ='".$rslt['status']."' , CHECK_RESPONSE='$response'   where OD_ID='$odid' ");
            }
            else{
                echo json_encode(["status"=>false ,"message"=>$rslt['status'], "response_code"=>200]);
                exit();
            }
            
      }
      else{
          echo json_encode(["status"=>false ,"message"=>"Your account not found for use pan service . ", "response_code"=>200]);
          exit();
      }
      
}
?>

            