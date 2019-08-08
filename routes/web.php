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

// Route::get('/', function () {
//     return view('agnes');
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::resource('nas', 'NasController');
Route::get('nas/delete/{id}','NasController@destroy')->name('nas.delete');

Route::resource('nastable', 'NasTableController');
Route::post('nastable/data', 'NasTableController@getData')->name('dataNas');

//masih cacat tabelnya kenapa ya bingung
Route::resource('radacct', 'RadAcctController');
Route::post('radacct/data', 'RadAcctController@getData')->name('dataRadAcct');
Route::get('radacct/delete/{id}','RadAcctController@destroy')->name('radacct.delete');

Route::resource('radcheck', 'RadCheckController');
Route::post('radcheck/data', 'RadCheckController@getData')->name('dataRadCheck');
Route::get('radcheck/delete/{id}','RadCheckController@destroy')->name('radcheck.delete');

Route::resource('radgroupcheck', 'RadGroupCheckController');
Route::post('radgroupcheck/data', 'RadGroupCheckController@getData')->name('dataRadGroupCheck');
Route::get('radgroupcheck/delete/{id}','RadGroupCheckController@destroy')->name('radgroupcheck.delete');

Route::resource('radgroupreply', 'RadGroupReplyController');
Route::post('radgroupreply/data', 'RadGroupReplyController@getData')->name('dataRadGroupReply');
Route::get('radgroupreply/delete/{id}','RadGroupReplyController@destroy')->name('radgroupreply.delete');

Route::resource('radhuntgroup', 'RadHuntGroupController');
Route::post('radhuntgroup/data', 'RadHuntGroupController@getData')->name('dataRadHuntGroup');
Route::get('radhuntgroup/delete/{id}','RadHuntGroupController@destroy')->name('radhuntgroup.delete');

Route::resource('radippool', 'RadIpPoolController');
Route::post('radippool/data', 'RadIpPoolController@getData')->name('dataRadIpPool');
Route::get('radippool/delete/{id}','RadIpPoolController@destroy')->name('radippool.delete');

Route::resource('radpostauth', 'RadPostAuthController');
Route::post('radpostauth/data', 'RadPostAuthController@getData')->name('dataRadAuth');
Route::get('radpostauth/delete/{id}','RadPostAuthController@destroy')->name('radpostauth.delete');

Route::resource('radreply', 'RadReplyController');
Route::post('radreply/data', 'RadReplyController@getData')->name('dataRad');
Route::get('radreply/delete/{id}','RadReplyController@destroy')->name('radreply.delete');

Route::resource('radusergroup', 'RadUserGroupController');
Route::post('radusergroup/data', 'RadUserGroupController@getData')->name('dataRadUserGroup');

// Route::get('/bar', function () {
//     return view('bar');
// });
