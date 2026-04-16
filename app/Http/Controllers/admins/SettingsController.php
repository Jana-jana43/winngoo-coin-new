<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

class SettingsController extends Controller
{
    public function changePassword()
    {
        return view('admin.settings.change-password');
    }  
public function updateChangePassword(Request $request)
{
    session()->flash('old_current_password', $request->current_password);

    $request->validate([
        'current_password' => 'required',
        'new_password'     => [
            'required',
            'min:6',
            Password::min(6)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        'new_password_confirmation' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                if ($value !== $request->new_password) {
                    $fail('Confirm password do not match.');
                }
            },
        ],
    ], [
        'current_password.required'          => 'Current password is required.',
        'new_password.required'              => 'New password is required.',
        'new_password.min'                   => 'New password must be at least 6 characters.',
        'new_password_confirmation.required' => 'Please confirm your new password.',
    ]);

    $admin = Auth::guard('admin')->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()
            ->withErrors(['current_password' => 'Current password is incorrect.'])
            ->withInput();
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    
    session()->forget('old_current_password');

    return back()->with('success', 'Password changed successfully!');
}


public function checkCurrentPassword(Request $request)
{
    $admin = Auth::guard('admin')->user();
    
    if (Hash::check($request->password, $admin->password)) {
        return response()->json(['valid' => true]);
    }
    
    return response()->json(['valid' => false, 'message' => 'Current password is incorrect.']);
}

 public function emailConfiguration()
    {
        $settings = Setting::where('group', 'email')
            ->pluck('value', 'key')
            ->toArray();
        // dd($settings);

        return view('admin.settings.email-configuration', compact('settings'));
    }
    
    public function language()
    {
       
        return view('admin.settings.language');
    }

    public function saveEmailSettings(Request $request)
    {

        $request->validate([
            'smtp_server' => 'required',
            'smtp_port' => 'required',
            'smtp_username'   => 'required|email|same:from_email',
            'from_email' => 'required|email',
            'encryption_type' => 'required',
            'from_name' => 'required',
        ]);

        foreach ($request->except('_token') as $key => $value) {

            // Handle password separately
            if ($key == 'smtp_password') {
                if (!empty($value)) {
                    Setting::set($key, encrypt($value), 'email');
                }
            } else {
                Setting::set($key, $value, 'email');
            }
        }

        return back()->with('success', 'Email settings updated successfully!');
    }

    public function sendTestMail()
    {
        $settings = Setting::getByGroup('email');

        if (empty($settings)) {
            return response()->json([
                'success' => false,
                'message' => 'No email settings found. Please save settings first.'
            ]);
        }

        // Decrypt password
        try {
            $password = decrypt($settings['smtp_password']);
        } catch (\Exception $e) {
            $password = $settings['smtp_password'];
        }

        // Dynamically set mail config from DB
        Config::set('mail.mailers.smtp.host',       $settings['smtp_server']);
        Config::set('mail.mailers.smtp.port',       $settings['smtp_port']);
        Config::set('mail.mailers.smtp.username',   $settings['smtp_username']);
        Config::set('mail.mailers.smtp.password',   $password);
        Config::set('mail.mailers.smtp.encryption', $settings['encryption_type']);
        Config::set('mail.from.address',            $settings['from_email']);
        Config::set('mail.from.name',               $settings['from_name']);

        // Static test recipient
        $staticTestEmail = 'support@winngoocoin.com'; // 👈 change this to your email

        try {
            Mail::raw('This is a test email. Your SMTP configuration is working correctly!', function ($message) use ($staticTestEmail, $settings) {
                $message->to($staticTestEmail)
                    ->subject('Test Email - ' . ($settings['from_name'] ?? 'System'));
            });

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully to ' . $staticTestEmail
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e->getMessage()
            ]);
        }
    }

    public function platformSettings(){
         $settings = Setting::where('group', 'platform')
            ->pluck('value', 'key')
            ->toArray();
        return view('admin.settings.platform-settings', compact('settings'));
    }

    public function savePlatformSettings(Request $request)
{
    $request->validate([
        'mining_frequency'       => 'nullable|numeric|min:1',
        'session_timeout'        => 'required|numeric|min:1',
        // 'account_lock_duration'  => 'required|numeric|min:1',
        'failed_attempts_count'  => 'required|numeric|min:1',
        'account_recovery_period'=> 'required|numeric|min:1',
    ]);

    foreach ($request->except('_token') as $key => $value) {
        Setting::set($key, $value, 'platform');
    }

    return back()->with('success', 'Platform settings updated successfully!');
}


 public function notificationSettings()
    {
        $settings = Setting::where('group', 'notification')
        ->pluck('value', 'key')
        ->toArray();
        

        return view('admin.settings.notification-settings', compact('settings'));
    }
 public function saveNotificationSettings(Request $request)
{
    $value = $request->has('email_notifications') ? 1 : 0;

    Setting::set('email_notifications', $value, 'notification');

    return back()->with('success', 'Notification settings updated!');
}






}
