<?php
session_start();
include_once("directpay.php");




$total_quantity = 0;
$total_price = 0;

foreach ($_SESSION["cart_item"] as $item){
    $item_price = $item["quantity"]*$item["price"];
    $total_quantity += $item["quantity"];
    $total_price += ($item["price"]*$item["quantity"]);
    }

    $directpay=new DirectPay();

    $Secret_key="";
    
    
    $hash="";
    
    $transArr=[];

    $config = $directpay->getConfigurations();


    $Secret_key=$config["authenticationToken"];
    $MerchantID=$config["merchantID"];
    $Amount=$total_price;
    $CurrencyISOCode="682";
    $MessageID="1";
    $TransactionID=substr(uniqid(), 0, 20);
    $Language="en";
    $ResponseBackURL="http://localhost:8000/result.php";


    $transArr["MerchantID"] = $MerchantID;
    $transArr["Amount"] = $Amount;
    $transArr["CurrencyISOCode"]= $CurrencyISOCode;
    $transArr["Language"]= $Language;
    $transArr["MessageID"]= $MessageID;
    $transArr["TransactionID"]= $TransactionID;
    $transArr["ResponseBackURL"] = $ResponseBackURL;


    ksort($transArr);
    $hash= $directpay->generate_hash($transArr, $Secret_key);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog - SoftLand Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: SoftLand
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="index.php">DirectPay</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
     
      
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="hero-section inner-page">
      <div class="wave">

        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-7 text-center hero-text">
                <h1 data-aos="fade-up" data-aos-delay="">Directpay Demo</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Direct Pay has a specialized solution for you. Whether you operate large business with sophisticated integration requirements, or an ambitious small business entrepreneur, we at Direct Pay are specialized in enabling our partners for secure and trusted payment services through major payment channels (credit card, Mada, Sadad).</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">

        <div class="row justify-content-center text-center">
          <div class="col-md-7 mb-5">
            <h2 class="section-heading">Choose Payment Method</h2>
            <p>Directpay provides different type of integration, for the merchant convenint</p>
          </div>
        </div>
        <div class="row align-items-stretch">

          <div class="col-lg-15 mb-12 mb-lg-0">
            <div class="pricing h-100 ">

            <form id="myForm"  action="https://paytest.directpay.sa/SmartRoutePaymentWeb/SRPayMsgHandler" method="post">
                <?php 
                    
                    foreach ($transArr as $key=>$value) {
                        if($value!=null){
                            
                            echo '<input type="hidden" class="form-control" id="'. $key.'" name="' . $key . '" value="'. $value .'"><br>';
                        }
                        
                    }
                    echo '<input type="hidden" id="SecureHash" class="form-control"  name="SecureHash" value="'. $hash .'"><br>';

             
                
                ?>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="CardNumber">Card Number</label>
                        <input type="text" name="CardNumber" class="form-control" id="CardNumber" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="CardHolderName">Card Holder Name</label>
                        <input type="text" name="CardHolderName" class="form-control" id="CardHolderName" >
                    </div>

                    
                    <div class="col-md-6 form-group">
                        <label for="ExpiryDateYear">Expiry Year</label>
                        <input type="text" name="ExpiryDateYear" class="form-control"  id="ExpiryDateYear" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="ExpiryDateMonth">Expiry Month</label>
                        <input type="text" name="ExpiryDateMonth" class="form-control" id="ExpiryDateMonth" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="SecurityCode">CVV</label>
                        <input type="text" name="SecurityCode" class="form-control" id="SecurityCode" >
                    </div>
                
                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-primary d-block w-100" value="Pay Now">
                    </div>
                </div>
                </form>
              


            </div>
          </div>
          
          
    </section>

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 me-auto text-center text-md-start mb-5 mb-md-0">
            <h2>Welcome to Directpay</h2>
          </div>
          <div class="col-md-5 text-center text-md-end">
            <p></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <h3>About Directpay</h3>
          <p>Direct Pay has a specialized solution for you. Whether you operate large business with sophisticated integration requirements, or an ambitious small business entrepreneur, we at Direct Pay are specialized in enabling our partners for secure and trusted payment services through major payment channels (credit card, Mada, Sadad).</p>
          <p class="social">
            <a href="#"><span class="bi bi-twitter"></span></a>
            <a href="#"><span class="bi bi-facebook"></span></a>
            <a href="#"><span class="bi bi-instagram"></span></a>
            <a href="#"><span class="bi bi-linkedin"></span></a>
          </p>
        </div>
        <div class="col-md-7 ms-auto">
          <div class="row site-section pt-0">
            <div class="col-md-4 mb-4 mb-md-0">
              <h3>Navigation</h3>
              <ul class="list-unstyled">
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              <h3>Services</h3>
              <ul class="list-unstyled">
                <li><a href="#">Team</a></li>
                <li><a href="#">Collaboration</a></li>
                <li><a href="#">Todos</a></li>
                <li><a href="#">Events</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center text-center">
        <div class="col-md-7">
          <p class="copyright">&copy; Copyright Directpay. All Rights Reserved</p>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=SoftLand
          -->
           
          </div>
        </div>
      </div>

    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>