<?php 
include_once("directpay.php");
$directpay=new DirectPay();

$Secret_key="";


$hash="";

$transArr=[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $Secret_key = $_POST['Secret_key'];
    $transArr["MerchantID"] = $_POST['MerchantID'];
    $transArr["Amount"] = $_POST['Amount'];
    $transArr["CurrencyISOCode"]= $_POST['CurrencyISOCode'];
    $transArr["Language"]= $_POST['Language'];
    $transArr["MessageID"]= $_POST['MessageID'];
    $transArr["TransactionID"]= $_POST['TransactionID'];
    $transArr["ResponseBackURL"] = $_POST['ResponseBackURL'];

    $transArr["BankIdCode1"] = $_POST['BankIdCode1'];
    $transArr["ServiceAmount1"] = $_POST['ServiceAmount1'];
    $transArr["IBanNum1"] = $_POST['IBanNum1'];
    $transArr["BeneficiaryName1"] = $_POST['BeneficiaryName1'];
    $transArr["ValueDate1"] = $_POST['ValueDate1'];
    ksort($transArr);
    $hash= $directpay->generate_hash($transArr, $Secret_key);

    
}else{
    echo "wrong data";
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form id="myForm" action="https://paytest.directpay.sa/SmartRoutePaymentWeb/SRPayMsgHandler" method="post">
        <?php 
            
            foreach ($transArr as $key=>$value) {
                if($value!=null){
                     echo '<label>' . $key . '</label>';
                     echo '<input type="text" name="' . $key . '" value="'. $value .'"><br>';
                }
                
            }
            echo '<input type="text" name="SecureHash" value="'. $hash .'"><br>';
            echo '<input type="submit" value="Submit">';
           
        ?>
    </form>

    <!-- <script>
		window.onload = function() {
			document.getElementById('myForm').submit();
		}
	</script> -->
</body>
</html>