<?php

namespace App\Http\Controllers\admins;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\UserMining;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\Setting;


class MemberController extends Controller
{

private function generateStrongPassword($length = 10)
{
    $upper   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower   = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $special = '@#$%&*!';

    // ✅ Guarantee at least one of each
    $password  = $upper[random_int(0, strlen($upper) - 1)];
    $password .= $lower[random_int(0, strlen($lower) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];

    // ✅ Fill remaining length randomly
    $all = $upper . $lower . $numbers . $special;
    for ($i = 4; $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    // ✅ Shuffle so guaranteed chars not always at start
    return str_shuffle($password);
}
    //
//  public function index()
// {
//     $users = \App\Models\User::with(['country', 'mining'])->latest()->get();
//     $countries = Country::all(); 

//     return view('admin.members.view', compact('users','countries'));
// }

// public function index()
// {
//      $users = User::with(['country', 'mining.coin'])->latest()->get();
//     $countries = Country::all();

//         $coins = Coin::where('status', 'active')->get(); 
//     // ✅ Get last user_code (NOT id)
//     $lastUser = User::orderBy('user_code', 'desc')->first();

//     if ($lastUser && $lastUser->user_code) {
//         // Extract number from WCU00008
//         $number = (int) substr($lastUser->user_code, 3);
//         $nextNumber = $number + 1;
//     } else {
//         $nextNumber = 1;
//     }

//     // ✅ Format
//     $nextUserCode = 'WCU' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

//     return view('admin.members.view', compact('users', 'countries', 'nextUserCode','coins'));
// }
// public function index()
// {
//     $users = User::with(['country', 'mining.coin'])->latest()->get();
//     $countries = Country::all();
//     $coins = Coin::where('status', 'active')->get(); 

//     // ✅ Dynamic Upgrade Rules (you can later move this to a service or config)
//     $upgradeRules = [
//         'Bronze' => ['Silver', 'Gold'],
//         'Silver' => ['Gold'],
//         'Gold'  => []   // highest plan - no upgrade
//     ];

//     // Pass coins and upgrade rules to view
//     $lastUser = User::orderBy('user_code', 'desc')->first();
//     $number = $lastUser && $lastUser->user_code 
//         ? (int) substr($lastUser->user_code, 3) + 1 
//         : 1;

//     $nextUserCode = 'WCU' . str_pad($number, 5, '0', STR_PAD_LEFT);

//     return view('admin.members.view', compact(
//         'users', 
//         'countries', 
//         'nextUserCode', 
//         'coins',
//         'upgradeRules'  
//     ));
// }









public function index()
{
    $users = User::with(['country', 'mining.coin'])->latest()->get();
    $countries = Country::all();
    $coins = Coin::where('status', 'active')->get();

    // $upgradeRules = [
    //     'Bronze' => ['Silver', 'Gold'],
    //     'Silver' => ['Gold'],
    //     'Gold'   => []
    // ];
    
    
    $activeCoins = Coin::where('status', 'active')->pluck('name')->toArray();

$allTiers = ['Bronze', 'Silver', 'Gold'];

$upgradeRules = [];
foreach ($allTiers as $index => $tier) {
    $upgradeRules[$tier] = array_values(
        array_filter(
            array_slice($allTiers, $index + 1),
            fn($coin) => in_array($coin, $activeCoins)
        )
    );
}

    $lastUser = User::orderBy('user_code', 'desc')->first();
    $number = $lastUser && $lastUser->user_code
        ? (int) substr($lastUser->user_code, 3) + 1
        : 1;
    $nextUserCode = 'WCU' . str_pad($number, '0', STR_PAD_LEFT);

    // ✅ Each user-க்கு mining history prepare பண்ணு
    $miningHistories = [];
    foreach ($users as $user) {
        $miningHistories[$user->id] = $this->getMiningHistory($user->id);
    }

    return view('admin.members.view', compact(
        'users',
        'countries',
        'nextUserCode',
        'coins',
        'upgradeRules',
        'miningHistories'  // ✅ pass to view
    ));
}

// // ✅ Helper function
// private function getMiningHistory($userId)
// {
//     $today = Carbon::today();

//     $histories = DB::table('user_mining_history')
//         ->where('user_id', $userId)
//         ->orderBy('start_date', 'asc')
//         ->get();

//     if ($histories->isEmpty()) return [];

//     $plans = DB::table('user_mining_history')
//         ->where('user_id', $userId)
//         ->select(
//             'coin_type',
//             DB::raw('MIN(start_date) as plan_start'),
//             DB::raw('MAX(end_date) as plan_end')
//         )
//         ->groupBy('coin_type')
//         ->orderBy('plan_start', 'asc')
//         ->get();

//     // Next coin start dates (for overlap fix)
//     $planList  = $plans->values();
//     $stopDates = [];
//     for ($p = 0; $p < count($planList); $p++) {
//         if (isset($planList[$p + 1])) {
//             $stopDates[$planList[$p]->coin_type] = Carbon::parse($planList[$p + 1]->plan_start);
//         } else {
//             $stopDates[$planList[$p]->coin_type] = $today->copy()->addDays(1);
//         }
//     }

//   $data = [];

// foreach ($plans as $plan) {
//     $coin      = Coin::where('name', $plan->coin_type)->first();
//     $maxCycles = (int)($coin ? $coin->mining_period : 24) + 12;

//     $startDate         = Carbon::parse($plan->plan_start);
//     $stopDate          = $stopDates[$plan->coin_type];
//     $currentCycleStart = $startDate->copy();

//     for ($i = 0; $i < $maxCycles; $i++) {
//         $currentCycleEnd = $currentCycleStart->copy()->addDays(30);

//         if ($currentCycleStart->gt($today)) break;
//         if ($currentCycleStart->gte($stopDate)) break;

//         $isActive = $histories->contains(function ($history) use ($currentCycleStart, $currentCycleEnd, $plan) {
//             if ($history->coin_type !== $plan->coin_type) return false;
//             $hDate = Carbon::parse($history->start_date);
//             return $hDate->gte($currentCycleStart) && $hDate->lt($currentCycleEnd);
//         });

//         // ✅ இந்த cycle எந்த months touch பண்றதோ அந்த months எல்லாம் add பண்ணு
//         $pointer = $currentCycleStart->copy()->startOfMonth();
//         $endOfCycle = $currentCycleEnd->copy();

//         while ($pointer->lte($endOfCycle) && $pointer->lte($today)) {
//             $data[] = [
//                 'coin'          => $plan->coin_type,
//                 'start_date'    => $pointer->format('01.m.Y'), // month start
//                 'end_date'      => $pointer->copy()->endOfMonth()->format('d.m.Y'),
//                 'month'         => (int)$pointer->format('m'),
//                 'year'          => (int)$pointer->format('Y'),
//                 'mining_status' => $isActive ? 'Active' : 'Inactive',
//             ];
//             $pointer->addMonth();
//         }

//         $currentCycleStart = $currentCycleEnd->copy();
//     }
// }

// // ✅ De-duplicate by coin+year+month — Active wins
// $merged = [];
// foreach ($data as $item) {
//     $key = $item['coin'] . '_' . $item['year'] . '_' . $item['month'];
//     if (!isset($merged[$key])) {
//         $merged[$key] = $item;
//     } elseif ($item['mining_status'] === 'Active') {
//         $merged[$key]['mining_status'] = 'Active'; // Active always wins
//     }
// }

// // ✅ Sort by year → month
// usort($merged, function ($a, $b) {
//     if ($a['year'] !== $b['year']) return $a['year'] - $b['year'];
//     return $a['month'] - $b['month'];
// });

// return array_values($merged);

// }



// private function getMiningHistory($userId)
// {
//     $histories = DB::table('user_mining_history')
//         ->where('user_id', $userId)
//         ->orderBy('start_date', 'asc')
//         ->get();

//     if ($histories->isEmpty()) return [];

//     $firstCoin = Coin::where('name', $histories->first()->coin_type)->first();
//     $maxCycles = (int)($firstCoin ? $firstCoin->mining_period : 24);

//     $planEnd       = Carbon::parse($histories->last()->end_date);
//     $coinHistories = $histories->values();
//     $total         = $coinHistories->count();

//     $data       = [];
//     $cycleCount = 0;

//     for ($i = 0; $i < $total; $i++) {
//         if ($cycleCount >= $maxCycles) break;

//         $row        = $coinHistories[$i];
//         $cycleStart = Carbon::parse($row->start_date);

//         if ($cycleStart->gt(now())) break;

//         $thisDue = $row->monthly_due_date
//             ? Carbon::parse($row->monthly_due_date)
//             : $cycleStart->copy()->addDays(30);

//         $cycleEnd = $thisDue->copy();
//         if ($cycleEnd->gt($planEnd)) $cycleEnd = $planEnd->copy();

//         $nextStart = ($i + 1 < $total)
//             ? Carbon::parse($coinHistories[$i + 1]->start_date)
//             : null;

//         // Active row
//         $data[] = [
//             'coin'          => $row->coin_type,
//             'start_date'    => $cycleStart->format('d.m.Y'),
//             'end_date'      => $cycleEnd->format('d.m.Y'),
//             'mining_status' => 'Active',
//         ];
//         $cycleCount++;

//         // Gap = Inactive
//         if ($nextStart && $thisDue->lt($nextStart) && $cycleCount < $maxCycles) {
//             $gapCursor = $thisDue->copy();

//             while ($gapCursor->lt($nextStart) && $cycleCount < $maxCycles) {
//                 if ($gapCursor->gt(now())) break;

//                 $slotEnd  = $gapCursor->copy()->addDays(30);
//                 if ($slotEnd->gt($nextStart)) $slotEnd = $nextStart->copy();

//                 if ($gapCursor->diffInDays($slotEnd) < 30) break;

//                 $data[] = [
//                     'coin'          => $row->coin_type,
//                     'start_date'    => $gapCursor->format('d.m.Y'),
//                     'end_date'      => $slotEnd->format('d.m.Y'),
//                     'mining_status' => 'Inactive',
//                 ];
//                 $cycleCount++;
//                 $gapCursor = $slotEnd->copy();
//             }
//         }
//     }

//     // Sort
//     // usort($data, function ($a, $b) {
//     //     return Carbon::createFromFormat('d.m.Y', $a['start_date'])
//     //         ->lt(Carbon::createFromFormat('d.m.Y', $b['start_date'])) ? -1 : 1;
//     // });
    
//     // Sort
// // Sort
// usort($data, function ($a, $b) {
//     $parseDate = function ($dateStr) {
//         if (empty($dateStr)) {
//             return Carbon::createFromTimestamp(0);
//         }
//         try {
//             $date = Carbon::createFromFormat('d.m.Y', $dateStr);
//             if ($date && $date->year > 0) {
//                 return $date;
//             }
//             return Carbon::createFromTimestamp(0);
//         } catch (\Exception $e) {
//             return Carbon::createFromTimestamp(0);
//         }
//     };

//     $dateA = $parseDate($a['start_date']);
//     $dateB = $parseDate($b['start_date']);

//     return $dateA->lt($dateB) ? -1 : 1;
// });

//     // Deduplicate
//     $final    = [];
//     $seenKeys = [];
//     foreach ($data as $item) {
//         $key = $item['coin'] . '_' . $item['start_date'];
//         if (!isset($seenKeys[$key])) {
//             $seenKeys[$key] = true;
//             $final[]        = $item;
//         }
//     }

//     return $final;
// }





// private function getMiningHistory($userId)
// {
//     $histories = DB::table('user_mining_history')
//         ->where('user_id', $userId)
//         ->orderBy('start_date', 'asc')
//         ->get();

//     if ($histories->isEmpty()) return [];

//     // ✅ Get inactive_months from user_mining
//     $userMining     = DB::table('user_mining')->where('user_id', $userId)->first();
//     $inactiveMonths = $userMining ? (int)$userMining->inactive_months : 0;

//     $firstCoin = Coin::where('name', $histories->first()->coin_type)->first();
//     $maxCycles = (int)($firstCoin ? $firstCoin->mining_period : 24);

//     $planEnd       = Carbon::parse($histories->last()->end_date);
//     $coinHistories = $histories->values();
//     $total         = $coinHistories->count();

//     $data       = [];
//     $cycleCount = 0;

//     for ($i = 0; $i < $total; $i++) {
//         if ($cycleCount >= $maxCycles) break;

//         $row        = $coinHistories[$i];
//         $cycleStart = Carbon::parse($row->start_date);

//         if ($cycleStart->gt(now())) break;

//         $thisDue = $row->monthly_due_date
//             ? Carbon::parse($row->monthly_due_date)
//             : $cycleStart->copy()->addDays(30);

//         $cycleEnd = $thisDue->copy();
//         if ($cycleEnd->gt($planEnd)) $cycleEnd = $planEnd->copy();

//         $nextStart = ($i + 1 < $total)
//             ? Carbon::parse($coinHistories[$i + 1]->start_date)
//             : null;

//         // Active row
//         $data[] = [
//             'coin'          => $row->coin_type,
//             'start_date'    => $cycleStart->format('d.m.Y'),
//             'end_date'      => $cycleEnd->format('d.m.Y'),
//             'mining_status' => 'Active',
//         ];
//         $cycleCount++;

//         // Gap = Inactive
//         if ($nextStart && $thisDue->lt($nextStart) && $cycleCount < $maxCycles) {
//             $gapCursor = $thisDue->copy();

//             while ($gapCursor->lt($nextStart) && $cycleCount < $maxCycles) {
//                 if ($gapCursor->gt(now())) break;

//                 $slotEnd = $gapCursor->copy()->addDays(30);
//                 if ($slotEnd->gt($nextStart)) $slotEnd = $nextStart->copy();
//                 if ($gapCursor->diffInDays($slotEnd) < 28) break;

//                 $data[] = [
//                     'coin'          => $row->coin_type,
//                     'start_date'    => $gapCursor->format('d.m.Y'),
//                     'end_date'      => $slotEnd->format('d.m.Y'),
//                     'mining_status' => 'Inactive',
//                 ];
//                 $cycleCount++;
//                 $gapCursor = $slotEnd->copy();
//             }
//         }
//     }

//     // ✅ Fallback: append missing inactive months from user_mining
//     $generatedInactive = count(array_filter($data, fn($d) => $d['mining_status'] === 'Inactive'));

//     if ($inactiveMonths > 0 && $generatedInactive < $inactiveMonths && !empty($data)) {
//         $lastActive = end($data);
//         $cursor     = Carbon::createFromFormat('d.m.Y', $lastActive['end_date']);
//         $remaining  = $inactiveMonths - $generatedInactive;

//         for ($m = 0; $m < $remaining && $cycleCount < $maxCycles; $m++) {
//             if ($cursor->gt(now())) break;
//             $slotEnd = $cursor->copy()->addDays(30);
//             $data[]  = [
//                 'coin'          => $lastActive['coin'],
//                 'start_date'    => $cursor->format('d.m.Y'),
//                 'end_date'      => $slotEnd->format('d.m.Y'),
//                 'mining_status' => 'Inactive',
//             ];
//             $cycleCount++;
//             $cursor = $slotEnd->copy();
//         }
//     }

//     // Sort
//     $parseDate = function ($dateStr) {
//         if (empty($dateStr)) return Carbon::createFromTimestamp(0);
//         try {
//             $date = Carbon::createFromFormat('d.m.Y', $dateStr);
//             return ($date && $date->year > 0) ? $date : Carbon::createFromTimestamp(0);
//         } catch (\Exception $e) {
//             return Carbon::createFromTimestamp(0);
//         }
//     };

//     usort($data, function ($a, $b) use ($parseDate) {
//         return $parseDate($a['start_date'])->lt($parseDate($b['start_date'])) ? -1 : 1;
//     });

//     // Deduplicate
//     $final    = [];
//     $seenKeys = [];
//     foreach ($data as $item) {
//         $key = $item['coin'] . '_' . $item['start_date'];
//         if (!isset($seenKeys[$key])) {
//             $seenKeys[$key] = true;
//             $final[]        = $item;
//         }
//     }

//     return $final;
// }





private function getMiningHistory($userId)
{
    $histories = DB::table('user_mining_history')
        ->where('user_id', $userId)
        ->orderBy('start_date', 'asc')
        ->get();

    if ($histories->isEmpty()) return [];

    $userMining     = DB::table('user_mining')->where('user_id', $userId)->first();
    $inactiveMonths = $userMining ? (int)$userMining->inactive_months : 0;

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

        // ✅ Removed: if ($cycleStart->gt(now())) break;

        $thisDue = $row->monthly_due_date
            ? Carbon::parse($row->monthly_due_date)
            : $cycleStart->copy()->addDays(30);

        $cycleEnd = $thisDue->copy();
        if ($cycleEnd->gt($planEnd)) $cycleEnd = $planEnd->copy();

        $nextStart = ($i + 1 < $total)
            ? Carbon::parse($coinHistories[$i + 1]->start_date)
            : null;

        // Active row
        $data[] = [
            'coin'          => $row->coin_type,
            'start_date'    => $cycleStart->format('d.m.Y'),
            'end_date'      => $cycleEnd->format('d.m.Y'),
            'mining_status' => 'Active',
        ];
        $activeCycleCount++; // ✅ Increment ONLY for active
        $cycleCount++;

        // Gap = Inactive
        if ($nextStart && $thisDue->lt($nextStart)) {
            $gapCursor = $thisDue->copy();

            while ($gapCursor->lt($nextStart)) {
                // ✅ Removed: if ($gapCursor->gt(now())) break;

                $slotEnd = $gapCursor->copy()->addDays(30);
                if ($slotEnd->gt($nextStart)) $slotEnd = $nextStart->copy();
                if ($gapCursor->diffInDays($slotEnd) < 28) break;

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

        for ($m = 0; $m < $remaining; $m++) { // ✅ No cycle cap, no future date break
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

    // Sort
    $parseDate = function ($dateStr) {
        if (empty($dateStr)) return Carbon::createFromTimestamp(0);
        try {
            $date = Carbon::createFromFormat('d.m.Y', $dateStr);
            return ($date && $date->year > 0) ? $date : Carbon::createFromTimestamp(0);
        } catch (\Exception $e) {
            return Carbon::createFromTimestamp(0);
        }
    };

    usort($data, function ($a, $b) use ($parseDate) {
        return $parseDate($a['start_date'])->lt($parseDate($b['start_date'])) ? -1 : 1;
    });

    // Deduplicate
    $final    = [];
    $seenKeys = [];
    foreach ($data as $item) {
        $key = $item['coin'] . '_' . $item['start_date'];
        if (!isset($seenKeys[$key])) {
            $seenKeys[$key] = true;
            $final[]        = $item;
        }
    }

    return $final;
}






public function destroy($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->mining()->delete();
    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully');
}


public function toggleMining(Request $request, $userId)
{
    $user = User::find($userId);
    
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $mining = UserMining::where('user_id', $userId)->first();

    if (!$mining) {
        return response()->json(['message' => 'Mining record not found'], 404);
    }

    $coin = Coin::where('name', $mining->coin_type)->first();
    $totalMonths  = (int) ($coin ? $coin->mining_period : 24);
    $monthlyProgress = 100 / $totalMonths;

    /*
    FIRST TIME ACTIVATE
    */
    if (!$mining->start_date) {
        $start = now();
        $mining->update([
            'start_date'          => $start,
            'monthly_due_date'    => $start->copy()->addMonth(),
            'end_date'            => $start->copy()->addMonths($totalMonths),
            'is_active'           => true,
            'last_activated_at'   => now(),
            'progress'            => 0
        ]);

        return response()->json([
            'success'   => true,
            'is_active' => true,
            'message'   => 'Mining started successfully',
            'progress'  => 0
        ]);
    }

    /*
    EARLY ACTIVATION (Before due date)
    */
 if ($mining->monthly_due_date && now()->lt($mining->monthly_due_date)) {
        if ($mining->next_cycle_activated_at) {
            return response()->json([
                'success'   => true,
                'is_active' => $mining->is_active,
                'message'   => 'Next cycle already activated'
            ]);
        }

        $mining->update([
            'pending_activation'      => true,
            'next_cycle_activated_at' => now(),
            'is_active'               => true,
        ]);

        return response()->json([
            'success'   => true,
            'is_active' => true,
            'message'   => 'Activation stored for next cycle'
        ]);
    }

    /*
    
    MONTH COMPLETED
    */
    if($mining->monthly_due_date && now()->gte($mining->monthly_due_date)) {
        if ($mining->pending_activation) {
            $progress = $mining->progress + $monthlyProgress;
        } else {
            // Missed activation
            $mining->inactive_months += 1;
            $progress = $mining->progress;
        }

        $nextDue = Carbon::parse($mining->monthly_due_date)->addMonth();

        $endDate = Carbon::parse($mining->start_date)
                    ->addMonths($totalMonths + $mining->inactive_months);

        $mining->update([
            'progress'            => min(100, $progress),
            'monthly_due_date'    => $nextDue,
            'pending_activation'  => false,
            'last_activated_at'   => now(),
            'end_date'            => $endDate,
            'is_active'           => true,
        ]);

        return response()->json([
            'success'        => true,
            'is_active'      => true,
            'message'        => 'Mining updated',
            'progress'       => round($progress, 2),
            'inactive_months'=> $mining->inactive_months,
            'new_end_date'   => $endDate
        ]);
    }
}
// public function store(Request $request)
// {



//     $validator = Validator::make($request->all(), [
//         'name' => 'required',
//         // 'email' => 'required|email|unique:users,email',
//         'email' => 'required|email:rfc,dns|unique:users,email',
//         'country_id' => 'required',
//         'phone' => 'required',
//         'dob' => 'required|date',
//     ]);

//     // ❌ If validation fails → show errors using dd()
//     // if ($validator->fails()) {
//     //     dd($validator->errors());
//     // }

//     if ($validator->fails()) {
//     return redirect()->back()->withErrors($validator)->withInput();
// }
//     $country = Country::find($request->country_id);

//     // Phone validation
//     $length = strlen($request->phone);
//     if ($length < $country->phone_min || $length > $country->phone_max) {
//         return back()->with('error', 'Invalid phone length');
//     }

//     //  Photo upload
//     $photoName = null;
//     if ($request->hasFile('photo')) {
//         $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
//         $request->file('photo')->move(public_path('uploads/users'), $photoName);
//     }

//     //  Status convert (VERY IMPORTANT 🔥)
//     $status = $request->has('status') ? 1 : 0;

//     //  Create User
// $user = User::create([
//     'name' => $request->name,
//     'email' => $request->email,
//     'country_id' => $request->country_id,
//     'phone' => $request->phone,
//     'dob' => $request->dob,
//     'postal_code' => $request->postal_code,
//     'photo' => $photoName,
//     'is_verified' => $status,
// ]);

// // ✅ Generate correct user_code based on ID
// $user->user_code = 'WCU' . str_pad($user->id, 5, '0', STR_PAD_LEFT);
// $user->save();
//     // ✅ Mining create
//     UserMining::create([
//         'user_id' => $user->id,
//         'coin_type' => $request->coin_type,
//         'start_date' => null,
//         'monthly_due_date' => null,
//         'end_date' => null,
//         'inactive_months' => 0,
//         'is_active' => false,
//         'progress' => 0
//     ]);

//     return redirect()->back()->with('success', 'User Added Successfully');
// }









public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'       => 'required',
        'email'      => 'required|email:rfc,dns|unique:users,email',
        'country_id' => 'required',
        'phone'      => 'required',
        'dob'        => 'required|date',
            'wingoo_platform' => 'nullable|string',
    'wingoo_id'       => 'nullable|string',
    ]);
    
     $emailNotification = Setting::where('group', 'notification')
            ->where('key', 'email_notifications')
           ->value('value');

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $country = Country::find($request->country_id);

    $length = strlen($request->phone);
    if ($length < $country->phone_min || $length > $country->phone_max) {
        return back()->with('error', 'Invalid phone length');
    }

$photoName = null;

if ($request->hasFile('photo')) {
    $photoName = time().'_'.$request->file('photo')->getClientOriginalName();

    $request->file('photo')->move(
        public_path('assets/images/profile'),
        $photoName
    );
}

    $status = $request->has('status') ? 1 : 0;

    // ✅ Generate random password
   // ✅ Generate strong random password
$randomPassword = $this->generateStrongPassword();

    $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => Hash::make($randomPassword), // ✅ hashed
        'country_id'  => $request->country_id,
        'phone'       => $request->phone,
        'dob'         => $request->dob,
        'postal_code' => $request->postal_code,
        'photo'       => $photoName,
        'is_verified' => $status,
          'email_verified_at' => now(),

             // ✅ ADD THESE
    'wingoo_platform' => $request->wingoo_platform,
    'winngoo_id'       => $request->wingoo_id,
    ]);

    $user->user_code = 'WCU' . str_pad($user->id, 5, '0', STR_PAD_LEFT);
    $user->save();

    UserMining::create([
        'user_id'          => $user->id,
        'coin_type'        => $request->coin_type,
        'start_date'       => null,
        'monthly_due_date' => null,
        'end_date'         => null,
        'inactive_months'  => 0,
        'is_active'        => false,
        'progress'         => 0
    ]);

    // // ✅ Send welcome email with password
    // Mail::send('emails.welcome', [
    //     'name'     => $user->name,
    //     'email'    => $user->email,
    //     'password' => $randomPassword,
    //     'userCode' => $user->user_code,
    // ], function ($message) use ($user) {
    //     $message->to($user->email, $user->name)
    //             ->subject('Welcome to Winngoo Coin — Your Account Details');
    // });



    try {
        
         if ($emailNotification == 1) {
    Mail::send('emails.welcome', [
        'name'     => $user->name,
        'email'    => $user->email,
        'password' => $randomPassword,
        'userCode' => $user->user_code,
    ], function ($message) use ($user) {
        $message->to($user->email, $user->name)
                ->subject('Welcome to Winngoo Coin — Your Account Details');
    });
         }

    // ✅ Success log
    Log::info('Mail sent successfully to: ' . $user->email);

} catch (\Exception $e) {

    // ❌ Error log
    Log::error('Mail failed for: ' . $user->email . ' | Error: ' . $e->getMessage());
}

    return redirect()->back()->with('success', 'User Added Successfully');
}


public function checkEmail(Request $request)
{
    $exists = User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
}


// public function upgradePlan(Request $request)
// {
   
//     $request->validate([
//         'user_id'     => 'required|integer|exists:users,id',
//         'coin_type'   => 'required|string|exists:coins,name',
//         'wingoo_platform' => 'nullable|string|max:100',
//         'wingoo_id'   => 'nullable|string|max:50',
//     ]);

//     $userId      = $request->user_id;
//     $newCoinType = trim($request->coin_type);

//     $mining = UserMining::where('user_id', $userId)->first();

//     if (!$mining) {
//         return redirect()->back()->with('error', 'Mining record not found');
//     }

//     // Debug 1: Current value என்ன இருக்கு?
//     \Log::info('Before Update - User ID: ' . $userId . ' | Current Coin: ' . $mining->coin_type . ' | New Coin: ' . $newCoinType);

//     if (!$mining->start_date) {
      
//         return redirect()->back()->with('error', 'Mining not started yet');
//     }

//     if ($mining->coin_type === $newCoinType) {
//         return redirect()->back()->with('error', 'User is already on ' . $newCoinType . ' Plan');
//     }
   

//     $startDate = Carbon::parse($mining->start_date);

//     $monthsCompleted = $startDate->diffInMonths(now()) - ($mining->inactive_months ?? 0);
//     $monthsCompleted = max(0, $monthsCompleted);

//     $coin = Coin::where('name', $newCoinType)->first();
//     $newDuration = $coin ? $coin->mining_period : 24;

//     $progress = ($monthsCompleted >= $newDuration) 
//                 ? 100 
//                 : round(($monthsCompleted / $newDuration) * 100, 2);

//     $newEndDate = $startDate->copy()->addMonths($newDuration + ($mining->inactive_months ?? 0));

//     // Actual Update
//     $updated = $mining->update([
//         'coin_type'         => $newCoinType,
//         'progress'          => min(100, $progress),
//         'end_date'          => $newEndDate,
//         'last_activated_at' => now(),
//     ]);

//     // Debug 2: Update successful ஆனதா?
//     \Log::info('Update Result: ' . ($updated ? 'SUCCESS' : 'FAILED') . ' | New Coin: ' . $newCoinType);

//     // Winngoo details
//     if ($request->filled('wingoo_platform') || $request->filled('wingoo_id')) {
//         User::where('id', $userId)->update([
//             'wingoo_platform' => $request->wingoo_platform,
//             'winngoo_id'      => $request->wingoo_id,
//         ]);
//     }

//     return redirect()->back()
//                      ->with('success', 'Successfully upgraded to ' . $newCoinType . ' Plan');
// }




// public function upgradePlan(Request $request)
// {
//     $request->validate([
//         'user_id'         => 'required|integer|exists:users,id',
//         'coin_type'       => 'required|string|exists:coins,name',
//         'wingoo_platform' => 'nullable|string|max:100',
//         'wingoo_id'       => 'nullable|string|max:50',
//     ]);

//     $userId      = $request->user_id;
//     $newCoinType = trim($request->coin_type);

//     $mining = UserMining::where('user_id', $userId)->first();
//     if (!$mining) {
//         return redirect()->back()->with('error', 'Mining record not found');
//     }
//     if ($mining->coin_type === $newCoinType) {
//         return redirect()->back()->with('error', 'User is already on ' . $newCoinType . ' Plan');
//     }

//     $now = now();

//     // ✅ Old end date & progress carry forward
//     $oldEndDate    = Carbon::parse($mining->end_date);
//     $carryProgress = $mining->progress;

//     // ✅ Next due = 30 days from now
//     $nextDue = $now->copy()->addDays(30);

//     // $mining->update([
//     //     'coin_type'               => $newCoinType,
//     //     'start_date'              => $now,
//     //     'end_date'                => $oldEndDate,   // ✅ Old end date same
//     //     'monthly_due_date'        => $nextDue,
//     //     'is_active'               => true,
//     //     'progress'                => $carryProgress, // ✅ Old progress same
//     //     'inactive_months'         => 0,
//     //     'pending_activation'      => false,
//     //     'last_activated_at'       => $now,
//     //     'next_cycle_activated_at' => null,
//     // ]);
    
    
    
    
    
    
//     $mining->update([
//     'coin_type'               => $newCoinType,
//     'start_date'              => $now,
//     'end_date'                => $oldEndDate,
//     'monthly_due_date'        => $nextDue,
//     'is_active'               => true,
//     'progress'                => $carryProgress,
//     'inactive_months'         => 0,
//     'pending_activation'      => false,
//     'last_activated_at'       => $now,
//     'next_cycle_activated_at' => null,
//     'current_month'           => $mining->current_month, // ✅ carry forward
// ]);
    
    
    
    
    

//     DB::table('user_mining_history')->insert([
//         'user_id'          => $userId,
//         'coin_type'        => $newCoinType,
//         'start_date'       => $now,
//         'end_date'         => $oldEndDate,
//         'monthly_due_date' => $nextDue,
//         'created_at'       => $now,
//         'updated_at'       => $now,
//     ]);

//     if ($request->filled('wingoo_platform') || $request->filled('wingoo_id')) {
//         User::where('id', $userId)->update([
//             'wingoo_platform' => $request->wingoo_platform,
//             'winngoo_id'      => $request->wingoo_id,
//         ]);
//     }

//     return redirect()->back()->with(
//         'success',
//         'Successfully upgraded to ' . $newCoinType . ' Plan'
//     );
// }




// public function upgradePlan(Request $request)
// {
//     $request->validate([
//         'user_id'         => 'required|integer|exists:users,id',
//         'coin_type'       => 'required|string|exists:coins,name',
//         'wingoo_platform' => 'nullable|string|max:100',
//         'wingoo_id'       => 'nullable|string|max:50',
//     ]);

//     $userId      = $request->user_id;
//     $newCoinType = trim($request->coin_type);

//     $mining = UserMining::where('user_id', $userId)->first();
//     if (!$mining) {
//         return redirect()->back()->with('error', 'Mining record not found');
//     }

//     if ($mining->coin_type === $newCoinType) {
//         return redirect()->back()->with('error', 'User is already on ' . $newCoinType . ' Plan');
//     }

//     $now = now();

//     // ✅ Old values carry forward
//     $oldEndDate    = Carbon::parse($mining->end_date);
//     $carryProgress = $mining->progress;

//     // ✅ New coin's total months
//     $newCoin        = Coin::where('name', $newCoinType)->first();
//     $newTotalMonths = (int)($newCoin ? $newCoin->mining_period : 24);

//     // ✅ Remaining progress % based on old end date
//     // How many 30-day cycles remain from today to old end date
//     $remainingDays   = (int) $now->diffInDays($oldEndDate);
//     $remainingMonths = max(1, (int) round($remainingDays / 30));

//     // ✅ current_month for new plan = newTotalMonths - remainingMonths
//     $newCurrentMonth = max(1, $newTotalMonths - $remainingMonths);

//     // ✅ Next due = 30 days from now
//     $nextDue = $now->copy()->addDays(30);

//     $mining->update([
//         'coin_type'               => $newCoinType,
//         'start_date'              => $now,
//         'end_date'                => $oldEndDate,
//         'monthly_due_date'        => $nextDue,
//         'is_active'               => true,
//         'progress'                => $carryProgress,
//         'inactive_months'         => 0,
//         'pending_activation'      => false,
//         'last_activated_at'       => $now,
//         'next_cycle_activated_at' => null,
//         'current_month'           => $newCurrentMonth, // ✅ recalculate for new plan
//     ]);


// DB::table('user_mining_history')
//     ->where('user_id', $userId)
//     ->orderBy('id', 'desc')
//     ->limit(1)
//     ->update([
//         'coin_type'  => $newCoinType,
//         'updated_at' => $now,
//     ]);






//     if ($request->filled('wingoo_platform') || $request->filled('wingoo_id')) {
//         User::where('id', $userId)->update([
//             'wingoo_platform' => $request->wingoo_platform,
//             'winngoo_id'      => $request->wingoo_id,
//         ]);
//     }

//     return redirect()->back()->with(
//         'success',
//         'Successfully upgraded to ' . $newCoinType . ' Plan'
//     );
// }




public function upgradePlan(Request $request)
{
    $request->validate([
        'user_id'         => 'required|integer|exists:users,id',
        'coin_type'       => 'required|string|exists:coins,name',
        'wingoo_platform' => 'nullable|string|max:100',
        'wingoo_id'       => 'nullable|string|max:50',
    ]);

    $userId      = $request->user_id;
    $newCoinType = trim($request->coin_type);

    $mining = UserMining::where('user_id', $userId)->first();
    if (!$mining) {
        return redirect()->back()->with('error', 'Mining record not found');
    }

    if ($mining->coin_type === $newCoinType) {
        return redirect()->back()->with('error', 'User is already on ' . $newCoinType . ' Plan');
    }

    $now = now();

    // ✅ Today activate பண்ணிருக்காங்களா check
    $todayEntry = DB::table('user_mining_history')
        ->where('user_id', $userId)
        ->whereDate('start_date', $now->toDateString())
        ->orderBy('id', 'desc')
        ->first();

    if ($todayEntry) {
        // ✅ Scenario 1: Today activate பண்ணி upgrade
        // coin_type மட்டும் change — nothing else touch
        DB::table('user_mining_history')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->update([
                'coin_type'  => $newCoinType,
                'updated_at' => $now,
            ]);

        $mining->update([
            'coin_type' => $newCoinType,
        ]);

    } else {
        // ✅ Scenario 2: Direct upgrade — only these fields change

        $carryProgress  = (float) $mining->progress;
        $oldCoin        = Coin::where('name', $mining->coin_type)->first();
        $oldTotalMonths = (int)($oldCoin ? $oldCoin->mining_period : 24);

        // Progress — this month add
        $remainingMonths = max(1, $oldTotalMonths - $mining->current_month);
        $monthlyProgress = (100 - $carryProgress) / $remainingMonths;
        $newProgress     = min(100, round($carryProgress + $monthlyProgress, 2));

        // End date — missed months + late days
        $newEndDate = Carbon::parse($mining->end_date);

        if ($mining->monthly_due_date) {
            $monthsSinceStart = (int)(
                Carbon::parse($mining->start_date)
                    ->diffInDays(Carbon::parse($mining->monthly_due_date)) / 30
            );
            $missedMonths = max(0, ($monthsSinceStart + 1) - $mining->current_month);

            if ($missedMonths > 0) {
                $newEndDate = $newEndDate->addDays($missedMonths * 30);
            }

            $totalDaysLate = (int) Carbon::parse($mining->monthly_due_date)->diffInDays($now);
            $lateDays      = max(0, $totalDaysLate - ($missedMonths * 30) - 1);
            if ($lateDays > 0) {
                $newEndDate = $newEndDate->addDays($lateDays);
            }
        }

        $nextDue = $now->copy()->addDays(30);

        // ✅ Only changed fields — nothing else touch
        $mining->update([
            'coin_type'          => $newCoinType,
                'start_date'         => $now, 
            'progress'           => $newProgress,
            'current_month'      => $mining->current_month + 1,
            'end_date'           => $newEndDate,
            'monthly_due_date'   => $nextDue,
            'last_activated_at'  => $now,
        ]);

        // New history row insert
        DB::table('user_mining_history')->insert([
            'user_id'          => $userId,
            'coin_type'        => $newCoinType,
            'start_date'       => $now,
            'end_date'         => $newEndDate,
            'monthly_due_date' => $nextDue,
            'created_at'       => $now,
            'updated_at'       => $now,
        ]);
    }

    if ($request->filled('wingoo_platform') || $request->filled('wingoo_id')) {
        User::where('id', $userId)->update([
            'wingoo_platform' => $request->wingoo_platform,
            'winngoo_id'      => $request->wingoo_id,
        ]);
    }

    return redirect()->back()->with('success', 'Successfully upgraded to ' . $newCoinType . ' Plan');
}



public function edit(User $user)
{
    return response()->json([
        'id'              => $user->id,
        'user_code'       => $user->user_code,
        'name'            => $user->name,
        'email'           => $user->email,
        'phone'           => $user->phone,
        'dob'             => $user->dob
                            ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d')
                            : '',
        'country_id'      => $user->country_id,
        'postal_code'     => $user->postal_code,
        'wingoo_platform' => $user->wingoo_platform,
        'winngoo_id'      => $user->winngoo_id,
        'photo'           => $user->photo
                            ? asset('assets/images/profile/' . $user->photo)
                            : asset('assets/images/users/avatar-3.jpg'),
        'coin_type'       => $user->mining->coin_type ?? '',
    ]);
}

public function update(Request $request, User $user)
{
    $validator = Validator::make($request->all(), [
        'name'            => 'required|string|max:255',
    
        'country_id'      => 'required',
        'phone'           => 'required',
        'dob'             => 'required|date',
        'postal_code'     => 'nullable|string|max:10',
        'wingoo_platform' => 'nullable|string',
        'wingoo_id'       => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator, 'edit')
            ->withInput()
            ->with('edit_user_id', $user->id);
    }

    // ✅ Photo upload
    $photoName = $user->photo;
    if ($request->hasFile('photo')) {
        // Delete old photo
        if ($user->photo && file_exists(public_path('assets/images/profile/' . $user->photo))) {
            unlink(public_path('assets/images/profile/' . $user->photo));
        }
        $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(
            public_path('assets/images/profile'),
            $photoName
        );
    }

    $user->update([
        'name'            => $request->name,
     
        'phone'           => $request->phone,
        'dob'             => $request->dob,
        'country_id'      => $request->country_id,
        'postal_code'     => $request->postal_code,
        'photo'           => $photoName,
        'wingoo_platform' => $request->wingoo_platform,
        'winngoo_id'      => $request->wingoo_id,
    ]);

    return redirect()->back()->with('success', 'User Updated Successfully');
}




}
