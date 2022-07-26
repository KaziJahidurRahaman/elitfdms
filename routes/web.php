<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/home', function () {
    return view('home.homepage');
});




Route::group(['prefix' => 'auth'], function() {
	Route::get('/', 'Auth\AuthController@index')->name('login');;
	Route::get('/login', 'Auth\AuthController@index');
	Route::post('/verify', 'Auth\AuthController@verify');
	Route::get('/logout', 'Auth\AuthController@logout');
	
	Route::get('/checkStatus', 'Auth\AuthController@checkStatus');
});


Route::group(['middleware' => ['auth']], function () {
	
	Route::get('/', 'Dashboard\DashboardController@index');
	
	Route::get('/report', 'Report\ReportController@report');
	Route::post('/get-report-data', 'Report\ReportController@getReportData');
	
	
	
	Route::group(['middleware' => ['adminAndOperator']], function () {
		
		Route::get('/inbound', 'Inbound\InboundController@scan');
		Route::get('/inbound-details/{bin_no}/{package_no}', 'Inbound\InboundController@details');
		Route::post('/inbound-as', 'Inbound\InboundController@inboundAs');
		
		Route::get('/bin-change', 'BinChange\BinChangeController@scan');
		Route::post('/bin-change-submit', 'BinChange\BinChangeController@change');
		
		
		Route::get('/handover', 'Handover\HandoverController@handover');
		Route::post('/get-handover-data', 'Handover\HandoverController@getHandoverData');
		Route::post('/get-calendar-data', 'Admin\AdminController@getCalendarData');
		Route::post('/mark-as-handover', 'Handover\HandoverController@markAsHandover');

		/////////////////////////----------------////////////////////////////////
		Route::get('/master-sheet', 'Handover\HandoverController@mastersheet');
		
		Route::get('/scrap', 'Scrap\ScrapController@scrap');
		Route::post('/get-scrap-data', 'Scrap\ScrapController@getScrapData');
		Route::post('/retrive-from-scrap', 'Scrap\ScrapController@retriveFromScrap');
		
		
		
	});
	
	
	
	
	
	
	Route::group(['middleware' => ['admin']], function () {
		
		Route::get('/upload-fd', 'UploadFD\UploadFDController@index');
		Route::post('/upload-fd-file', 'UploadFD\UploadFDController@upload');
		
		Route::group(['prefix' => 'admin'], function () {
			Route::get('/bin-config', 'Admin\AdminController@binConfig');
			Route::post('/create-bin', 'Admin\AdminController@createBin');
			
			Route::get('/dop-mapping', 'Admin\AdminController@dopMapping');
			Route::post('/upload-dop-file', 'Admin\AdminController@uploaddop');
			
			Route::get('/user-management', 'Admin\AdminController@userManagement');
			Route::post('/get-user-data', 'Admin\AdminController@getUserData');
			Route::post('/add-user', 'Admin\AdminController@addUser');
			
			Route::get('/scarp-config', 'Admin\AdminController@scrapConfig');
			Route::post('/scarp-config-update', 'Admin\AdminController@scrapConfigUpdate');

			Route::get('/mail-ageing', 'Admin\AdminController@mailAgeing');
			Route::post('/mail-ageing-update', 'Admin\AdminController@mailAgeingUpdate');

			Route::get('/calendar', 'Admin\AdminController@calendar');

			Route::post('/calendar-update', 'Admin\AdminController@calendarUpdate');			
		});
	});
	
});
	



