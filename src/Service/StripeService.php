<?php

namespace App\Service;

use App\Entity\Produit;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeService
{
    private $privateKeys;

    public function __construct()
    {
        if($_ENV['APP_ENV'] == 'dev'){
            $this->privateKeys = $_ENV['STRIPE_SECRET_KEY_TEST'];
        }else{
            $this->privateKeys = $_ENV['STRIPE_SECRET_KEY_LIVE'];
        }
    }

    public function paymentIntent($total){
        Stripe::setApiKey($this->privateKeys);
        return PaymentIntent::create([
            "amount" => $total * 100,
            "currency" => "eur",
            "payment_method_types" => [
                "card"
            ]

        ]);
    }

    public function paiement($amount, $currency, $description, array $stripeParameter){
        Stripe::setApiKey($this->privateKeys);
        $payment_intent = null;
        if(isset($stripeParameter['stripeIntentId'])){
            $payment_intent = PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }
        if($stripeParameter['stripeIntentStatus'] == "succeeded"){
            // TODO
        }else{
            $payment_intent->cancel();
        }
        return $payment_intent;
    }
    public function stripe(array $stripeParameter, $total){
        return $this->paiement(
            $total * 100,
            'eur',
            "test",
            $stripeParameter
        );
    }
}