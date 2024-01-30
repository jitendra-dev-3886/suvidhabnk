<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'GST Registration' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";


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

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'Company Registration' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";


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

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'TDS Retrun' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";


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

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'ITR Retrun' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";


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

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$id' AND TYPE = 'DSC Certificate' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";


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
