<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserMining;
use Carbon\Carbon;
use App\Events\DueNotificationEvent;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;
use App\Models\Setting;


class SendDueNotifications extends Command
{
    protected $signature = 'send:due-notifications';
    protected $description = 'Send due date reminders';

//     public function handle()
//     {
//         $today = Carbon::today();

//         $records = UserMining::whereNotNull('monthly_due_date')->get();

//         foreach ($records as $record) {

//             $dueDate = Carbon::parse($record->monthly_due_date);

//             // ðŸ”¥ days difference calculate
//             $daysLeft = $today->diffInDays($dueDate, false);

//             // âœ… 2 days before OR 1 day before
//             // if ($daysLeft == 2 || $daysLeft == 1) {

//             //     $message = "Your due date is on " . $dueDate->format('d-m-Y');

//             //     // ðŸ”¥ send realtime notification
//             //     broadcast(new DueNotificationEvent($message, $record->user_id));
//             // }
            
//             if ($daysLeft == 2 || $daysLeft == 1 || $daysLeft == 0) {

//     $message = "Your due date is on " . $dueDate->format('d-m-Y');

//     // âœ… DB save (NEW)
//     \DB::table('notifications')->insert([
//         'user_id' => $record->user_id,
//         'message' => $message,
//         'is_read' => 0,
//         'created_at' => now(),
//         'updated_at' => now()
//     ]);

//     // âœ… realtime (already iruku)
//     broadcast(new DueNotificationEvent($message, $record->user_id));
// }
//         }

//         $this->info('Notifications sent successfully');
//     }



// public function handle()
// {
//     $today = Carbon::today();

//     $records = UserMining::whereNotNull('monthly_due_date')->get();

//     foreach ($records as $record) {

//         $originalDate = Carbon::parse($record->monthly_due_date);

//         // 🔥 Step 1: அந்த மாதத்துக்கு max days கண்டுபிடி
//         $daysInMonth = Carbon::create($today->year, $today->month)->daysInMonth;

//         // 🔥 Step 2: safe day (30/31 overflow avoid)
//         $safeDay = min($originalDate->day, $daysInMonth);

//         // 🔥 Step 3: current month due date
//         $dueDate = Carbon::create(
//             $today->year,
//             $today->month,
//             $safeDay
//         );

//         // 🔥 Step 4: already கடந்தா → next month (again safe)
//         if ($dueDate->lt($today)) {

//             $nextMonth = $today->copy()->addMonth();

//             $daysInNextMonth = $nextMonth->daysInMonth;

//             $safeDay = min($originalDate->day, $daysInNextMonth);

//             $dueDate = Carbon::create(
//                 $nextMonth->year,
//                 $nextMonth->month,
//                 $safeDay
//             );
//         }

//         // 🔥 Step 5: days difference
//         $daysLeft = $today->diffInDays($dueDate, false);

//         // ✅ 2,1,0 days
//         if ($daysLeft == 2 || $daysLeft == 1 || $daysLeft == 0) {

//             $message = "Your due date is on " . $dueDate->format('d-m-Y');

//             $exists = \DB::table('notifications')
//                 ->where('user_id', $record->user_id)
//                 ->whereDate('created_at', today())
//                 ->exists();

//             if (!$exists) {

//                 \DB::table('notifications')->insert([
//                     'user_id' => $record->user_id,
//                     'message' => $message,
//                     'is_read' => 0,
//                     'created_at' => now(),
//                     'updated_at' => now()
//                 ]);

//                 broadcast(new DueNotificationEvent($message, $record->user_id));
//             }
//         }
//     }

//     $this->info('Notifications sent successfully');
// }


// public function handle()
// {
//     $today = Carbon::today();

//     $records = UserMining::whereNotNull('monthly_due_date')->get();

//     foreach ($records as $record) {

//       $originalDate = Carbon::parse($record->monthly_due_date);

// // 🔥 current month safe day
// $daysInMonth = Carbon::create($today->year, $today->month)->daysInMonth;
// $safeDay = min($originalDate->day, $daysInMonth);

// // 🔥 current month due date
// $dueDate = Carbon::create(
//     $today->year,
//     $today->month,
//     $safeDay
// );

// // 🔥 if already passed → keep moving forward (multi-month)
// while ($dueDate->lt($today)) {

//     $dueDate->addMonth();

//     $daysInMonth = $dueDate->daysInMonth;
//     $safeDay = min($originalDate->day, $daysInMonth);

//     $dueDate->day = $safeDay;
// }

//         // 🔥 Step 3: days difference
//         $daysLeft = $today->diffInDays($dueDate, false);

//         // ✅ 2,1,0 days reminder
//         if ($daysLeft == 2 || $daysLeft == 1 || $daysLeft == 3 ) {

//             $message = "Your due date is on " . $dueDate->format('d-m-Y');

//             // 🚫 duplicate avoid (same day multiple insert avoid)
//             $exists = \DB::table('notifications')
//                 ->where('user_id', $record->user_id)
//                 ->whereDate('created_at', today())
//                 ->exists();

//             if (!$exists) {

//                 // ✅ DB insert
//                 \DB::table('notifications')->insert([
//                     'user_id' => $record->user_id,
//                     'message' => $message,
//                     'is_read' => 0,
//                     'created_at' => now(),
//                     'updated_at' => now()
//                 ]);
                
//                  $user = User::find($record->user_id);
            

//                 if ($user && $user->email) {

//     Log::info('Mail sending started: ' . $user->email);

//     try {

//         Mail::send('emails.expiry', [
//             'user' => $user,
//             'dueDate' => $dueDate->format('d-m-Y')
//         ], function ($mail) use ($user) {
//             $mail->to($user->email);
//             $mail->subject('Your Plan is Expiring Soon');
//         });

//         Log::info('Mail sent successfully: ' . $user->email);

//     } catch (\Exception $e) {

//         Log::error('Mail failed: ' . $e->getMessage());
//     }
// }

//                 // ✅ realtime broadcast
//                 broadcast(new DueNotificationEvent($message, $record->user_id));
                
                
                
       
//             }
//         }
//     }

//     $this->info('Notifications sent successfully');
// }

public function handle()
{
    
    $emailNotification = Setting::where('group', 'notification')
            ->where('key', 'email_notifications')
           ->value('value');
    $today = Carbon::today();

    $records = UserMining::whereNotNull('monthly_due_date')->get();

    foreach ($records as $record) {

        \Log::info('Processing user: ' . $record->user_id);

        $originalDate = Carbon::parse($record->monthly_due_date);

        // 🔥 Step 1: current month safe day
        $daysInMonth = Carbon::create($today->year, $today->month)->daysInMonth;
        $safeDay = min($originalDate->day, $daysInMonth);

        $dueDate = Carbon::create(
            $today->year,
            $today->month,
            $safeDay
        );

        // 🔥 Step 2: multi-month carry forward
        while ($dueDate->lt($today)) {

            $dueDate->addMonth();

            $daysInMonth = $dueDate->daysInMonth;
            $safeDay = min($originalDate->day, $daysInMonth);

            $dueDate->day = $safeDay;
        }

        // 🔥 Step 3: days difference
        $daysLeft = $today->diffInDays($dueDate, false);

        // ✅ 3,2,1 days reminder
        if ($daysLeft == 3 || $daysLeft == 2 || $daysLeft == 1) {

            $message = "Your due date is on " . $dueDate->format('d-m-Y');

            // 🔥 check duplicate notification
            $exists = \DB::table('notifications')
                ->where('user_id', $record->user_id)
                ->whereDate('created_at', today())
                ->exists();

            // ✅ Insert notification only once
            if (!$exists) {
                \DB::table('notifications')->insert([
                    'user_id' => $record->user_id,
                    'message' => $message,
                    'is_read' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                \Log::info('Notification inserted for user: ' . $record->user_id);
                
                //sample 
                
                 // 🔥 ALWAYS send mail (important fix)
                            $user = \App\Models\User::find($record->user_id);

                            if ($user && $user->email) {

                \Log::info('Mail sending: ' . $user->email);

                try {
                          if ($emailNotification == 1) {

                    \Illuminate\Support\Facades\Mail::send('emails.expiry', [
                        'user' => $user,
                        'dueDate' => $dueDate->format('d-m-Y')
                    ], function ($mail) use ($user) {
                        $mail->to($user->email);
                        $mail->subject('Your Plan is Expiring Soon');
                    });
                    
                          }

                    \Log::info('Mail sent: ' . $user->email);

                } catch (\Exception $e) {

                    \Log::error('Mail failed: ' . $e->getMessage());
                }
            }
                
                
                
                //end sample
            }

           

            // 🔥 realtime notification
            // broadcast(new DueNotificationEvent($message, $record->user_id));
        }
    }

    $this->info('Notifications + Emails processed successfully');
}

}