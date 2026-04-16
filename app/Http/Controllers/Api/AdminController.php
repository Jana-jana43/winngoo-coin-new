<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  
   public function settings()
    {
        try {
            $emailSettings    = Setting::getByGroup('email');
            $platformSettings = Setting::getByGroup('platform');

            // Remove password from email settings for security
            unset($emailSettings['smtp_password']);

            return response()->json([
                'success' => true,
                'data'    => [
                    'email'    => $emailSettings,
                    'platform' => $platformSettings,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch settings: ' . $e->getMessage()
            ], 500);
        }
    }
   
}
