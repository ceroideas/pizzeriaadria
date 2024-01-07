<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\V1\MakePaymentRequest;
use Ssheduardo\Redsys\Facades\Redsys;

class RedsysController extends Controller
{


public function makePayment(MakePaymentRequest $request) {
    $order = time();
    Redsys::setAmount(123123);
    Redsys::setOrder($order);
    Redsys::setCurrency('978');
    Redsys::setMerchantcode(env('REDSYS_MERCHANT_CODE'));
    Redsys::setTerminal(env('REDSYS_TERMINAL'));
    Redsys::setTransactiontype('T');
    Redsys::setExpiryDate($request->expirationDate);
    Redsys::setPan($request->cardNumber);
    Redsys::setCVV2($request->ccv);

    // Generar la firma
    $signature = Redsys::generateMerchantSignature(env('REDSYS_KEY'));
    Redsys::setMerchantSignature($signature);

    // Construir el arreglo de datos
    $datosPago = [
        'DS_MERCHANT_AMOUNT' => 123123,
        'DS_MERCHANT_ORDER' => $order,
        "DS_MERCHANT_CURRENCY" => "978",
        "DS_MERCHANT_MERCHANTCODE" => env('REDSYS_MERCHANT_CODE'),
        'DS_MERCHANT_TERMINAL' => env('REDSYS_TERMINAL'),
        'DS_MERCHANT_TRANSACTIONTYPE' => 'T',
        "DS_MERCHANT_EXPIRYDATE" => $request->expirationDate,
        "DS_MERCHANT_PAN" => $request->cardNumber,
        "DS_MERCHANT_CVV2" => $request->ccv
    ];

    $datosPago = json_encode($datosPago);

    // $signature = hash_hmac("sha256", $datosPago, env('REDSYS_KEY')); // forma alternativa de generar la firma

    // Construir el arreglo final de datos para la petición
    $requestData = [
        'Ds_MerchantParameters'  => base64_encode($datosPago),
        'Ds_SignatureVersion' => Redsys::getVersion(),
        'Ds_Signature' => $signature,
    ];

    // Realizar la petición
    $respuesta = Http::post(env('REDSYS_URL'), $requestData);

    dd($respuesta->body());

    return 'Hello World';
}

public function makePayment3(MakePaymentRequest $request) {

    Redsys::setAmount(123123);
    Redsys::setOrder(time());
    Redsys::setCurrency('978');
    Redsys::setMerchantcode(env('REDSYS_MERCHANT_CODE'));
    Redsys::setIdentifier('REQUIRED');
    Redsys::setTerminal(env('REDSYS_TERMINAL'));
    Redsys::setTransactiontype('T');
    Redsys::setExpiryDate($request->expirationDate); // Asegúrate de que $request->expirationDate tenga el formato correcto
    Redsys::setPan($request->cardNumber);
    Redsys::setCVV2($request->ccv);
    // Agrega otros campos necesarios según la documentación de Redsys


        $datosPago = [

            'DS_MERCHANT_AMOUNT' => 123123,
            'DS_MERCHANT_ORDER' => 12345678,
            "DS_MERCHANT_CURRENCY" => "978",
            "DS_MERCHANT_MERCHANTCODE" => env('REDSYS_MERCHANT_CODE'),
            "DS_MERCHANT_IDENTIFIER" => 'REQUIRED',
            'DS_MERCHANT_TERMINAL' => env('REDSYS_TERMINAL'),

            'DS_MERCHANT_TRANSACTIONTYPE' => 'T',
            "DS_MERCHANT_EXPIRYDATE" => $request->expirationDate, // Format AAMM
            "DS_MERCHANT_PAN" => $request->cardNumber,
            "DS_MERCHANT_CVV2" => $request->ccv
        ];

    $signature = Redsys::generateMerchantSignature(env('REDSYS_KEY'));
    Redsys::setMerchantSignature($signature);

        //$test = base64_encode( json_encode($datosPago) );
        $test = json_encode($datosPago);
        dd(Redsys::getMerchantParameters($test));
    $requestData = [
        'Ds_MerchantParameters' => Redsys::getMerchantParameters($test),
        'Ds_SignatureVersion' => Redsys::getVersion(),
        'Ds_Signature' => $signature,
    ];


      return Redsys::executeRedirection();
    // $respuesta = Http::post(env('REDSYS_URL'), $requestData);

    // dd($respuesta->body());

    return 'Hello World';
}

