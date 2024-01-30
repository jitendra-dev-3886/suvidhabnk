<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;
  

  $sql = "SELECT * FROM vehicle_registration WHERE date(REQUEST_DATE) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID </th>
                    <th>Vehicle Owner</th>
                    <th>Insurance Type</th>
                    <th>Vehicle Number</th>
                    <th>Whatsapp Mobile No.</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
        $usdt = $con->query("select * from user where ID='".$row['USER_ID']."' ")->fetch_assoc();
        if(strtolower($row['USER_ID']) == "admin"){
            $prtnerid = "ADMIN";
        }
        else{
            $prtnerid = $usdt['PARTNER_ID'];
        }
        
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$prtnerid}</td>
                    <td>{$row['VEHICLE_OWNER']}</td>
                    <td>{$row['INSURANCE_TYPE']}</td>
                    <td>{$row['VEHICLE_NUMBER']}</td>
                    <td>{$row['WHATSAPP_NUMBER']}</td>
                    <td>{$row['REQUEST_DATE']}</td>
                    <td>";
                    
                    if($row["STATUS"] == 'Pending'){
                    $userdata .= "<span id='resbtn'><input type='button' class='btn-primary' data-uid='{$row['ID']}' id='approvbtn' value='Approve' data-toggle='modal' data-target='#insurancemodal'/><input type='button' id='rejectbtn' data-uid='{$row['ID']}' class='btn-danger' value='Reject'/></span>";
                    }else{
                         $userdata .= "<span id='resbtn'>{$row['STATUS']}</span>";
                    }
                   $userdata .= "</td>
                    <td><span class='badge badge-info right' style='cursor:pointer;' id='mbtn' data-mid='{$row['ID']}'  data-toggle='modal' data-target='#insurance_details' data-dismiss='modal'>View Details</span></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
               
               
    echo $userdata;
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

 $vid = $_POST["vid"];
$userdata = "";
  
  $inusrance_modal = $con->query("SELECT * FROM vehicle_registration WHERE ID = '$vid'")->fetch_assoc();

