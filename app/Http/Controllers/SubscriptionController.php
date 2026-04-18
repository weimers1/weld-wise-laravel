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
        $subscription = $this->paypal->get_subscription($subscription_id);

        // check whether subscription is invalid or inactive
        if ($subscription['status'] !== $this->status['active']) {
            return redirect()->route('subscription.get')->with('showModal', [
                'title' => 'Subscription Invalid',
                'body' => 'The subscription is invalid. Please try again.',
            ]);
        }

        return view('subscription.index')->with('showModal', [
            'title' => 'Unlimited Access Granted!',
            'body' => 'Subscription was successful.',
        ]);
    }
}
