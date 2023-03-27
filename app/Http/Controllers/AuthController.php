<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Mail;

class AuthController extends Controller
{

    
    public function register()
    {
        return view('auth/register');
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('home')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('timekeeping');
        }

        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function forgotPasswordAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $token = Password::getRepository()->createNewToken();
            EmailOtp::where('email', $user->username)->delete();
            $email_otp = new EmailOtp([
                'email' => $user->username,
                'otp' => $otp,
                'token' => $token,
                'expired_at' => Carbon::now()->addSecond(60),

            ]);
            $email_otp->save();
            Mail::to($user->username)->send(new ForgotPassword($email_otp, $token));
            return redirect()->route('forgot.password')->with('success', 'Please check your email to reset password');
        }
    }
    public function confirmOtp(Request $request, string $token)
    {
        return view('auth/confirm_otp')->with('token', $token);
    }

    public function confirmOtpAction(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);
        $emailOtp = EmailOtp::where('token', $request->token)->first();
        if ($emailOtp) {
            $otp = $emailOtp->otp;
            if ($otp == $request->otp && $emailOtp->expired_at > Carbon::now()) {
                return redirect()->route('reset.password', $request->token);
            } elseif ($otp != $request->otp) {
                return redirect()->route('confirm.otp', $request->token)->with('error', 'Wrong OTP');
            } else if ($emailOtp->expired_at < Carbon::now()) {
                return redirect()->route('confirm.otp', $request->token)->with('error', 'OTP expired');
            }
        } else {
            return redirect()->route('confirm.otp', $request->token)->with('error', 'Link expired');
        }
    }
    public function resetPassword(Request $request, string $token)
    {
        $email = EmailOtp::where('token', $token)->first();
        $email = $email->email;
        return view('auth/reset_password')->with('token', $token)->with('email', $email);
    }

    public function resetPasswordAction(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $emailOtp = EmailOtp::where('token', $request->token)->get()->first();
        $user = User::where('username', $emailOtp->email)->get()->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success', 'Reset password success. Please login!');
    }

}