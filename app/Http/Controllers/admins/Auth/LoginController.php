<?php

namespace App\Http\Controllers\admins\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }

  
//   public function login(Request $request)
//     {
//         // dd($request->all());
//         $request->validate([
//             'login' => 'required',
//             'password' => 'required',
//         ]);

//         $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
//             ? 'email'
//             : 'username';

//         $credentials = [
//             $field => $request->login,
//             'password' => $request->password,
//         ];

//         if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
//             return redirect()->route('dashboard');
//         }

//         return back()
//         ->withInput($request->only('login'))
//         ->withErrors(['login' => 'Invalid username/email or password',
//          ]);
//     }


public function login(Request $request)
{
    // Validate the input
    $request->validate([
        'login' => 'required',
        'password' => 'required',
    ]);

    // Determine if login is email or username
    $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'username';

    // Try to fetch the user first
    $user = \App\Models\Admin::where($field, $request->login)->first();

    if (!$user) {
        // User not found
        return back()
            ->withInput($request->only('login'))
            ->withErrors(['login' => 'Invalid username/email or password.']);
    }

    if ($user->status !== 'active') {
        // User exists but account is inactive
        return back()
            ->withInput($request->only('login'))
            ->withErrors(['login' => 'Your account is inactive. Please contact admin.']);
    }

    // Attempt login
    $credentials = [
        $field => $request->login,
        'password' => $request->password,
    ];

    if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        // Successful login
        return redirect()->route('dashboard');
    }

    // Wrong password
    return back()
        ->withInput($request->only('login'))
        ->withErrors(['login' => 'Invalid username/email or password.']);
}


 public function showForgotForm()
    {
        return view('admin.auth.forgot-password');
    }




  public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:admins,email'
    ]);

        $user = Admin::where('email', $request->email)->first();

    $token = Str::random(64);

    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => $token,
            'created_at' => Carbon::now()
        ]
    );

    $link = url('/admin/reset-password/' . $token . '?email=' . $request->email);




    Mail::send('emails.reset_password_link', [
        'link' => $link,
        'name' => $user->name
    ], function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Admin Reset Password');
    });
    
    
    
//     Mail::send('emails.reset_password_link', [
//     'user' => $user,
//     'link' => $link
// ], function ($message) use ($user) {
//     $message->to($user->email, $user->name)
//             ->subject('Admin Reset Password');
// });


    return back()->with('success', 'Reset link sent to your email');
}

public function showResetForm($token, Request $request)
{
    // Ensure the email is coming from the URL query string
    $email = $request->query('email');

    return view('admin.auth.reset-password', [
        'token' => $token,
        'email' => $email
    ]);
}




public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:admins,email',
        'password' => 'required|min:8|confirmed'
    ]);

    $record = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();

    // Token not found OR mismatch → LOGIN PAGE
    if (!$record || $request->token !== $record->token) {
        return redirect()->route('login')->with('error', 'Invalid password reset token.');
    }

    // Token expired → LOGIN PAGE
    if (Carbon::parse($record->created_at)->addMinutes(10)->isPast()) {
        return redirect()->route('login')->with('error', 'This password reset link has expired. Please request a new one.');
    }

    //  Update password
    Admin::where('email', $request->email)->update([
        'password' => Hash::make($request->password)
    ]);

    // Delete token
    DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->delete();

    //  Stay on same page → show success card
    return back()->with('success', 'Password reset successful!');
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();   // admin guard logout

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');   // login page redirect
}

}
