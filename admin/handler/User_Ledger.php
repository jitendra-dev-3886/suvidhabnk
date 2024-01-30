<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

  
  $sql = "SELECT * FROM `user` where US_STATUS='Active' ORDER BY `ID` DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
                        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
                    }else{
                         $ownername = "Admin";
                    }
                  
                  
                  $user_type=$row['USER_TYPE'];
                  if($user_type==46){
                      $user_ttype="Retailer";
                  }else if($user_type==47){
                      $user_ttype="Distributor";
                  }else if($user_type==48){
                      $user_ttype="Master Distributor";
                  }else{
                      $user_ttype="None";
                  }
                  
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$user_ttype</td>
                    <td>
                       <a href='ParticularUserLedger?mid={$row['ID']}' target='_blank' class='btn btn-success showledger'>Show Full Ledger</a>
                    </td>
                 </tr>";
                        // <input type='button' data-mid={$row['ID']} class='btn btn-success showledger' value='Show Full Ledger'>
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }

    
?>