<?php
session_start();
require_once('../Db/config.php');

$mobileid = $_POST['mobileid'];

$output = "";



$live = $con->query("SELECT * FROM user WHERE MOBILE LIKE '%{$mobileid}%' OR PARTNER_ID LIKE '%{$mobileid}%'") or die('sql query failed');

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

$output .= "<div id='livefetch' class='form-row d-flex justify-content-around '>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Name</label>
                        <input type='text' class='form-control' value= '{$row['FIRST_NAME']}' name='agent_naame' id='agent_naame' placeholder='' readonly>
                      </div>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Remaning Balance</label>
                        <input type='text' class='form-control'  value ='{$row['MAIN_BAL']}' name='bal' id='bal' placeholder='' readonly>
                    </div>
                </div>
                <div class='form-row d-flex justify-content-around '>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Type</label>
                        <input type='text' class='form-control'  value='{$usertype['NAME']}' name='type' id='type' placeholder='' readonly>
                      </div>
                    <div class='form-group col-md-5'>
                        <label for='exampleInputEmail1'>Agent Owner Name</label>
                        <input type='text' class='form-control'  value='$ownername' name='o_name' id='o_name' placeholder='' readonly>
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
<script>
$(document).ready(function () {
    // var amt,$total_cpn;
    $(function(){
    $("#amt").keyup(function (e){
      
      if($("#amt").val() < 0) {
          alert("Please input minimum 1 rupee");
      }
    }); 
    });
    });
</script>