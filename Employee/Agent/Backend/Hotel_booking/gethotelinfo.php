<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
// include("../Auth/userdata.php");


if(isset($_POST["type"]) && $_POST["type"] == "hotelsearch"){
    
    
    
    
    
    $data = '{
  "CheckInDate": "23/06/2022",
  "NoOfNights": "1",
  "CountryCode": "IN",
  "CityId": "130443",
  "IsTBOMapped": "true",
  "ResultCount": 0,
  "PreferredCurrency": "INR",
  "GuestNationality": "IN",
  "NoOfRooms": 2,
  "MaxRating": 5,
  "MinRating": 1,
  "ReviewScore": 0,
  "IsNearBySearchAllowed": false,
  "EndUserIp": "192.168.10.159",
  "TokenId": "1053e0d3-2e28-4a28-ae63-7a2fa8aa1ef8",
  "RoomGuests": [
    {
      "NoOfAdults": 1,
      "NoOfChild": 0,
      "ChildAge": [
        
      ]
    },
    {
      "NoOfAdults": 1,
      "NoOfChild": 0,
      "ChildAge": [
        
      ]
    }
    
  ]
}';
    
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelResult/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
     'Accept-Encoding: gzip, deflate',  
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
    
}

?>