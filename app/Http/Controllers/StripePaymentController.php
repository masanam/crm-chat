<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('stripe');
    }

    public function subscribe(): View
    {
        return view('subscribe');
    }


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        Stripe\Customer::create();

        Stripe\Charge::create([
            "amount" => 10 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from Customer."
        ]);

        return back()
            ->with('success', 'Payment successful!');
    }

    public function processPayment(Request $request)
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Create a customer
        $customer = Stripe\Customer::create();

        // Attach the payment method to the customer
        $paymentMethod = $this->createPaymentMethod($request->stripeToken);
        $paymentMethod->attach(['customer' => $customer->id]);

        // Create a PaymentIntent with the customer and payment method
        $paymentIntent = Stripe\PaymentIntent::create([
            'amount' => 1000, // Amount in cents
            'currency' => 'usd',
            'customer' => $customer->id,
            'payment_method' => $paymentMethod->id,
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        // Retrieve the client secret
        $clientSecret = $paymentIntent->client_secret;

        return response()->json(['client_secret' => $clientSecret]);
    }

    private function createPaymentMethod($token)
    {
        return Stripe\PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'token' => $token,
            ],
        ]);
    }
}
