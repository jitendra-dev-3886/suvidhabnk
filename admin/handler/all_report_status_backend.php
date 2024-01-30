<?php
session_start();
include("../../Db/config.php");
include("../../Agent/Backend/Userinfo/getuserinfo.php");
include("../../Agent/Backend/Functions/main_function.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
    $refid=$_POST['refid'];
    $tra_type=$_POST['tra_type'];
    
    if($refid!==''){
        if($tra_type=='Recharge'){
    
    
    $sql = "SELECT * FROM `recharge_transaction` WHERE `REFERENCE_ID`='$refid'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <div id='edit_data'>
            <form>
            <div class='form-group'>
            <input type='hidden' id='update_ref_id' value='$refid'>
                    <lable>Status:</lable>
                    <input type='text' name='firstname' id='upate_firstname' class='form-control' value='{$row['STATUS']}'>
            </div>
           <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='button' class='btn btn-primary' data-dismiss='modal'  id='update' value='Update'>
        </div>
          
 </form>
 </div>";
mysqli_close($con);
 echo $output;
        }
    }else{
        echo "No Record Found";
    // }
 
 }
        }

}else{
    echo "Reference ID is Blank";
}
}


if(isset($_POST['pageidd']) && $_POST['pageidd'] == 10){
    $refid=$_POST['refid'];
    $tra_type=$_POST['tra_type'];
    $tra_amount=$_POST['edit_amount'];
    $refrence =  "EKEN".date("Ymd").mt_rand(999 , 9999);
    
    // echo $refid;
    // echo $tra_type;
     if($refid!==''){
        if($tra_type=='Recharge'){
            
            $update_recharge_transaction=$con->query("UPDATE `recharge_transaction` SET `STATUS`='Failed,Request Failed' WHERE `REFERENCE_ID`='$refid'");
            if($update_recharge_transaction){
                echo 1;
                
                $fetch_report_query=$con->query("SELECT * FROM `report` WHERE `REFERENCE_ID`='$refid'")->fetch_assoc();
                $user_id=$fetch_report_query['USER_ID'];
                // echo $user_id;
                $user_fetch_query=$con->query("SELECT * FROM `user` WHERE `ID`='$user_id'")->fetch_assoc();
                $user_previous_main_bal=$user_fetch_query['MAIN_BAL'];
                $user_transaction_amount=$tra_amount;
                $user_after_main_bal=$user_previous_main_bal+$user_transaction_amount;
                $user_update=$con->query("UPDATE `user` SET `MAIN_BAL`='$user_after_main_bal' WHERE `ID`='$user_id'");
                $ref=$refrence;
                $opening=$user_previous_main_bal;
                $closing=$user_after_main_bal;
                $amount=$user_transaction_amount;
                
                insert_allreport($user_id  ,$ref , "Recharge Refund" , $opening  , $closing , $amount , "Credit" , "Refund Failed Txn Amount");

                // echo $user_main_bal;
                
                
                
                
                
                
                
                
            }else{
                echo 0;
            }
            
        }
        
        
     }else{
    echo "Reference ID is Blank";
}
    
    
    
}

?>