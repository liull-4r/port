<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashBoardController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home']);
Route::get('about', [HomeController::class, 'about']);
Route::get('services', [HomeController::class, 'services']);
Route::get('portfolio', [HomeController::class, 'portfolio']);
Route::get('contact', [HomeController::class, 'contact']);
//admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/home', [DashboardController::class, 'admin_home']);
    Route::post('admin/home/post', [DashboardController::class, 'admin_home_post']);


    Route::get('admin/about', [DashboardController::class, 'admin_about']);
    Route::get('admin/services', [DashboardController::class, 'admin_services']);
    Route::get('admin/portfolio', [DashboardController::class, 'admin_portfolio']);
    Route::get('admin/contact', [DashboardController::class, 'admin_contact']);
});

Route::get('login', [AuthController::class, 'login']);
Route::post('login_admin', [AuthController::class, 'login_admin']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::get('admin/logout', [AuthController::class, 'logout']);
Route::post('forgot_admin', [AuthController::class, 'forgot_admin']);


//email test
/*Route::get('/test-email', function () {

  $details = [
      'title' => 'Test Email',
      'body' => 'This is a test email sent from your Laravel application.'
  ];
      Mail::to('mulugese@gmail.com')->send(new \App\Mail\TestMail($details));


  return 'Email sent!';
});*/

//Route::get('/kat', function () {
  //  return view('kat');
//})
