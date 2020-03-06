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

// Route::get('/', function () {
//     return view('welcome');
// });





//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('admin', function () {
    //     return view('admin.dashboard');
    // });
    route::get('admin','HomeController@dashboard')->name('admin');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('department', 'DepartmentController');
    Route::resource('section', 'SectionController');
    
    Route::resource('documents', 'DocumentsController');
    Route::resource('workflow','WorkFlowController');

    Route::get('users.datauser', 'UserController@getData')->name('users.datauser');
    Route::get('usersd/{id}', 'UserController@destroy')->name('users.destroyd');
    Route::get('userss/getRegion','UserController@getRegion');
    Route::get('users.showProfile.{id}','UserController@showProfile')->name('users.showProfile');
    Route::patch('users.updateProfile.{id}','UserController@updateProfile')->name('users.updateProfile');

    Route::get('rolesd/{id}','RoleController@destroy')->name('roles.destroyd');
    Route::get('roles.dataroles', 'RoleController@getData')->name('roles.dataroles');
    
    Route::get('department.datadepartment','DepartmentController@getData')->name('department.datadepartment');
    
    Route::get('section.datasection','SectionController@getData')->name('section.datasection');
    
    

    
    Route::get('documents.dataDocument','DocumentsController@getData')->name('documents.dataDocument');
    Route::get('documents.dataNeedMyAction','DocumentsController@getDataNeedMyAction')->name('documents.dataNeedMyAction');
    Route::get('documents.needMyAction','DocumentsController@needMyAction')->name('documents.needMyAction');
    Route::get('documents.getDataMyDocument','DocumentsController@getDataMyDocument')->name('documents.getDataMyDocument');
    Route::get('documents.myDocument','DocumentsController@myDocument')->name('documents.myDocument');
    Route::get('documents.needAction/{id}','DocumentsController@needAction')->name('documents.needAction')->middleware('auth');
    Route::post('documents.sentBack','DocumentsController@sentBack')->name('documents.sentBack');
    Route::get('document.printDocument/{id}','DocumentsController@printDocument')->name('document.printDocument');
    Route::post('documents.update_ajax','DocumentsController@update_ajax')->name('documents.update_ajax');
    Route::post('documents.reject','DocumentsController@reject')->name('documents.reject');

    Route::get('workflow.dataworkflow','WorkFlowController@getData')->name('workflow.dataworkflow');
    Route::get('workflow.getuser','WorkFlowController@getUser')->name('workflow.getuser');
    Route::post('workflow.simpan','WorkFlowController@simpan')->name('workflow.simpan');
    Route::get('workflow/editDetail/{id}','WorkFlowController@editDetail')->name('workflow.editDetail');
    Route::patch('workflow.updateDetail','WorkFlowController@updateDetail')->name('workflow.updateDetail');
    Route::post('workflow.editSort','WorkFlowController@editSort')->name('workflow.editSort');
});
