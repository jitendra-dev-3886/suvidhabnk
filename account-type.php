<?php
    include("dashboard/includes/config.php");
    $res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
    $row = $res->fetch_assoc();
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Page Icons -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Page Title -->
        <title>Rc Portal Home</title>

        <!-- Stylesheets -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/style.min.css"> -->

        
<!-- Stylesheets -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<!-- 
<link rel="stylesheet" href="css/fontawsome.css">
<link rel="stylesheet" href="css/fontawsome.min.css"> -->


<link rel="stylesheet" href="css/style.min.css">
<link rel="stylesheet" href="css/login.min.css">
    </head>
    
    <body class="shape-bg">
        <header class="header">
            <div class="header__logo">
                <a href="https://www.MiniAtm.in/" target="_blank">
                    <img src="images/<?php echo $row['LOGO']; ?>" alt="MiniAtm">
                </a>
            </div>

            <div class="header__menu">
                <a href="javascript:;">Recharge</a>
                <span class="divider">|</span>
                <a href="javascripe:;">AEPS</a>
                <span class="divider">|</span>
                <a href="javascript:;">DMT</a>
                <span class="divider">|</span>
                <a href="javascript:;">PANCARD (UTI / NSDL)</a>
                <span class="divider">|</span>
                <a href="javascript:;">BBPS</a>
            </div>
            <br>
            <div class="header__menu">
                <a href="javascript:;">INSURANCE | FLIGHT / RAIL / BUS TICKET BOOKING</a>
                <!--<span class="divider">|</span>-->
            </div>
        </header>

        <div class="container">
            <div class="pannelBoxes">                
                <a href="login.php" class="pannelBoxes__link animated" data-animation="appeared show" data-animation-delay="200" onclick="{ document.getElementById('frmLoginMasterDistributor').submit(); }">
                    <figure><img src="img/log1.jpeg" alt="icon" style="max-width: 42rem; height: 185px; max-height: 208px;"></figure>
                    <p>Retailer</p>
                    <form id="frmLoginMasterDistributor" action="login.php" method="post">
                        <input type="hidden" id="hfLoginType" name="hfLoginType" value="master distributor" />
                    </form>
                </a>                
                <a href="login.php" class="pannelBoxes__link animated" data-animation="appeared show" data-animation-delay="200" onclick="{ document.getElementById('frmLoginMasterDistributor').submit(); }">
                    <figure><img src="img/dth-2.jpg" alt="icon" style="max-width: 32rem; height: 185px; max-height: 208px;"></figure>
                    <p>Distributor</p>
                    <form id="frmLoginMasterDistributor" action="login.php" method="post">
                        <input type="hidden" id="hfLoginType" name="hfLoginType" value="master distributor" />
                    </form>
                </a>                
            
                <a href="login.php" class="pannelBoxes__link animated" data-animation="appeared show" data-animation-delay="400" onclick="{ document.getElementById('frmLoginDistributor').submit(); }">
                    <figure><img src="img/domestic.jpeg" alt="icon" style="max-width: 30rem;"></figure>
                    <p>Master  Distributor</p>
                    <form id="frmLoginDistributor" action="login.php" method="post">
                        <input type="hidden" id="hfLoginType" name="hfLoginType" value="distributor" />
                    </form>
                </a>
            
                <a href="login.php" class="pannelBoxes__link animated" data-animation="appeared show" data-animation-delay="600" onclick="{ document.getElementById('frmLoginRetailer').submit(); }">
                    <figure><img src="img/4-bps.jpeg" alt="icon" style="max-width: 29rem;"></figure>
                    <p>White Lable</p>
                    <form id="frmLoginRetailer" action="login.php" method="post">
                        <input type="hidden" id="hfLoginType" name="hfLoginType" value="retailer" />                            
                    </form>
                </a>                
            
                <a href="login.php" class="pannelBoxes__link animated" data-animation="appeared show" data-animation-delay="800" onclick="{ document.getElementById('frmLoginAPILogin').submit(); }">
                    <figure><img src="img/pan.jpeg" alt="icon" style="max-width: 32rem;"></figure>
                    <p>API Login</p>
                    <form id="frmLoginAPILogin" action="login.php" method="post">
                        <input type="hidden" id="hfLoginType" name="hfLoginType" value="api_login" />
                    </form>
                </a>                
            </div>
        </div> 

        <footer class="footer">
            <div class="container">
                <div class="footer__grid">
                    <div class="footer__copyright">
                        &copy; Copyright 2021 MiniAtm. All right Reserved.
                    </div>
                    <div class="footer__links">
                        <a href="javascript:;">Recharge</a>
                        <a href="javascripe:;">Bill Payment</a>
                        <a href="javascript:;">DMT</a>
                    </div>
                </div>
            </div>
        </footer>
<!-- 
        <div class="siteLoaderWrap">
            <div class="siteLoaderWrap__container">
                <div class="spinner1"></div>
                <div class="spinner2"></div>
                <div class="spinner3"></div>
                <div class="spinner4"></div>
                <div class="spinner5"></div>
            </div>
        </div> -->

        <!-- Javascripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/appear.js"></script>
        <script src="js/functions.js"></script>
        <script src="js/app.min.js"></script>

    </body>
    
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var 
        s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/<?php echo $row['CHATID']; ?>/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    
</html>