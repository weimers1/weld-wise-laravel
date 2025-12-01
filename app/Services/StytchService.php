<?php

namespace App\Services;

class StytchService
{
    protected $project_id;

    protected $secret;

    public function __construct()
    {
        $this->project_id = env('STYTCH_PROJECT_ID');
        $this->secret = env('STYTCH_SECRET');
    }

    public function send_magic_link($email, $phone = null)
    {
        $url = 'https://test.stytch.com/v1/magic_links/email/login_or_create';
        $data = ['email' => $email];

        return $this->make_request($url, $data);
    }

    public function verify_magic_link($token)
    {
        $url = 'https://test.stytch.com/v1/magic_links/authenticate';
        $data = ['token' => $token];

        return $this->make_request($url, $data);
    }

    public function send_sms_otp($stytch_user_id, $phone)
    {
        $url = 'https://test.stytch.com/v1/otps/sms/send';

        return $this->make_request($url, ['user_id' => $stytch_user_id, 'phone_number' => $phone]);
    }

    public function verify_sms_otp($phone_id, $code)
    {
        $url = 'https://test.stytch.com/v1/otps/authenticate';

        return $this->make_request($url, [
            'method_id' => $phone_id,
            'code' => $code,
        ]);
    }

    public function make_request($url, $data)
    {
        // initialize the cURL session
        $ch = curl_init($url);

        // return as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // HTTP POST request
        curl_setopt($ch, CURLOPT_POST, true);

        // set fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // set header
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Basic '.base64_encode($this->project_id.':'.$this->secret),
        ]);

        // execute the cURL command
        $response = curl_exec($ch);

        // handle error
        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        // close the session
        curl_close($ch);

        // return the response as an associative array
        return json_decode($response, true);
    }
}
