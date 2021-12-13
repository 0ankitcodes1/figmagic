<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageRouteController;
use App\Mail\testingMail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Jobs\testingJob;


// Route::get('/testing-email', function() {
//     Mail::to('ankit.171703@ncit.edu.np')->send(new testingMail());
//     dd("Done");
// });

// Route::get('/send-email', function() {
//     // Sending Email
//     // ProcessMail::dispatch();

//     $email = "dramasuggestion@gmail.com";
//     $send_mail = Mail::to($email)->send(new testingMail());

//     // message
//     dd("Email Was sent successfully");
// });

Route::get('/', [PageRouteController::class, 'home']);
Route::get('/about-us', [PageRouteController::class, 'about']);
Route::get('/knowledgebase', [PageRouteController::class, 'knowledgebase']);
Route::get('/pricing', [PageRouteController::class, 'pricing']);
Route::get('/signup', [PageRouteController::class, 'signup']);
Route::get('/login', [PageRouteController::class, 'login']);
Route::get('/forgotpassword', [PageRouteController::class, 'forgotpassword']);
Route::get('/forgot-password', [PageRouteController::class, 'forgotpass']);
Route::get('/changepassword', [PageRouteController::class, 'changepassword']);
Route::get('/settings', [PageRouteController::class, 'settings']);
Route::get('/logincomplete', [PageRouteController::class, 'logincomplete']);
Route::get('/verify-email', [PageRouteController::class, 'verifyemail']);
Route::get('/dashboard', [PageRouteController::class, 'dashboard']);



Route::get('/privacy-policy', [PageRouteController::class, 'privacy']);
Route::get('/terms-of-service', [PageRouteController::class, 'terms']);
Route::get('/contact-us', [PageRouteController::class, 'contact']);
Route::get('/report-bug', [PageRouteController::class, 'reportbug']);
Route::get('/new-features', [PageRouteController::class, 'newfeatures']);















// Route::get("/test", function() {
//     // dd("HEllo");
//     // Mail::to("ankitgodarthapa@gmail.com")->send(new testingMail());
//     testingJob::dispatch();
//     dd("done");
// });

Route::get('/auth/user/google', function() { return Socialite::driver('google')->redirect(); });

// Route::get('/sign-in/github/redirect', function() {
//     // receive the data from 
//     $user = Socialite::driver('google')->user();
//     dd($user);
// });