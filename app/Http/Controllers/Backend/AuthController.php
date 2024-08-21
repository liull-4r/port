<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Session;
use Illuminate\Contracts\Mail\Mailable;



class AuthController extends Controller
{

    public function login(Request $request)
    {
        /* $password='12345678';
    $dd= Hash::make($password);
    dd($dd);*/
        return view('backend.auth.login');
    }
    public function forgot(Request $request)
    {
        return view('backend.auth.forgot');
        //
    }
    public function forgot_admin(Request $request)
    {
        $random_password = rand(111111111, 999999999);
        $user = User::where('email', '=', $request->email)->first();
        $details = [
            'title' => 'Test Email',
            'body' => 'This is a test email sent from your Laravel application.'
        ];
        if (!empty($user)) {
            $user->password = Hash::make($random_password);
            $user->save();
            $user->password_random = $random_password;
            Mail::to('mulugese@gmail.com')->send(new ForgotPasswordMail($details, $user, $random_password,));
            return redirect()->back()->with('success', 'Password Successfully sent to your email box, please check your email box');
        } else {
            return redirect()->back()->with('error', 'Email ID Not Found');
        }
    }
    public function login_admin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (!empty(Auth::User()->status)) {
                if (Auth::User()->is_admin == '1') {
                    return redirect()->intended('admin/dashboard');
                } else {
                    return redirect()->back()->with('error', 'you are not the admin');
                }
            } else {
                $user_id = Auth::user()->id;
                Auth::logout();
                $user = User::find($user_id);
                return redirect('login')->with('success', 'This email is not verified yet!');
            }
        } else {
            return redirect()->back()->with('error', 'please enter the correct credential');
        }
    }
    public function logout()
    {

        Auth::logout();
        return redirect(url('login'));
    }
}
