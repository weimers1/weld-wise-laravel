<?php

namespace App\Http\Controllers;

use App\Services\PayPalService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $paypal;

    protected $status = [
        'active' => 'ACTIVE',
    ];

    public function __construct(PayPalService $paypal)
    {
        $this->paypal = $paypal;
    }

    public function get()
    {
        return view('subscription.index');
    }

    public function create(Request $request, $subscription_id)
    {
        // confirm with PayPal whether the subscription is legit using the curl command
        /* curl -v -X GET https://api-m.sandbox.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G \
         * -H 'Authorization: Bearer access_token6V7rbVwmlM1gFZKW_8QtzWXqpcwQ6T5vhEGYNJDAAdn3paCgRpdeMdVYmWzgbKSsECednupJ3Zx5Xd-g' \
         * -H 'Content-Type: application/json' \
         * -H 'Accept: application/json'
         */
        $subscription = $this->paypal->get_subscription($subscription_id);

        // check whether subscription is invalid or inactive
        if ($subscription['status'] !== $this->status['active']) {
            // redirect to subscription page
            return redirect()->route('subscription.get');
        }

        return view('subscription.index');
    }
}
