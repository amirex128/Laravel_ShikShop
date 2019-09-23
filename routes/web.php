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

Auth::routes();
	Route::get('panel/setting/api/warranty' ,"panel\PanelController@warrantyApi");

	Route::get('panel/setting/api/order' ,"panel\PanelController@followOrder");
	Route::post('panel/robot/store/api', 'panel\RobotController@storeApi');

	Route::post('panel/slider/store/api', 'panel\SliderController@storeApi');
	Route::get('panel/slider/store/api', 'panel\SliderController@getApi');
// Admin panel Routes
Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'panel', 'namespace' => 'panel'], function () {
	Route::get('/sliders','SliderController@index');
	Route::post('/sliders','SliderController@store');

	Route::resource('robot', 'RobotController');
	// Dashboard Route
    Route::get('/', 'ProductController@index');

    // Invoices Routes
    Route::group(['prefix' => 'invoice'], function () {

        Route::get('/', 'InvoiceController@index');
        Route::get('/{order}', 'InvoiceController@get');
        Route::get('/{order}/description/{description}', 'InvoiceController@description');
        Route::get('/{order}/status/{status}', 'InvoiceController@status');
    });

    // Setting Route
    Route::group(['prefix' => 'setting'], function () {

        Route::get('/', 'PanelController@setting');
        Route::post('/slider', 'PanelController@slider');
        Route::post('/posters', 'PanelController@poster');
        Route::post('/info', 'PanelController@info');
        Route::post('/social_link', 'PanelController@social_link');
        Route::post('/shipping_cost', 'PanelController@shipping_cost');
        Route::get('/dollar_cost/{dollar_cost}', 'PanelController@dollar_cost');
    });

    // Category Route
    Route::resource('category', 'CategoryController');

    // Products panel Route
    Route::resource('article', 'ArticleController')->except([ 'show' ]);
    Route::get('/article/search/{query?}', 'ArticleController@search');

    // Products panel Route
    Route::resource('product', 'ProductController')->except([ 'show' ]);
    Route::get('/product/search/{query?}', 'ProductController@search');

    // Color panel routes
    Route::resource('color', 'ColorController')->except([ 'create', 'show' ]);
    // Warranty panel routes
//    Route::resource('warranty', 'WarrantyController')->except([ 'create', 'show' ]);
    // Brand panel routes
    Route::resource('brand', 'BrandController')->except([ 'create', 'show' ]);
    // Size panel routes
    Route::resource('size', 'SizeController')->except([ 'create', 'show' ]);
    // Design panel routes
    Route::resource('design', 'DesignController')->except([ 'create', 'show' ]);
    // Question and Answer panel routes
    Route::resource('question_and_answer', 'QuestionAndAnswerController')->except([ 'create', 'show' ]);
    // Ticket panel routes
    Route::resource('ticket', 'TicketController')->except([ 'create', 'update', 'show', 'edit', 'store' ]);
    // getSlider panel routes
    Route::resource('user', 'UserController')->except([ 'create', 'show', 'store' ]);
    Route::resource('provider', 'ProvinceController');
});


Route::get('/', function () {
    return redirect('/login');
});

