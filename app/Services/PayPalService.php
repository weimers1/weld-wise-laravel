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
        $this->secret    = env('PAYPAL_SECRET');
        $this->base_url  = env('PAYPAL_SANDBOX', true)
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';
    }

    public function verify_webhook_signature(
        $transmission_id,
        $transmission_time,
        $cert_url,
        $auth_algo,
        $transmission_sig,
        $webhook_id,
        $raw_body
    ) {
        $response = $this->make_request('POST', '/v1/notifications/verify-webhook-signature', [
            'transmission_id'   => $transmission_id,
            'transmission_time' => $transmission_time,
            'cert_url'          => $cert_url,
            'auth_algo'         => $auth_algo,
            'transmission_sig'  => $transmission_sig,
            'webhook_id'        => $webhook_id,
            'webhook_event'     => json_decode($raw_body, true),
        ]);

        return ($response['verification_status'] ?? '') === 'SUCCESS';
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

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => strtoupper($method),
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $access_token,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_POSTFIELDS     => !empty($data) ? json_encode($data) : null,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
