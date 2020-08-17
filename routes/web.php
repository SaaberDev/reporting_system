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

/**
 * ************* Auth Routes *************
 */
Auth::routes([
    'register' => false,
    'reset' => false,
]);
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/**
 * ************* ADMIN ROUTE GROUP *************
 */
Route::prefix('admin')->name('admin.')->namespace('admin_panel')->middleware('role:isAdmin')
    ->group(function (){
        Route::get('/', 'AssetController@index')->name('index');
        Route::get('/add_asset', 'AssetController@create')->name('create');
        Route::post('/store_asset', 'AssetController@store')->name('store');
        Route::get('/edit_asset/{id}', 'AssetController@edit')->name('edit');
        Route::post('/update_asset/{id}', 'AssetController@update')->name('update');
        //Asset Details Routes
        Route::get('/asset_details/{asset_slug}', 'AssetController@show')->name('show');
        Route::get('/asset_details/{asset_slug}/updateStatus', 'AssetController@updateStatus')->name('updateStatus');
        //Delete Route for Asset and Report
        Route::get('/delete_asset/{id}', 'AssetController@destroy_asset')->name('destroy_asset');
        Route::get('/delete_report/{id}', 'AssetController@destroy_report')->name('destroy_report');
        //Report Detail Route
        Route::get('/report_details/show_details/{report_slug}', 'AssetController@showReport')->name('showReport');
        Route::get('/report_details/show_details/{report_slug}/updateValidStatus', 'AssetController@updateValidStatus')->name('updateValidStatus');
        //PDF Routes
        Route::get('/asset_details/previewPDF/{asset_slug}', 'PDFController@previewPDF')->name('previewPDF');
        Route::get('/asset_details/download-PDF/{asset_slug}', 'PDFController@downloadPDF')->name('downloadPDF');
        //Admin Password Change
        Route::get('change-password', 'AuthController@change_password')->name('change.password');
        Route::post('update-password', 'AuthController@update_password')->name('update.password');
    });


/**
 * ************* USER ROUTE GROUP *************
 */
Route::prefix('report')->name('report.')->namespace('user_panel')->middleware('role:isUser')
    ->group(function (){
        Route::get('/', 'ReportController@index')->name('index');
        Route::get('/report_details/{asset_slug}', 'ReportController@show')->name('show');
        Route::get('/add_report/{asset_slug}', 'ReportController@create')->name('create');
        Route::post('/store_report/{asset_slug}', 'ReportController@store')->name('store');
    });
