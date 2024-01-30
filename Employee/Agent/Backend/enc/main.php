<?php

// gen_cert("server");

function gen_cert($userid)
            {
                $dn = array("countryName" => 'XX', "stateOrProvinceName" => 'State', "localityName" => 'SomewhereCity', "organizationName" =>'MySelf', "organizationalUnitName" => 'Whatever', "commonName" => 'mySelf', "emailAddress" => 'user@example.com');
                //Passphrase can be taken during registration
                //Here its initialized to 1234 for sample               
                $privkeypass = 'root';
                $numberofdays = 365;
                //RSA encryption and 1024 bits length
                $privkey = openssl_pkey_new(array('private_key_bits' => 1024,'private_key_type' => OPENSSL_KEYTYPE_RSA));
                $csr = openssl_csr_new($dn, $privkey);
                $sscert = openssl_csr_sign($csr, null, $privkey, $numberofdays);
                openssl_x509_export($sscert, $publickey);
                openssl_pkey_export($privkey, $privatekey, $privkeypass);
                openssl_csr_export($csr, $csrStr);
                //Generated keys are stored into files
                $fp=fopen("$userid.key","w");
                fwrite($fp,$privatekey);
                fclose($fp);
                $fp=fopen("$userid.crt","w");
                fwrite($fp,$publickey);
                fclose($fp);       
            }
            
            
// echo encrypt("Manish","");
            //Encryption with public key
            function encrypt($source,$rc="")
            {
                //path holds the certificate path present in the system               
                $path="server.crt";
                $fp=fopen($path,"r");
                $pub_key=fread($fp,8192);
                fclose($fp);
                openssl_get_publickey($pub_key);
            //$source='';
                //$source="sumanth ahoiadodakjaksdsa;ldadkkllksdalkalsdl;asld;ls sumanthasddddddddddddddddddddddddddddddddfsdfsffdfsdfsumanth";
                $j=0;
                $x=strlen($source)/10;
                $y=floor($x);
                for($i=0;$i<$y;$i++)
                {
                $crypttext='';
               
                openssl_public_encrypt(substr($source,$j,10),$crypttext,$pub_key);$j=$j+10;
                $crt.=$crypttext;
                $crt.=":::";
                }
                if((strlen($source)%10)>0)
                {
                openssl_public_encrypt(substr($source,$j),$crypttext,$pub_key);
                $crt.=$crypttext;
                }   
                return(base64_encode($crt));
               
            }

// $enc = encrypt("Manish","");
// echo $enc;
// echo "\n";
// echo "\n";
// echo "\n";
// echo "\n";
// echo decrypt(base64_decode($enc) ,"server");

            //Decryption with private key
            function decrypt($crypttext,$userid)
            {
                $passphrase="root";
                $path="server.key";
                $fpp1=fopen($path,"r");
                $priv_key=fread($fpp1,8192);
                fclose($fpp1);
                $res1= openssl_get_privatekey($priv_key,$passphrase);
                $tt=explode(":::",$crypttext);
                $cnt=count($tt);
                $i=0;
                while($i<$cnt)
                {
                openssl_private_decrypt($tt[$i],$str1,$res1);
                $str.=$str1;
                $i++;
                }
                return $str;     
        }
        
        
        
        
        
        
        
echo json_encode([
  "Virtual Account Number Verification IN" => [
      "Client Code"=>encrypt("ABCD"),
      "Virtual Account Number"=>encrypt("ABCD99999999"),
      "Transaction Amount"=>encrypt("100000.00"),
      "Mode"=>encrypt("N"),
      "UTR"=>encrypt("AXIS211301165012"),
      "Remitter Name"=>encrypt("ABCD Limted"),
      "Remitter Account Number"=>encrypt("123456789"),
      "Sender IFSC"=>encrypt("AXIS0000012"),
      "STRI"=>encrypt("AAAAAA"),
      "Date"=>encrypt("12/03/2019)")
      ]
  ]);