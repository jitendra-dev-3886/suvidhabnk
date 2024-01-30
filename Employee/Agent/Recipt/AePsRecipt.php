<?php
session_start();
error_reporting(0);
    include("../../Db/config.php");
    include("../include/Auth.php");
    // $id = $_GET['id'];
    $refrence = $_GET['refrence_id'];
    $from = $_GET['from'];
    
    if($from == 'report'){
        $url = "../AePsServiceReport";
    }else{
        $url = "../index";
    }
    // $status = $service;
   
    //fetch static_bbps
    $static_bbps = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$refrence'")->fetch_assoc();
    $userdetails = $static_bbps['USER_ID'];
    $report = json_decode($static_bbps['RESPONSE'],true);
        // var_dump($report);
        // exit;
    $service= $static_bbps['TRANS_TYPE'];
    
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
     <title><?php echo $row['NAME']?> | AePS - Recipt</title>
     <style>
         .center {
              display: block;
              margin-left: auto;
              margin-right: auto;
              /*width: 50%;*/
            }
            
            tr.tfooter td {
                padding: 5px 0rem 0 1rem !important;
                
            }
            .copyright{text-align: center;
        }
        .logo{
            
            width:40px;
            
        }
    }
        
     </style>
</head>

<body>

<?php if($service == "CW") {?>

     <section  id="print-area">
          <div class="container">
               <div class="row d-flex justify-content-center" >
                   <div class="col-sm-11 btns mb-3">
                       <button class="btn btn-primary printr" id="printr" onclick='printr()'><i class="fas fa-print"></i> Print Recipt</button>
                       <button class="btn btn-danger" id="goBack" onclick="goBack()"><i class="fas fa-print"></i> Go Back</button>
                   </div>
                    <div class="col-11">
                         <div class="table-responsive" id="reciept-table">
                                 <div class="text-center"> AEPS Cash Withdrawal </div>
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                            <th colspan="4" class="">Transaction Date : <?php echo $static_bbps['TIMESTAMP'] ?></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                       
                                          <tr>
                                             <td>Merchant Name: <?php echo $user['FIRST_NAME']." ".$user['LAST_NAME']; ?></td>
                                             <td  colspan="4">Merchant Mobile Number : <?php echo $user['MOBILE']; ?></td>
                                        </tr>
                                     
                                        <tr>
                                              <td colspan="1" style="font-size:12px;">Aadhaar No: <?php echo $report['data']['customerAadhaarNumber'] ?></td>
                                              <td colspan="1" style="font-size:12px;">TRANS TYPE: <?php echo $static_bbps['TRANS_TYPE'] ?></td>
                                              <td colspan="2" style="font-size:12px;">BANK RRN : <?php echo $report['data']['bankRRN'] ?></td>
                                        </tr>

                                          <?php
                                          // foreach($arrrs as $arrr)
                                           //  {
                                             ?>
                                        
                                        <tr>
                                             <th colspan="5" style="text-align:center">Transaction Summary:</th>
                                        </tr>
                                        <tr>
                                             <th>Transaction Id</th>
                                             <th>Withdrawal Amount</th>
                                             <th>Available Balance</th>
                                             <th>Status</th>
                                        </tr>
                                        <?php
                                            $rep = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$refrence'");
                                       $totl=0;
                                        while($orrep = $rep->fetch_assoc()){
                                            $totl += $orrep['AMOUNT'];
                                        ?>
                                        <tr>
                                             <td><?php echo $orrep['REFFRENCE_ID'] ?></td>
                                             <td><?php echo $report['data']['transactionAmount']; ?></td>
                                             <td><?php echo $report['data']['balanceAmount']; ?></td>
                                             <td colspan="2"><?php echo $orrep['STATUS'] ?></td>
                                        </tr>
                                       <?php  } ?>
                                        <tr class="tfooter">
                                             <td colspan="8">
                                                  <span class="fw-bold m-0">Total Amount Rs. : <?php echo $totl ?> /-</span>
                                                  <br>
                                                  <!--<h6>Amount in Words : Five Thousand Fourty Only.</h6>-->
                                                  <span class="m-0">Amount in Words : <?php 
                                                  $class_obj = new numbertowordconvertsconver();
                                                    $convert_number = $totl;
                                                    echo $class_obj->convert_number($convert_number); 
                                                  ?> Rupees Only</span>
                                                  
                                                <div class="" style=' text-align: right; '>
                                                   <img  src="../../assets/images/<?php echo $row['I_LOGO']?>"  class="logo" alt="DMT" width="60">
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
     
<?php } else if($service == "BE") {?>


  <section  id="print-area">
          <div class="container">
               <div class="row d-flex justify-content-center" >
                   <div class="col-sm-11 btns mb-3">
                       <button class="btn btn-primary printr" id="printr" onclick='printr()'><i class="fas fa-print"></i> Print Recipt</button>
                       <button class="btn btn-danger" id="goBack" onclick="goBack()"><i class="fas fa-print"></i> Go Back</button>
                   </div>
               
                  
                    <div class="col-11">
                  
                         <div class="table-responsive" id="reciept-table">
                                    <h6 class="text-center">  AEPS Balance Enquiry  </h6>
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
                                             <td colspan="2">Merchant Name: <?php echo $user['FIRST_NAME']." ".$user['LAST_NAME']; ?></td>
                                             <td  colspan="2">Merchant Mobile Number : <?php echo $user['MOBILE'] ?></td>
                                        </tr>
                                     
                                        <tr>
                                              <td colspan="1" style="font-size:12px;">Aadhaar No: <?php echo $report['last_aadhar'] ?></td>
                                              <td colspan="1" style="font-size:11px;">TRANS TYPE: <?php echo $static_bbps['TRANS_TYPE'] ?></td>
                                              <td colspan="2" style="font-size:12px;">BANK RRN : <?php echo $report['data']['bankRRN'] ?></td>
                                        </tr>

                                          <?php
                                          // foreach($arrrs as $arrr)
                                           //  {
                                             ?>
                                        
                                        <tr>
                                             <th colspan="5" style="text-align:center">Transaction Summary:</th>
                                        </tr>
                                        <tr>
                                             <th>Transaction Id</th>
                                             <th>Available Balance</th>
                                             <th>Status</th>
                                        </tr>
                                        <?php
                                            $rep = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$refrence' AND TRANS_TYPE='BE'");
                                       $totl=0;
                                        while($orrep = $rep->fetch_assoc()){
                                            $totl += $report['balanceamount'];
                                        ?>
                                        <tr>
                                             <td><?php echo $orrep['REFFRENCE_ID'] ?></td>
                                             <td><?php echo $report['data']['balanceAmount'] ?></td>
                                             <td><?php echo $orrep['STATUS'] ?></td>
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
                                                  ?> Rupees Only </span>
                                                  
                                              <div class="col-sm-11">
                                                  
                                                  <div style='text-align: right;'>
                                                   <img src="../../assets/images/<?php echo $row['I_LOGO']?>" width='60' class="img-fluid logo" alt="DMT">
                                                 </div>

                                                      <div class="copyright" style='text-align: center;'>
                                                        © Copyright <strong><span><?php echo $row['NAME']?></span></strong>. All Rights Reserved
                                                      </div>
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

<?php } else if($service == "M") {?>


 <section  id="print-area">
     
     
     
     
          <div class="container">
              
       
              
               <div class="row d-flex justify-content-center" >
                   <div class="col-sm-11 btns mb-1">
                       <button class="btn btn-primary printr" id="printr" onclick='printr()'><i class="fas fa-print"></i> Print Recipt</button>
                       <button class="btn btn-danger" id="goBack" onclick="goBack()"><i class="fas fa-print"></i> Go Back</button>
                        
                   </div>
    
                <div class="col-11">
                         <div class="table-responsive" id="reciept-table">
                                 <!--<div class="alert alert-danger m-0" role="alert">-->
                                 <!--</div>-->
                                <div class="text-center"> <b> AEPS Aadhar Pay </b> </div>
                              <table class="table table-bordered">
                                   <thead>
                                           <tr>
                                             <!--<th><img src="assets/images/dmt_logo.jpg" width='200'  class="img-fluid logo" alt="DMT">
                                             </th>-->
                                             <!--<th class="">Retailer Name : <?php //echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?>-->
                                             <!--</th>-->
                                            <th colspan="2" class="">Transaction Date : <?php echo $static_bbps['TIMESTAMP'] ?></th>

                                        </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                             <td>Merchant Name: <?php echo $user['FIRST_NAME']." ".$user['LAST_NAME']; ?></td>
                                             <td  colspan="4">Merchant Mobile Number : <?php echo $user['MOBILE'] ?></td>
                                        </tr>
                                     
                                        <tr>
                                              <td>Aadhaar No: <?php echo $report['last_aadhar'] ?></td>
                                              <td colspan="2">TRANS TYPE: <?php echo $static_bbps['TRANS_TYPE'] ?></td>
                                              <td colspan="2">BANK RRN : <?php echo $report['bankrrn'] ?></td>
                                        </tr>

                                          <?php
                                          // foreach($arrrs as $arrr)
                                           //  {
                                             ?>
                                        
                                        <tr>
                                             <th colspan="5" style="text-align:center">Transaction Summary:</th>
                                        </tr>
                                        <tr>
                                             <th>Transaction Id</th>
                                             <th>Withdrawal Amount</th>
                                             <th>Available Balance</th>
                                             <th>Status</th>
                                        </tr>
                                        <?php
                                            $rep = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$refrence' AND TRANS_TYPE='M'");
                                       $totl=0;
                                        while($orrep = $rep->fetch_assoc()){
                                            $totl += $orrep['AMOUNT'];
                                        ?>
                                        <tr>
                                             <td><?php echo $orrep['REFFRENCE_ID'] ?></td>
                                             <td><?php echo $report['amount']; ?></td>
                                             <td><?php echo $report['balanceamount']; ?></td>
                                             <td colspan="2"><?php echo $orrep['STATUS'] ?></td>
                                        </tr>
                                       <?php  } ?>
                                        <tr class="tfooter">
                                             <td colspan="6">
                                                  <span class="fw-bold">Total Amount Rs. : <?php echo $totl ?> /- </span><br>
                                                  <!--<h6>Amount in Words : Five Thousand Fourty Only.</h6>-->
                                                  <h6 style="display:inline;">Amount in Words : <?php 
                                                  $class_obj = new numbertowordconvertsconver();
                                                    $convert_number = $totl;
                                                    echo $class_obj->convert_number($convert_number); 
                                                  ?> Rupees Only</h6>
                                                <!--<div class="" style=' text-align: right; '>-->
                                                   <img style="float: right;" src="../../assets/images/<?php echo $row['I_LOGO']?>" width='60' class="logo" alt="DMT">
                                               <!--</div>-->
                                                  
                                                      <div class="copyright">
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
     
<?php } else if($service == "MS") {?>

 <section  id="print-area">
          <div class="container">
               <div class="row d-flex justify-content-center" >
                   <div class="col-sm-11 btns mb-3">
                       <button class="btn btn-primary printr" id="printr" onclick='printr()'><i class="fas fa-print"></i> Print Recipt</button>
                       <button class="btn btn-danger" id="goBack" onclick="goBack()"><i class="fas fa-print"></i> Go Back</button>
                   </div>
    
                    <div class="col-11">
                         <div class="table-responsive" id="reciept-table">
                                    <h6 class="text-center">AEPS Mini Statements </h6>
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
                                             <td>Merchant Name: <?php echo $user['FIRST_NAME']." ".$user['LAST_NAME']; ?></td>
                                             <td  colspan="4">Merchant Mobile Number : <?php echo $user['MOBILE'] ?></td>
                                        </tr>
                                     
                                        <tr>
                                              <td class="p-0  mx-1">Aadhaar No: ********<?php echo $report['last_aadhar'] ?></td>
                                              <td class="p-0  mx-1" colspan="2">TRANS TYPE: <?php echo $static_bbps['TRANS_TYPE'] ?></td>
                                              <td class="p-0  mx-1" colspan="2">Bank Rrn: <?php echo $report['data']['bankRRN'] ?></td>
                                        </tr>

                                        
                                        <tr>
                                             <th colspan="5" style="text-align:center" class="p-0">Transaction Summary:</th>
                                        </tr>
                                         <thead>
                                            <tr>
                                              <th colspan="1" style="text-align: center; font-size:15px;" class="p-0" >Date</th>
                                              <th colspan="1" style="text-align: center; font-size:15px;" class="p-0" >Amount</th>
                                              <th colspan="1" style="text-align:center; font-size:15px;" class="p-0" >TxnType</th>
                                              <th colspan="1" style="text-align: center; font-size:15px;" class="p-0" >Narration</th>
                                            </tr>
                                          </thead>
                                           <tbody>
                                                <?php  
                                                 $response_data = json_decode($static_bbps['RESPONSE'],true);
                                                 $st = explode(",", $response_data['miniStatement']);
                                                 $totl=0;
                                                 $totl += $response_data['AMOUNT'];
                                                 $total_stamnt = count($response_data["ministatement"]);
                                                
                                                for($n=0;$n<$total_stamnt;$n++){
                                                
                                                if($response_data["ministatement"][$n]['txnType'] == 'D'){
                                                    $response_data["ministatement"][$n]['txnType'] =  "Debit";
                                                }
                                                
                                                if($response_data["ministatement"][$n]['txnType'] == 'C'){
                                                    $response_data["ministatement"][$n]['txnType'] = "Credit";
                                                    
                                                }
                                                
                                                ?>  
                                                <tr>
                                                  
                                                  <td colspan="1" style="text-align: center; font-size:12px;" class="p-0"><?php echo $response_data["ministatement"][$n]['date']; ?></td>
                                                  <td  colspan="1" style="text-align: center; font-size:12px;" class="p-0"><?php echo $response_data["ministatement"][$n]["amount"]; ?></td>
                                                  <td colspan="1" style="text-align: center; font-size:12px;" class="p-0"><?php echo $response_data["ministatement"][$n]['txnType']; ?></td>
                                                  <td colspan="1" style="text-align: center; font-size:12px;" class="p-0"><?php echo $response_data["ministatement"][$n]['narration']; ?></td>
                                                 
                                                </tr>
                                            <?php } ?>
                                                
                                              </tbody>
                                      
                                        <tr class="tfooter">
                                             <td colspan="8">
                                                  <!--<h2 class="fw-bold">Total Amount Rs. : <?php echo $totl ?> /-</h2>-->
                                                  <!--<h6>Amount in Words : Five Thousand Fourty Only.</h6>
                                                 <h6>Amount in Words :--> <?php 
                                                  #$class_obj = new numbertowordconvertsconver();
                                                    #$convert_number = $totl;
                                                    #echo $class_obj->convert_number($convert_number); 
                                                  ?>  <!--Rupees Only</h6>-->
                                                  
                                                <div class="col-sm-11" style='text-align:right;' >
                                                   <img style="width:60px !important;" src="../../assets/images/<?php echo $row['I_LOGO']?>"  alt="DMT">
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
     
<?php } ?>
     <script src="assets/recipt/js/bootstrap.bundle.min.js"></script>
     
       <script type="text/javascript">
        function goBack(){
              location.replace("<?php echo $url ?>");
            
        }
    
          
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