<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51IXkSpCm8y7Wcgvv5kmlxqoiqikN7kpMSo2UR5OboxcHAybFzuzrzsyx00Ooy64t23XzoLU2traWzYc20jPr1R2b00n6gtQhBq');
        		
		$amount = 200;
		$amount *= 200;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From Codehunger',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

		return view('checkout.credit-card',compact('intent'));

    }

    // public function after_payment()
    // {
    //     //echo 'Payment Has been Received';
    //     return view('checkout.sucess');
    // }
}
