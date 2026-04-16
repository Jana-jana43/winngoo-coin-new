<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class LoginController extends Controller
{
  
//     public function login(Request $request)
//     {
//         /* 1️⃣ VALIDATION */
//         $request->validate([
//             'email'    => 'required|email',
//             'password' => 'required'
//         ]);

//         /* 2️⃣ USER CHECK */
//         $user = User::where('email', $request->email)->first();

//         if (!$user) {
//             return response()->json([
//                 'message' => 'Invalid email or password'
//             ], 401);
//         }

//  if(!$user->email_verified_at){
//     return response()->json([
//         'message' => 'Please verify your email first'
//     ],403);
// }
//         /* 3️⃣ ACCOUNT LOCK CHECK */
//         if ($user->locked_until && now()->lessThan($user->locked_until)) {

//             $minutesLeft = now()->diffInMinutes($user->locked_until);

//             return response()->json([
//                 'message' => "Your account is blocked due to multiple failed login attempts. Try again in After 2 hours."
//             ], 423); // Locked
//         }
        


// /* 🔁 RESET FAILED ATTEMPTS AFTER LOCK EXPIRES */
// if ($user->locked_until && now()->greaterThanOrEqualTo($user->locked_until)) {
//     $user->update([
//         'failed_attempts' => 0,
//         'locked_until' => null
//     ]);
// }

//         /* 4️⃣ PASSWORD CHECK */
//         if (!Hash::check($request->password, $user->password)) {

//             $user->failed_attempts += 1;

//             /* ❌ 5 ATTEMPTS → LOCK FOR 2 HOURS */
//             if ($user->failed_attempts >= 5) {
//                 $user->locked_until = now()->addHours(2);
//             }

//             $user->save();

//             return response()->json([
//                 'message' => 'Incorrect password. Attempt ' . $user->failed_attempts . ' of 5.'
//             ], 401);
//         }

//         /* 5️⃣ OTP VERIFIED CHECK */
//         // if (!$user->is_verified) {
//         //     return response()->json([
//         //         'message' => 'Please verify your email using OTP'
//         //     ], 403);
//         // }

//         /* 6️⃣ LOGIN SUCCESS → RESET LOCK DATA */
//         $user->update([
//             'failed_attempts' => 0,
//             'locked_until'    => null
//         ]);

//         $token = $user->createToken('api_token')->plainTextToken;

//         return response()->json([
//             'message' => 'Login successful',
//             'token'   => $token,
//             'user'    => [
//                 'id'    => $user->id,
//                 'name'  => $user->name,
//                 'email' => $user->email
//             ]
//         ], 200);
//     }

    public function login(Request $request)
    {
        /* 1️⃣ VALIDATION */
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        /* 2️⃣ LOAD PLATFORM SETTINGS FROM DB */
        $platformSettings       = Setting::getByGroup('platform');
        $maxFailedAttempts      = (int) ($platformSettings['failed_attempts_count']  ?? 5);
        $accountRecoveryHours   = (int) ($platformSettings['account_recovery_period'] ?? 2);
        $sessionTimeoutMinutes  = (int) ($platformSettings['session_timeout']         ?? 30);

        /* 3️⃣ USER CHECK */
        // $user = User::where('email', $request->email)->first();
$user = User::withTrashed()
    ->where('email', $request->email)
    ->first();

if (!$user) {
    return response()->json([
        'success' => false,
        'message' => 'Invalid email'
    ], 401);
}

// 🔥 IMPORTANT
if ($user->deleted_at !== null || (int)$user->is_deleted === 1) {
    return response()->json([
        'success' => false,
        'message' => 'Your account is inactive, kindly reach admin support.'
    ], 403);
}


        if (!$user->email_verified_at) {
           
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email first'
            ], 403);
        }

        if ($user->locked_until && now()->lessThan($user->locked_until)) {

            $minutesLeft = ceil(now()->diffInMinutes($user->locked_until));
            $hoursLeft   = floor($minutesLeft / 60);

            if ($hoursLeft > 0) {
                $label = $hoursLeft === 1 ? 'hour' : 'hours';
                $timeMessage = "Try again after {$hoursLeft} {$label}.";
            } else {
                $label = $minutesLeft === 1 ? 'minute' : 'minutes';
                $timeMessage = "Try again after {$minutesLeft} {$label}.";
            }

            return response()->json([
                'success' => false,
                'message' => "Your account is locked due to multiple failed login attempts. {$timeMessage}"
            ], 423);
        }

        /* 5️⃣ PASSWORD CHECK */
        if (!Hash::check($request->password, $user->password)) {

            $user->failed_attempts += 1;

            /* ❌ MAX ATTEMPTS REACHED → LOCK ACCOUNT */
            if ($user->failed_attempts >= $maxFailedAttempts) {
                $user->locked_until    = now()->addHours($accountRecoveryHours);
                $user->failed_attempts = 0; // reset after lock

                $user->save();

                return response()->json([
                    'success' => false,
                    'message' => "Your account is locked due to {$maxFailedAttempts} failed attempts. Try again after {$accountRecoveryHours} hour(s)."
                ], 423);
            }

            $user->save();

            $remainingAttempts = $maxFailedAttempts - $user->failed_attempts;

            return response()->json([
                'success' => false,
                'message' => "Incorrect password. {$remainingAttempts} attempt(s) remaining before account lock."
            ], 401);
        }

        /* 6️⃣ LOGIN SUCCESS → RESET LOCK DATA */
        $user->update([
            'failed_attempts' => 0,
            'locked_until'    => null
        ]);

        /* 7️⃣ CREATE TOKEN WITH EXPIRY FROM SETTINGS */
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }
}
