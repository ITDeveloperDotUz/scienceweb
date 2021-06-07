<?php

use App\Admin\Controllers\OrganizationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OJS\SubmissionController as OJSSubmissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'setLocale'], function (){

    Route::get('/', [SiteController::class, 'home'])->name('home');
    Route::get('/journals', [SiteController::class, 'journals']);
    Route::get('/contacts', [SiteController::class, 'contacts']);
    Route::get('/publishers', [SiteController::class, 'publishers']);
    Route::resource('page', PageController::class);

    Route::group([
        'prefix'        => 'my',
        'middleware'    => ['auth:user,publisher', 'verified'],
        'as'            => 'profile' . '.',
    ], function (Router $router) {
        $router->get('/', [ProfileController::class, 'profile'])->name('home');
        $router->get('/edit', [ProfileController::class, 'edit'])->name('edit');
        $router->post('/update', [ProfileController::class, 'update'])->name('update');
        $router->resource('organizations', OrganizationController::class);

    });

    Route::group([
        'prefix'        => 'my',
        'middleware' => ['auth:publisher', 'verified'],
        'as' => 'publisher.'
    ], function (Router $router){
        $router->get('/settings', [PublisherController::class, 'settings'])->name('settings');
        $router->get('/create_api_token', [PublisherController::class, 'createApiToke'])->name('create_api_token');

    });

    // Submissions
    Route::resource('submission', SubmissionController::class);
    Route::resource('publication', SubmissionController::class);
    Route::post('submission/upload', [SubmissionController::class, 'upload_file'])->name('submission.upload');

    // User
    Route::resource('user', UserController::class)->middleware(['auth', 'verified']);
    Route::post('/user/upload-avatar', [UserController::class, 'upload_avatar']);
    Route::get('/{orcid}', [ProfileController::class, 'profile'])->where('orcid', '(\w{4}-){3}\w{4}');

    // Auth
    Auth::routes(['verify' => true]);
    Route::get('/auth/service/orcid', [RegisterController::class, 'orcidRidrect']);
    Route::get('/auth/callback/orcid', [RegisterController::class, 'orcidCallback']);

    // Citation Styles
    Route::get('/submission/citation-style/{id}/{style}', [SubmissionController::class, 'cite']);

    // Settings
    Route::get('set/locale/{locale}', [SettingsController::class, 'setLocale'])->name('set.locale');

    // Conferences
    Route::get('event/conference', [EventController::class, 'index']);
    Route::get('conference/create', [EventController::class, 'createConference'])->name('conference.create');
    Route::get('journal/create', [EventController::class, 'createJournal'])->name('journal.create');
    Route::resource('event', EventController::class);

    Route::get('ojs', [OJSSubmissionController::class, 'index']);
    Route::get('ojs/user/{login}', [OJSSubmissionController::class, 'showUser']);
    Route::get('ojs/publication/{id}', [OJSSubmissionController::class, 'showPublication']);
    Route::delete('ojs/citation_delete/{id}', [OJSSubmissionController::class, 'deleteCitation']);

});
