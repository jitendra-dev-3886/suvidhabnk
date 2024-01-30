<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.kumare-digitalnetwork.com/KEDAPI/RechargeAPI.aspx?MobileNo=9911611346&APIKey=Zpj9qewxvcpv1ujtouJ4pAnQI2eMujZzW2O&REQTYPE=RECH&REFNO=SK42654265&SERCODE=RJ&CUSTNO=6289195314&REFMOBILENO=&AMT=10&STV=0&RESPTYPE=JSON',
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
echo $response;

