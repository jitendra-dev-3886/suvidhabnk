<?php
include("../../Db/config.php");
$refrence = $_GET['refrence_id'];
$recipt = $con->query("SELECT * FROM payout_transaction WHERE REFFRENCE_ID = '$refrence'")->fetch_assoc();
$response_data = json_decode($recipt['CHECK_RESPONSE'],true);

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
    <title>Payout Recipt</title>
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
            <h4 class="headline__title receipt__title">Payout Receipt </h4>
        </div>
        <div class="receipt__paper">
            <div id="reciptid" class="receipt__info">
        <img src="../../assets/images/<?php echo $row['I_LOGO']?>" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="90" style="margin-top: -15px;">
        <img src="Logo/aeps.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="110" style="float:right;">
            <div class="receipt__block">
                    <label>Time:</label>
                    <p><?php echo $recipt['FILTER_DATE'].' '.$recipt['TIMESTAMP'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Benificiary Id:</label>
                    <p><?php echo $response_data['data']['transfer']['beneId'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Account Number:</label>
                    <p><?php echo $response_data['data']['transfer']['bankAccount'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>IFSC Code:</label>
                    <p><?php echo $response_data['data']['transfer']['ifsc'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Status:</label>
                    <p><?php echo $response_data['data']['transfer']['status'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>UTR:</label>
                    <p><?php echo $response_data['data']['transfer']['utr'] ?></p>
                </div>
                <div class="receipt__block">
                    <label>Amount:</label>
                    <p><?php echo $response_data['data']['transfer']['amount'] ?></p>
                </div>
                <div class="receipt__block" style="text-align: center;">
                    <p class="text-center">Message : <?php echo $response_data['message'] ?></p>
                </div>
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
        
        bodye =  document.querySelector("body");
        
        window.print();
        
        bodye = document.querySelector("body");
    }
    
</script>


</body>
</html>