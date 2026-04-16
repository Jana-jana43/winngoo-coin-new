<?php

namespace App\Http\Controllers\admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;



class StaffController extends Controller
{
    public function index()
    {
        $roles = Role::where('status', 'active')->get();
        // Get last staff
        $lastStaff = Admin::orderBy('id', 'desc')->first();
        $staffs = Admin::latest()->get();

        if ($lastStaff && $lastStaff->staff_id) {
            $number = (int) substr($lastStaff->staff_id, 3);
            $staffId = 'WCR' . str_pad($number + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $staffId = 'WCR00001';
        }
        return view('admin.staffManagement.staffmanagement', compact('roles', 'staffId', 'staffs'));
    }



    public function store(Request $request)
{
    
    
    // ✅ Validation
    $validator = Validator::make($request->all(), [
        'role' => 'required',
     'staff_name' => 'required|unique:admins,username',
        'email' => [
            'required',
            'email:rfc,dns',
            'unique:admins,email'
        ],
    ], [
        'staff_name.required' => 'Username is required.',
   'staff_name.unique' => 'This username is already taken.',
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('modal', 'add');
    }
    
     $emailNotification = Setting::where('group', 'notification')
            ->where('key', 'email_notifications')
           ->value('value');

    // ✅ Auto Staff ID
    $last = Admin::orderBy('id', 'desc')->first();

    if ($last && $last->staff_id) {
        $num = (int) substr($last->staff_id, 3);
        $staffId = 'WCR' . str_pad($num + 1, 5, '0', STR_PAD_LEFT);
    } else {
        $staffId = 'WCR00001';
    }

    // ✅ Strong Password Generator
    $plainPassword = $this->generateStrongPassword(8);

    // ✅ Store Staff
    $staff = Admin::create([
        'staff_id' => $staffId,
        'role_id' => $request->role,
        'username' => ucfirst($request->staff_name),
        'email' => $request->email,
        'status' => $request->has('staff_status') ? 'active' : 'inactive',
        'password' => Hash::make($plainPassword),
    ]);


             if ($emailNotification == 1) {
                // ✅ Send Email
                Mail::send('emails.staff_credentials', [
                    'staff' => $staff,
                    'password' => $plainPassword
                ], function ($message) use ($staff) {
                    $message->to($staff->email);
                    $message->subject('Your Account Credentials');
                });
                
             }

    return back()->with('success', 'Staff created successfully & email sent!');
}

    public function destroy($id)
    {
        $staff = Admin::findOrFail($id);

        // Delete profile image if exists
        if (!empty($staff->profile)) {
            $path = public_path('assets/adminprofile/' . $staff->profile);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        // Delete staff record
        $staff->delete();

        return redirect()->back()->with('success', 'Staff deleted successfully');
    }

    public function staffStatus(Request $request)
    {
        $staffs = Admin::findOrFail($request->id);

        // If checkbox checked → active, else inactive
        $staffs->status = $request->has('status') ? 'active' : 'inactive';

        $staffs->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function updateStaff(Request $request, $id)
    {
        // dd($request->all());
        $staff = Admin::findOrFail($id);

        // Validation rules
        $rules = [
            'Role' => 'required',
            'username' => 'required|max:50|unique:admins,username,' . $id,


        ];

        $messages = [

            'role.required' => 'Role is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'Username is already exist.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal', 'edit')
                ->with('editStaffId', $id); // Pass the ID of the staff that failed
        }
        // Update staff data
        $staff->role_id = $request->Role;
        $staff->username = $request->username;
        $staff->status = $request->staff_status;



        $staff->save();

        return redirect()->back()->with('success', 'Staff updated successfully!');
    }

    private function generateStrongPassword($length = 8)
{
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '@$!%*#?&';

    // Ensure at least one of each
    $password =
        $lower[rand(0, strlen($lower) - 1)] .
        $upper[rand(0, strlen($upper) - 1)] .
        $numbers[rand(0, strlen($numbers) - 1)] .
        $symbols[rand(0, strlen($symbols) - 1)];

    // Fill remaining length
    $all = $lower . $upper . $numbers . $symbols;

    for ($i = strlen($password); $i < $length; $i++) {
        $password .= $all[rand(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}
}
