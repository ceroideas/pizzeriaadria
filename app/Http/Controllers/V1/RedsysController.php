<?php

namespace App\Http\Controllers\V1;

include_once 'apiRedsys.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\V1\MakePaymentRequest;
use Ssheduardo\Redsys\Facades\Redsys;
use RedsysAPI;

class RedsysController extends Controller
{

    public function makePayment(MakePaymentRequest $request) {

        $miObj = new RedsysAPI;
        $miObj->setParameter("DS_MERCHANT_AMOUNT", 12);
        $miObj->setparameter("DS_MERCHANT_ORDER", 1446068581);
        $miObj->setparameter("DS_MERCHANT_MERCHANTCODE", 351267786);
        $miObj->setparameter("DS_MERCHANT_CURRENCY", '978');
        $miObj->setparameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
        $miObj->setparameter("DS_MERCHANT_TERMINAL", 1);
        $miObj->setparameter("DS_MERCHANT_EXPIRYDATE", $request->expirationDate);
        $miObj->setparameter("DS_MERCHANT_PAN", $request->cardNumber);
        $miObj->setparameter("DS_MERCHANT_CVV2", $request->ccv);
        $miObj->setparameter("DS_MERCHANT_IDENTIFIER", "REQUIRED");


        $miObj->setparameter("DS_MERCHANT_DIRECTPAYMENT", true); // Opcional

        $merchantParameters =  $miObj->createMerchantParameters();

        $claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
        $firma = $miObj->createMerchantSignature($claveSHA256);

        $requestData = [
             // 'Ds_MerchantParameters'  => Redsys::getMerchantParameters(  json_encode($merchantParameters)  ),
            'Ds_MerchantParameters' => $merchantParameters,
            'Ds_SignatureVersion' => "HMAC_SHA256_V1",
            'Ds_Signature' => $firma,
        ];

        // Realizar la petición
        $respuesta = Http::post(env('REDSYS_URL'), $requestData);

        dd($respuesta->body());
        dd($firma);

    }

}
