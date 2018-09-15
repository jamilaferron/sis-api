<?php

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



Auth::routes();


//Route::get('/verify/{email_token}', 'VerifyController@verify')->name('verify');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

/*
Route::group(['middleware' => ['web', 'auth']], function ()
{
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/', function ()
    {

            if(Auth::user()->role == 'support worker')
            {

                    $supportworker = \App\SupportWorker::where('user_id', Auth::user()->id)->first();
                    $supportworker->id;
                    $reportsCount = \App\SupportSession::where('supportworker_id', $supportworker->id)->where('report_id', "!=", null)
                        ->where('report_deadline', '<', now())->count();
                    return view('dashboard')->with('reportsCount', $reportsCount);

            }
            elseif(Auth::user()->role == 'manager')
            {

                    $supportworkersCount = \App\User::where('role', '=', 'support worker')
                        ->where('active', true)->count();
                    $serviceusersCount = \App\ServiceUser::where('active', true)->count();
                    $reportsCount = \App\SupportSession::where('report_id', "!=", null)->count();

                    return view('managerhome')->with('supportworkersCount', $supportworkersCount)->with('reportsCount', $reportsCount)
                        ->with('serviceusersCount', $serviceusersCount);


            }
            elseif(Auth::user()->role == 'superAdmin')
            {

                    return view('superadminhome');

            }
            else
            {

                    $supportworkersCount = \App\User::where('role', '=', 'support worker')
                        ->where('active', true)->count();
                    $serviceusersCount = \App\ServiceUser::where('active', true)->count();
                    $reportsCount = \App\SupportSession::where('report_id', "!=", null)
                        ->where('report_deadline', '<', now())->count();

                    return view('adminDash')->with('supportworkersCount', $supportworkersCount)->with('reportsCount', $reportsCount)
                        ->with('serviceusersCount', $serviceusersCount);


            }

    })->name('home');
    
});
*/
Route::group(['middleware' => ['web', 'auth']], function ()
{
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/', function ()
    {
        return view('dashboard');

    })->name('home');

});

Route::group(['middleware' => ['App\Http\Middleware\IsAdmin']], function () {

    Route::resource('adminDash', 'DashboardController');
    Route::resource('supportRequests', 'SupportRequestsController');
    Route::get('sessions', 'SessionsController@startSession');
    Route::resource('sessions', 'SessionsController');
    Route::resource('serviceUsers', 'ServiceUsersController');

});
Route::group(['middleware' => ['App\Http\Middleware\IsSupportWorker']], function () {

    Route::get('session/{id}',['uses' => 'SessionsController@startSession', 'as' => 'session.startSession']);
    Route::resource('sessions', 'SessionsController');
    Route::resource('serviceUsers', 'ServiceUsersController');

});


Route::group(['middleware' => 'App\Http\Middleware\IsSuperAdmin'], function () {

    Route::resource('users', 'UsersController');
});

Route::group(['middleware' => 'App\Http\Middleware\IsAdmin'], function () {

    Route::resource('supportWorkers', 'SupportWorkersController');

});

