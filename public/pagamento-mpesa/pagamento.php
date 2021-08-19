<?php
    require_once('../vendor/autoload.php');
    use Paymentsds\MPesa\Client;


    $celular = $_POST['celular'];
    $valor = $_POST['valor'];
    $reference = $_POST['reference'];
    
    $client = new Client([
        'apiKey' => '', 
        'publicKey' =>'',
        'serviceProviderCode' => '171717'
    ]);

    if(!empty($celular) && !empty($valor) && !empty($reference)){
        $paymentData = [
            'from' => '258' . $celular,                 // input_CustomerMSISDN
            'reference' => $reference,          // input_ThirdPartyReference
            'transaction' => 'T12344CC',        // input_TransactionReference
            'amount' => $valor                  // input_Amount
        ]; 

        $result = $client->receive($paymentData);

        if ($result->success) {
            header('Location: home.php');
        } else {
            header('Location: index.php');
        }
    }else{
        echo "Preencha todos os campos do formulário";
    }
?>
