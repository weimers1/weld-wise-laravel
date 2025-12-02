<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StytchService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    protected $stytch;

    public function __construct(StytchService $stytch)
    {
        $this->stytch = $stytch;
    }

    public function create(Request $request)
    {
        // determine whether the user was logging in
        $loggingIn = $request->getRequestUri() == '/user/login';

        $email = env('DEVELOPER_EMAIL');

        if (! $loggingIn) {
            $request->validate(
                [
                    'name_first' => 'required',
                    'name_last' => 'required',
                    'email_sign_up' => 'unique:users,email|email|confirmed',
                    'phone' => 'required|regex:/^\+1\d{10}$/|size:12|unique:users,phone',
                ],
                [
                    'name_first' => 'First name is required.',
                    'name_last' => 'Last name is required.',
                    'email_sign_up.unique' => 'Please use a different email address.',
                    'email_sign_up.email' => 'Please use a valid email address.',
                    'email_sign_up.confirmed' => 'Please confirm your email.',
                    'phone.required' => 'Phone number is required.',
                    'phone.regex' => 'Please enter a valid phone number.',
                    'phone.unique' => 'This phone number has already been used. Please contact support (support@weld-wise.com) if you believe this is an error.',
                ]
            );

            User::create([
                'name_first' => request('name_first'),
                'name_last' => request('name_last'),
                'email' => request('email_sign_up'),
                'phone' => request('phone'),
            ]);

            $email = $request['email_sign_up'];
        }

        if ($loggingIn) {
            $request->validate(
                [
                    'email_log_in' => 'required|email',
                ],
                [
                    'email_log_in' => 'The email field is required.',
                ]
            );

            // verify email exists in system
            if (is_null(User::where('email', '=', $request['email_log_in'])->first())) {
                return redirect()->back()->withErrors(['email_log_in' => 'Log in failed. Please verify that you have entered your email correctly and have an account.']);
            }

            $email = $request['email_log_in'];
        }

        try {
            $response = $this->stytch->send_magic_link($email);
            if (array_key_exists('error', $response)) {
                throw ValidationException::withMessages([$response['error']]);
            }
        } catch (Exception $e) {
            // @TODO: send error email

            // let user know
            return redirect()->back()->with('modal_info', [
                'title' => 'System Error',
                'body' => 'A system error has occurred. Please try again later.',
            ]);
        }

        if ($loggingIn) {
            return redirect()->back()->with('modal_info', [
                'title' => 'Log In Link Sent!',
                'body' => 'A log in link has been sent to your email.',
            ]);
        }

        return redirect()->back()->with('modal_info', [
            'title' => 'Verification Link Sent!',
            'body' => 'A verification link has been sent to your email.',
        ]);
    }

    public function authenticate(Request $request)
    {
        // grab the token from the request
        $token = $request->query('token');

        // verify there is a token
        if (! $token) {
            return redirect()->to('/user/login')->with('modal_info', [
                'title' => 'Invalid Attempt',
                'body' => 'The login attempt could not be completed. Please try logging in again.',
            ]);
        }

        try {
            // verify the token
            $response = $this->stytch->verify_magic_link($token);
        } catch (Exception $e) {
            // @TODO: send error email

            // let user know
            return redirect()->to('/user/login')->with('modal_info', [
                'title' => 'System Error',
                'body' => 'A system error has occurred. Please try again later.',
            ]);
        }

        // if for some reason the response does not have what we need
        if (! isset($response['status_code']) && ! isset($response['user']['emails'][0]['email'])) {
            abort(418);
        }

        // unable to auth magic link
        if ($response['status_code'] === 401) {
            abort(401, 'Your session may have expired. Please try logging in again.');
        }

        // if response status code not 200
        if ($response['status_code'] !== 200) {
            // abort with base status code
            abort($response['status_code']);
        }

        // get the user
        $user = User::where('email', '=', $response['user']['emails'][0]['email'])->first();

        // if user's stytch ID not yet stored, add it
        if (is_null($user['stytch_id'])) {
            $user['stytch_id'] = $response['user']['user_id'];

            // update user
            $user->save();
        }

        // otherwise, handle login for user with email from magic link
        return $this->handleLogin($user);
    }

    private function handleLogin($user)
    {
        // if email not verified yet, mark it as verified now
        if (is_null($user['email_verified_at'])) {
            $this->verify_email($user);
        }

        // if user has verified phone number, good to go
        if (! is_null($user['phone_verified_at'])) {

            // otherwise login
            Auth::login($user);

            // take them home
            return redirect('/');
        }

        // otherwise, use stytch to send OTP to user's phone
        $response = $this->stytch->send_sms_otp($user['stytch_id'], $user['phone']);

        // if response status code not 200; abort with error code
        if ($response['status_code'] !== 200) {
            abort($response['status_code']);
        }

        // redirect to OTP page
        return redirect('/otp?phone='.urlencode($user['phone']).'&phone_id='.$response['phone_id']);
    }

    private function verify_email(User $user)
    {
        // set verification time to now
        $user['email_verified_at'] = now();

        // update user
        $user->save();
    }

    public function destroy()
    {
        // log out currently logged in user
        Auth::logout();

        // redirect to home page
        return redirect('/');
    }

    public function get()
    {
        return view('auth.index');
    }

    public function otp(Request $request)
    {
        $phone = $request->query('phone');
        $phone_id = $request->query('phone_id');

        // if phone or phone_id not provided, abort
        if (! $phone || ! $phone_id) {
            abort(418);
        }

        return view('auth.otp', compact(['phone', 'phone_id']));
    }

    public function verify_phone_number(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6',
            'phone_id' => 'required',
        ], [
            'otp_code.required' => 'Verification code is required.',
            'otp_code.digits' => 'Verification code must be exactly 6 digits.',
        ]);

        // grab the needed info to verify
        $phone_id = request('phone_id');
        $otp_code = request('otp_code');

        // attempt to verify
        $response = $this->stytch->verify_sms_otp($phone_id, $otp_code);

        // if something went wrong, abort
        if ($response['status_code'] !== 200) {
            abort($response['status_code']);
        }

        $user = User::where('email', '=', $response['user']['emails'][0]['email'])->first();

        // update the user's phone number as verified
        $user['phone_verified_at'] = now();
        $user->save();

        // nothing went wrong yet so log the user in
        Auth::login($user);

        // send them to the home page
        return redirect('/');
    }
}
