<?php
session_start();
error_reporting(0);
    include("../../Db/config.php");
    include("../include/fetch_data.php");
    // $id = $_GET['id'];
    $refrence = $_GET['refrence_id'];
    // $status = $_GET['service'];
   
    //fetch static_bbps
    $static_bbps = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID='$refrence'")->fetch_assoc();
    $userdetails = $static_bbps['USER_ID'];
    $rspns = json_decode($static_bbps['RESPONSE'],true);
    $fth_data = json_decode($static_bbps['FETCH_RESPONSE'],true);
    $conname =$fth_data['name'];

        // print_r($report);
        // exit;

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

$user=$con->query("SELECT * FROM `user` WHERE ID='$userdetails'")->fetch_assoc();

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
     <title><?php echo $row['NAME']?> | BBPS - Recipt</title>
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
                       <button onclick="javascript:location.replace('../BBPSReport')" class="btn btn-danger" id="goBack"><i class="fas fa-print"></i> Go Back</button>
                       <img src="../img/b-assured.svg" width="120" style="float:right">
                   </div>
                   
                    <div class="col-11">
                         <div class="table-responsive" id="reciept-table">
              
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                            <th colspan="8" class="">Transaction Date : <?php echo $static_bbps['FILTER_DATE']." ".$static_bbps['TIMESTAMP'] ?></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                             <td colspan="1">Merchant Name: <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?></td>
                                             <td  colspan="3">Merchant Mobile Number : <?php echo $user['MOBILE'] ?></td>
                                             <td  colspan="2">Consumer Name : <?php echo $fth_data['response']['billerResponse']['customerName'] ?></td>
                                             <td  colspan="2">Consumer Number : <?php echo $static_bbps['CA_NUM'] ?></td>
                                        </tr>
                                       <tr>
                                             <td colspan="1">Category: <?php echo $static_bbps['CATEGORY'] ?></td>
                                             <td  colspan="3">Service Provider : <?php echo $static_bbps['OP_NAME'] ?></td>
                                             <td  colspan="2">Initiating Channel : AGT</td>
                                             <td  colspan="2">Payment Mode : CASH</td>
                                        </tr>
                                        <tr>
                                             <th colspan="6" style="text-align:center">Transaction Summary</th>
                                             <th colspan="2" style="text-align:center">Approvel Ref Num : <?php echo $rspns['approvalRefNumber'] ?></th>
                                        </tr>
                                        <tr style="text-align: center; ">
                                             <td>Transaction Id</td>
                                             <td>Biller Id</td>
                                             <td>Biller Name</td>
                                             <td>CCF</td>
                                             <td>Bill Amount</td>
                                             <td>TOTAL Amount</td>
                                             <td colspan="4">Transaction Status</td>
                                        </tr>
                                        <?php
                                            $rep = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID = '$refrence'");
                                       $totl=0;
                                        while($orrep = $rep->fetch_assoc()){
                                            $totl += $orrep['AMOUNT'];
                                        ?>
                                        <tr>
                                             <td style="text-align: center; " ><?php echo $orrep['REFFRENCE_ID'] ?></td>
                                             <td style="text-align: center; " ><?php echo $orrep['OPERATOR'] ?></td>
                                             <td style="text-align: center; " ><?php echo $orrep['OP_NAME'] ?></td>
                                             <td style="text-align: center; " >0</td>
                                             <td style="text-align: center; "><?php echo $orrep['AMOUNT'] ?></td>
                                             <td style="text-align: center; "><?php echo $orrep['AMOUNT'] ?></td>
                                             <th style="text-align: center; "  colspan="4"><?php echo $orrep['STATUS'] ?></th>
                                        </tr>
                                       <?php  } ?>
                                        <tr class="tfooter">
                                             <td colspan="8">
                                                  <span class="fw-bold">Total Amount Rs. : <?php echo $totl ?> /-</span> <br>
                                                  <!--<h6>Amount in Words : Five Thousand Fourty Only.</h6>-->
                                                  <span>Amount in Words : <?php 
                                                  $class_obj = new numbertowordconvertsconver();
                                                    $convert_number = $totl;
                                                    echo $class_obj->convert_number($convert_number); 
                                                  ?> Rupees Only</span>
                                                  
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