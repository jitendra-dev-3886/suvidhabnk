<?php
session_start();
require_once('../../Db/config.php');
include("function.php");

 if(isset($_POST["pname"]))  
 {  
      $name = filterThis($_POST["pname"]);  
      $service = filterThis($_POST["service"]);  
      $camt = filterThis($_POST["c_amt"]);  
      $ctype = filterThis($_POST["c_type"]);  
      $ctxnlimit = filterThis($_POST["ctxnlimit"]);  
      $cvamt = filterThis($_POST["cvamt"]);  
      $csdate = filterThis($_POST["csdate"]);  
      $cedate = filterThis($_POST["cedate"]);  
      $cremark = filterThis($_POST["cremark"]);  

      $query = $con->query("INSERT INTO `promocode`(`NAME`, `SERVICE`, `CASHBACK_AMOUNT`, `CASHBACK_TYPE`,`TRANSACTION_LIMITS`, `VALID_AMOUNT`, `FIRST_DATE`, `EXPIRY_DATE`, `STATUS`, `REMARK`) VALUES 
      ('$name','$service','$camt','$ctype','$ctxnlimit','$cvamt','$csdate','$cedate','Active','$cremark')");  
      if($query)  
      
            {  
               echo 1;

      }else{
                   echo 0;

          
      }   
 }
 
 
 if(isset($_POST["pageid"]) && $_POST["pageid"] == 1)  
 {  
      $fromdate = filterThis($_POST["formdate"]);  
      $todate = filterThis($_POST["todate"]);  
        

      $query = $con->query("SELECT * FROM `promocode` WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC");
      $output = "";
      $i = 1;
      
      $output .= "<table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Promocode Name</th>
                    <th>Service</th>
                    <th>Cashback Amount</th>
                    <th>Cashback Type</th>
                    <th>Transaction Limit</th>
                    <th>Valid Amount</th>
                    <th>Start Date</th>
                    <th>Expiry date</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>";
                  
      while($row = $query->fetch_assoc()){
          $output .= "
          
          <tr>
          <td>".$i++."</td>
          <td>{$row['NAME']}</td>
          <td>{$row['SERVICE']}</td>
          <td>{$row['CASHBACK_AMOUNT']}</td>
          <td>{$row['CASHBACK_TYPE']}</td>
          <td>{$row['TRANSACTION_LIMITS']}</td>
          <td>{$row['VALID_AMOUNT']}</td>
          <td>{$row['FIRST_DATE']}</td>
          <td>{$row['EXPIRY_DATE']}</td>
          <td>{$row['STATUS']}</td>
          <td>{$row['REMARK']}</td>
          <td>{$row['DATE']}</td>
          </tr>
          
          ";
      }
    
     $output .= "</tbody>
                </table>";
     
    echo $output;
 }
 

 
?>
