<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'GST Registration'";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'Company Registration'";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                     <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'TDS Retrun'";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                     <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 3){

 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'ITR Retrun'";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                     <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 4){

 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'DSC Certificate'";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                     <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


?>