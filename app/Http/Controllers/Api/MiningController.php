<?php



namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\UserMining;

use Carbon\Carbon;

use App\Models\Coin;

use Illuminate\Support\Facades\Hash;

use App\Models\Country;

use Illuminate\Support\Facades\Auth;

use DB;

class MiningController extends Controller

{






public function activate(Request $request)
{
    $user = auth()->user();
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $mining = UserMining::where('user_id', $user->id)->first();
    if (!$mining) {
        return response()->json(['message' => 'Mining record not found'], 404);
    }

    $coin        = Coin::where('name', $mining->coin_type)->first();
    $totalMonths = (int)($coin ? $coin->mining_period : 24);

    $currentProgress   = (float) $mining->progress;
    $remainingProgress = 100 - $currentProgress;

    /*
    =====================
    FIRST TIME ACTIVATE
    =====================
    */
    if (!$mining->start_date) {
        $start         = now();
        $firstProgress = round((1 / $totalMonths) * 100, 2);
        $nextDue       = $start->copy()->addDays(30);
        $endDate       = $start->copy()->addDays($totalMonths * 30);

        $mining->update([
            'start_date'        => $start,
            'monthly_due_date'  => $nextDue,
            'end_date'          => $endDate,
            'is_active'         => true,
            'last_activated_at' => now(),
            'progress'          => $firstProgress,
            'current_month'     => 1,
        ]);

        DB::table('user_mining_history')->insert([
            'user_id'          => $user->id,
            'coin_type'        => $mining->coin_type,
            'start_date'       => $start,
            'end_date'         => $endDate,
            'monthly_due_date' => $nextDue,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return response()->json([
            'message'  => 'Mining started successfully',
            'progress' => $firstProgress,
        ]);
    }

    /*
    =====================
    EARLY ACTIVATION
    =====================
    */
    if ($mining->monthly_due_date && now()->lt($mining->monthly_due_date)) {

        $nextDue = now()->copy()->addDays(30);

        // ❌ NO progress change
        $newProgress = $currentProgress;

        $mining->update([
            'monthly_due_date'   => $nextDue,
            'pending_activation' => true,
            'last_activated_at'  => now(),
            'progress'           => $currentProgress, // unchanged
            'current_month'      => $mining->current_month, // unchanged
        ]);

        // ✅ History check
        $todayHistory = DB::table('user_mining_history')
            ->where('user_id', $user->id)
            ->whereDate('start_date', now()->toDateString())
            ->first();

        if ($todayHistory) {
            DB::table('user_mining_history')
                ->where('id', $todayHistory->id)
                ->update([
                    'monthly_due_date' => $nextDue,
                    'updated_at'       => now(),
                ]);
        } else {
            DB::table('user_mining_history')->insert([
                'user_id'          => $user->id,
                'coin_type'        => $mining->coin_type,
                'start_date'       => now(),
                'end_date'         => $mining->end_date, // unchanged
                'monthly_due_date' => $nextDue,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        return response()->json([
            'message'  => 'Early activation successful',
            'progress' => $currentProgress,
        ]);
    }

    /*
    =====================
    MONTH COMPLETED
    =====================
    */
    if (!$mining->monthly_due_date || now()->gte($mining->monthly_due_date)) {

        $monthsSinceStart = (int)(
            Carbon::parse($mining->start_date)
                ->diffInDays(Carbon::parse($mining->monthly_due_date)) / 30
        );

        $missedMonths = ($monthsSinceStart + 1) - $mining->current_month;
        $missedMonths = max(0, $missedMonths);

        if ($missedMonths > 0) {
            $newEndDate              = Carbon::parse($mining->end_date)->addDays($missedMonths * 30);
            $mining->inactive_months += $missedMonths;
        } else {
            $newEndDate = Carbon::parse($mining->end_date);
        }

        $totalDaysLate = (int) Carbon::parse($mining->monthly_due_date)->diffInDays(now());
        $lateDays      = max(0, $totalDaysLate - ($missedMonths * 30) - 1);

        if ($lateDays > 0) {
            $newEndDate = $newEndDate->copy()->addDays($lateDays);
        }

        $nextDue         = now()->copy()->addDays(30);
        $remainingMonths = max(1, $totalMonths - $mining->current_month);
        $monthlyProgress = $remainingProgress / $remainingMonths;
        $newProgress     = min(100, $currentProgress + $monthlyProgress);

        $mining->update([
            'progress'           => round($newProgress, 2),
            'monthly_due_date'   => $nextDue,
            'pending_activation' => false,
            'last_activated_at'  => now(),
            'end_date'           => $newEndDate,
            'current_month'      => $mining->current_month + 1,
            'inactive_months'    => $mining->inactive_months,
        ]);

        // ✅ History check
        $todayHistory = DB::table('user_mining_history')
            ->where('user_id', $user->id)
            ->whereDate('start_date', now()->toDateString())
            ->first();

        if ($todayHistory) {
            DB::table('user_mining_history')
                ->where('id', $todayHistory->id)
                ->update([
                    'end_date'         => $newEndDate,
                    'monthly_due_date' => $nextDue,
                    'updated_at'       => now(),
                ]);
        } else {
            DB::table('user_mining_history')->insert([
                'user_id'          => $user->id,
                'coin_type'        => $mining->coin_type,
                'start_date'       => now(),
                'end_date'         => $newEndDate,
                'monthly_due_date' => $nextDue,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        return response()->json([
            'message'       => 'Mining updated',
            'progress'      => round($newProgress, 2),
            'end_date'      => $newEndDate,
            'missed_months' => $missedMonths,
            'late_days'     => $lateDays,
        ]);
    }
}


// 07-04





public function dashboard()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }

    $mining = UserMining::where('user_id', $user->id)->first();

    if (!$mining) {
        return response()->json([
            'message' => 'Mining record not found'
        ], 404);
    }

    $coin = Coin::where('name', $mining->coin_type)->first();

    // ✅ Use end_date from user_mining table directly
    $endDate = $mining->end_date;

    // Mining completed check
    if ($mining->progress >= 100) {
        return response()->json([
            'coin_type' => $mining->coin_type,
            'coin_image' => $coin ? asset($coin->image) : null,
            'coin_image2' => $coin ? asset($coin->image2) : null,
            'start_date' => $mining->start_date,
            'end_date' => $endDate,    // ← from user_mining
            'progress' => 100,
            'inactive_months' => $mining->inactive_months,
            'mining_status' => 'Completed',
            'message' => 'Mining completed successfully'
        ]);
    }

    return response()->json([
        'coin_type' => $mining->coin_type,
        'coin_image' => $coin ? asset($coin->image) : null,
        'coin_image2' => $coin ? asset($coin->image2) : null,
        'start_date' => $mining->start_date,
        'end_date' => $endDate,      // ← from user_mining
        'monthly_due_date' => $mining->monthly_due_date,
        'progress' => round($mining->progress, 2),
        'inactive_months' => $mining->inactive_months,
        'mining_status' => $mining->is_active ? 'Active' : 'Inactive',
        'next_activation_required' => $mining->monthly_due_date
    ]);
}














public function progress()

{

    $user = auth()->user();

    if (!$user) {

    return response()->json([

        'message' => 'Unauthenticated'

    ], 401);

}

    $mining = UserMining::where('user_id', $user->id)->first();

if (!$mining) {

    return response()->json([

        'message' => 'Mining record not found'

    ], 404);

}

    return response()->json([

        'total_progress' => $mining->progress,

        'months_completed' => floor($mining->progress / (100 / 24)),

        'total_months' => 24

    ]);

}



public function changePassword(Request $request)

{

    $request->validate([

        'old_password' => 'required',

        'new_password' => 'required|min:6|confirmed'

    ]);



    $user = auth()->user();



    if (!Hash::check($request->old_password, $user->password)) {

        return response()->json([

            'message' => 'Old password is incorrect'

        ], 400);

    }



    $user->update([

        'password' => Hash::make($request->new_password)

    ]);



    return response()->json([

        'message' => 'Password changed successfully'

    ]);

}



public function profile(){

    $user = auth()->user();

    $user->photo = $user->photo 

        ? url('assets/images/profile/'.$user->photo)

        : null;

      return response()->json([

        'user' => $user,

        

    ]);

}



public function updateProfile(Request $request)

{

    $user = auth()->user();



    $request->validate([

        'name' => 'required|string|min:2',

        'dob' => 'required|date',

        'country_id' => 'required|exists:countries,id',

        'postal_code' => 'nullable|string'

    ]);



    $country = Country::find($request->country_id);



    /* AGE VALIDATION */

    $age = \Carbon\Carbon::parse($request->dob)->age;

    if ($age < 18) {

        return response()->json([

            'message' => 'You must be at least 18 years old'

        ], 422);

    }



    /* POSTAL CODE VALIDATION */

    if ($country->postal_regex && $request->postal_code) {

        if (!preg_match('/'.$country->postal_regex.'/', $request->postal_code)) {

            return response()->json([

                'message' => 'Invalid postal code for selected country'

            ], 422);

        }

    }



    $user->update([

        'name' => $request->name,

        'dob' => $request->dob,

        'country_id' => $request->country_id,

        'postal_code' => $request->postal_code

    ]);



    return response()->json([

        'message' => 'Profile updated successfully',

        'user' => $user

    ]);

}



public function updateProfilePhoto(Request $request)

{

    $request->validate([

        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'

    ]);



    $user = Auth::user();



    if ($request->hasFile('photo')) {



        $file = $request->file('photo');



        $filename = time().'_'.$file->getClientOriginalName();



        $destination = public_path('assets/images/profile');



        $file->move($destination, $filename);



        // delete old photo

        if ($user->photo && file_exists(public_path('assets/images/profile/'.$user->photo))) {

            unlink(public_path('assets/images/profile/'.$user->photo));

        }



        $user->photo = $filename;

        $user->save();

    }



    return response()->json([

        'success' => true,

        'message' => 'Profile photo updated successfully',

        // 'photo_url' => asset('assets/images/profile/'.$filename)

    ]);

}




// future
// sowmii
public function miningHistory(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
    }

    $histories = DB::table('user_mining_history')
        ->where('user_id', $user->id)
        ->orderBy('start_date', 'asc')
        ->get();

    if ($histories->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'Mining not started'], 404);
    }

    $userMining = DB::table('user_mining')->where('user_id', $user->id)->first();
    $inactiveMonths = $userMining ? (int)$userMining->inactive_months : 0;
    $currentMonth   = $userMining ? (int)$userMining->current_month : 0;

    $firstCoin = Coin::where('name', $histories->first()->coin_type)->first();
    $maxCycles = (int)($firstCoin ? $firstCoin->mining_period : 24);

    $planEnd       = Carbon::parse($histories->last()->end_date);
    $coinHistories = $histories->values();
    $total         = $coinHistories->count();

    $data             = [];
    $activeCycleCount = 0; // ✅ Only active cycles count toward the cap
    $cycleCount       = 0; // total safety counter

    for ($i = 0; $i < $total; $i++) {
        if ($activeCycleCount >= $maxCycles) break; // ✅ Only break on active cycle cap

        $row        = $coinHistories[$i];
        $cycleStart = Carbon::parse($row->start_date);

        $thisDue  = Carbon::parse($row->monthly_due_date);
        $cycleEnd = $thisDue->copy();
        if ($cycleEnd->gt($planEnd)) $cycleEnd = $planEnd->copy();

        $nextStart = ($i + 1 < $total)
            ? Carbon::parse($coinHistories[$i + 1]->start_date)
            : null;

        // ✅ Add active row
        $data[] = [
            'coin'          => $row->coin_type,
            'start_date'    => $cycleStart->format('d.m.Y'),
            'end_date'      => $cycleEnd->format('d.m.Y'),
            'mining_status' => 'Active',
        ];
        $activeCycleCount++; // ✅ Increment ONLY for active
        $cycleCount++;

        // ✅ Fill gap (inactive) between this row's due date and next row's start
        if ($nextStart && $thisDue->lt($nextStart)) {
            $gapCursor = $thisDue->copy();

            while ($gapCursor->lt($nextStart)) {
                $slotEnd  = $gapCursor->copy()->addDays(30);
                if ($slotEnd->gt($nextStart)) $slotEnd = $nextStart->copy();

                $slotDays = $gapCursor->diffInDays($slotEnd);
                if ($slotDays < 28) break;

                $data[] = [
                    'coin'          => $row->coin_type,
                    'start_date'    => $gapCursor->format('d.m.Y'),
                    'end_date'      => $slotEnd->format('d.m.Y'),
                    'mining_status' => 'Inactive',
                ];
                // ✅ Inactive does NOT increment $activeCycleCount
                $cycleCount++;
                $gapCursor = $slotEnd->copy();
            }
        }
    }

    // ✅ Append remaining inactive months after last active row
    $generatedInactive = count(array_filter($data, fn($d) => $d['mining_status'] === 'Inactive'));

    if ($inactiveMonths > 0 && $generatedInactive < $inactiveMonths && !empty($data)) {
        // ✅ Find the last ACTIVE entry specifically
        $activeEntries = array_filter($data, fn($d) => $d['mining_status'] === 'Active');
        $lastActive    = end($activeEntries);
        $cursor        = Carbon::createFromFormat('d.m.Y', $lastActive['end_date']);
        $remaining     = $inactiveMonths - $generatedInactive;

        for ($m = 0; $m < $remaining; $m++) { // ✅ No cycle cap on inactive months
            $slotEnd = $cursor->copy()->addDays(30);
            $data[]  = [
                'coin'          => $lastActive['coin'],
                'start_date'    => $cursor->format('d.m.Y'),
                'end_date'      => $slotEnd->format('d.m.Y'),
                'mining_status' => 'Inactive',
            ];
            $cursor = $slotEnd->copy();
        }
    }

    // Sort by start_date ascending
    usort($data, function ($a, $b) {
        return Carbon::createFromFormat('d.m.Y', $a['start_date'])
            ->lt(Carbon::createFromFormat('d.m.Y', $b['start_date'])) ? -1 : 1;
    });

    // Deduplicate by coin + start_date
    $final    = [];
    $seenKeys = [];
    foreach ($data as $item) {
        $key = $item['coin'] . '_' . $item['start_date'];
        if (!isset($seenKeys[$key])) {
            $seenKeys[$key] = true;
            $final[]        = $item;
        }
    }

    return response()->json([
        'status'  => true,
        'message' => 'Mining history fetched successfully',
        'data'    => $final
    ]);
}




public function updateCoin(Request $request)
    {
        $userId = $request->user_id;
        $newCoinType = $request->coin_type;

        $mining = UserMining::where('user_id', $userId)->first();

        if (!$mining) {
            return response()->json(['message' => 'Mining record not found'], 404);
        }

        if (!$mining->start_date) {
            return response()->json(['message' => 'Mining not started yet'], 400);
        }

        $startDate = Carbon::parse($mining->start_date);

        // ✅ completed months (inactive removed)
        $monthsCompleted = $startDate->diffInMonths(now()) - $mining->inactive_months;
        $monthsCompleted = max(0, $monthsCompleted);

        // ✅ new duration from DB
        $coin = Coin::where('name', $newCoinType)->first();
        $newDuration = $coin ? $coin->mining_period : 24;

        // ✅ progress
        if ($monthsCompleted >= $newDuration) {
            $progress = 100;
        } else {
            $progress = ($monthsCompleted / $newDuration) * 100;
        }

        $newEndDate = $startDate->copy()->addMonths($newDuration + $mining->inactive_months);

        $mining->update([
            'coin_type' => $newCoinType,
            'progress' => min(100, $progress),
            'end_date' => $newEndDate
        ]);

        return response()->json([
            'message' => 'Coin updated successfully',
            'new_coin' => $newCoinType,
            'progress' => round($progress, 2),
            'end_date' => $newEndDate
        ]);
    }
    
    
    
    public function sendDueNotifications()
{
    $today = Carbon::today();

    $users = User::whereNotNull('monthly_due_date')->get();

    foreach ($users as $user) {

        $dueDate = Carbon::parse($user->monthly_due_date);

        // Check if today is within 3 days before due date
        if ($today->between($dueDate->copy()->subDays(2), $dueDate)) {

            // 🔔 Send Notification
            // Example: DB / SMS / Email

            \Log::info("Notification sent to User ID: " . $user->id);

            // Example DB Notification
            // Notification::send($user, new DueReminderNotification());

        }
    }

    return response()->json(['message' => 'Notifications processed']);
}
    
    
    public function getNotifications()
{
    $notifications = \DB::table('notifications')
        ->where('user_id', auth()->id())
        ->orderBy('id', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'data' => $notifications
    ]);
}
    
    
    
}


