<?php

session_start();
require_once('../../Db/config.php');
// require("../include/Auth.php");

//Recharge report code here........
    /*  error_reporting(E_ALL);
  ini_set("display_errors",1); */
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "SELECT * FROM index_form_response WHERE date(DATE_TIME) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>MOBILE</th>
                        <th>DATE_TIME</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                    
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['DATE_TIME']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    

?>