<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMining;
use Carbon\Carbon;
class DashboardController extends Controller
{
    //
    // public function index(){
    //     return view ('admin.dashboard');
    // }

//      public function index()
//     {
//         // Total Users
//         $totalUsers = User::count();

//         // Active Miners
//         $activeMiners = UserMining::where('is_active',1)->count();

//         // Inactive Miners
//         $inactiveMiners = UserMining::where('is_active',0)->count();

//         // Total mined coins
//         // $totalMined = UserMining::sum('progress'); 
//   $totalMined = $activeMiners + $inactiveMiners;
//         return view('admin.dashboard', compact(
//             'totalUsers',
//             'activeMiners',
//             'inactiveMiners',
//             'totalMined'
//         ));
//     }


public function index(Request $request)
{
    // ✅ Year filters (independent)
    $usersYear = $request->users_year ?? now()->year;
    $coinYear  = $request->coin_year ?? now()->year;

    // ---------------- TOP ----------------
    $totalUsers = User::count();
    $activeMiners = UserMining::where('is_active',1)->count();
    $inactiveMiners = UserMining::where('is_active',0)->count();
    $totalMined = UserMining::sum('progress');

    // ---------------- USERS CHART ----------------
    $months = [];
    $activeData = [];
    $inactiveData = [];

    for ($i = 1; $i <= 12; $i++) {
        $months[] = Carbon::create()->month($i)->format('M');

        $activeData[] = UserMining::whereYear('created_at', $usersYear)
            ->whereMonth('created_at', $i)
            ->where('is_active', 1)
            ->count();

        $inactiveData[] = UserMining::whereYear('created_at', $usersYear)
            ->whereMonth('created_at', $i)
            ->where('is_active', 0)
            ->count();
    }

    // ---------------- COIN CHART ----------------
    $bronze = UserMining::whereYear('created_at', $coinYear)->where('progress','<',30)->count();
    $silver = UserMining::whereYear('created_at', $coinYear)->whereBetween('progress',[30,70])->count();
    $gold   = UserMining::whereYear('created_at', $coinYear)->where('progress','>',70)->count();

    $coinUsage = [$bronze, $silver, $gold];

    // ---------------- ACTIVITY CHART ----------------

    // DAILY
    $dailyLabels = [];
    $dailyData = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $dailyLabels[] = $date->format('D');

        $dailyData[] = User::whereDate('created_at', $date)->count();
    }

    // WEEKLY
    $weeklyLabels = ['Week 1','Week 2','Week 3','Week 4'];
    $weeklyData = [];

    for ($i = 1; $i <= 4; $i++) {
        $weeklyData[] = User::whereBetween('created_at', [
            now()->startOfMonth()->addWeeks($i-1),
            now()->startOfMonth()->addWeeks($i)
        ])->count();
    }

    // MONTHLY
    $monthlyLabels = [];
    $monthlyData = [];

    for ($i = 1; $i <= 12; $i++) {
        $monthlyLabels[] = Carbon::create()->month($i)->format('M');

        $monthlyData[] = User::whereMonth('created_at', $i)->count();
    }

    // ---------------- COUNTRY (simple) ----------------
    $years = [now()->year];

    $countryData = [
        'USA' => [User::whereYear('created_at', now()->year)->where('country_id',1)->count()],
        'India' => [User::whereYear('created_at', now()->year)->where('country_id',2)->count()],
    ];

    return view('admin.dashboard', compact(
        'usersYear',
        'coinYear',

        'totalUsers',
        'activeMiners',
        'inactiveMiners',
        'totalMined',

        'months',
        'activeData',
        'inactiveData',

        'coinUsage',

        'dailyLabels',
        'dailyData',
        'weeklyLabels',
        'weeklyData',
        'monthlyLabels',
        'monthlyData',

        'years',
        'countryData'
    ));
}
}
