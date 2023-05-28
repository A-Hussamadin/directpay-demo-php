<?php
class DirectPay{

    public $config;
    public $authenticationToken;
    public $merchantID;
    public $create_invoice_url;
    public $inquiry_invoice_url;
    public $refund_invoice_url;
    public $payment_refund_inquiry_url;
    public $payment_url;

    public function __construct() {
       $this->config = parse_ini_file('config.ini', true);
        $this->authenticationToken = $this->config['authenticationToken'];
        $this->merchantID = $this->config['merchantID'];
        $this->create_invoice_url = $this->config['create_invoice_url'];
        $this->inquiry_invoice_url = $this->config['inquiry_invoice_url'];
        $this->refund_invoice_url = $this->config['refund_invoice_url'];
        $this->payment_refund_inquiry_url = $this->config['payment_refund_inquiry_url'];
        $this->payment_url = $this->config['payment_url'];
    }
    
    public function  getConfigurations(){
        return $this->config;
    }


    //return the hash
    public function generate_hash($transactiondetails, $Secret_key){
        
        $orderString = $Secret_key;

        foreach($transactiondetails as $key => $value){
          
            if($value!=null){
                $orderString .=$value;
            }
            
        }

        print_r($orderString);
        echo "\n";

       // $sha256Hex = hash('sha256',$orderString,false);
       // $binaryHash = hex2bin($sha256Hex);
       // $hash = bin2hex($sha256Hex);
       $hash = hash('sha256', $orderString);
        print_r($hash);
        echo "\n";
        return $hash;
    }

    public function create_invoice(){

        $inoviceID= (string)rand(1, 1000000); 

        
        $data = [
            "authenticationToken" => $this->config['authenticationToken'],
            "merchantID" => $this->config['merchantID'],
            "invoicesDetails" => [
                [
                    "currency" => "682",
                    "expiryperiod" => "3D",
                    "customerEmailAddress" => "h.abushelha@gmail.com",
                    "paymentDescription" => "Test invoice",
                    "dynamicFields" => [
                        [
                            "itemID" => "1"
                        ]
                    ],
                    "language" => "ar",
                    "amount" => "10",
                    "invoiceID" => $inoviceID,
                    "customerID" => "1234567",
                    "customerMobileNumber" => "0597185778"
                ]
            ]
        ];
        
            $invoices = json_encode($data, JSON_UNESCAPED_SLASHES);
            //$inovices = array("invoices"=> $inovices_data);
            $invoices_data= 'invoices='.$invoices;
         //   print_r($invoices_data);
          //  exit();
            $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $this->config['create_invoice_url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $invoices_data,

        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Accept-Language: application/json',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    print_r($response);
     curl_close($curl);
    // var_dump($response);
   //  exit();
     $data = json_decode($response, true);
    print_r($data);
    // $result = $this->getResult($data['trandata']);
    // return $result;

    $paymentlink = $data['invoicesDetails'][0]['paymentLink'];
    header('Location: '.$paymentlink);

    }

    public function redirect_payment(){


        $transactionID= (string)rand(1, 1000000); 


        $data = [
            "authenticationToken" => $this->config['authenticationToken'],
            "merchantID" => $this->config['merchantID'],
            "messageID"=>"1",
            "transactionID"=>$transactionID,
            "amount"=> "100",
            "currencyISOCode"=>"682",
            "responseBackURL"=>"http://localhost:8000/result.php"
        ];


        $ionvices = json_encode($data, JSON_UNESCAPED_SLASHES);
        print_r($ionvices);
      //  exit();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config['payment_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ionvices,

            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Accept-Language: application/json',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        print_r($response);
        curl_close($curl);
    }



}





?>