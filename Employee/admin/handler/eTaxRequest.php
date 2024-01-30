<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
$EtaxType = $_POST['type'];
$formd = $_POST["formdate"];
$tod = $_POST["todate"];
$i = 1;
$sql = "SELECT * FROM `etax` WHERE TYPE='$EtaxType' AND (STATUS = 'Pending' OR STATUS = 'Under Process') AND (date(DATE) BETWEEN '$formd' AND '$tod') ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Member Id</th>
                    <th>NAME</th>
                    <th>Mobile</th>
                    <th>Refrence Id</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $transid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id' ORDER BY ID DESC")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user_Data['PARTNER_ID']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['DATE']}</td>
                    <td>";
                    if($row["STATUS"] == 'Pending' || $row["STATUS"] == 'Under Process'){

                    $userdata .= "<span id='resbtn'><input type='button' id='update_ticket' data-toggle='modal' data-mid='{$transid}' data-status='{$row['STATUS']}' data-target='#myModal' class='btn-danger e-tax' value='Update'/></span>";
                    }else{
                         $userdata .= "<span id='resbtn'>{$row['STATUS']}</span>";   
                    }
                   $userdata .= "</td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}


if(isset($_POST['update_hid']) && $_POST['update_hid'] == 2){      
             $row_id =$_POST['id'];
             $status =$_POST['status'];
             $remark =$_POST['remark'];
             $today_action = date("Y-m-d h:i:s A"); 
             
             $pandt = $con->query("select * from etax where ID='$row_id'")->fetch_assoc();
             $fetchamt = $con->query("SELECT * FROM etax_commission WHERE SERVICE = '{$pandt["TYPE"]}'")->fetch_assoc();
             $charge_amount = $fetchamt["CHARGE"];
                 
              if($pandt['STATUS'] == "Success" || $pandt['STATUS'] == "Failed"){
                    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"Status is already updated ." ));
                    exit;
                 }
                 
             $query2 = $con->query("UPDATE `etax` SET `STATUS`='$status',`REMARK`='$remark',`ACTION_DATE`='$today_action' WHERE ID='$row_id'");
             
            if($query2){
         if($status == "Failed"){
             $usdt = $con->query("select * from user where ID='{$pandt["USER_ID"]}' ")->fetch_assoc();
             $usupdtbal = $usdt['MAIN_BAL'] + $charge_amount;
             $updatbal = $con->query("update user set MAIN_BAL='$usupdtbal' where ID='{$pandt["USER_ID"]}'");
             if($updatbal){
              insert_allreport($pandt['USER_ID']  ,$pandt['REFERENCE_ID'] , $pandt['TYPE']." Refund" , $usdt['MAIN_BAL']  , $usupdtbal , $charge_amount , "Credit" , $pandt['TYPE']." Refund Transaction", "MAIN");
             echo json_encode(array("status"=>true ,"response_code"=>  1 , "message"=>"Updated Successfully ." ));
             }
          exit;
         }
         else if ($status == "Success"){
           $comm = $con->query("SELECT * FROM `etax_commission` WHERE SERVICE='{$pandt["TYPE"]}'")->fetch_assoc();
            $rtcom = $comm['RT_COMM'];
            $dtcom = $comm['DT_COMM'];
             $user = $con->query("select * from user where ID='{$pandt["USER_ID"]}' and USER_TYPE='46'")->fetch_assoc();
            $ds_id = $user['OWNER_ID'];
            $ds_data =  $con->query("select * from user where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
            
                $us_main_bal = $user['MAIN_BAL'];
                $ds_main_bal = $ds_data['MAIN_BAL'];
                
                $update_bal = $us_main_bal+$rtcom;
                $ds_update_bal = $ds_main_bal+$dtcom;
                
                
            $con->query("update user set MAIN_BAL='$update_bal' where ID='{$pandt["USER_ID"]}'");
           
            insert_allreport($pandt['USER_ID']  ,$pandt['REFERENCE_ID'] , $pandt['TYPE']." Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , $pandt['TYPE']." Transaction Commission" , "MAIN");
            
            $con->query("update user set MAIN_BAL='$ds_update_bal' where ID='$ds_id' ");
            
            insert_allreport($ds_id  ,$pandt['REFERENCE_ID'] , $pandt['TYPE']." Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , $pandt['TYPE']." Transaction Commission" , "MAIN");
            
        echo json_encode(array("status"=>true ,"response_code"=>  1 , "message"=>"Updated Successfully ." ));
      exit;
         }else{
             
        echo json_encode(array("status"=>true ,"response_code"=>  1 , "message"=>"Updated Successfully ." ));
         }
      exit;
     }else{
        echo json_encode(array("status"=>false ,"response_code"=>  500 , "message"=>"Server Error ." ));
      exit;
      }
              
}


?>