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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h3>Waite while getting redirected</h3>
    <form id="myForm" action="https://paytest.directpay.sa/SmartRoutePaymentWeb/SRPayMsgHandler" method="post">
        <?php 
            
            foreach ($transArr as $key=>$value) {
                if($value!=null){
                    
                     echo '<input type="hidden" name="' . $key . '" value="'. $value .'"><br>';
                }
                
            }
            echo '<input type="hidden" name="SecureHash" value="'. $hash .'"><br>';
        //  echo '<input type="submit" value="Submit">';
           
        ?>
    </form>

    <script>
		window.onload = function() {
			document.getElementById('myForm').submit();
		}
	</script>
</body>
</html>