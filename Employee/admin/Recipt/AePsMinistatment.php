<?php
include("../../Db/config.php");
$refrence = $_GET['refrence_id'];
$recipt = $con->query("SELECT * FROM aeps_transactions WHERE REFFRENCE_ID = '$refrence'")->fetch_assoc();
$response_data = json_decode($recipt['RESPONSE'],true);

  // $op = explode(",", $recipt['OPERATOR']);
  $st = explode(",", $recipt['STATUS']);
  $st = explode(",", $response_data['ministatement']);

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministatement Recipt</title>
    <link rel="stylesheet" href="https://fintechdev.github.io/x2-ui/css/styleguide.css">
    
    <style>
        .receipt__paper {
    align-items: center;
    border-radius: 5px;
    border-top: 5px solid #353f4c;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 630px;
    overflow: hidden;
    position: relative;
    width: 100%;
}

td, th {
    padding: 2px 10px !important;
}


.receipt__info {
    animation: slideDown 1.5s;
    background-color: #FFF;
    box-shadow: 0 -4px 3px 0 rgb(0 0 0 / 20%);
    height: 1000px;
    overflow-y: auto;
    padding: 30px;
    position: relative;
    transform-origin: 50% 0%;
    width: 98%;
    z-index: 101;
}
.receipt__headline {
    padding: 0px;
}
.receipt__title {
    padding: 0;
    margin: 0px;
}
    </style>
</head>
<body>
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
<!--<div class="receipt">-->
<!--    <div class="receipt__holder">-->
<!--        <div class="receipt__headline">-->
<!--            <h4 class="headline__title receipt__title">Ministatement Receipt </h4>-->
<!--        </div>-->
<!--        <div class="receipt__paper">-->
<!--            <div id="reciptid" class="receipt__info">-->
<!--        <img width="90" src="../../assets/images/<?php echo $row['I_LOGO']?>"  class="img-fluid logo " alt="logo">-->
<!--        <img src="Logo/aeps.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="110" style="float:right;">-->
<!--                <div class="receipt__block">-->
<!--                    <label>Time:</label>-->
<!--                    <p><?php echo $recipt['FILTER_DATE'].' - '.$recipt['TIMESTAMP'] ?></p>-->
<!--                </div>-->
               
<!--                <div class="receipt__block">-->
<!--                    <label>Mobile Number:</label>-->
<!--                    <p><?php echo $recipt['MOBILE'] ?></p>-->
<!--                </div>-->
<!--                <div class="receipt__block">-->
<!--                    <label>Aadhaar Number:</label>-->
<!--                    <p>XXXX XXXX <?php echo $response_data['last_aadhar'] ?></p>-->
<!--                </div>-->
<!--                <div class="receipt__block">-->
<!--                    <label>Bank RRN:</label>-->
<!--                    <p><?php echo $response_data['bankrrn'] ?></p>-->
<!--                </div>-->
                
<!--                <div class="receipt__block">-->
<!--                    <label>Available Balance:</label>-->
<!--                    <p><?php echo $response_data['balanceamount'] ?></p>-->
<!--                </div>-->
                
<!--                <?php -->
<!--                if($response_data["status"] == 'true'){-->
<!--                    $i=1;-->
<!--                ?>-->
<!--                <div class="table-responsive">-->
<!--                        <table class="table table-bordered">-->
<!--  <thead>-->
<!--    <tr>-->
<!--      <th scope="col">Date</th>-->
<!--      <th scope="col">Amount</th>-->
<!--      <th scope="col">txnType</th>-->
<!--    </tr>-->
<!--  </thead>-->
<!--  <tbody>-->
<!--    <?php  -->
    
<!--    $total_stamnt = count($response_data["ministatement"]);-->
    
<!--    for($n=0;$n<$total_stamnt;$n++){-->
    
<!--    if($response_data["ministatement"][$n]['txnType'] == 'D'){-->
<!--        $response_data["ministatement"][$n]['txnType'] =  "Debit";-->
<!--    }-->
    
<!--    if($response_data["ministatement"][$n]['txnType'] == 'C'){-->
<!--        $response_data["ministatement"][$n]['txnType'] = "Credit";-->
        
<!--    }-->
    
<!--    ?>  -->
<!--    <tr>-->
      
<!--      <td><?php echo $response_data["ministatement"][$n]['date']; ?></td>-->
<!--      <td><?php echo $response_data["ministatement"][$n]["amount"]; ?></td>-->
<!--      <td><?php echo $response_data["ministatement"][$n]['txnType']; ?></td>-->
     
<!--    </tr>-->
<!--<?php } ?>-->
    
<!--  </tbody>-->
<!--</table>-->
<!--                    </div>-->
<!--  <?php }else{-->
<!--  echo "Ministatement Can't Fetch";-->
<!--  }-->
<!--  ?>-->

<!--                <div class="receipt__block" style="text-align: center;">-->
<!--                    <p class="text-center">Message : <?php echo $response_data['message'] ?></p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="receipt__actions is-flex-centered is-print-hidden">-->
<!--                <button onclick="javascript:location.replace('../AePsServiceReport.php')" class="button receipt__button">Back</button>-->
<!--                <button onclick="printr('reciptid')" class="button button--action receipt__button">Print</button>-->
<!--            </div>-->
<!--        </div>-->
        <!--<div class="receipt__footer is-print-hidden">-->
        <!--    <nav class="navbar__holder">-->
        <!--        <li class="langbar__item is-active">-->
        <!--            <button class="langbar__button button button--rounded">EN</button>-->
        <!--        </li>-->
        <!--        <li class="langbar__item">-->
        <!--            <button class="langbar__button button button--rounded">FR</button>-->
        <!--        </li>-->
        <!--        <li class="langbar__item">-->
        <!--            <button class="langbar__button button button--rounded">ES</button>-->
        <!--        </li>-->
        <!--    </nav>-->
        <!--</div>-->
<!--    </div>-->
<!--</div>-->


<!-- jQuery -->
<script>
    
    function printr(id){
        var bodye = document.querySelector("body");
        var recipte = document.getElementById(id);
      
     bodye = recipte;
        
        window.print();
        
        bodye = document.querySelector("body");
    }
    
</script>


</body>
</html>