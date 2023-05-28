<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

// if(!empty($_POST["action"])) {
//     switch($_POST["action"]) {
//         case "add":
//             if(!empty($_POST["quantity"])) {
//                 $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
//                 $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
                
//                 if(!empty($_SESSION["cart_item"])) {
//                     if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
//                         foreach($_SESSION["cart_item"] as $k => $v) {
//                                 if($productByCode[0]["code"] == $k) {
//                                     if(empty($_SESSION["cart_item"][$k]["quantity"])) {
//                                         $_SESSION["cart_item"][$k]["quantity"] = 0;
//                                     }
//                                     $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
//                                 }
//                         }
//                     } else {
//                         $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
//                     }
//                 } else {
//                     $_SESSION["cart_item"] = $itemArray;
//                 }
//             }
//         break;
//         case "remove":
//             if(!empty($_SESSION["cart_item"])) {
//                 foreach($_SESSION["cart_item"] as $k => $v) {
//                         if($_POST["code"] == $k)
//                             unset($_SESSION["cart_item"][$k]);				
//                         if(empty($_SESSION["cart_item"]))
//                             unset($_SESSION["cart_item"]);
//                 }
//             }
//         break;
//         case "empty":
//             unset($_SESSION["cart_item"]);
//         break;	
//     }
//     }
    $total_quantity = 0;
    $total_price = 0;
if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item){
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
    }
}
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
        <div class="row">
            <div class="col d-flex flex-row-reverse bd-highlight">
            <a class="active"  href="cart.php"> <i class="bi bi-cart"></i> Cart <span class="badge text-bg-danger"><?php echo $total_quantity;?></span>
            </div>
        </div>
        <div class="row mb-5">
        <?php
	        $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	        if (!empty($product_array)) { 
		    foreach($product_array as $key=>$value){
	?>

          <div class="col-md-4">
          <form method="post" action="addtocart.php">
             <input type="hidden" name="action" value="add"/>
             <input type="hidden" name="code" value="<?php echo $product_array[$key]["code"]; ?>"/>
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="<?php echo $product_array[$key]["image"]; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="post-text">
                <span class="post-meta">December 13, 2019 &bullet; By <a href="#">Admin</a></span>
                <h3><a href="#"><?php echo $product_array[$key]["name"]; ?></a></h3>
                <p><?php echo "$".$product_array[$key]["price"]; ?></p>
                <p><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></p>
              </div>
            </div>
            </form>
          </div>
          <?php
                }
            }
            ?>
          
          

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