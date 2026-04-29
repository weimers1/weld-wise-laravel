<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    protected $paypal;

    public function __construct(PayPalService $paypal)
    {
        $this->paypal = $paypal;
    }

    public function get()
    {
        $token = Str::random(64);

        auth()->user()->purchases()->create([
            'tier'              => 2,
            'payment_type'      => 'recurring',
            'paypal_identifier' => $token,
            'status'            => 'pending',
        ]);

        return view('subscription.index', ['custom_id' => $token]);
    }

    public function pending()
    {
        return view('subscription.pending');
    }

    public function webhook(Request $request)
    {
        $verified = $this->paypal->verify_webhook_signature(
            $request->header('PAYPAL-TRANSMISSION-ID'),
            $request->header('PAYPAL-TRANSMISSION-TIME'),
            $request->header('PAYPAL-CERT-URL'),
            $request->header('PAYPAL-AUTH-ALGO'),
            $request->header('PAYPAL-TRANSMISSION-SIG'),
            env('PAYPAL_WEBHOOK_ID'),
            $request->getContent()
        );

        if (!$verified) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $payload = $request->json()->all();

        if (($payload['event_type'] ?? '') !== 'BILLING.SUBSCRIPTION.ACTIVATED') {
            return response()->json(['status' => 'ignored'], 200);
        }

        $resource  = $payload['resource'];
        $custom_id = $resource['custom_id'] ?? null;
        $sub_id    = $resource['id'];
        $plan_id   = $resource['plan_id'];
        $start     = $resource['billing_info']['last_payment']['time'] ?? now();
        $next      = $resource['billing_info']['next_billing_time'] ?? null;

        $purchase = Purchase::where('paypal_identifier', $custom_id)
            ->where('status', 'pending')
            ->first();

        if (!$purchase) {
            return response()->json(['error' => 'Purchase not found'], 404);
        }

        $purchase->update([
            'paypal_identifier' => $sub_id,
            'paypal_reference'  => $plan_id,
            'status'            => 'active',
        ]);

        $purchase->subscription()->create([
            'current_period_start' => $start,
            'current_period_end'   => $next,
            'status'               => 'active',
        ]);

        return response()->json(['status' => 'ok'], 200);
    }
}
