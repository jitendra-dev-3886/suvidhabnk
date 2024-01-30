<?php
require_once('../Db/config.php');
$id=$_GET["id"];
$fetchurl = $con->query("SELECT * FROM `blog` WHERE ID = '$id'")->fetch_assoc();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  

  <title>Paydeer Blogs - Need to you know </title>
  <meta content="Have a look at what is BBPS services and everything you must have an idea about BBPS services and the kind of BBPS services that we are offering in India." name="description">
  <meta content="" name="keywords">
<link rel="shortcut icon" href="favicon.svg" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- Template Main CSS File -->
  
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
<link href="../css/blog.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: Paydeer - v1.2.1
  * Template URL: https://bootstrapmade.com/Paydeer-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7WCG9NYPN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T7WCG9NYPN');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-221712912-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-221712912-1');
</script>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '516647973417145');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=516647973417145&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<!-- Twitter universal website tag code -->
<script>
!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
// Insert Twitter Pixel ID and Standard Event data below
twq('init','o89sw');
twq('track','PageView');
</script>
<!-- End Twitter universal website tag code → -->

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Corporation",
  "name": "Paydeer Services Private Limited",
  "alternateName": "Paydeer Services Pvt. Ltd.",
  "url": "https://paydeer.in",
  "logo": "https://paydeer.in/images/Logo/PaydeerLogo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+917428274282",
    "contactType": "technical support",
    "areaServed": "IN",
    "availableLanguage": "en"
  },
  "sameAs": [
    "https://www.facebook.com/Paydeer.business",
    "https://twitter.com/paydeerindia",
    "https://instagram.com/Paydeer.business",
    "https://www.youtube.com/channel/UCW01CsZteJbZKRExzYLJsnQ",
    "https://www.linkedin.com/company/paydeer",
    "https://in.pinterest.com/paydeer/"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What are the benefits of using m-ATM at Paydeer Services?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Through Paydeer micro ATM, you can now convert your shop into a mini ATM and earn profit by fulfilling the financial needs of the people. Can do the following things with the help of Paydeer Micro ATM.

• Verifying customer’s biometric identity
• Deposit and withdraw money from the bank account
• Printed transaction receipt
• Find out the balance information in the account
• Can get a mini statement
• Fund transfer from one account to another
• Recharge and bill payment facility"
    }
  },{
    "@type": "Question",
    "name": "What are the benefits and advantages of using AEPS services at Paydeer Services?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "AEPS payment system is straightforward and fast. Paydeer AEPS service is safe, secure and you can pay through it anytime from anywhere.

• Convenient to use
• Safe and secure payment
• Provide financial services of various banks
• It provides financial assistance to people in remote areas with fewer banking facilities.
• Through PAYDEER AEPS, all bank account holders will be able to access their bank accounts through Aadhaar authentication.
• PAYDEER is elementary only Aadhar numbers, and biometric information are required.
• Based on PAYDEER AEPS, you can now facilitate various Central or State Government schemes."
    }
  }]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://paydeer.in/blog/aadhaar-enabled-payment-system/"
  },
  "headline": "Aadhaar Enabled Payment System- Everything You Should Know About It",
  "description": "AePS or Aadhaar enabled payment system is a payment mechanism through which an Aadhaar cardholder can perform banking transactions. It is an initiative that empowers all the sections of society by letting them perform banking transactions through an Aadhaar card.",
  "image": "https://paydeer.in/images/Logo/PaydeerLogo.png",  
  "author": {
    "@type": "Organization",
    "name": "Paydeer"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "Paydeer",
    "logo": {
      "@type": "ImageObject",
      "url": "https://paydeer.in/images/Logo/PaydeerLogo.png"
    }
  },
  "datePublished": "2022-04-21",
  "dateModified": "2022-04-21"
}
</script>

<!-- Facebook OG tags code → -->
<meta property="og:url" content="https://paydeer.in/blog" />
<meta property="og:site_name" content="blog" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Paydeer Blogs - Need to you know " />
<meta property="og:description" content="In paydeer blog you will be able to know about paydeer services, what is new in paydeer and many more" />
<meta property="og:image" content="https://paydeer.in/images/Logo/PaydeerLogo.png" />
<meta property="og:image:secure_url" content="https://paydeer.in/images/Logo/PaydeerLogo.png" />
<meta property="og:image:width" content="2000" />
<meta property="og:image:height" content="333" />
<meta property="og:image:alt" content="services" />
<!--Twitter Card tag code → -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@paydeer" />
<meta name="twitter:creator" content="Webspidy" />
<meta name="twitter:title" content="Paydeer Services - Money Transfer| AEPS| Recharges| Insyurance | Loans " />
<meta name="twitter:description" content="Paydeer offer sequre and fast money transfer, AEPS, Insurance, Loans and Finance service in all over india." /> 

<link rel="canonical" href="https://paydeer.in/blog" />

<style>
        #div1 {
            width:23.33%;
            float:Right;
        }
        #div2 {
            width:23.33%;
            float:Left;
        }
        #div3 {
            width:53.33%;
            margin: 0 auto;
        }
      #blog_text,.blog_dec,#blog_text span{
        font-size: 20px !important;
        font-family: 'Ubuntu', sans-serif !important;
        font-weight:400 !important;
        letter-spacing:0.2px;
        line-height:30px;
        }
      
    </style>
  
</head>

<body>

  <!-- ======= Top Bar ======= -->
  
  <!-- ======= Header ======= -->
   <?php include('../topheader.php');?>
    <br>
    <center>
         <?php
        
                $res = $con->query("SELECT * FROM `blog` WHERE ID = '$id'");
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                    // $did = $row['ID'];
          ?>
    <div class = "container" id="div3">
    <article id="bbps">
		<img src="../admin/assets/Blog/<?php echo $row['IMAGE'] ?>" alt="bbps" width="900" height="700">	
    <br><br>
			
			
	<div class="standard-content">
		<div class="standard-main-content entry-content" id="div4">
			<div class="post-entry standard-post-entry classic-post-entry blockquote-style-1" id="blog_text">
			<p><h1><b><center><?php echo $row['TITLE'] ?></center></b></h1><br>
		    <p class="blog_dec"><?php echo $row['RICH_TEXT'] ?><br></p>
		    </div>
           </div>
		</div>
	</div>
	</article>
    </div>
    <?php
                    }
                }
                ?>
    </center>

  
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('../Footer.php');?>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>