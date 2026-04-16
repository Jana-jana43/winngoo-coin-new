<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    //   public function index()
    // {
    //     return view('admin.profile');
    // }
          public function index()
    {
        // return view('admin.profile');
         $admin = Auth::guard('admin')->user();

    return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin) {
        return back()->with('error', 'Unauthorized');
    }

    // ✅ VALIDATION
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
        'last_name' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
        // 'email' => ['required', 'email:rfc,dns'],
        'phone' => ['nullable', 'digits_between:10,15'],
        'profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
    ], [
        'name.regex' => 'Name should contain only letters',
        'last_name.regex' => 'Last name should contain only letters',
        // 'email.email' => 'Enter a valid email address',
        'phone.digits_between' => 'Phone must be between 10 and 15 digits',
    ]);
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // ✅ UPDATE
    $admin->username = $request->name;
    $admin->last_name = $request->last_name;
    // $admin->email = $request->email;
    $admin->phone = $request->phone;

    // ✅ IMAGE UPLOAD
    if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/adminprofile'), $filename);

        $admin->profile = $filename;
    }

    $admin->save();

    return back()->with('success', 'Profile Updated Successfully');
}
}
