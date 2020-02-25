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
//     return view('index');
// });

// Route::get('/home', function () {
//     return view('index');
// });

Route::get('/', 'LandingController@index');
Route::get('/home', 'HomeController@index');
Route::POST('/mail', 'HomeController@feedback');

// ------------- BPAD CMS -------------

Route::get('/profil', function () {
    return view('pages.profil');
});

Route::group(['prefix' => 'content'], function () {
	Route::get('/berita', 'ContentController@berita_all');
	Route::get('/berita/{id}', 'ContentController@berita_read');
	Route::get('/foto', 'ContentController@foto_all');
	Route::get('/foto/{id}', 'ContentController@foto_open');
	Route::get('/video', 'ContentController@video_all');
	Route::get('/video/{id}', 'ContentController@video_open');
});

// ------------- BPAD DT --------------

Route::group(['prefix' => 'cms'], function () {
	Route::get('/menu', 'CmsController@menuall');
	Route::post('/form/tambahmenu', 'CmsController@forminsertmenu');
});

Route::group(['prefix' => 'security'], function () {
	Route::get('/group user', 'SecurityController@grupall');
	Route::get('/group user/ubah', 'SecurityController@grupubah');
	Route::post('/form/tambahgrup', 'SecurityController@forminsertgrup');
	Route::post('/form/ubahgrup', 'SecurityController@formupdategrup');
	Route::post('/form/hapusgrup', 'SecurityController@formdeletegrup');

	Route::get('/tambah user', 'SecurityController@tambahuser');
	Route::post('/form/tambahuser', 'SecurityController@forminsertuser');

	Route::get('/manage user', 'SecurityController@manageuser');
	Route::post('/form/tambahuser', 'SecurityController@forminsertuser');
	Route::post('/form/ubahuser', 'SecurityController@formupdateuser');
	Route::post('/form/hapususer', 'SecurityController@formdeleteuser');
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
