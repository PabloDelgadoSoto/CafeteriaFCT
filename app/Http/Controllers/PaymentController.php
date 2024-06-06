<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Controllers\CartController;

class PaymentController extends Controller
{
    private $gateway;


    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
{
    try {

        $cart = new CartController();
        $total = $cart->getTotal();

        $response = $this->gateway->purchase([
            'amount' => $total,
            'currency' => env('PAYPAL_CURRENCY'),
            'returnUrl' => route('payment.success'),
            'cancelUrl' => route('payment.cancel'),


        ])->send();



        if ($response->isRedirect()) {
            // Redirige al usuario a PayPal
            return $response->redirect();
        } else {
            return $response->getMessage();
        }
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

public function success(Request $request)
{
    $transactionId = $request->get('paymentId');
    $payerId = $request->get('PayerID');

    if ($transactionId && $payerId) {
        $response = $this->gateway->completePurchase([
            'transactionReference' => $transactionId,
            'payerId' => $payerId,
        ])->send();

        $data = $response->getData();

        if ($response->isSuccessful()) {

            $amount = $data['transactions'][0]['amount'];
            $payerEmail = $data['payer']['payer_info']['email']; // Asume que el correo electrónico del pagador está disponible aquí

            // Guarda los datos en la base de datos
            $payment = new Payment();
            $payment->payment_id = $transactionId;
            $payment->payer_id = $payerId;
            $payment->payer_email = $payerEmail;
            $payment->amount = $amount['total'];
            $payment->currency = $amount['currency'];
            $payment->payment_status = 'completed'; // Asumiendo que el estado de pago es 'completed'
            $payment->save();
        }
    }

    // Redirige al usuario a la página de inicio
    return redirect('/');
}

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Payment was cancelled');
    }
}
