<?php
include("../../Db/config.php");
$refrence = $_GET['refrence_id'];
$recipt = $con->query("SELECT * FROM pay_bill_api WHERE REFFRENCE_ID = '$refrence'")->fetch_assoc();
$response_data = json_decode($recipt['RESPONSE'],true);
// echo "<pre>";
// print_r($response_data);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h4 class="headline__title receipt__title">BBPS Receipt </h4>
        </div>
        <div class="receipt__paper">
            <div id="reciptid" class="receipt__info">
        <img src="Logo/bbps.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="90">
                <div class="receipt__block">
                    <label>Date&Time:</label>
                    <p><?php echo $recipt['FILTER_DATE'].' '.$recipt['TIMESTAMP'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Category:</label>
                    <p><?php echo $recipt['CATEGORY'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Operator:</label>
                    <p><?php echo $recipt['OP_NAME'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Operator Id:</label>
                    <p><?php echo $recipt['OPERATORID'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>CA Number</label>
                    <p><?php echo $recipt['CA_NUM'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Refference Id</label>
                    <p><?php echo $recipt['REFFRENCE_ID'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Status:</label>
                    <p><?php echo $recipt['STATUS'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Amount:</label>
                    <h4><?php echo $recipt['AMOUNT'] ?></h4>
                </div>
                <div class="receipt__block" style="text-align: center;">
                    <p class="text-center">Message : <?php echo $response_data['message'] ?></p>
                </div>
            </div>
            <div class="receipt__actions is-flex-centered is-print-hidden">
                <button  onclick="javascript:location.replace('../MoneyTransferUPIReport')" class="button receipt__button">Back</button>
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
        
        bodye =  document.querySelector("body");
        
        window.print();
        
        bodye = document.querySelector("body");
    }
    
</script>


</body>
</html>