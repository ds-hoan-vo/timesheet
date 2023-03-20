<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function register_action(Request $request)
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

    public function login_action(Request $request)
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

    public function forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function forgot_password_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $email_otp = new EmailOtp([
                'email' => $user->username,
                'otp' => $otp,
                'expired_at' => Carbon::now()->addSecond(60),
            ]);
            $email_otp->save();

            Mail::to($user->email)->send(new ForgotPassword($email_otp));
            $request->session()->put('email', $email_otp->email);
            return redirect()->route('confirm.otp');
        } else {
            return back()->withErrors([
                'password' => 'Wrong username',
            ]);
        }
    }
    public function confirm_otp(Request $request)
    {
        return view('auth/confirm_otp')->with('email', $request->session()->get('email'));
    }

    public function confirm_otp_action(Request $request)
    {   
       
        $request->validate([
            'otp' => 'required',
        ]);
        $email = $request->session()->get('email');
        $email_otp = EmailOtp::where('email', $email)->where('email', $email)->where('otp', $request->otp)->first();
        if ($email_otp) {
            if (Carbon::now()->lessThan($email_otp->expired_at)) {
                $request->session()->put('email', $email);
                $email_otp->delete();
                return redirect()->route('reset.password');
            } else {
                $request->session()->forget('email');
                return back()->withErrors([
                    'otp' => 'OTP expired',
                ]);
            }
        } else {
            $request->session()->forget('email');
            return back()->withErrors([
                'otp' => 'Wrong OTP',
            ]);
        }
    }

    public function reset_password(Request $request)
    {
        return view('auth/reset_password')->with('email', $request->session()->get('email'));
    }

    public function reset_password_action(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $email = $request->session()->get('email');
        $user = User::where('username', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success', 'Reset password success. Please login!');
    }

}