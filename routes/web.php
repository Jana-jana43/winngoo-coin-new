<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admins\Auth\LoginController;
use App\Http\Controllers\admins\DashboardController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admins\ProfileController;
use App\Http\Controllers\admins\MemberController;
use App\Http\Controllers\admins\RolesController;
use App\Http\Controllers\admins\StaffController;
use App\Http\Controllers\admins\ContentManagementController;
use App\Http\Controllers\admins\SettingsController;
use App\Http\Controllers\admins\CoinManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admins\NotificationController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/clear-cache', function () {

    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');

    return "All caches cleared successfully";
});

Route::get('/run-cron', function () {
    Artisan::call('send:due-notifications');
    return "Cron executed successfully!";
});
//Landing page

Route::get('/',[HomeController::class, 'home'])->name('home');
Route::get('/aboutus',[HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/faq',[HomeController::class, 'faq'])->name('faq');
Route::get('/privacy-policy',[HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms-conditions',[HomeController::class, 'termsAndConditions'])->name('termsAndConditions');
Route::get('/contactus',[HomeController::class, 'contactus'])->name('contactus');
Route::post('/contact-submit', [HomeController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/success',[HomeController::class, 'success'])->name('success');







// Route::get('/',[LoginController::class, 'index'])->name('login');

Route::get('/admin/login',[LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin') ->name('dashboard');
// Route::get('/forgot-password',[LoginController::class,'forgotpassword'])->name('forgot-password');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->group(function () {

Route::get('/forgot-password',[LoginController::class,'showForgotForm'])->name('admin.forgot.password');
Route::post('/forgot-password',[LoginController::class,'sendResetLink'])->name('admin.forgot.password.send');
Route::get('/reset-password/{token}',[LoginController::class,'showResetForm'])->name('admin.password.reset');
Route::post('/reset-password',[LoginController::class,'resetPassword'])->name('admin.password.update');
Route::post('/password/update',[LoginController::class,'updatePassword'])->name('admin.password.update');
// profile
Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
Route::get('/members', [MemberController::class, 'index'])->name('admin.members');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');



// sowmiya
Route::get('/faq', [ContentManagementController::class, 'faq'])->name('admin.faq');
Route::get('/create-faq', [ContentManagementController::class, 'createFaq'])->name('admin.create.faq');
Route::get('/edit-faq/{id}', [ContentManagementController::class, 'editFaq'])->name('admin.edit.faq');
Route::post('/store-faq', [ContentManagementController::class, 'store'])->name('admin.store.faq');
Route::put('/update-faq/{id}', [ContentManagementController::class, 'update'])
    ->name('admin.update.faq');

Route::delete('/admin/faq/delete/{id}', [ContentManagementController::class, 'delete'])->name('admin.delete.faq');
Route::post('/faq/status/{id}', [ContentManagementController::class, 'updateStatus'])->name('admin.faq.status');
Route::get('/manage-privacypolicy', [ContentManagementController::class, 'managePrivacyPolicy'])->name('admin.manage.privacy.policy');
Route::post('/admin/privacy/save', [ContentManagementController::class, 'savePrivacy'])
    ->name('admin.save.privacy');
Route::get('/manage-termsandconditions', [ContentManagementController::class, 'manageTermsAndConditions'])->name('admin.manage.terms.and.conditions');

Route::post('/admin/terms-and-conditions/save', [ContentManagementController::class, 'saveTerms'])
    ->name('admin.save.terms');

Route::get('/manage-news', [ContentManagementController::class, 'manageNews'])->name('admin.manage.news');

Route::post('/admin/news/save', [ContentManagementController::class, 'saveNews'])
    ->name('admin.save.news');
Route::get('/manage-about', [ContentManagementController::class, 'manageAbout'])->name('admin.manage.about');
Route::post('about/save', [ContentManagementController::class, 'storeAbout']);


//rolemangement
Route::get('/rolemanagement', [RolesController::class, 'index'])->middleware('auth:admin') ->name('admin.rolemanagement');
Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
Route::delete('/roles/delete/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
Route::post('/roles/toggle-status', [RolesController::class, 'toggleStatus'])->name('roles.toggleStatus');
Route::put('/roles/update/{id}', [RolesController::class, 'update'])->name('roles.update');

// staff management

Route::get('/staffmanagement', [StaffController::class, 'index'])->middleware('auth:admin') ->name('admin.staffmanagement');
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::delete('/admin/{id}', [StaffController::class, 'destroy'])->name('admin.destroy');
Route::post('/staff/update-status', [StaffController::class, 'staffStatus'])->name('staff.toggleStatus');
Route::put('/staff/update/{id}', [StaffController::class, 'updateStaff'])->name('staff.update');


//coin management

Route::get('/coinmanagement', [CoinManagementController::class, 'index'])->name('admin.coinmanagement');
Route::post('/coin/store', [CoinManagementController::class, 'store'])->name('coin.store');
Route::post('/coin/update-status', [CoinManagementController::class, 'coinStatus'])->name('coin.toggleStatus');
Route::post('/coin/update/{id}', [CoinManagementController::class, 'update'])->name('coin.update');
Route::delete('/coin/delete/{id}', [CoinManagementController::class, 'delete'])->name('coin.delete');

//settings sowmi
Route::get('/change-password', [SettingsController::class, 'changePassword'])
        ->name('admin.change.password.form');

Route::post('/change-password', [SettingsController::class, 'updateChangePassword'])
        ->name('admin.change.password');
Route::post('check-current-password', [SettingsController::class, 'checkCurrentPassword'])
    ->name('admin.check.current.password')
    ->middleware('auth:admin');

Route::delete('users/{id}', [MemberController::class, 'destroy'])->name('users.delete');
Route::post('users/store', [MemberController::class, 'store'])->name('admin.users.store');
// Web Upgrade Route
Route::post('users/upgrade', [MemberController::class, 'upgradePlan'])
     ->name('admin.users.upgrade');
      Route::post('/users/{userId}/toggle-mining', [MemberController::class, 'toggleMining'])
    ->name('admin.users.toggleMining');
    // Edit User
Route::get('users/{user}/edit', [MemberController::class, 'edit'])->name('admin.users.edit');
Route::put('users/{user}', [MemberController::class, 'update'])->name('admin.users.update');    
Route::post('users/check-email', [MemberController::class, 'checkEmail'])->name('admin.users.checkEmail');
     
     

// jana email configuration

    Route::get('/email-configuration', [SettingsController::class, 'emailConfiguration'])
        ->name('admin.email.configuration');
    Route::post('/admin/settings/email', [SettingsController::class, 'saveEmailSettings'])
    ->name('settings.email.save');
    Route::post('/settings/email/test', [SettingsController::class, 'sendTestMail'])->name('settings.email.test');

    //jana platform settings
    Route::get('/platform-settings', [SettingsController::class, 'platformSettings'])->name('admin.platform.settings');
    Route::post('/settings/platform/save', [SettingsController::class, 'savePlatformSettings'])->name('settings.platform.save');

// Notification Module
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('admin.notifications.store');
Route::post('notifications/{id}/update', [NotificationController::class, 'update'])->name('admin.notifications.update');
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    
     //language
    Route::get('/language', [SettingsController::class, 'language'])->name('admin.language');
    
     //notification settings
    Route::get('/notification-settings', [SettingsController::class, 'notificationSettings'])->name('admin.notification.settings');
    Route::post('/settings/notifications', [SettingsController::class, 'saveNotificationSettings'])
    ->name('settings.notifications.save');
    
    
   


});