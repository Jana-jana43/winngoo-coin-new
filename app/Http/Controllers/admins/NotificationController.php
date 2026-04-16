<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        return view('admin.notifications.index', compact('notifications'));
    }

    // public function store(Request $request)
    // {

    //     // $request->merge([
    //     //     'scheduled_time' => $request->hour.':'.$request->minute.' '.$request->ampm,
    //     // ]);


        

    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'message' => 'required|string|max:1000',
    //         'type' => 'required|in:Information,Warning,Success',
    //         'audience' => 'required|in:All Users,Premium Users,Subscribed Users',
    //         'medium' => 'required|array|min:1',
    //         'medium.*' => 'in:In-App,Email,SMS',
    //         'scheduled_date' => 'required|date|after_or_equal:today',
    //         'scheduled_time' => 'required',
    //     ], [
    //         'title.required' => 'Title is required.',
    //         'message.required' => 'Message is required.',
    //         'type.required' => 'Please select a notification type.',
    //         'type.in' => 'Invalid notification type selected.',
    //         'audience.required' => 'Please select a target audience.',
    //         'medium.required' => 'Please select at least one delivery medium.',
    //         'medium.min' => 'Please select at least one delivery medium.',
    //         'scheduled_date.required' => 'Scheduled date is required.',
    //         'scheduled_date.after_or_equal' => 'Scheduled date must be today or a future date.',
    //         'scheduled_time.required' => 'Scheduled time is required.',
    //     ]);

    //     Notification::create([
    //         'title' => $validated['title'],
    //         'message' => $validated['message'],
    //         'type' => $validated['type'],
    //         'audience' => $validated['audience'],
    //         'medium' => implode(',', $validated['medium']),
    //         'scheduled_date' => $validated['scheduled_date'],
    //         'scheduled_time' => $validated['scheduled_time'],
    //         'status' => 'Pending',
    //     ]);

    //     if ($request->ajax()) {
    //         session()->flash('success', 'Notification created successfully.');

    //         return response()->json(['success' => true]);
    //     }

    //     return redirect()->route('admin.notifications')->with('success', 'Notification created successfully.');
    // }


    public function store(Request $request)
{
    // ✅ Validation
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        'type' => 'required|in:Information,Warning,Success',
        'audience' => 'required|in:All Users,Premium Users,Subscribed Users',
        'medium' => 'required|array|min:1',
        'medium.*' => 'in:In-App,Email,SMS',
        'scheduled_date' => 'required|date|after_or_equal:today',
        'scheduled_time' => 'required', // comes from JS (10:30 AM)
    ], [
        'title.required' => 'Title is required.',
        'message.required' => 'Message is required.',
        'type.required' => 'Please select a notification type.',
        'type.in' => 'Invalid notification type selected.',
        'audience.required' => 'Please select a target audience.',
        'medium.required' => 'Please select at least one delivery medium.',
        'medium.min' => 'Please select at least one delivery medium.',
        'scheduled_date.required' => 'Scheduled date is required.',
        'scheduled_date.after_or_equal' => 'Scheduled date must be today or a future date.',
        'scheduled_time.required' => 'Scheduled time is required.',
    ]);

    // ✅ Convert 12hr (AM/PM) → 24hr (DB TIME format)
    $time = date("H:i:s", strtotime($request->scheduled_time));

    // ✅ Store in DB
    Notification::create([
        'title' => $validated['title'],
        'message' => $validated['message'],
        'type' => $validated['type'],
        'audience' => $validated['audience'],
        'medium' => implode(',', $validated['medium']),
        'scheduled_date' => $validated['scheduled_date'],
        'scheduled_time' => $time, // ✅ correct format
        'status' => 'Pending',
    ]);

    // ✅ AJAX response
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Notification created successfully.'
        ]);
    }

    // ✅ Normal response
    return redirect()->route('admin.notifications')
        ->with('success', 'Notification created successfully.');
}

// public function store(Request $request)
// {
//     // ✅ Validation
//     $validated = $request->validate([
//         'title'          => 'required|string|max:255',
//         'message'        => 'required|string|max:1000',
//         'type'           => 'required|in:Information,Warning,Success',
//         'audience'       => 'required|in:All Users,Premium Users,Subscribed Users',
//         'medium'         => 'required|array|min:1',
//         'medium.*'       => 'in:In-App,Email,SMS',
//         'scheduled_date' => 'required|date|after_or_equal:today',
//         'scheduled_time' => 'required',
//     ], [
//         'title.required'                  => 'Title is required.',
//         'message.required'                => 'Message is required.',
//         'type.required'                   => 'Please select a notification type.',
//         'type.in'                         => 'Invalid notification type selected.',
//         'audience.required'               => 'Please select a target audience.',
//         'medium.required'                 => 'Please select at least one delivery medium.',
//         'medium.min'                      => 'Please select at least one delivery medium.',
//         'scheduled_date.required'         => 'Scheduled date is required.',
//         'scheduled_date.after_or_equal'   => 'Scheduled date must be today or a future date.',
//         'scheduled_time.required'         => 'Scheduled time is required.',
//     ]);

