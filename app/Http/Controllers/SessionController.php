<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StytchService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!$loggingIn) {
            $request->validate(
                [
                    'name_first' => 'required',
                    'name_last' => 'required',
                    'email_sign_up' => 'unique:users,email|email|confirmed',
                ],
                [
                    'name_first' => 'First name is required.',
                    'name_last' => 'Last name is required.',
                    'email_sign_up.unique' => 'Please use a different email address.',
                    'email_sign_up.email' => 'Please use a valid email address.',
                    'email_sign_up.confirmed' => 'Please confirm your email.',
                ]
            );

            User::create([
                'name_first' => request('name_first'),
                'name_last' => request('name_last'),
                'email' => request('email_sign_up'),
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
            $this->stytch->send_magic_link($email);
        } catch (Exception $e) {
            // @TODO: send error email

            // let user know
            return redirect()->back()->with('modal_info', [
                'title' => 'System Error',
                'body' => 'A system error has occurred. Please try again later.'
            ]);
        }

        if ($loggingIn) {
            return redirect()->back()->with('modal_info', [
                'title' => 'Log In Link Sent!',
                'body' => 'A log in link has been sent to your email.'
            ]);
        }

        return redirect()->back()->with('modal_info', [
            'title' => 'Verification Link Sent!',
            'body' => 'A verification link has been sent to your email.'
        ]);
    }

    public function authenticate(Request $request)
    {
        // grab the token from the request
        $token = $request->query('token');

        // verify there is a token
        if (!$token) {
            return redirect()->route('login')->with('modal_info', [
                'title' => 'Invalid Attempt',
                'body' => 'The login attempt could not be completed. Please try logging in again.'
            ]);
        }

        try {
            // verify the token
            $response = $this->stytch->verify_magic_link($token);
        } catch (Exception $e) {
            // @TODO: send error email

            // let user know
            return redirect()->route('login')->with('modal_info', [
                'title' => 'System Error',
                'body' => 'A system error has occurred. Please try again later.'
            ]);
        }

        // if for some reason the response does not have what we need
        if (!isset($response['status_code']) || !isset($response['user']['emails'][0]['email'])) {
            abort(418);
        }

        // if response status code 200
        if ($response['status_code'] === 200) {
            // get the user
            $user = User::where('email', '=', $response['user']['emails'][0]['email'])->first();

            // if email not verified yet, mark it as verified now
            if (is_null($user['email_verified_at'])) {
                $this->verify_email($user);
            }

            // login
            Auth::login($user);

            // take them home
            return redirect('/');
        }

        // unable to auth magic link
        if ($response['status_code'] === 401) {
            abort(401, 'Your session may have expired. Please try logging in again.');
        }

        // otherwise, abort with base status code
        abort($response['status_code']);
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
        return redirect("/");
    }

    public function get()
    {
        return view('auth.index');
    }
}
