<?php
include_once("directpay.php");


$directpay = new DirectPay();

$result = $directpay->redirect_payment();
?>