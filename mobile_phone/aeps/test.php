<?php
session_start();

include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");

    $base_url = "https://api.paysprint.in";
    $finger = $_POST['fingerData'];
    
// echo "work<br>";
    // $str = '{"latitude":"22.8019062","longitude":"88.3448094","mobilenumber":"8240193509","referenceno":"sNAVe0DS","ipaddress":"157.40.210.19","adhaarnumber":"737187166174",
    // "accessmodetype":"APP","nationalbankidentification":"607153","requestremarks":"Balance Enquiry","pipe":"bank1","timestamp":"2021-09-15 21:19:48","transactiontype":"BE",
    // "submerchantid":"CTC74","is_iris":false}';
    // echo "<pre>";
    // print_r($ara2);
    // $finger = '<PidData>
    //           <Data type="X">MjAyMS0wOS0xNVQyMjowMTo0NNhXCW86YhoY/ncMxChKO8w9i0Apv7bt+fyoeOB8J1SJKaxVcCjJkG4UcAsCEnvoMSao3mae4jkU/JyTzrJ753hI+ir57z4mww09+IJ21zdoOBZLmIUD3DhXm4q8qC5tf1Bg6MzqFhWAFjxgzv3mewb9PHFDm0367MrOzzSrVdYpBCGWysCJfBNzlaxMm9X+/aUU6lRhwx49epBE54uKSD4MOlNERPmWqc/cXGsgRIVIc9yhzBBwzhI/CPj61OUlNeW93dDfdd3dpCCR2lDDMB4yzV1L5yLogWdo/Mintq96d5uopRfGIaCVvE/y55mNteZIbUsaXzinPi3LFc5riGMGSJY3u1JryHdjKrM/3JA0wg6YsOlEOgTwMMMbOSDSgUqDs3ipnldHQPQ6J0nkioZ97bk/IDoYbNBIMZkSideCjaOqQeRL4lLn63GgreKHpDStV0QdsbQh8EAfi4V9W9FMjPLLVa7BWY4AuBBbb1yBPTmw4lGBb2rHPTFOHaJRi9ec4yodlwmPefRo2eYvQ34Z8LqYBOsz2HHtYW38gv3+8Y5flkbEubFHRF6HHzoJ0wkiSw0ag75+Zhnmp1i7iscIdDym6+9b+4hTTZHDinNjZ34q3sBzA/VNuY58ot+kgFqQrv6ADN0Xf+w/24ciW490HES5Qx+fmSka/C7NMJJn/yARt4T5/LWhzhxkCYMvK5/rMYAXugfSZwpER3aqAMY6keFwrTYgucdu1cm4RMFPCIKb51OiWnHy0N4tcxDIh9lGUCmRk4y1NiSKERqCNTD/sLWwbP2pxRb1kXlcWoof28skmtCYXOj1xtMne69i37t0sJS8f5Xvh/AKgRSXeaclfuT7Kw/cRE7TL25GHuBRFWCj1OjKfjMro9BtqmJ8tSyxYRZ+77nJLlNIcRcLgkIgufnhxImDFqFPZJ9h7HRQpv6RdKrOw8txdAGmtNbVp2/cuLj+h/H5L/MCWswZMQ7m7xPYRwWEVqpi5MiTrST+PlxVgWuD858pW0tdQKw2LnuI7uapuI3Mfta1ftRWKisooMIOltSR6ATUlNKMvDGiLjaWw2b9H6SZ1l3+fj93dkd5G5VhncCwjSDIIyelT8n1rKFUeEWE6qsgD9phEsLURsxzlMcQqib4ntufdxMacfKlqaOseXPQAe0+ENrsguY9sTGdSXAbG4/iPF7Yl5xmuJiuUnjqgxy5U1lAwuHGfdAeG/BniYKl7BisNEQnAantmXApxAqauWgO03EZ20a2Pn1zOcQ75HrpXoIVAdiIjQqN5tTKFxsfaHrgapt8LBDzEAIZ4avRpvk7mPJsn5sAqgBFMygxBh7YUfX6jgmW0hnWlMyLMOQ3mMdrfPw=</Data>
    //           <DeviceInfo dc="1ae4c830-3674-46bc-abb4-1c3f73630f39" dpId="MANTRA.MSIPL" mc="MIIEGjCCAwKgAwIBAgIGAXvo51agMA0GCSqGSIb3DQEBCwUAMIHqMSowKAYDVQQDEyFEUyBNYW50cmEgU29mdGVjaCBJbmRpYSBQdnQgTHRkIDcxQzBBBgNVBDMTOkIgMjAzIFNoYXBhdGggSGV4YSBvcHBvc2l0ZSBHdWphcmF0IEhpZ2ggQ291cnQgUyBHIEhpZ2h3YXkxEjAQBgNVBAkTCUFobWVkYWJhZDEQMA4GA1UECBMHR3VqYXJhdDEdMBsGA1UECxMUVGVjaG5pY2FsIERlcGFydG1lbnQxJTAjBgNVBAoTHE1hbnRyYSBTb2Z0ZWNoIEluZGlhIFB2dCBMdGQxCzAJBgNVBAYTAklOMB4XDTIxMDkxNTA5NDYyMloXDTIxMTAxNTEwMDExOVowgbAxJDAiBgkqhkiG9w0BCQEWFXN1cHBvcnRAbWFudHJhdGVjLmNvbTELMAkGA1UEBhMCSU4xEDAOBgNVBAgTB0dVSkFSQVQxEjAQBgNVBAcTCUFITUVEQUJBRDEOMAwGA1UEChMFTVNJUEwxHjAcBgNVBAsTFUJpb21ldHJpYyBNYW51ZmFjdHVyZTElMCMGA1UEAxMcTWFudHJhIFNvZnRlY2ggSW5kaWEgUHZ0IEx0ZDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANwoSWFRum5a7pah/NSVXSdCo7PMwVWCz76Dd49CHBGAIJr5x0ZekZ1ATNiy14x5TIOZchLCIHNIrBZchGXghRcj5fhGesN6feBlIphGH5uSmRNLKDpiyTT2VajNISFVcJtpja01GfCS2QpUHoM46myhFY/J6OCcVqAxOVt6rxqCcJTbG28UH38KfdzgQ4fVst329aZHRppCGLjMknyZwHYqfEXbjX+KsziXDZhOdlEd/1Z1B/Pb+I5LdWbO/XUwmgeI+LOlHhP49ctC6uSYGSaz85qbNrOC9CCc97NLShZMjYdGAWqV5fBo7asDpm/AVkgz+DVRiz274VYLXeYyg90CAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAWxnbNzdMx82LAsJpVMGPqxR91skPcukscRGgZ7+Bn1fCA2qQT4l+t5Pk9X2Fj/GHQVlev2cOMn0V6UohhJTpFRX0x39+mnv9xzwx1q0Qx3BtsjKqfPfWjqzFvupCp0gvDaRhFZQi1RQVPS5yoVnxKPnCaPYMKH9gYU+VdxCm5iFuLxwEoYV4I81FIcGmzx4WbAcYr5vlqIVFuNrxGJzz3y+VrtvsPV1wg/s8TKo27o+Y8/LVPF37QCoNmxTz+mpan2jkYvqK4r08dH+twEhLcEa9woBIYIuKpaDxDzyNg76XcQ6eXAvYIuJ3dzTX+k1jr9roUGpyULSanUIfJCV+UA==" mi="MFS100" rdsId="MANTRA.AND.001" rdsVer="1.0.4">
    //               <additional_info>
    //                  <Param name="srno" value="4600928"/>
    //                  <Param name="sysid" value="680ce708b7f97392"/>
    //                  <Param name="ts" value="2021-09-15T22:01:46+05:30"/>
    //               </additional_info>
    //           </DeviceInfo>
    //           <Hmac>hv+5fmAjuGHp8wdDXcIYoTpWWRwprFFLllMNrYXq64PqIOmzHUj4peHRuAureYEX</Hmac>
    //           <Resp errCode="0" errInfo="Capture Success" fCount="1" fType="0" iCount="0" iType="0" nmPoints="57" pCount="0" pType="0" qScore="82"/>
    //           <Skey ci="20221021">G7mqDGo6JkwROABswVyoa1Xd/GQ1t1wexB9Lp0a1RMRDL+SJf+psqmTmaWsmlhF9mYApT7PPssYCuKyL1Z1zHIMnqS3dSIxht6x3U9nU3V8704FpeEIfHR0amhEdh+1jxh2C4ReN0nnrSEUGYdmdRX5a5aHT+LDPCY6SbObbKGgUB3B75Vfvfh/kHW6ByDRMwFwI+xUNfxETowKFOPrUplYeZ8jFRHHyXX2wZ+qbLn5mXgSve6+ycpb9VpA/vl7e8qy13kF+ozK+NjOO4ZnzFPEkTVyx1LjLF2Q2SI4jn6qi4NEC9d7xVNru3zA/vm5IFQBqLk+hpn11XqFQZng1cw==</Skey>
    //         </PidData>';

    $arr = array(
            "latitude"=>"22.8019062",
            "longitude"=>"88.3448094",
            "mobilenumber"=>"8240193509",
            "referenceno"=>"sNAfaVe0DSpppesp",
            "ipaddress"=> "103.248.60.68",
            "adhaarnumber"=>737187166174,
            "accessmodetype"=>"APP",
            "nationalbankidentification"=>"607153",
            "requestremarks"=>"Balance Enquiry",
            "data"=>"$finger",
            "pipe"=>"bank1",
            "timestamp"=>"2021-09-17 21:19:48",
            "transactiontype"=>"BE",
            "submerchantid"=>"HRC100",
            "is_iris" => false,
            );
            
            
    // print_r(json_decode($str));
    //  $data_tkn = encryptaeps($arr);
     
          $data_tkn = encrypt($arr);
            $sendData = array(
                "body"=>$data_tkn,
                );
            $main_body = json_encode($sendData , true);
            $token = create_token();
            // echo $data_tkn;
            // exit;
            // echo $token;
    
    
               $curl = curl_init();
                curl_setopt_array($curl, [
                  CURLOPT_URL => "$base_url/api/v1/service/aeps/balanceenquiry/index",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => $main_body,
                  CURLOPT_HTTPHEADER => [
                     "Content-Type: application/json",
                    // "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                    "Token:".$token
                    ],
                ]);
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                echo json_decode($response);
                curl_close($curl);
    
                
?>