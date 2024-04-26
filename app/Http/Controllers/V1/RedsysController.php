<?php

namespace App\Http\Controllers\V1;

include_once 'apiRedsys.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\V1\MakePaymentRequest;
use Ssheduardo\Redsys\Facades\Redsys;

use App\Models\Order;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Resources\V1\OrderResource;

class RedsysController extends Controller
{

    public function makePayment(MakePaymentRequest $request) {

        $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';

        Redsys::setAmount($request->amount);
        Redsys::setOrder(time());
        Redsys::setMerchantcode('351267786'); //Reemplazar por el código que proporciona el banco
        Redsys::setCurrency('978');
        Redsys::setTransactiontype('0');
        Redsys::setTerminal('1');
        Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
        Redsys::setNotification(url('/api/v1/noti?order_id='.$request->order_id)); //Url de notificacion
        Redsys::setUrlOk(url('/completado')); //Url OK
        Redsys::setUrlKo(url('/error_pedido')); //Url KO
        Redsys::setVersion('HMAC_SHA256_V1');
        Redsys::setTradeName('Pizzeria Adria');
        Redsys::setTitular('Pizzeria Adria');

        /*Redsys::setPan($request->cardNumber); //Número de la tarjeta
        Redsys::setExpiryDate($request->expirationDate); //AAMM (año y mes)
        Redsys::setCVV2($request->ccv); //CVV2 de la tarjeta*/

        Redsys::setEnvironment('test'); //Entorno test

        $signature = Redsys::generateMerchantSignature($key);
        Redsys::setMerchantSignature($signature);

        $form = Redsys::createForm();

        return view('redsys',compact('form'));

        return Redsys::executeRedirection();

    }

    public function noti(Request $request)
    {
        $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
        $parameters = Redsys::getMerchantParameters($request->input('Ds_MerchantParameters'));
        $DsResponse = $parameters["Ds_Response"];
        $DsResponse += 0;

        \Log::info($parameters);

        if (Redsys::check($key, $request->input()) && $DsResponse <= 99) {
            // lo que quieras que haya si es positiva la confirmación de redsys

            $order = Order::find($request->order_id);
            $order->status = 2;
            $order->save();

        } else {
            //lo que quieras que haga si no es positivo

            $order = Order::find($request->order_id);
            $order->status = 0;
            $order->save();

        }
    }

    public function migrar()
    {
        Schema::table('orders', function(Blueprint $table) {
            //
            $table->string('type')->nullable();
            $table->string('hour')->nullable();
            $table->string('day')->nullable();
            $table->string('address')->nullable();
        });
    }

}
