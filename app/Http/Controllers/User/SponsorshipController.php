<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Braintree;
class SponsorshipController extends Controller
{
    public function index(Apartment $apartment) {

        $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();
    return view('users.sponsorships', [
        'token' => $token,
        'apartment' => $apartment,
    ]);
    }

    public function checkout (Request $request) {
        $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $amount = $request["amount"];
    $nonce = $request["payment_method_nonce"];

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => 'Johnny',
            'lastName' => 'Stecchino',
            'email' => 'johnny@stecchino.it',
        ],
        'options' => [
            'submitForSettlement' => true
        ]
]); 

if ($result->success) {
    $transaction = $result->transaction;
    return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
} else {
    $errorString = "";

    foreach($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }

/*     $_SESSION["errors"] = $errorString;
    header("Location: " . $baseUrl . "index.php"); */
    return back()->withErrors('An error occurred with the message: ' . $result->message);
}
    }
}