    public function makePayment2(MakePaymentRequest $request) {

        $datosPago = [

            'DS_MERCHANT_AMOUNT' => 123123,
            'DS_MERCHANT_ORDER' => 12345678,
            "DS_MERCHANT_CURRENCY" => "978",
            "DS_MERCHANT_MERCHANTCODE" => env('REDSYS_MERCHANT_CODE'),
            "DS_MERCHANT_IDENTIFIER" => 'REQUIRED',
            'DS_MERCHANT_TERMINAL' => env('REDSYS_TERMINAL'),

            'DS_MERCHANT_TRANSACTIONTYPE' => 'T',
            "DS_MERCHANT_EXPIRYDATE" => $request->expirationDate, // Format AAMM
            "DS_MERCHANT_PAN" => $request->cardNumber,
            "DS_MERCHANT_CVV2" => $request->ccv
        ];

        $requestData = [
            'Ds_MerchantParameters' => base64_encode( json_encode($datosPago) ),
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'Ds_Signature' => $this->generarFirma($datosPago)
        ];


              $key = 'JrcKh4xhnFPm2s/z/3YOVHtEzApFZ6Oq';

              Redsys::setAmount(123);
              Redsys::setOrder(time());
              Redsys::setMerchantcode('346311483'); //Reemplazar por el código que proporciona el banco
              Redsys::setCurrency('978');
              Redsys::setTransactiontype('0');
              Redsys::setTerminal('1');
              Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
              // Redsys::setNotification(url('orden_pago?'.$args)); //Url de notificacion
              // Redsys::setUrlOk(url('completado')); //Url OK
              // Redsys::setUrlKo(url('error_pedido',$request->id_carrito)); //Url KO
              Redsys::setVersion('HMAC_SHA256_V1');
              Redsys::setTradeName('GrupoK2');
              Redsys::setTitular('GrupoK2');


              Redsys::setPan('4548812049400004'); //Número de la tarjeta
              Redsys::setExpiryDate('3412'); //AAMM (año y mes)
              Redsys::setCVV2('123'); //CVV2 de la tarjeta

              Redsys::setProductDescription('Compras por la aplicación');
              Redsys::setEnviroment('live'); //Entorno test

              $signature = Redsys::generateMerchantSignature($key);
              //Redsys::setMerchantSignature($signature);

              return Redsys::executeRedirection();

            // Redsys::setAmount(rand(10, 600));
            // Redsys::setOrder(time());
            // Redsys::setMerchantcode(env('REDSYS_MERCHANT_CODE'),); //Reemplazar por el código que proporciona el banco
            // Redsys::setCurrency('978');
            // Redsys::setTransactiontype('T');
            // Redsys::setTerminal(env('REDSYS_TERMINAL'),);
            // Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
            // //Redsys::setNotification(config('redsys.url_notification')); //Url de notificacion
            // // Redsys::setUrlOk(config('redsys.url_ok')); //Url OK
            // // Redsys::setUrlKo(config('redsys.url_ko')); //Url KO
            // Redsys::setVersion('HMAC_SHA256_V1');
            // Redsys::setTradeName('Tienda S.L');
            // Redsys::setTitular('Pedro Risco');
            // Redsys::setProductDescription('Compras varias');
            // Redsys::setEnviroment('test'); //Entorno test

            // $signature = Redsys::generateMerchantSignature(env('REDSYS_KEY'));
            //dd($signature);

        $respuesta = Http::post(env('REDSYS_URL'), $requestData);

        dd($respuesta->body());

        return 'Helllo WOrld';
    }

    public function generarFirma($datosPago) {
        // Paso 1: Codificar los datos en BASE64
        $datosCodificados = base64_encode(json_encode($datosPago));

        // Paso 2: Diversificar la clave de firma con 3DES
        $claveCodificada = base64_decode(env('REDSYS_KEY')); // Asegúrate de que redsys_key esté en BASE64
        //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('des-ede3-cbc'));
        $iv = $datosPago['DS_MERCHANT_ORDER'];
        //$claveDiversificada = openssl_encrypt($datosPago['DS_MERCHANT_ORDER'], 'des-ede3-cbc', $claveCodificada, 0, $iv);
        $claveDiversificada = openssl_encrypt($datosCodificados, 'des-ede3-cbc', $claveCodificada, 0, $iv);

        // Paso 3: Calcular el HMAC SHA256 con Ds_MerchantParameters y la clave diversificada
        $firma = hash_hmac('sha256', $datosCodificados, $claveDiversificada, true);

        // Paso 4: Codificar la firma en BASE64
        $firmaCodificada = base64_encode($firma);

        return $firmaCodificada;
    }
}
