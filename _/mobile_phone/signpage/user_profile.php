<?php

    include("../includes/config.php");
    include("../includes/imagepaths.php");
    
    $mobile= $_POST['mobile'];
    $password = $_POST['password'];
    

        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_array($result);
            $id = $row['ID'];
            $myRow = $con->query("SELECT * FROM `user_profile` WHERE USER_ID='$id'")->fetch_assoc(); 
            
            $pp = $myRow["PROFILE_IMG"];
            $detailResponse = array(
                "status" =>true,
                "message" =>"Details Fetched",
                "data"=>[
                "PROFILE_IMG"=>$myRow["PROFILE_IMG"],
                "MAIN_OWNER"=>$myRow["MAIN_OWNER"],
                "MAIN_OWNER_ID"=>$myRow["MAIN_OWNER_ID"],
                "OWNER_ID"=>$myRow["OWNER_ID"],
                "USER_ID"=>$myRow["USER_ID"],
                "ALTERNATE_PHONE_NO"=>$myRow["ALTERNATE_PHONE_NO"],
                "DOB"=>$myRow["DOB"],
                "GENDER"=>$myRow["GENDER"],
                "COUNTRY"=>$myRow["COUNTRY"],
                "STATE"=>$myRow["STATE"],
                "FACEBOOK_URL"=>$myRow["FACEBOOK_URL"],
                "TWITTER_URL"=>$myRow["TWITTER_URL"],
                "LINKEDIN_URL"=>$myRow["LINKEDIN_URL"],
                "INSTAGRAM_URL"=>$myRow["INSTAGRAM_URL"],
                "DRIBBLE_BOX_URL"=>$myRow["DRIBBLE_BOX_URL"],
                "DROPBOX_URL"=>$myRow["DROPBOX_URL"],
                "GOOGLE_PLUS_URL"=>$myRow["GOOGLE_PLUS_URL"],
                "PINTEREST_URL"=>$myRow["PINTEREST_URL"],
                "SKYPE_URL"=>$myRow["SKYPE_URL"],
                "VINE_URL"=>$myRow["VINE_URL"],
                "AADHAR_CARD_NO"=>$myRow["AADHAR_CARD_NO"],
                "PAN_CARD_NO"=>$myRow["PAN_CARD_NO"],
                "BANK"=>$myRow["BANK"],
                "B_NAME"=>$myRow["B_NAME"],
                "AC_HOLDER_NAME"=>$myRow["AC_HOLDER_NAME"],
                "AC_NUM"=>$myRow["AC_NUM"],
                "IFSC_CODE"=>$myRow["IFSC_CODE"],
                "PASSBOOK"=>$myRow["PASSBOOK"],
                "DATE"=>$myRow["DATE"]
                ]
                );

           echo json_encode($detailResponse);
        }
        else{ 
                $detailResponse = array(
                "status" =>false,
                "message" =>"Details fetching Failed",
                "data"=>[
                "PROFILE_IMG"=>$myRow["PROFILE_IMG"],
                "MAIN_OWNER"=>$myRow["MAIN_OWNER"],
                "MAIN_OWNER_ID"=>$myRow["MAIN_OWNER_ID"],
                "OWNER_ID"=>$myRow["OWNER_ID"],
                "USER_ID"=>$myRow["USER_ID"],
                "ALTERNATE_PHONE_NO"=>$myRow["ALTERNATE_PHONE_NO"],
                "DOB"=>$myRow["DOB"],
                "GENDER"=>$myRow["GENDER"],
                "COUNTRY"=>$myRow["COUNTRY"],
                "STATE"=>$myRow["STATE"],
                "FACEBOOK_URL"=>$myRow["FACEBOOK_URL"],
                "TWITTER_URL"=>$myRow["TWITTER_URL"],
                "LINKEDIN_URL"=>$myRow["LINKEDIN_URL"],
                "INSTAGRAM_URL"=>$myRow["INSTAGRAM_URL"],
                "DRIBBLE_BOX_URL"=>$myRow["DRIBBLE_BOX_URL"],
                "DROPBOX_URL"=>$myRow["DROPBOX_URL"],
                "GOOGLE_PLUS_URL"=>$myRow["GOOGLE_PLUS_URL"],
                "PINTEREST_URL"=>$myRow["PINTEREST_URL"],
                "SKYPE_URL"=>$myRow["SKYPE_URL"],
                "VINE_URL"=>$myRow["VINE_URL"],
                "AADHAR_CARD_NO"=>$myRow["AADHAR_CARD_NO"],
                "PAN_CARD_NO"=>$myRow["PAN_CARD_NO"],
                "BANK"=>$myRow["BANK"],
                "B_NAME"=>$myRow["B_NAME"],
                "AC_HOLDER_NAME"=>$myRow["AC_HOLDER_NAME"],
                "AC_NUM"=>$myRow["AC_NUM"],
                "IFSC_CODE"=>$myRow["IFSC_CODE"],
                "PASSBOOK"=>$myRow["PASSBOOK"],
                "DATE"=>$myRow["DATE"]
                ]
                );

            echo json_encode($detailResponse);
        }
        

?>
