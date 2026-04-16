<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Models\UserMining;
use App\Models\Setting;


class RegisterController extends Controller
{
   
 public function register(Request $request)
{

// 🔥 ADD THIS AT TOP
$deletedUser = User::withTrashed()
    ->where('email', $request->email)
    ->where('is_deleted', true)
    ->first();

// if ($deletedUser) {
//     return response()->json([
//         'message' => 'This account was deleted and cannot be registered again'
//     ], 403);
// }

if ($deletedUser) {
    $deletedUser->restore();
    $deletedUser->is_deleted = 0;
    $deletedUser->password = Hash::make($request->password);
    $deletedUser->save();

    return response()->json([
        'message' => 'Account restored successfully'
    ]);
}
    /* 1️⃣ BASIC FIELD VALIDATION */
    $request->validate([
        'name'    => 'required|string|min:2',
        'email'        => 'required|email|unique:users,email',
        'password'     => [
            'required',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ],
        'country_id'   => 'required|exists:countries,id',
        'phone'        => 'required|numeric',
        'dob'          => 'required|date',
        'postal_code'  => 'nullable|string',
    ], [
        'password.regex' =>
            'Password must contain uppercase, lowercase, number and symbol'
    ]);
    
    $emailNotification = Setting::where('group', 'notification')
            ->where('key', 'email_notifications')
           ->value('value');


    /* 2️⃣ GET COUNTRY */
    $country = Country::find($request->country_id);
 // email verify cloumn 
 $verify_token = Str::random(64);

    /* 3️⃣ PHONE VALIDATION (COUNTRY BASED) */
    $phoneLength = strlen($request->phone);
    if ($phoneLength < $country->phone_min || $phoneLength > $country->phone_max) {
        return response()->json([
            'message' =>
                "Phone number must be between {$country->phone_min} and {$country->phone_max} digits"
        ], 422);
    }

    /* 4️⃣ AGE VALIDATION (18+) */
    $age = Carbon::parse($request->dob)->age;
    if ($age < 18) {
        return response()->json([
            'message' => 'You must be at least 18 years old'
        ], 422);
    }

    /* 5️⃣ POSTAL CODE VALIDATION (ONLY IF EXISTS) */
    if ($country->postal_regex && $request->postal_code) {
        if (!preg_match('/'.$country->postal_regex.'/', $request->postal_code)) {
            return response()->json([
                'message' => 'Invalid postal code for selected country'
            ], 422);
        }
    }
  $otp = rand(1000, 9999);
    /* 6️⃣ CREATE USER */
    $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => Hash::make($request->password),
        'country_id'  => $country->id,
        'phone'       => $request->phone,
        'dob'         => $request->dob,
        'postal_code' => $request->postal_code,
        'remember_token' => $verify_token
        // 'otp'            => $otp,
        // 'otp_expires_at' => now()->addHours(24), // ✅ 24 HOURS VALID
        // 'is_verified'    => false,
    ]);

    // $verifyLink = url('/verify-email/'.$verify_token);
    // $verifyLink = "https://winngoo.com/verify-email/".$verify_token;
$verifyLink = "https://winngoocoin.com/api/verify-email/".$verify_token;
$start = now();
//         UserMining::create([
//     'user_id' => $user->id,
//     'coin_type' => 'Bronze',
//     'start_date' => now(),
//     // 'end_date' => now()->addYears(2), 
//      'monthly_due_date' => $start->copy()->addMonth(), // next month due

//     'end_date' => $start->copy()->addYears(2),// Bronze = 2 years
//     'is_active' => false,
//     'progress' => 0
//   ]);
  
   UserMining::create([
    'user_id' => $user->id,
    'coin_type' => 'Bronze',
    // 'start_date' => now(),
    // // 'end_date' => now()->addYears(2), 
    //  'monthly_due_date' => $start->copy()->addMonth(), // next month due

    // 'end_date' => $start->copy()->addYears(2),// Bronze = 2 years
   'start_date' => null,
    'monthly_due_date' => null,
    'end_date' => null,
    'inactive_months' => 0,
    'is_active' => false,
    'progress' => 0
  ]);
  
  
  if ($emailNotification == 1) {


        Mail::send('emails.verifyemail', [
    'user' => $user,
    'link' => $verifyLink
], function ($m) use ($user) {
    $m->to($user->email, $user->name)
      ->subject('Verify Your Email');
});

        // Mail::send('emails.registersucess', [
        //     'user' => $user
        // ], function ($m) use ($user) {
        //     $m->from('support@winngooboostmedia.com', 'Winngoo Coin');
        //     $m->to($user->email, $user->name)
        //     ->subject('Register Successful');
        // });
                    Mail::send('emails.registersucess', [
                'user' => $user
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Register Successfully');
            });
        
  }

            return response()->json([
                'message' => 'Account Created Successfully
Please check your email to verify your account',
                'user_id' => $user->id
            ], 201);
}


