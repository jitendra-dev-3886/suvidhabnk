
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
<title>ABOUT US - MiniAtm</title>
<meta name="keywords" content="@@keywords" />
<meta name="description" content="@@description" />

<!-- Stylesheets -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<link rel="stylesheet" href="css/style.min.css">

</head>
<body>
    
    <?php include("header.php"); ?>

    <section class="subBanner">
        <div class="subBanner__content">
            <div class="title animated" data-animation="appeared showBar" data-animation-delay="100">
                <h2 class="size36 animated" data-animation="appeared fadeInUp">About Us</h2>
            </div>
        </div>
        <div class="subBanner__image">
            <figure>
                <img
                    src="img/about-banner.png" alt="graphics"
                    class="animated" data-animation="appeared show" data-animation-delay="1000"
                >
            </figure>
        </div>
    </section>

    <section class="visionMission">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="visionMission__title">
                        <h1 class="heading-primary size46 animated" data-animation="appeared fadeInUp" data-animation-delay="100"><?php echo $row['WEBSITENAME']; ?> Mini Atm</h1>
                        <p class="animated" data-animation="appeared fadeInUp" data-animation-delay="200"><?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions is an Indian conglomerate specialising in Fin-Tech, E-Commerce, Retail, Internet and Technology, Founded in Feb 2019, sales services via web portals as well as electronic payment services, shopping search engines and cloud computing services. It owns and operates a diverse array of businesses across India in numerous sectors, and is named as one of the India's most admired companies by E-Commerce users. <?php echo $row['WEBSITENAME']; ?> Mini Atm is India's largest retailer and E-commerce company, one of the largest Internet and AI companies, one of the biggest venture capital firms.</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="visionMission__vision animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <figure class="fix-picture">
                            <img src="img/our-vision.png" />
                        </figure>
                        <div class="visionMission__vision--title">
                            <h3 class="heading-primay size30">Our Vision</h3>
                        </div>
                        <div class="visionMission__vision--text">
                            <p class="paragraph">Our vision is to change the way Southeast Asia transacts day to day, and to help local businesses in the region adopt technology in digital payments and mobile commerce to connect to a wider audience of customers</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="visionMission__mission animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <figure class="fix-picture">
                            <img src="img/our-mision.png" />
                        </figure>
                        <div class="visionMission__mission--title">
                            <h3 class="heading-primay size30">Our Mission</h3>
                        </div>
                        <div class="visionMission__mission--text">
                            <p class="paragraph">To make online payments simple, seamless &amp; secure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutContent">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="aboutContent__text">
                        <p class="paragraph">We provide the fundamental technology infrastructure and marketing reach to help merchants, brands and other businesses that provide products, services and digital content to leverage the power of the Internet to engage with their users and customers. Our businesses are comprised of core commerce, cloud computing, digital media and entertainment, innovation initiatives and others. Through invested affiliates, we also participate in the logistics and local services sectors. <?php echo $row['WEBSITENAME']; ?> Mini Atm is guided by principles like customer obsession rather than competitor focus, passion for invention, commitment to operational excellence, and long-term thinking. We are driven by the excitement of building technologies, inventing products, and providing services that change lives. We embrace new ways of doing things, make decisions quickly, and are not afraid to fail. We have the scope and capabilities of a large company, and the spirit and heart of a small one.Our mission is to be ECommerceʼs most customer- centric company. Our actions, goals, projects, programs and inventions begin and end with the customer top of mind.<br><br><?php echo $row['WEBSITENAME']; ?> Mini Atm is largest leading payment gateway that offers comprehensive payment services for customer and merchants. We offer mobile payment solutions to over 3 million merchants and allow consumers to make seamless mobile payments from Cards, Bank Accounts and Digital Credit among others. We pioneered and are the leader of QR based mobile payments in India. With the launch of <?php echo $row['WEBSITENAME']; ?> Mini Atm Payments system, we aim to bring banking and financial services to half-a-billion un-served and under-served Indians. We strive to maintain an open culture where everyone is a hands-on contributor and feels comfortable sharing ideas and opinions. Our team spends hours, designing each new feature and obsesses about the smallest of details.</p>
                    </div>
                </div>
            </div>
        </dic>
    </section>

    <section class="location">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="location__title">
                        <h2 class="heading-primay size36 animated" data-animation="appeared fadeInUp" data-animation-delay="100">Our Location</h2>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="location__address animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <i class="addressIcon"></i>
                        <p class="paragraph"><?php echo $row['ADDRESS']; ?></p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="location__address animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <i class="emailIcon"></i>
                        <p class="paragraph"><?php echo $row['SEMAIL']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

 <?php include("footer.php"); ?> 
    
    <!-- Javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="js/validate.min.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/typed.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/ScrollMagic.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script> -->
    <script src="js/animation.gsap.min.js"></script>
    <script src="js/app.min.js"></script>
    
</body>
</html>