//     // ✅ Convert 12hr → 24hr
//     $time = date("H:i:s", strtotime($request->scheduled_time));

//     // ✅ Store in DB
//     $notification = Notification::create([
//         'title'          => $validated['title'],
//         'message'        => $validated['message'],
//         'type'           => $validated['type'],
//         'audience'       => $validated['audience'],
//         'medium'         => implode(',', $validated['medium']),
//         'scheduled_date' => $validated['scheduled_date'],
//         'scheduled_time' => $time,
//         'status'         => 'Pending',
//     ]);

//     $scheduled = \Carbon\Carbon::parse(
//         $validated['scheduled_date'] . ' ' . $time,
//         'Asia/Kolkata'
//     );

//     $now          = \Carbon\Carbon::now('Asia/Kolkata');
//     $delaySeconds = $now->diffInSeconds($scheduled, false);

//     if ($delaySeconds <= 0) {
//         \App\Jobs\SendNotificationJob::dispatch($notification);
//     } else {
//         \App\Jobs\SendNotificationJob::dispatch($notification)
//             ->delay(now()->addSeconds($delaySeconds));
//     }

//     if ($request->ajax()) {
//         return response()->json([
//             'success' => true,
//             'message' => 'Notification created and scheduled successfully.'
//         ]);
//     }

//     return redirect()->route('admin.notifications')
//         ->with('success', 'Notification scheduled successfully.');
// }

// public function store(Request $request)
// {
//     $validated = $request->validate([
//         'title'          => 'required|string|max:255',
//         'message'        => 'required|string|max:1000',
//         'type'           => 'required|in:Information,Warning,Success',
//         'audience'       => 'required|in:All Users,Premium Users,Subscribed Users',
//         'medium'         => 'required|array|min:1',
//         'medium.*'       => 'in:In-App,Email,FCM',
//         'scheduled_date' => 'required|date|after_or_equal:today',
//         'scheduled_time' => 'required',
//     ]);

//     $time = date("H:i:s", strtotime($request->scheduled_time));

//     $notification = \App\Models\Notification::create([
//         'title'          => $validated['title'],
//         'message'        => $validated['message'],
//         'type'           => $validated['type'],
//         'audience'       => $validated['audience'],
//         'medium'         => implode(',', $validated['medium']),
//         'scheduled_date' => $validated['scheduled_date'],
//         'scheduled_time' => $time,
//         'status'         => 'Pending',
//     ]);

//     $users = match($validated['audience']) {
//         'All Users'        => \App\Models\User::all(),
//         'Premium Users'    => \App\Models\User::where('plan', 'premium')->get(),
//         'Subscribed Users' => \App\Models\User::where('subscribed', true)->get(),
//         default            => collect(),
//     };

//     $scheduled    = \Carbon\Carbon::parse($validated['scheduled_date'] . ' ' . $time, 'Asia/Kolkata');
//     $delaySeconds = max(0, \Carbon\Carbon::now('Asia/Kolkata')->diffInSeconds($scheduled, false));

//     $batchDelay = 0; // ✅ ADD THIS

//     foreach ($users as $user) {
//         \App\Jobs\SendNotificationJob::dispatch(
//             $notification,
//             $user,
//             $validated['medium']
//         )->delay(now()->addSeconds($delaySeconds + $batchDelay)); // ✅ ADD THIS

//         $batchDelay += 2; // ✅ ADD THIS — 2 second gap between each user
//     }

//     if ($request->ajax()) {
//         return response()->json([
//             'success' => true,
//             'message' => 'Notification created and scheduled successfully.'
//         ]);
//     }

//     return redirect()->route('admin.notifications')
//         ->with('success', 'Notification scheduled successfully.');
// }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $request->merge([
            'scheduled_time' => $request->hour.':'.$request->minute.' '.$request->ampm,
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|in:Information,Warning,Success',
            'audience' => 'required|in:All Users,Premium Users,Subscribed Users',
            'medium' => 'required|array|min:1',
            'medium.*' => 'in:In-App,Email,SMS',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'message.required' => 'Message is required.',
            'type.required' => 'Please select a notification type.',
            'type.in' => 'Invalid notification type selected.',
            'audience.required' => 'Please select a target audience.',
            'medium.required' => 'Please select at least one delivery medium.',
            'medium.min' => 'Please select at least one delivery medium.',
            'scheduled_date.required' => 'Scheduled date is required.',
            'scheduled_time.required' => 'Scheduled time is required.',
        ]);

        $notification->update([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'type' => $validated['type'],
            'audience' => $validated['audience'],
            'medium' => implode(',', $validated['medium']),
            'scheduled_date' => $validated['scheduled_date'],
            'scheduled_time' => $validated['scheduled_time'],
        ]);

        if ($request->ajax()) {
            session()->flash('success', 'Notification updated successfully.');

            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.notifications')->with('success', 'Notification updated successfully.');
    }

    public function destroy($id)
{
    $notification = Notification::findOrFail($id);
    $notification->delete();

    if (request()->ajax()) {
        session()->flash('success', 'Notification deleted successfully.');
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.notifications')
                     ->with('success', 'Notification deleted successfully.');
}
}
