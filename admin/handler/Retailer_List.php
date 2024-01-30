<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

//Recharge report code here........
    /*  error_reporting(E_ALL);
  ini_set("display_errors",1); */
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
        
        $i = 1;
    
 $sql = "SELECT * FROM user WHERE USER_TYPE = '46' AND US_STATUS='Active' ORDER BY ID DESC";
//  echo $sql;

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Partner ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Owner Name</th>
                        <th>Joining Date</th>
                        
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  $owner_id=$row['OWNER_ID'];
                  if($owner_id=='Admin' || $owner_id=='admin' || $owner_id=='ADMIN'){
                      $owner_name = "$owner_id";
                  }else{
                  
                  $user_query=$con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                  $owner_name=$user_query['FIRST_NAME']." ".$user_query['LAST_NAME']." (".$user_query['MOBILE'].")";
                  }
            
                   
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$owner_name</td>
                    <td>{$row['DATE']}</td>
                   
            
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
        
        $i = 1;
    
 $sql = "SELECT * FROM user WHERE USER_TYPE = '47' AND US_STATUS='Active' ORDER BY ID DESC";
//  echo $sql;

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Partner ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Owner Name</th>
                        <th>Joining Date</th>
                        
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                $owner_id=$row['OWNER_ID'];
                  if($owner_id=='Admin' || $owner_id=='admin' || $owner_id=='ADMIN'){
                      $owner_name = "$owner_id";
                  }else{
                  
                  $user_query=$con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                  $owner_name=$user_query['FIRST_NAME']." ".$user_query['LAST_NAME']." (".$user_query['MOBILE'].")";
                  }
            
                   
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$owner_name</td>
                    <td>{$row['DATE']}</td>
                   
            
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
        
        $i = 1;
    
 $sql = "SELECT * FROM user WHERE USER_TYPE = '48' AND US_STATUS='Active' ORDER BY ID DESC";
//  echo $sql;

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Partner ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Owner Name</th>
                        <th>Joining Date</th>
                        
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  $owner_id=$row['OWNER_ID'];
                  if($owner_id=='Admin' || $owner_id=='admin' || $owner_id=='ADMIN'){
                      $owner_name = "$owner_id";
                  }else{
                  
                  $user_query=$con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                  $owner_name=$user_query['FIRST_NAME']." ".$user_query['LAST_NAME']." (".$user_query['MOBILE'].")";
                  }
                   
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$owner_name</td>
                    <td>{$row['DATE']}</td>
                   
            
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
        
        $i = 1;
    
 $sql = "select distinct USER_ID from login_history where USER_ID<>'' and LOGIN_DATE='".date("Y-m-d")."'";
 

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Partner ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Owner Name</th>
                        <th>Joining Date</th>
                        
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  $userr_id=$row['USER_ID'];
                  
                  $user_query_fetch=$con->query("SELECT * FROM user WHERE ID='$userr_id'")->fetch_assoc();
                  $userr_name=$user_query_fetch['FIRST_NAME']." ".$user_query_fetch['LAST_NAME'];
                  $userr_parner_id=$user_query_fetch['PARTNER_ID'];
                  $userr_mobile=$user_query_fetch['MOBILE'];
                  $userr_email=$user_query_fetch['EMAIL'];
                  $userr_owner_id=$user_query_fetch['OWNER_ID'];
                  $userr_join_date=$user_query_fetch['DATE'];
                  
                  
                  
                  
                  
                  
                  
                  $owner_id=$userr_owner_id;
                  if($owner_id=='Admin' || $owner_id=='admin' || $owner_id=='ADMIN'){
                      $owner_name = "$owner_id";
                  }else{
                  
                  $user_query=$con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                  $owner_name=$user_query['FIRST_NAME']." ".$user_query['LAST_NAME']." (".$user_query['MOBILE'].")";
                  }
                   
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>$userr_parner_id</td>
                    <td>$userr_name</td>
                    <td>$userr_mobile</td>
                    <td>$userr_email</td>
                    <td>$owner_name</td>
                    <td>$userr_join_date</td>
                   
            
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    

?>