<?php
session_start();
include("../../Db/config.php");

// include('function.php');
if(isset($_POST['pageid']) && $_POST['pageid'] == "fund_rt"){
    $utype= $_POST['user_type'];
         $ress = $con->query("SELECT * FROM user WHERE USER_TYPE='$utype'");
         
         $output = "";
        if($ress->num_rows > 0){
            
            while($seleted_user = $ress->fetch_assoc()){
                       $output .= "<option value='{$seleted_user['ID']}'>{$seleted_user['FIRST_NAME']} {$seleted_user['LAST_NAME']} ( Mobile : {$seleted_user['MOBILE']} )</option>";

            }
            
}
echo $output;
}

        


?>