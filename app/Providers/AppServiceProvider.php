<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {

        Schema::defaultStringLength(191);
        // Set mail config dynamically from DB
        try {
            if (Schema::hasTable('settings')) {
                $smtpSettings = Setting::getByGroup('email');

                if (!empty($smtpSettings)) {

                    // Decrypt password
                    try {
                        $password = decrypt($smtpSettings['smtp_password']);
                    } catch (\Exception $e) {
                        $password = $smtpSettings['smtp_password'];
                    }

                    // Map encryption type to correct Laravel scheme
                    $schemeMap = [
                        'tls' => 'smtp',   // TLS port 587 → smtp
                        'ssl' => 'smtps',  // SSL port 465 → smtps
                        ''    => 'smtp',   // default
                    ];

                    $scheme = $schemeMap[$smtpSettings['encryption_type']] ?? 'smtp';

                    Config::set('mail.default',                    'smtp');
                    Config::set('mail.mailers.smtp.host',          $smtpSettings['smtp_server']);
                    Config::set('mail.mailers.smtp.port',          (int) $smtpSettings['smtp_port']);
                    Config::set('mail.mailers.smtp.scheme',   $scheme); // 👈 mapped value

                    Config::set('mail.mailers.smtp.username',      $smtpSettings['smtp_username']);
                    Config::set('mail.mailers.smtp.password',      $password);
                    Config::set('mail.from.address',               $smtpSettings['from_email']);
                    Config::set('mail.from.name',                  $smtpSettings['from_name']);
                }
            }
        } catch (\Exception $e) {
            // Silently fall back to .env settings
        }
    }
}
