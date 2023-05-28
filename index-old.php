<?php
include_once("directpay.php");


$directpay=new DirectPay();
$config = $directpay->getConfigurations();


$Secret_key=$config["authenticationToken"];
$MerchantID=$config["merchantID"];
$Amount="10";
$CurrencyISOCode="682";
$MessageID="1";
$TransactionID=substr(uniqid(), 0, 20);
$Language="en";
$ResponseBackURL="http://localhost:8000/result.php";
$BankIdCode1="";
$ServiceAmount1="";
$IBanNum1="";
$BeneficiaryName1="";
$ValueDate1="";



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DirectPay Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        body {
            background-color: #333;
            color: #fff;
        }
        .my-class{
            background-color: #fff;
            color: #000;
        }
        .my-span{
            color:green;
            margin:0;
        }
       
    </style>
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="column">
            <h1>DirectPay Demo</h1>
        </div>
    </div>
    <div class="row"></div>
    <div class="my-class row shadow p-3 mb-5 rounded">
        
        <div class="col-md-12">
        <form class="row g-3 " action="redirectpayment.php" method="POST">
        <h3>Merchant Credentials</h3>
            <span class="my-span">Use your own Test Merchant Credentials in Config.ini</span>
            <div class="col-md-6">
                <label for="Secret_key" class="form-label">Authentication Token</label>
                <input type="text" class="form-control" id="Secret_key"  name="Secret_key" value="<?php echo $Secret_key; ?>">
            </div>
            <div class="col-md-6">
                <label for="MerchantID" class="form-label">Merchant Id</label>
                <input type="text" class="form-control" id="MerchantID" name="MerchantID" value="<?php echo $MerchantID; ?>">
            </div>
            <hr class="my-4">
            <h3>Transaction details</h3>
            <span class="my-span">TransactionID is generated unquily everytime.</span>
            <div class="col-md-4">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo $Amount; ?>" />
            </div>
            <div class="col-md-4">
                <label for="CurrencyISOCode">Currency</label>
                <input type="text" class="form-control" id="CurrencyISOCode" name="CurrencyISOCode" value="<?php echo $CurrencyISOCode; ?>" />
            </div>
            <div class="col-md-4">
            <label for="Language">Language</label>
                <input type="text" class="form-control" id="Language" name="Language" value="<?php echo $Language; ?>" />
            </div>
            <div class="col-md-4">
            <label for="MessageID">Message ID</label>
                <input type="text" class="form-control" id="MessageID" name="MessageID" value="<?php echo $MessageID; ?>" />
            </div>
            <div class="col-md-4">
                <label for="TransactionID">Transaction ID</label>
                <input type="text" class="form-control" id="TransactionID" name="TransactionID" value="<?php echo $TransactionID; ?>" />
            </div>
            <div class="col-md-4">
            <label for="ResponseBackURL">Merchant ResponseBack URL</label>
                <input type="text" class="form-control" id="ResponseBackURL" name="ResponseBackURL" value="<?php echo $ResponseBackURL; ?>" />
            </div>
            <hr class="my-4">
            <h3>IBAN 1 Details</h3>
            <span class="my-span">Optional in case you need to test the payout</span>
            <div class="col-md-4">
                <label for="BankIdCode1">Bank Id Code 1</label>
                <input type="text" class="form-control" id="BankIdCode1" name="BankIdCode1" value="<?php echo $BankIdCode1; ?>" />
            </div>
            <div class="col-md-4">
                <label for="ServiceAmount1">Payout Amount 1</label>
                <input type="text" class="form-control" id="ServiceAmount1" name="ServiceAmount1" value="<?php echo $ServiceAmount1; ?>" />
            </div>
            <div class="col-md-4">
                <label for="IBanNum1">IBAN 1</label>
                <input type="text" class="form-control" id="IBanNum1" name="IBanNum1" value="<?php echo $IBanNum1; ?>" />
            </div>
            <div class="col-md-4">
                <label for="BeneficiaryName1">Beneficiary Name 1</label>
                <input type="text" class="form-control" id="BeneficiaryName1" name="BeneficiaryName1" value="<?php echo $BeneficiaryName1; ?>" />
            </div>
            <div class="col-md-4">
            <label for="ValueDate1">Transfer Date 1</label>
                <input type="text" class="form-control" id="ValueDate1" name="ValueDate1" value="<?php echo $ValueDate1; ?>" />
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Pay</button>
            </div>
        </form>
    </div>
    </div>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>