$vehicle_details = json_decode($inusrance_modal["RESPONSE_DATA"],true);


  $userdata .= "<ul class='list-group'>
  <li class='list-group-item'>Vehicle Name : ".$vehicle_details["result"]["model"]."</li>
  <li class='list-group-item'>Owner Name : ".$vehicle_details["result"]["owner"]."</li>
  <li class='list-group-item'>Owner FatherName : ".$vehicle_details["result"]["ownerFatherName"]."</li>
  <li class='list-group-item'>Owner Count : ".$vehicle_details["result"]["ownerCount"]."</li>
  <li class='list-group-item'>Mobile Number : ".$vehicle_details["result"]["mobileNumber"]."</li>
  <li class='list-group-item'>Number : ".$vehicle_details["result"]["regNo"]."</li>
  <li class='list-group-item'>Class : ".$vehicle_details["result"]["class"]."</li>
  <li class='list-group-item'>Engine : ".$vehicle_details["result"]["engine"]."</li>
  <li class='list-group-item'>Chassis Number : ".$vehicle_details["result"]["chassis"]."</li>
  <li class='list-group-item'>Manufacturer Name : ".$vehicle_details["result"]["vehicleManufacturerName"]."</li>
  <li class='list-group-item'>Vehicle Colour : ".$vehicle_details["result"]["vehicleColour"]."</li>
  <li class='list-group-item'>Vehicle Category : ".$vehicle_details["result"]["vehicleCategory"]."</li>
  <li class='list-group-item'>Norms Type : ".$vehicle_details["result"]["normsType"]."</li>
  <li class='list-group-item'>Body Type : ".$vehicle_details["result"]["bodyType"]."</li>
  <li class='list-group-item'>StatusAsOn : ".$vehicle_details["result"]["statusAsOn"]."</li>
  <li class='list-group-item'>Rc StandardCap : ".$vehicle_details["result"]["rcStandardCap"]."</li>
  <li class='list-group-item'>Vehicle Cylinders No : ".$vehicle_details["result"]["vehicleCylindersNo"]."</li>
  <li class='list-group-item'>Vehicle Seat Capacity : ".$vehicle_details["result"]["vehicleSeatCapacity"]."</li>
  <li class='list-group-item'>Vehicle Sleeper Capacity : ".$vehicle_details["result"]["vehicleSleeperCapacity"]."</li>
  <li class='list-group-item'>Vehicle Standing Capacity : ".$vehicle_details["result"]["vehicleStandingCapacity"]."</li>
  <li class='list-group-item'>Wheel base : ".$vehicle_details["result"]["wheelbase"]."</li>
  <li class='list-group-item'>Pucc Number : ".$vehicle_details["result"]["puccNumber"]."</li>
  <li class='list-group-item'>Pucc Upto : ".$vehicle_details["result"]["puccUpto"]."</li>
  <li class='list-group-item'>Blacklist Status : ".$vehicle_details["result"]["blacklistStatus"]."</li>
  <li class='list-group-item'>Permit IssueDate : ".$vehicle_details["result"]["permitIssueDate"]."</li>
  <li class='list-group-item'>Permit Number : ".$vehicle_details["result"]["permitNumber"]."</li>
  <li class='list-group-item'>Permit Type : ".$vehicle_details["result"]["permitType"]."</li>
  <li class='list-group-item'>Permit Valid From : ".$vehicle_details["result"]["permitValidFrom"]."</li>
  <li class='list-group-item'>Permit Valid Upto : ".$vehicle_details["result"]["permitValidUpto"]."</li>
  <li class='list-group-item'>National Permit Number : ".$vehicle_details["result"]["nationalPermitNumber"]."</li>
  <li class='list-group-item'>National Permi tUpto : ".$vehicle_details["result"]["nationalPermitUpto"]."</li>
  <li class='list-group-item'>National Permit IssuedBy : ".$vehicle_details["result"]["nationalPermitIssuedBy"]."</li>
  <li class='list-group-item'>is Commercial : ".$vehicle_details["result"]["isCommercial"]."</li>
  <li class='list-group-item'>nocDetails : ".$vehicle_details["result"]["nocDetails"]."</li>
  <li class='list-group-item'>Type : ".$vehicle_details["result"]["type"]."</li>
  <li class='list-group-item'>Reg. Authority : ".$vehicle_details["result"]["regAuthority"]."</li>
  <li class='list-group-item'>Reg. Date : ".$vehicle_details["result"]["regDate"]."</li>
  <li class='list-group-item'>Vehicle Manufacturing MonthYear : ".$vehicle_details["result"]["vehicleManufacturingMonthYear"]."</li>
  <li class='list-group-item'>Rc ExpiryDate : ".$vehicle_details["result"]["rcExpiryDate"]."</li>
  <li class='list-group-item'>vehicle TaxUpto : ".$vehicle_details["result"]["vehicleTaxUpto"]."</li>
  <li class='list-group-item'>Vehicle Insurance CompanyName : ".$vehicle_details["result"]["vehicleInsuranceCompanyName"]."</li>
  <li class='list-group-item'>vehicle Insurance Upto : ".$vehicle_details["result"]["vehicleInsuranceUpto"]."</li>
  <li class='list-group-item'>Rc Financer : ".$vehicle_details["result"]["rcFinancer"]."</li>
  <li class='list-group-item'>Vehicle Cubic Capacity : ".$vehicle_details["result"]["vehicleCubicCapacity"]."</li>
  <li class='list-group-item'>Gross Vehicle Weight : ".$vehicle_details["result"]["grossVehicleWeight"]."</li>
  <li class='list-group-item'>Unladen Capacity : ".$vehicle_details["result"]["unladenWeight"]."</li>
  <li class='list-group-item'>Vehicle Cubic Capacity : ".$vehicle_details["result"]["vehicleCubicCapacity"]."</li>
  <li class='list-group-item'>Address : ".$vehicle_details["result"]["presentAddress"]."</li>
  <li class='list-group-item'>Address Line : ".$vehicle_details["result"]["splitPresentAddress"]["addressLine"]."</li>
  <li class='list-group-item'>District : ".$vehicle_details["result"]["splitPresentAddress"]["district"][0]."</li>
  <li class='list-group-item'>State : ".$vehicle_details["result"]["splitPresentAddress"]["state"][0][0]."</li>
  <li class='list-group-item'>City : ".$vehicle_details["result"]["splitPresentAddress"]["city"][0]."</li>
  <li class='list-group-item'>Pincode : ".$vehicle_details["result"]["splitPresentAddress"]["pincode"]."</li>
  <li class='list-group-item'>Country : ".$vehicle_details["result"]["splitPresentAddress"]["country"][2]."</li>
  
</ul>";
               
    echo $userdata;
}    

