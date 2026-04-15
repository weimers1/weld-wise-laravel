<?php

namespace App\Services;

class PayPalService
{
    protected $client_id;

    protected $secret;

    protected $base_url;

    public function __construct()
    {
        $this->client_id = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
        $this->base_url = env('PAYPAL_SANDBOX', true)
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';
    }

    public function get_subscription($subscription_id)
    {
        return $this->make_request('GET', "/v1/billing/subscriptions/{$subscription_id}");
    }

    protected function get_access_token()
    {
        $ch = curl_init($this->base_url . '/v1/oauth2/token');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => 'grant_type=client_credentials',
            CURLOPT_USERPWD        => $this->client_id . ':' . $this->secret,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $response['access_token'] ?? null;
    }

    public function make_request($method, $endpoint, $data = [])
    {
        $access_token = $this->get_access_token();

        $ch = curl_init($this->base_url . $endpoint);

        $headers = [
            'Authorization: Bearer ' . $access_token,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => strtoupper($method),
            CURLOPT_HTTPHEADER     => $headers,
        ];

        if (!empty($data)) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
