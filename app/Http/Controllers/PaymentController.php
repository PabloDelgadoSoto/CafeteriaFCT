<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TicketController;
use App\Models\Ingredientes_extra;
use App\Models\Elaboracion;
use App\Models\Ingrediente;
use Gloudemans\Shoppingcart\Facades\Cart;


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
        session(['hora' => $request->hora]);
        // Verifica el stock antes de pagar
        $items = Cart::content();
        foreach ($items as $item) {
            $extrasArray = explode(", ", $item->options->extras);
            foreach ($extrasArray as $extraName) {
                $extra = Ingredientes_extra::where('nombre', $extraName)->first();
                if ($extra) {
                    if ($extra->cantidad < $item->qty) {
                        return redirect()->back()->with('error', 'No hay suficiente stock de ' . $extraName);
                    }
                } else {
                    // Maneja el caso en que el extra no se encuentra
                }
            }

            $elaboraciones = Elaboracion::where('bocadillo_id', $item->id)->get();
            foreach ($elaboraciones as $elaboracion) {
                $ingrediente = Ingrediente::find($elaboracion->ingrediente_id);
                if ($ingrediente) {
                    if ($ingrediente->cantidad < $item->qty) {
                        return redirect()->back()->with('error', 'No hay suficiente stock del ingrediente: ' . $ingrediente->nombre);
                    }
                } else {
                    // Maneja el caso en que el ingrediente no se encuentra
                }
            }
        }

        // Si hay suficiente stock, procede con la compra
        $total = Cart::subtotal();

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
            $hora = session('hora');

            $request->merge([
                'date' => now(),
                'total' => $amount['total'],
                'user_id' => auth()->id(),
                'hora' => $hora

            ]);

            $ticketController = new TicketController();
            $ticketController->store($request);
        }

        // Redirige al usuario a la página de inicio
        return redirect()->route('home');
    }



    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Payment was cancelled');
    }
}