if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
      
             $status =$_POST['status'];
             $userid =$_POST['uid'];
             $today_action = date("Y-m-d h:i:s A"); 
             
              $vhdt = $con->query("SELECT * FROM vehicle_registration WHERE ID='$userid' ")->fetch_assoc();
          if(strtolower($vhdt['STATUS']) == "rejected" || strtolower($vhdt['STATUS']) == $status){
              echo 2;
              exit;
          }
             $query2 = $con->query("UPDATE `vehicle_registration` SET `STATUS`='$status' ,`FILTER_DATE`='$today_action' WHERE ID='$userid'");
             if($query2){
                   $cuser = $con->query("SELECT * FROM `user` WHERE ID = '".$vhdt['USER_ID']."'")->fetch_assoc();
                   
                    $charge = $con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Insurance'")->fetch_assoc();
                    $chargeamt = $charge["CHARGE"];
                    
                    $after_amt = $cuser["MAIN_BAL"]+$chargeamt;
                    $con->query("UPDATE user SET MAIN_BAL='$after_amt' WHERE ID = '".$vhdt['USER_ID']."'");
                    
                  insert_allreport($vhdt['USER_ID']  ,$vhdt['VEHICLE_NUMBER'] , "INSURANCE REFUND" , $cuser["MAIN_BAL"]  , $after_amt , $chargeamt , "Credit" , "INSURANCE REFUND Transaction", "MAIN");
                  echo 1;
             }else{
                  echo 0;
              }
              
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 4){

     
             $userid =$_POST['insid'];
             $rtcomm =$_POST['rt_comm'];
             $dtcomm =$_POST['dt_comm'];
             $remark =$_POST['remark'];
             $status ="Approved";
             $image2 = $_FILES['insdoc'];
             $insdoc = $image2['name'];
             $img_tmp2 = $image2['tmp_name'];
             $today_action = date("Y-m-d h:i:s A"); 
             $dist = "../assets/Insurance_document/".$insdoc;
    
             $txn = $con->query("select * from vehicle_registration where ID='$userid'")->fetch_assoc();
             
             $query = $con->query("UPDATE `vehicle_registration` SET `INSURANCE_DOC`='$insdoc',`RT_COMM`='$rtcomm',`DT_COMM`='$dtcomm', REMARK='$remark',`STATUS`='$status',`FILTER_DATE`='$today_action' WHERE ID='$userid'");
             if($query){
              move_uploaded_file($img_tmp2,$dist);
              
             $usdt = $con->query("select * from user where ID='".$txn['USER_ID']."' ")->fetch_assoc();
             $usupdtbal = $usdt['MAIN_BAL'] + $rtcomm;
             $con->query("update user set MAIN_BAL='$usupdtbal' where ID='".$txn['USER_ID']."'");
              insert_allreport($txn['USER_ID']  , "INSRNCE".$userid , "Insurence Approved" , $usdt['MAIN_BAL']  , $usupdtbal , $rtcomm , "Credit" , "Vehicle Insurence Transaction", "MAIN");
                 $ds_id = $usdt['OWNER_ID'];
                 
                $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
             $usupdtbal = $ds_data['AEPS_BAL'] + $dtcomm;
             $con->query("update user set AEPS_BAL='$usupdtbal' where ID='$ds_id'");
              insert_allreport($ds_id  , "INSRNCE".$userid , "Insurence Approved" ,  $ds_data['AEPS_BAL']  , $usupdtbal , $dtcomm , "Credit" , "Vehicle Insurence Transaction", "AEPS");
              echo 1;
             }else{
                  echo 0;
              }
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){

 $i = 1;
$fromdate = $_POST['formdate'];
$todate = $_POST['todate'];

  $sql = "
SELECT * FROM vehicle_registration WHERE date(REQUEST_DATE) BETWEEN '{$fromdate}' AND '{$todate}'
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Vehicle Owner</th>
                    <th>Insurance Type</th>
                    <th>Vehicle Number</th>
                    <th>Whatsapp Mobile No.</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['VEHICLE_OWNER']}</td>
                    <td>{$row['INSURANCE_TYPE']}</td>
                    <td>{$row['VEHICLE_NUMBER']}</td>
                    <td>{$row['WHATSAPP_NUMBER']}</td>
                    <td>{$row['REQUEST_DATE']}</td>
                    <td>";
                    if($row["STATUS"] == 'Pending'){
                    $userdata .= "<span id='resbtn'><input type='button' class='btn-primary' data-uid='{$row['ID']}' id='approvbtn' value='Approve' data-toggle='modal' data-target='#insurancemodal'/><input type='button' id='rejectbtn' data-uid='{$row['ID']}' class='btn-danger' value='Reject'/></span>";
                    }else{
                         $userdata .= "<span id='resbtn'>{$row['STATUS']}</span>";
                    }
                   $userdata .= "</td>
                    <td><span class='badge badge-info right' style='cursor:pointer;' id='mbtn' data-mid='{$row['ID']}'  data-toggle='modal' data-target='#insurance_details' data-dismiss='modal'>View Details</span></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
               
               
    echo $userdata;
}


  ?>