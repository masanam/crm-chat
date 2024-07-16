<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterEmail;
use App\Models\User;
use App\Models\Profile;

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

    //     dd($request);
    //     "_token" => "jGlL4cArdJR3Ofh87LOxNBho3oZzgePX6SOzwDHa"
    //   "email" => "anto@gmail.com"
    //   "first_name" => "masanam"
    //   "last_name" => "Tokyo"
    //   "phone_number" => "0987654321"
    //   "company" => "PT. ABC"
    //   "job" => "IT"
    //   "industry" => "IT"
    //   "team_number" => "10"
    //   "new_password" => "12345678"
    //   "card_number" => "4242 4242 4242 4242"
    //   "exp_month" => "12"
    //   "exp_year" => "2028"
    //   "security_code" => "123"
    //   "firstName" => "Joko"
    //   "lastName" => "Wardoyo"
    //   "emailAddress" => "joko@gmail.com"
    //   "address" => "Jl. abc"
    //   "state" => "Banten"
    //   "city" => "Jakarta"
    //   "postal_code" => "57156"
    //   "phone" => "09876554321"
    //   "stripeToken" => "tok_1PbH4VP2jpJZ1J5slt7Tedf2"

      $data = $request;
      $email = strtolower($data['email']);
      $name = $data['first_name'].' '.$data['last_name'];
      $userData = array(
          'type' => 'Registration',
          'first_name' => strtolower($data['first_name']),
          'last_name' => ucwords(strtolower($data['last_name'])),
          'email' => $email,
          'phone_number' => $data['phone_number'],
           ); 

        Mail::to($email)->send(new RegisterEmail($userData));

    //   $profile = Profile::create([
    //     'first_name' => strtolower($data['first_name']),
    //     'last_name' => ucwords(strtolower($data['last_name'])),
    //     'email' => $email,
    //     'job_title' => $data['job'],
    // ]);

    //   $lastInsertedId= $profile ->id;
      $user = User::create([
        // 'profile_id' => $lastInsertedId,
        'name' => ucwords(strtolower($name)),
        'email' => $email,
        'password' => Hash::make($data['new_password']),
    ]);
    
    $user->sendEmailVerificationNotification();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Create a new Stripe customer.
        $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => $request->address,
                "postal_code" => $request->postal_code,
                "city" => $request->city,
                "state" => $request->state,
                "country" => "INA",
            ],
            "email" => $request->emailAddress,
            "name" => $request->firstName.' '.$request->lastName ,
            "source" => $request->stripeToken
        ));

        $amount = 1 * 100;
        $charge = Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment from Pasima.",
            "shipping" => [
                "name" => $request->firstName.' '.$request->lastName,
                "address" => [
                    "line1" => $request->address,
                    "postal_code" => $request->postal_code,
                    "city" => $request->city,
                    "state" => $request->state,
                    "country" => "INA",
                    ],
            ]
        ]);

        $refund = Stripe\Refund::create([
            "charge" => $charge->id,
            "amount" => $amount,
            'reason' => 'requested_by_customer'
        ]);
               
       $balanceTransaction = Stripe\BalanceTransaction::retrieve($refund->balance_transaction);

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
