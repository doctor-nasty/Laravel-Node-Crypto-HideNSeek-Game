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

use Illuminate\Support\Facades\Auth;
use App\Game;
Use App\User;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['verify' => false]);

// Route::get('/chat', 'ChatsController@index');
// Route::get('messages', 'ChatsController@fetchMessages');
// Route::post('messages', 'ChatsController@sendMessage');
//Route::get('/games', 'Games\GameController@getGames')->name('games');
//Route::get('/game/{id}', 'Games\GameController@getGame')->name('game');
Route::group(['middleware' => ['auth', 'status', 'check.token']], function () {
    // Route::post('/buypointspaypal', 'MyControllers\PointsController@buyPointsPaypal')->name('buypoints.paypal');
    Route::post('', 'MyControllers\GameController@activate')->name('games.activate');

    Route::get('/', 'MyControllers\MainController@getMain')->name('dashboard');
    // Route::get('/plans', 'MyControllers\PlanController@index')->name('plans.index');
    // Route::get('/coinbase', 'MyControllers\CoinbaseController@index')->name('coinbase.index');
    // Route::get('/plan/{plan}', 'MyControllers\PlanController@show')->name('plans.show');
    // Route::get('/buypoints', 'MyControllers\PointsController@buyPoints')->name('buy_points');
    Route::post('/bid/{game_id}', 'MyControllers\PointsController@bid')->name('bid');
    Route::post('/bid_answer', 'MyControllers\PointsController@bidAnswer')->name('bid.answer');
    // Route::post('/buy_points', 'MyControllers\PointsController@buyPoint')->name('buy.points');
    // Route::post('/buy-points', 'MyControllers\CoinbaseController@buyPoint')->name('buy.points.coinbase');
    // Route::post('/subscription', 'MyControllers\SubscriptionController@create')->name('subscription.create');
    // Route::post('/subscription/cancel', 'MyControllers\SubscriptionController@cancel')->name('subscription.cancel');
    // Route::get('/profile', 'MyControllers\UserController@profile');

    // Route::get('users', 'MyControllers\UserController@users')->name('users');
    // Route::post('users', 'MyControllers\UserController@usersPost')->name('users.post');
    // Route::get('user/{id}', 'MyControllers\UserController@show')->name('users.show');


    Route::get('settings', 'MyControllers\UserController@settings')->name('settings');
    Route::post('settings', 'MyControllers\UserController@update')->name('settings.update');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::resource('games', 'MyControllers\GameController');
    Route::get('my_bids', 'MyControllers\GameController@myBids');
    Route::get('game/activate/{id}', 'MyControllers\GameController@activeGame');
    //Route::post('/api/coinbase/webhook', 'PagesController@webhook');
    Route::post('/webhook/success', 'PagesController@webhook');
    Route::get('/test-txt-file', 'MyControllers\GameController@webhook2');
    Route::post('getGameModalHtml', 'MyControllers\GameController@getGameModalHtml');
    Route::post('getGameEditModalHtml', 'MyControllers\GameController@getGameEditModalHtml');
    // Route::get('/points', 'MyControllers\PointsController@index');
    Route::get('/documentation', 'MyControllers\PagesController@documentation');
    Route::get('/delegations', 'MyControllers\PagesController@delegations');
    // Route::get('requests', 'RequestsController@requests');
    // Route::post('requests', ['as' => 'requests.store', 'uses' => 'RequestsController@requestsSaveData']);
    // Route::get('settings/password', function() {
    //     return view('pages.settings');
    // });
    // Route::post('settings/password', 'MyControllers\UpdatePasswordController@update');
    Route::post('settings/avatar', 'MyControllers\UserController@update_avatar');
    // Route::get('search', 'MyControllers\SearchController@search');
    // Route::get('contact', 'ContactUsController@contactUS');
    // Route::post('save_contact', ['as' => 'save_contact', 'uses' => 'ContactUsController@contactSaveData']);
    // Route::get('redeem', 'RedeemController@redeem');
    // Route::post('redeem', ['as' => 'redeem.store', 'uses' => 'RedeemController@redeemSaveData']);
    // Route::get('send', 'MyControllers\MainController@sendNotification');
    // Route::get('/notify', function () {

    //     $user = \App\User::find(1);

    //     $details = [
    //             'greeting' => 'Game',
    //             'body' => 'თქვენს დაწყებულ თამაშს შემოუერთდა მოთამაშე.',
    //             'thanks' => '!',
    //     ];

    //     $user->notify(new \App\Notifications\GameBiddedNotification($details));

    //     // return dd("Done");
    // })->name('notify');
    Route::get('/markAsRead', function(){

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();

    })->name('mark');

    // web3 endpoints
    Route::get('/get_balance', 'Web3Controller@getBalance');
    Route::get('/get_nfts', 'Web3Controller@getNFTs');
    Route::get('/can_create_game', 'Web3Controller@canCreateGame');
    Route::get('/can_play_game', 'Web3Controller@canPlayGame');
});

// Route::post('list/users', 'JsController@ListUsers');
Route::post('list/games', 'JsController@ListGames');
// Route::post('list/points', 'JsController@ListPoints');
Route::post('list/own_games', 'JsController@ListOwnGames');
Route::post('list/bid_games', 'JsController@ListBidGames');

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth.lock')->name('login.locked');
Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');
Route::get('login/signature', 'Web3Controller@signature');
Route::post('login/check_signature', 'Web3Controller@login');

// Route::group(['middleware' => 'verified'], function () {
//     Route::get('admin', 'AdminController@admin')->name('admin');
//     Route::get('admin/games', 'AdminPagesController@games')->name('games');
//     Route::resource('admin/users', 'AdminUsersController');
//     });
