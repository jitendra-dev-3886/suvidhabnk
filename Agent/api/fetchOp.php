<?php

extract($_POST);
$curl = curl_init();

curl_setopt_array($curl, array(
//   CURLOPT_URL => 'http://planapi.in/api/Mobile/OperatorFetchNew?ApiUserID=4545&ApiPassword=Naveen@123&Mobileno='.$mobile,
  CURLOPT_URL => 'http://planapi.in/api/Mobile/OperatorFetchNew?ApiUserID=4309&ApiPassword=suvidhaa@007&Mobileno='.$mobile,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
$data=json_decode($response,true);
$op_code=$data['OpCode'];
$circle_code=$data['CircleCode'];


echo $response;
// echo $mobile;

if(isset($op_code) && isset($pageid) && $pageid=='13' ){

$curl = curl_init();

curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://planapi.in/api/Mobile/RofferCheck?apimember_id=4545&api_password=Naveen@123&mobile_no=$mobile&operator_code=$op_code",
  CURLOPT_URL => "http://planapi.in/api/Mobile/RofferCheck?apimember_id=4309&api_password=suvidhaa@007&mobile_no=$mobile&operator_code=$op_code",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response,true);
$mobile = $data['MOBILENO']; 
$rdata = $data['RDATA'];

echo json_encode(["mobile" => $mobile,
                  "rdata"  => $rdata
]);


}



// Browse  Plan
if(isset($pageid) && $pageid == "14"){
$curl = curl_init();

curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://planapi.in/api/Mobile/Operatorplan?apimember_id=4545&api_password=Naveen@123&cricle=$circle_code&operatorcode=$op_code",
  CURLOPT_URL => "http://planapi.in/api/Mobile/Operatorplan?apimember_id=4309&api_password=suvidhaa@007&cricle=$circle_code&operatorcode=$op_code",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response1 = curl_exec($curl);

curl_close($curl);
echo $response1;

$data1 = json_decode($response1,true);
$operator1 = $data1['Operator']; 
$circle1 = $data1['Circle'];
$dat = $data1['RDATA'];

echo json_encode(["operator1" => $operator1,
                  "circle1"  => $circle1,
                  "dat"  => $dat
]);




}


// dth info
if(isset($_POST['dth_info'])){
    


$curl = curl_init();

$op = $_POST['dthop'];
$ca = $_POST['vcnumber'];

$r_offer = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$op'")->fetch_assoc(); 
$offer_op=$r_offer['roffer'];    

      
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://planapi.in/api/Mobile/DTHINFOCheck?apimember_id=4309&api_password=suvidhaa@007&Opcode=$offer_op&mobile_no=$ca",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
echo $response;
$rstl = json_decode($response, true);


    
}





?>

