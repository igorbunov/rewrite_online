<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SynonimController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\UploadCounterController;

// old code

Route::view('/', 'old.main');

Route::view('activate', 'old.pre_activate');
Route::get('activate/{key}', [ActivationController::class, 'showPayButton']);
Route::post('activationsuccess', [ActivationController::class, 'successCallback']);

Route::get('check_activation/{key}', [ActivationController::class, 'checkActivation']);
Route::get('check_login/{email}/{pass}', [ActivationController::class, 'checkLogin']);

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
    Route::post('projects/{project}/recalc_keywords', [ProjectController::class, 'recalcDoneKeywords'])->name('projects.recalc_done_keywords');
    Route::resource('projects', ProjectController::class);

    Route::resource('projects.keywords', KeywordController::class);
    Route::resource('projects.sources', SourceController::class);

    Route::post('synonims/find', [SynonimController::class, 'find'])->name('synonims.find');

    Route::get('support', [SupportController::class, 'index'])->name('support.index');
    Route::post('support/send', [SupportController::class, 'send'])->name('support.send');

    Route::post('download', [UploadCounterController::class, 'update']);

    Route::get('report', ReportController::class);
});
