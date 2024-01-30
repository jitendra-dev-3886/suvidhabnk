<?php
session_start();
include("include/Auth.php");
require_once('../Db/config.php');

$mobileid = $_POST['mobileid'];

$output = "";



$live = $con->query("SELECT * FROM user WHERE OWNER_ID = '$usid' AND MOBILE LIKE '%{$mobileid}%' OR PARTNER_ID LIKE '%{$mobileid}%'") or die('sql query failed');

if($live->num_rows > 0){
    
    $row = $live->fetch_assoc();
    
      $oid = $row["OWNER_ID"];
    $utype = $row["USER_TYPE"];
    
   
    
$usertype = $con->query("SELECT * FROM user_type WHERE ID = '$utype' ")->fetch_assoc();
$userowner = $con->query("SELECT * FROM user WHERE ID = '$oid' ")->fetch_assoc();

if($userowner != ""){
        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
    }else{
         $ownername = "Admin";
    }

$output .= "<div class='form-row d-flex justify-content-around '>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Name</label>
                        <input type='text' class='form-control' value= '{$row['FIRST_NAME']}' name='agent_naame' id='agent_naame' placeholder=''>
                      </div>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Remaning Balance</label>
                        <input type='text' class='form-control'  value ='{$row['AEPS_BAL']}' name='bal' id='bal' placeholder=''>
                    </div>
                </div>
                <div class='form-row d-flex justify-content-around '>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Type</label>
                        <input type='text' class='form-control'  value='{$usertype['NAME']}' name='type' id='type' placeholder=''>
                      </div>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Owner Name</label>
                        <input type='text' class='form-control'  value='$ownername' name='o_name' id='o_name' placeholder=''>
                    </div>
                </div>
                
                
                <div class='form-row d-flex justify-content-around'>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Amount</label>
                        <input type='number' class='form-control' name='amt' id='amt' placeholder=''>
                    </div>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Remark</label>
                        <input type='text' class='form-control'  name='remark' id='remark' placeholder=''>
                    </div>
                </div>
            </div>";
    
}else{
    $output .= "<h2 class='text-white'>Data Not Find</h2>";
}

if($mobileid == ''){
    $output .= "";
}
            
echo $output;
            

























?>