public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp'   => 'required|digits:4'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    if ($user->is_verified) {
        return response()->json(['message' => 'User already verified'], 400);
    }

    if (now()->greaterThan($user->otp_expires_at)) {
        return response()->json(['message' => 'OTP expired'], 400);
    }

    if ($user->otp !== $request->otp) {
        return response()->json(['message' => 'Invalid OTP'], 400);
    }

    /* ✅ VERIFY SUCCESS */
    $user->update([
        'is_verified' => true,
        'otp' => null,
        'otp_expires_at' => null
    ]);

    return response()->json([
        'message' => 'OTP verified successfully'
    ]);
}



public function verifyEmail($token)
{
    
    $user = User::where('remember_token', $token)->first();

    if (!$user) {
        return view('landingPage.success', ['status' => 'invalid']);
    }

    // already verified
    if ($user->email_verified_at) {
        return view('landingPage.success', ['status' => 'already_verified']);
    }

    // verify email
    $user->update([
        'email_verified_at' => now(),
        'remember_token' => null
    ]);

    return view('landingPage.success', ['status' => 'verified']);
}

public function checkEmail(Request $request) 
    {
       $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkPhone(Request $request){

     $exists = User::where('phone', $request->phone)->exists();
        return response()->json(['exists' => $exists]);
      }
      




public function forgotsendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);
    
    $emailNotification = Setting::where('group', 'notification')
            ->where('key', 'email_notifications')
           ->value('value');


    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    $token = Str::random(64);

    $user->update([
        'password_reset_token' => $token,
        'password_reset_expires_at' => now()->addMinutes(10)
    ]);

    // 🔗 Deep link
    // $deepLink = "winngoocoin://reset-password?token={$token}&email={$user->email}";
    $deepLink = "https://winngoocoin.com/reset-password?token={$token}&email={$user->email}";
    

  if ($emailNotification == 1) {
    Mail::send('emails.reset_password_link', [
        'user' => $user,
        'link' => $deepLink
    ], function ($m) use ($user) {
        $m->from('support@wimbgo.com', 'Winngoo Coin');
        $m->to($user->email, $user->name)
          ->subject('Reset Your Password');
    });
    
  }

    return response()->json([
        'message' => 'Password reset link sent to your email'
    ]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => [
            'required',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]
    ]);

    $user = User::where('email', $request->email)
        ->where('password_reset_token', $request->token)
        ->first();

    if (!$user || now()->greaterThan($user->password_reset_expires_at)) {
        return response()->json([
            'message' => 'Invalid or expired reset link'
        ], 400);
    }

    $user->update([
        'password' => Hash::make($request->password),
        'password_reset_token' => null,
        'password_reset_expires_at' => null
    ]);

    return response()->json([
        'message' => 'Password reset successfully'
    ]);
}


//jana

   public function deviceToken(Request $request)
{
    $request->validate([
        'device_token' => 'required|string',
        'platform' => 'nullable|in:android,ios,web',
    ]);

    $user = Auth::user(); // Authenticated user from Bearer token

    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $token = DeviceToken::updateOrCreate(
        ['fcm_token' => $request->device_token],
        [
            'user_id' => $user->id,
            'platform' => $request->platform,
        ]
    );

    return response()->json([
        'message' => 'Device token saved successfully',
        'data' => $token
    ]);
}

 public function sendTestNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        // Get all device tokens
        $tokens = DeviceToken::pluck('fcm_token')->toArray();

        if (empty($tokens)) {
            return response()->json(['message' => 'No device tokens found'], 400);
        }

        $messaging = Firebase::messaging(); // Get Messaging instance from Firebase facade

        $notification = Notification::create($request->title, $request->body);

        foreach ($tokens as $token) {
            $message = CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData(['extra' => 'Test push notification']);

            $messaging->send($message);
        }

        return response()->json([
            'message' => 'Notifications sent successfully',
            'success' => count($tokens)
        ]);
    }

//     public function deleteAccount(Request $request)
// {
//     $user = auth()->user();

//     if (!$user) {
//         return response()->json(['message' => 'Unauthorized'], 401);
//     }

//     // Update before delete
//     $user->update([
//         'is_deleted' => true,
//         'email' => $user->email . '_deleted_' . time(),
//         'phone' => $user->phone . '_deleted_' . time(),
//     ]);

//     $user->delete(); // soft delete

//     return response()->json([
//         'message' => 'Account deleted successfully'
//     ]);
// }
public function deleteAccount(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // revoke tokens
    // $user->tokens()->delete();

    // mark as deleted
    $user->update([
        'is_deleted' => true
    ]);

    $user->delete(); // soft delete

    return response()->json([
        'message' => 'Account deleted successfully'
    ]);
}
}
