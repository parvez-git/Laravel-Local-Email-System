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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::prefix('home')->name('home')->group(function(){

	Route::get('/', 'HomeController@index');
	Route::get('/composemessage', 'HomeController@composemessage')->name('.composemessage');
	Route::get('/searchsentmessage', 'HomeController@searchSentMessage')->name('.sentmessage.search');
	Route::get('/searchreceivedmessage', 'HomeController@searchReceivedMessage')->name('.receivedmessage.search');
	Route::get('/viewmessage/{id}/{notificationid?}', 'HomeController@viewmessage')->name('.viewmessage');
	Route::get('/sentmessage', 'HomeController@sentmessage')->name('.sentmessage');
	Route::post('/messagesend', 'HomeController@messageSend')->name('.message.send');
	Route::get('/clearnotifications', 'HomeController@markAsReadNotification')->name('.notification.clear');
});

Route::middleware(['auth','admin'])->prefix('admin')->group(function ()
{
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::get('/lostuser', 'AdminController@lost')->name('admin.user.lost');
	Route::get('/returned', 'AdminController@returned')->name('admin.user.returned');
	Route::put('/userblock/{id}', 'AdminController@block')->name('admin.user.block');
	Route::delete('/userdelete/{id}', 'AdminController@delete')->name('admin.user.delete');
});
