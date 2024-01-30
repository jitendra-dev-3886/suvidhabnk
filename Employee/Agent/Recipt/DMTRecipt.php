<?php
session_start();
    include("../../Db/config.php");
    include("../include/Auth.php");
    
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Backend/Functions/main_function.php");
    include("../Backend/DMT/paysprint/dmt_function.php");
    // $id = $_GET['id'];
    $refrence = $_GET['refrence_id'];
    $from = $_GET['where'];
   
    //fetch static_bbps
    $static_bbps = $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$refrence'")->fetch_assoc();
    $remterusid = $static_bbps["USER_ID"];
    
    $remiterdet = json_decode(getRemit($static_bbps['MOBILE']) , true);
    // print_r($remiterdet);
    $fetchremeter= $con->query("SELECT * FROM `dmt_user` WHERE USER_ID='$remterusid'")->fetch_assoc();
    
    $report_reme = json_decode($fetchremeter['RESPONSE'],true);
    $report = json_decode($static_bbps['RESPONSE'],true);
        // var_dump($report);
        // exit;
    $accno=$report['account_number'];
    $dmt_bene = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT='$accno'")->fetch_assoc();
    $verify_dmt = json_decode($dmt_bene['VERIFY_RESPONSE'],true);

    // var_dump($dmt_bene);
    // TEST
    
    class numbertowordconvertsconver {
    function convert_number($number) 
    {
        if (($number < 0) || ($number > 999999999)) 
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga) 
        {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= " and ";
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = "zero";
        }
        return $result;
    }
}

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../assets/recipt/css/bootstrap.min.css">
     <link rel="stylesheet" href="../assets/recipt/css/style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title><?php echo $row['NAME']?> | DMT - Recipt</title>
     <style>
         .center {
              display: block;
              margin-left: auto;
              margin-right: auto;
              /*width: 50%;*/
            }
        .logo{
            
            width:40px;
        }
        
        
             tr.tfooter td {
                padding: 5px 0rem 0 1rem !important;
                }
        
        
        
     </style>
</head>

<body>

     <section  id="print-area">
          <div class="container">
               <div class="row d-flex justify-content-center" >
                   <div class="col-sm-11 btns mb-3">
                       <button type="button" class="btn btn-primary printr" id="printr"><i class="fas fa-print"></i> Print Recipt</button>
                       <!--<button onclick="javascript:location.replace('DMT_Report')" class="btn btn-danger" id="goBack"><i class="fas fa-print"></i> Go Back</button>-->
                      <!--<?php if($from == 'fapi'){ ?>-->
                       <!--<a href="https://www.ethhub.in/Dashboard/User/Home" class="btn btn-danger">Close</a>-->
                   <!--<?php }else{?>-->
                       <a type="button"  href="index" id="close_page" class="btn btn-danger close_page">Close</a>
                   <!--<?php }?>-->
                   </div>
                   
                    <div class="col-11">
                         <div class="table-responsive" id="reciept-table">
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                             <!--<th><img src="assets/images/dmt_logo.jpg" width='200'  class="img-fluid logo" alt="DMT">
                                             </th>-->
                                             <!--<th class="">Retailer Name : <?php //echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?>-->
                                             <!--</th>-->
                                            <th colspan="4" class="">Transaction Date : <?php echo $static_bbps['TIMESTAMP'] ?></th>

                                        </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                             <td>Merchant Name: <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?></td>
                                             <td  colspan="4">Merchant Mobile Number : <?php echo $user['MOBILE'] ?></td>
                                        </tr>
                                     
                                        <tr>
                                              <td>Remitter Name: <?php echo $remiterdet['data']['fname'].' '.$remiterdet['data']['lname'] ?></td>
                                              <td colspan="2">Remitter Mobile Number : <?php echo $remiterdet['data']['mobile'] ?></td>
                                              <td colspan="2">Transaction Mode : <?php echo $static_bbps['TRANS_TYPE'] ?></td>
                                        </tr>
                                        <tr>
                                              <td>Beneficiary Name: <?php echo $verify_dmt['benename'] ?></td>
                                              <td colspan="2">Beneficiary Account Number : <?php echo $report['account_number'] ?></td>
                                              <td colspan="2">Beneficiary IFSC Code : <?php echo $dmt_bene['IFSC'] ?></td>
                                        </tr>
                                        
                                          <?php
                                          // foreach($arrrs as $arrr)
                                           //  {
                                             ?>
                                        
                                        <tr>
                                             <th colspan="5" style="text-align:center">Transaction Summary:</th>
                                        </tr>
                                        <tr>
                                             <td>Transaction Id</td>
                                             <td>Bank RRN</td>
                                             <td>Remittance Amount</td>
                                             <!--<td>Dmt Txn ID</td>-->
                                             <!--<td>Service Charges</td>-->
                                             <td>Status</td>
                                        </tr>
                                        <?php
                                                $rep = $con->query("SELECT * FROM `dmt_transactions` WHERE COMM_REFID='".$static_bbps['COMM_REFID']."'");
                                            
                                            //   $rep =  $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$refrence'");

                                       $totl=0;
                                    //   echo "SELECT * FROM `dmt_transactions` WHERE COMM_REFID='".$static_bbps['COMM_REFID']."'";
                                        while($orrep = $rep->fetch_assoc()){
                                            $totl += $orrep['AMOUNT'];
                                        ?>
                                        <tr>
                                             <td><?php echo $orrep['REFFRENCE_ID'] ?></td>
                                             <td><?php echo $report['utr']; ?></td>
                                             <td><?php echo $orrep['AMOUNT'] ?></td>
                                             <th><?php echo $orrep['STATUS'] ?></th>
                                        </tr>
                                       <?php  } ?>
                                        <tr class="tfooter">
                                             <td colspan="8">
                                                  <span class="fw-bold">Total Amount Rs. : <?php echo $totl ?> /-<span> <br>
                                                  <!--<h6>Amount in Words : Five Thousand Fourty Only.</h6>-->
                                                 <span>Amount in Words : <?php 
                                                  $class_obj = new numbertowordconvertsconver();
                                                    $convert_number = $totl;
                                                    echo $class_obj->convert_number($convert_number); 
                                                  ?> Rupees Only </span>
                                                  
                                                  <div class="" style=' text-align: right; '>
                                                   <img width="60" src="../../assets/images/<?php echo $row['I_LOGO']?>"  class="img-fluid logo " alt="logo" style="width: 15%;">
                                               </div>
                                               
                                                  <div class="copyright" style='text-align: center;'>
                                                        © Copyright <strong><span><?php echo $row['NAME']?></span></strong>. All Rights Reserved
                                                 </div>
      
                                             </td>

                                        </tr>

                                   </tbody>

                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <script src="assets/recipt/js/bootstrap.bundle.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
  
          <script type="text/javascript">
          var printbtn = document.querySelector(".printr");
          var content = document.getElementById("reciept-table");
          var backup = document.body.innerHTML;

          printbtn.addEventListener("click", function () {

               document.body.innerHTML = content.innerHTML;
               window.print();
               document.body.innerHTML = backup;
          });
          
          var close_page = document.getElementById("close_page");
          
          close_page.addEventListener("click", function () {
             window.close();
          });
           
     </script>
</body>

</html>