<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

$i = 1;
$sql = "SELECT * FROM `pan_transaction` WHERE STATUS='Pending' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Member Id</th>
                    <th>Member Mobile</th>
                    <th>NumberOfCoupon</th>
                    <th>Amount</th>
                    <th>RT COMM</th>
                    <th>DT COMM</th>
                    <th>Status</th>
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
                    <td>{$user_Data['MOBILE']}</td>
                    <td>{$row['NUMBER_OF_COUPON']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['RT_COMM']}</td>
                    <td>{$row['DT_COMM']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td>";
                    if($row["STATUS"] == 'Requested' || $row["STATUS"] == 'Pending'){

                    $userdata .= "<span id='resbtn'><input type='button' id='update_ticket' data-toggle='modal' data-mid='{$transid}' data-status='{$row['STATUS']}' data-target='#myModal' class='btn-danger update' value='Update'/></span>";
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


if($_POST['update_hid']==3){      
     $row_id =$_POST['id'];
     $status =$_POST['status'];
     $status =$_POST['status'];
     $remarks =$_POST['remarks'];
     $pandt = $con->query("select * from pan_transaction where ID='$row_id'")->fetch_assoc();
     $noofcoupon = $pandt["NUMBER_OF_COUPON"];
     
     if($pandt['STATUS'] == "Success" || $pandt['STATUS'] == "Failed"){
        echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"Status is already updated ." ));
        exit;
     }
    //   echo "UPDATE `pan_transaction` SET `STATUS`='$status' WHERE ID='$user_id'"; die();
     $query2 = $con->query("UPDATE `pan_transaction` SET `STATUS`='$status', `REMARK`='$remarks' WHERE ID='$row_id'");
     if($query2){
         if($status == "Failed"){
             $usdt = $con->query("select * from user where ID='".$pandt['USER_ID']."' ")->fetch_assoc();
             $usupdtbal = $usdt['MAIN_BAL'] + $pandt['AMOUNT'];
             $con->query("update user set MAIN_BAL='$usupdtbal' where ID='".$pandt['USER_ID']."'");
              insert_allreport($pandt['USER_ID']  ,$pandt['TRANSACTION_ID'] , "Pan Refund" , $usdt['MAIN_BAL']  , $usupdtbal , $pandt['AMOUNT'] , "Credit" , "Pan Refund Transaction", "MAIN");
         }
         else if ($status == "Success"){
           $comm =$con->query("SELECT * FROM `pan_coupon` WHERE ID='1'")->fetch_assoc();
            $rtcom = $comm['RT_COMM']*$noofcoupon;
            $dtcom = $comm['DT_COMM']*$noofcoupon;
             $user = $con->query("select * from user  where ID='".$pandt['USER_ID']."' and USER_TYPE='46'")->fetch_assoc();
            $ds_id = $user['OWNER_ID'];
            $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
            
                $us_main_bal = $user['MAIN_BAL'];
                $ds_main_bal = $ds_data['AEPS_BAL'];
                
                $update_bal = $us_main_bal+$rtcom;
                $ds_update_bal = $ds_main_bal+$dtcom;
                
                
            $con->query("update pan_transaction set RT_COMM='$rtcom',DT_COMM='$dtcom' where ID='$row_id'");
            $con->query("update user set MAIN_BAL='$update_bal'  where ID='".$pandt['USER_ID']."' ");
           
            insert_allreport($pandt['USER_ID']  ,$pandt['TRANSACTION_ID'] , "Pan Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , "PAN Transaction Commission" , "MAIN");
            
            $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
            
            insert_allreport($ds_id  ,$pandt['TRANSACTION_ID'] , "Pan Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , "PAN Transaction Commission" , "AEPS");
            
         }
        echo json_encode(array("status"=>true ,"response_code"=>  1 , "message"=>"Updated Successfully ." ));
      exit;
     }else{
        echo json_encode(array("status"=>false ,"response_code"=>  500 , "message"=>"Server Error ." ));
      exit;
      }
              
}


?>