
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
<title>CONTACT US - Career</title>
<meta name="keywords" content="@@keywords" />
<meta name="description" content="@@description" />

<!-- Stylesheets -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<link rel="stylesheet" href="css/style.min.css">
<link rel="stylesheet" href="css/toastr.min.css">

</head>

<body>

   <?php include("header.php"); ?> 

    <section class="subBanner">
        <div class="subBanner__content">
            <div class="title animated" data-animation="appeared showBar" data-animation-delay="100">
                <h2 class="size36 animated" data-animation="appeared fadeInUp">Contact Us</h2>
            </div>
        </div>
        <div class="subBanner__image">
            <figure>
                <img
                    src="img/contact-banner.png" alt="graphics"
                    class="animated" data-animation="appeared show" data-animation-delay="1000" 
                >
            </figure>
        </div>
    </section>

    <section class="section light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="contactusPage">
                        <div class="formBox">
                            <h3 class="size30 reverse">Get in Touch </h3>
                            <form action="ajax.php" method="post" class="formBlock custom-form ajaxForm" id="contactForm"  enctype="multipart/form-data">
                                <input type="hidden" name="action" value="contact" />
                                <div class="form-group field">
                                    <input type="text" class="form-control input" placeholder="First Name" name="firstname" id="firstname">
                                </div>
                                <div class="form-group field">
                                    <input type="text" class="form-control input" placeholder="Last Name" name="lastname" id="lastname">
                                </div>
                                <div class="form-group field">
                                    <input type="text" class="form-control input" placeholder="Email" name="email" id="email" required>
                                </div>
                                <div class="form-group field">
                                    <input type="text" class="form-control input" placeholder="Mobile Number" name="mobile" id="mobile" required>
                                </div>
                                <div class="form-group field">
                                    <textarea class="form-control input" placeholder="Message" rows="3" name="message" id="message" required></textarea>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-md-5">
                                        <div class="btnBlock">
                                            <button type="submit" class="btn btn-primary no-redius btn-full">Contact Now!</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="infoBox">
                            <div class="infoBox__details">
                                <ul>
                                    <li>
                                        <img src="img/contact/map.png" alt="map">
                                        <span><?php echo $row['ADDRESS']; ?></span>
                                    </li>
                                    <li>
                                        <img src="img/contact/mobile.png" alt="mobile">
                                        <span><?php echo $row['SNUMBER']; ?></span>
                                    </li>
                                    <li>
                                        <img src="img/contact/clock.png" alt="clock">
                                        <span>9AM to 6PM (Monday to Saturday)</span>
                                    </li>
                                    <li>
                                        <img src="img/contact/envelope.png" alt="envelope">
                                        <span><?php echo $row['SEMAIL']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="touch__title">
                        <h2 class="heading-primary size36">Get in Touch</h2>
                    </div>
                    <form action="" class="formBlock custom-form">
                        <div class="form-group field">
                            <input type="text" class="form-control input" placeholder="Name">
                        </div>
                        <div class="form-group field">
                            <input type="text" class="form-control input" placeholder="Email">
                        </div>
                        <div class="form-group field">
                            <input type="text" class="form-control input" placeholder="Phone">
                        </div>
                        <div class="form-group field">
                            <textarea name="" class="form-control input" placeholder="Message" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="btnBlock">
                            <button class="btn btn-primary no-redius btn-full">Submit</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </section>
    
    <!-- <section class="contactLocation">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="contactLocation__title">
                        <h2 class="heading-primay size36 animated" data-animation="appeared fadeInUp" data-animation-delay="100">Our Location</h2>
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="contactLocation__address animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <i class="addressIcon"></i>
                        <p class="paragraph"></p>
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="contactLocation__address animated" data-animation="appeared fadeInUp" data-animation-delay="200">
                        <i class="emailIcon"></i>
                        <p class="paragraph"></p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<?php include("footer.php"); ?> 

    
    
    <!-- Javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="js/validate.min.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/typed.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/ScrollMagic.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script> -->
    <script src="js/animation.gsap.min.js"></script>
    <script src="js/app.min.js"></script>
    
</body>
</html>
