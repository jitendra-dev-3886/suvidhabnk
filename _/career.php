
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
<title>CAREERS - Career</title>
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
                <h2 class="size36 animated" data-animation="appeared fadeInUp">Careers</h2>
            </div>
        </div>
        <div class="subBanner__image">
            <figure>
                <img
                    src="img/career-banner.png" alt="graphics"
                    class="animated" data-animation="appeared show" data-animation-delay="1000"
                >
            </figure>
        </div>
    </section>

    <section class="career">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="pjd__title">
                        <h1 class="heading-primary size46 animated" data-animation="appeared fadeInUp" data-animation-delay="100">Building the Future of Payments</h1>
                        <p class="animated" data-animation="appeared fadeInUp" data-animation-delay="200"><?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions is a truly 'Indian' payments company serving the offline retailers and businesses. We empower the merchants to accept UPI payments for through the <?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions QR. Merchants can sign up instantly and start receiving the funds immediately in their bank account. <?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions makes payment acceptance simple by offering merchants a single interface for all UPI apps such as PayTM, PhonePe, Google Pay, BHIM, Mobikwik, Freecharge, True Caller and 100 other UPI apps. <?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions is a fin-tech company and not a re-seller. We are not an aggregator or payment gateway in the traditional sense. <?php echo $row['WEBSITENAME']; ?> SMB Mitra Solutions works closely with our partner banks to develop custom APIs to enable an extremely simple product for the merchants. Our QR technology and deep integration at the bank end is our secret sauce.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="careerCard">
        <div class="container">
            <div class="careerCardPattern">
                <div class="careerCard__title">
                    <h1 class="heading-primary size46 animated" data-animation="appeared fadeInUp" data-animation-delay="100">See where you fit in</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-5 d-flex">
                        <div class="careerCard__block animated" data-animation="appeared fadeInUp" data-animation-delay="200" data-name="Marketing">
                            <figure class="fix-picture">
                                <img src="img/career-marketing.png" alt="">
                            </figure>
                            <h4 class="heading-primary size21">Marketing</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5 d-flex">
                        <div class="careerCard__block animated" data-animation="appeared fadeInUp" data-animation-delay="300" data-name="Technology">
                            <figure class="fix-picture">
                                <img src="img/career-technology.png" alt="">
                            </figure>
                            <h4 class="heading-primary size21">Technology</h4>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="careerForm">
                            <h2 class="size40 text-center">Fill Required Details</h2>
                            <form action="ajax.php" method="post" class="formBlock custom-form ajaxForm" id="careerForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="career" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" placeholder="Position" name="position" id="position">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" id="department" placeholder="Department" name="department" id="department">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" placeholder="Name" name="car_name" id="car_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" placeholder="Email" name="car_email" id="car_email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" placeholder="Mobile Number" name="car_mobile" id="car_mobile">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <input type="text" class="form-control input" placeholder="Current Company" name="current_company" id="current_company">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group field">
                                            <label for="upload_resume">Upload resume</label>
                                            <input type="file" class="form-control input" placeholder="Upload Latest Resume" name="upload_resume" id="upload_resume">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <figure>
                                            <img src="img/captcha.jpg" alt="">
                                        </figure> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="btnBlock">
                                            <button type="submit" class="btn btn-primary no-redius btn-full">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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