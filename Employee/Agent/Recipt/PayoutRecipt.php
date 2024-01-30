<?php
session_start();
include("../../Db/config.php");
include("../include/Auth.php");

$id = $_SESSION['id'];
$rc_tra = $con->query("SELECT * FROM `user` WHERE ID ='$id'")->fetch_assoc();
$refrence = $_GET['refrence_id'];
$recipt = $con->query("SELECT * FROM `payout_transaction` WHERE REFFRENCE_ID = '$refrence'")->fetch_assoc();
$st = explode(",", $recipt['STATUS']);

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
     <title><?php echo $row['NAME']?> | Payout - Report </title>
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
                       <button class="btn btn-primary printr" id="printr" onclick='printr()'><i class="fas fa-print"></i> Print Recipt</button>
                       <button class="btn btn-danger" id="goBack" onclick="javascript:location.replace('../PayoutServiceReport.php')"><i class="fas fa-print"></i> Go Back</button>
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
                                            <th colspan="4" class="">Transaction Date : <?php echo $recipt['TIMESTAMP'] ?></th>

                                        </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                             <td>Merchant Name: <?php echo $rc_tra['FIRST_NAME'].' '. $rc_tra['LAST_NAME'] ?></td>
                                             <td  colspan="4">Transaction Type : <?php  echo $recipt['TRANS_TYPE']?></td>
                                        </tr>
                                     
                               
                                        <tr>
                                              <td colspan="2">Refrence Id: <?php echo $recipt['REFFRENCE_ID']  ?></td>
                                              <td colspan="2">Recipt Status : <?php echo $recipt['STATUS'] ?></ ?></td>
                                        </tr>
                                        
                               
                                        <tr class="tfooter">
                                             <td colspan="8">
                                                  <span class="fw-bold">Total Amount Rs. : <?php  echo $recipt['AMOUNT'] ?> /-<span> <br>
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

     <script src="../assets/recipt/js/bootstrap.bundle.min.js"></script>
     
       <script type="text/javascript">
       function goBack() {
               window.location.replace('index');
            }

     </script>
          <script type="text/javascript">
          var printbtn = document.querySelector(".printr");
          var content = document.getElementById("reciept-table");
          var backup = document.body.innerHTML;

          printbtn.addEventListener("click", function () {

               document.body.innerHTML = content.innerHTML;
               window.print();
               document.body.innerHTML = backup;
          });
     </script>
</body>

</html>

