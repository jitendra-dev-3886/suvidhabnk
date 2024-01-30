<?php
include("../../Db/config.php");
$refrence = $_GET['refrence_id'];
$recipt = $con->query("SELECT * FROM aeps_transactions WHERE REFFRENCE_ID = '$refrence'")->fetch_assoc();
$response_data = json_decode($recipt['RESPONSE'],true);

  // $op = explode(",", $recipt['OPERATOR']);
  $st = explode(",", $recipt['STATUS']);

// echo "<pre>";
// print_r($response_data);
// echo "</pre>";

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AePS Recipt</title>
    <link rel="stylesheet" href="https://fintechdev.github.io/x2-ui/css/styleguide.css">
    
    <style>
        .receipt__paper {
    align-items: center;
    border-radius: 5px;
    border-top: 5px solid #353f4c;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 550px;
    overflow: hidden;
    position: relative;
    width: 100%;
}
.receipt__info {
    animation: slideDown 1.5s;
    background-color: #FFF;
    box-shadow: 0 -4px 3px 0 rgb(0 0 0 / 20%);
    height: 432px;
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
<div class="receipt">
    <div class="receipt__holder">
        <div class="receipt__headline">
            <h4 class="headline__title receipt__title">AePs Receipt </h4>
        </div>
        <div class="receipt__paper">
            <div id="reciptid" class="receipt__info">
        <img src="../../assets/images/<?php echo $row['I_LOGO']?>" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="90" style="margin-top: -15px;">
        <img src="Logo/aeps.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="110" style="float:right;">
        
        <?php if(isset($response_data["statuscode"])){ ?>
                <div class="receipt__block">
                    <label>Time:</label>
                    <p><?php echo $recipt['FILTER_DATE'].' - '.$recipt['TIMESTAMP'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>bank Name:</label>
                    <p><?php echo $response_data['data']['bankName'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Mobile Number:</label>
                    <p><?php echo $recipt['MOBILE'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Aadhaar Number:</label>
                    <p>  
                    <?php
                        echo $response_data['data']['accountNumber'];    
                    
                    ?></p>
                </div>
                <div class="receipt__block">
                    <label>Bank RRN:</label>
                    <p> <?php
                   
                        echo $response_data['data']['operatorId'];    
                    ?></p>
                </div>
                <?php
                if($response_data['amount'] == ""){
                ?>
                <div class="receipt__block">
                    <label>Withdrawal Amount:</label>
                    <p>0</p>
                </div>
                <?php
                }else{
                ?>
                
                <div class="receipt__block">
                    <label>Withdrawal Amount:</label>
                    <p><?php echo $response_data['amount'] ?></p>
                </div>
                
                <?php } ?>
                
                <div class="receipt__block">
                    <label>Status:</label>
                    <p><?php echo $st[0] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Available Balance:</label>
                    <p>
                    <?php
                    
                        echo $response_data['data']['bankAccountBalance'];    
    
                    ?>
                    </p>
                </div>

                <div class="receipt__block" style="text-align: center;">
                    <p class="text-center">Message : <?php echo $response_data['status'] ?></p>
                </div>
                
                <?php }else{ ?>
                
                        <div class="receipt__block">
                    <label>Time:</label>
                    <p><?php echo $recipt['FILTER_DATE'].' - '.$recipt['TIMESTAMP'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Name:</label>
                    <p><?php echo $response_data['name'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Mobile Number:</label>
                    <p><?php echo $recipt['MOBILE'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Aadhaar Number:</label>
                    <p>  
                    <?php
                    if($recipt['API'] != "PAYSPRINT"){
                        echo $response_data['data']['accountNumber'];    
                    }
                    else{
                        echo "XXXX XXXX ".$response_data['last_aadhar'];
                    }
                    ?></p>
                </div>
                <div class="receipt__block">
                    <label>Bank RRN:</label>
                    <p> <?php
                    if($recipt['API'] != "PAYSPRINT"){
                        echo $response_data['data']['opreratorId'];    
                    }
                    else{
                        echo $response_data['bankrrn'];
                    }
                    ?></p>
                </div>
                <?php
                if($response_data['amount']!="0"){
                ?>
                <div class="receipt__block">
                    <label>Withdrawal Amount:</label>
                    <p><?php echo $response_data['amount'] ?></p>
                </div>
                <?php
                }
                ?>
                
                <div class="receipt__block">
                    <label>Status:</label>
                    <p><?php echo $st[0] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Available Balance:</label>
                    <p>
                    <?php
                    if($recipt['API'] != "PAYSPRINT"){
                        echo $response_data['data']['bankAccountBalance'];    
                    }
                    else{
                        echo $response_data['balanceamount'];
                    }
                    ?>
                    </p>
                </div>

                <div class="receipt__block" style="text-align: center;">
                    <p class="text-center">Message : <?php echo $response_data['message'] ?></p>
                </div>
                
                
                <?php } ?>
            </div>
            <div class="receipt__actions is-flex-centered is-print-hidden">
                <button onclick="javascript:location.replace('../AePsServiceReport.php')" class="button receipt__button">Back</button>
                <button onclick="printr('reciptid')" class="button button--action receipt__button">Print</button>
            </div>
        </div>
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
    </div>
</div>

<script>
    
    function printr(id){
        var bodye = document.querySelector("body");
        var recipte = document.getElementById(id);
        
        recipte = document.querySelector("body");
        
        window.print();
        
        bodye = document.querySelector("body");
    }
    
</script>


</body>
</html>