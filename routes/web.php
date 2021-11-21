<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportMessage;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SynonimController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\UploadCounterController;

// old code

Route::get('/', function () {
    return view('old.main');
});

Route::get('activate', [ActivationController::class, 'preIndex']);
Route::get('activate/{key}', [ActivationController::class, 'showPayButton']);
Route::post('activationsuccess', [ActivationController::class, 'success']);
Route::get('check_activation/{key}', [ActivationController::class, 'checkActivation']);
Route::get('check_login/{email}/{pass}', [ActivationController::class, 'checkLogin']);
Route::post('get_pay_button', [ActivationController::class, 'getButton']);

Route::get('support', [SupportMessage::class, 'index']);
Route::post('support/send', [SupportMessage::class, 'send']);

Route::post('download', [UploadCounterController::class, 'update']);

Route::view('contacts', 'old.contacts');
Route::view('return', 'old.return');
Route::view('about', 'old.about');
Route::view('license', 'old.license');

// new code

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => ['auth', 'verified']
], function () {
    Route::post('projects/{project}/text', [ProjectController::class, 'updateText'])->name('projects.text');
    Route::resource('projects', ProjectController::class);

    Route::resource('projects.keywords', KeywordController::class);
    Route::resource('projects.sources', SourceController::class);

    Route::post('synonims/find', [SynonimController::class, 'find'])->name('synonims.find');

    Route::get('report', [ActivationController::class, 'report']);
});


Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});