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


// Route::get('/home', function () {
//     return view('index');
// });
    
Route::get('/', 'LandingController@index');
Route::get('/index2', 'LandingController@index2');
Route::get('/index/copy', function () {
    return view('indexcopy');
});
Route::get('/home', 'HomeController@index');
Route::POST('/home/password', 'HomeController@password');
Route::get('/logout', 'LandingController@logout');

Route::get('/profil', function () {
    return view('profil');
});

Route::group(['prefix' => 'konten'], function () {
	Route::get('/berita', 'ContentController@berita');
	Route::get('/berita/view', 'ContentController@beritasingle');
	Route::get('/galeri', 'ContentController@galeri');
});

Route::group(['prefix' => 'setup'], function () {
	Route::get('/kategori', 'SetupController@kategoriall');
	Route::post('/form/tambahkategori', 'SetupController@forminsertkategori');
	Route::post('/form/ubahkategori', 'SetupController@formupdatekategori');
	Route::post('/form/hapuskategori', 'SetupController@formdeletekategori');

	Route::get('/jenis', 'SetupController@jenisall');
	Route::post('/form/tambahjenis', 'SetupController@forminsertjenis');
	Route::post('/form/ubahjenis', 'SetupController@formupdatejenis');
	Route::post('/form/hapusjenis', 'SetupController@formdeletejenis');


	Route::get('/file', 'SetupController@fileall');
	Route::get('/tambah file', 'SetupController@filetambah');
	Route::get('/ubah file', 'SetupController@fileubah');
	Route::post('/form/tambahfile', 'SetupController@forminsertfile');
	Route::post('/form/ubahfile', 'SetupController@formupdatefile');
	Route::post('/form/hapusfile', 'SetupController@formdeletefile');
});

Route::group(['prefix' => 'cms'], function () {
	Route::get('/menu', 'CmsController@menuall');
	Route::post('/form/tambahmenu', 'CmsController@forminsertmenu');
	Route::post('/form/ubahmenu', 'CmsController@formupdatemenu');
	Route::post('/form/hapusmenu', 'CmsController@formdeletemenu');
	Route::get('/menuakses', 'CmsController@menuakses');
	Route::post('/form/ubahaccess', 'CmsController@formupdateaccess');
});

Route::group(['prefix' => 'media'], function () {
    Route::get('/content', 'CmsController@contentall');
    Route::get('/tambah content', 'CmsController@contenttambah');
    Route::post('/ubah content', 'CmsController@contentubah');
    Route::post('/form/tambahcontent', 'CmsController@forminsertcontent');
    Route::post('/form/ubahcontent', 'CmsController@formupdatecontent');
    Route::post('/form/hapuscontent', 'CmsController@formdeletecontent');
});

Route::group(['prefix' => 'kepegawaian'], function () {
	Route::get('/excel', 'KepegawaianController@printexcel');
	Route::get('/excelpegawai', 'KepegawaianController@printexcelpegawai');

	Route::get('/data pegawai', 'KepegawaianController@pegawaiall');
	Route::get('/tambah pegawai', 'KepegawaianController@pegawaitambah');
	Route::get('/ubah pegawai', 'KepegawaianController@pegawaiubah');
	Route::post('/form/tambahpegawai', 'KepegawaianController@forminsertpegawai');
	Route::post('/form/ubahpegawai', 'KepegawaianController@formupdatepegawai');
	Route::post('/form/hapuspegawai', 'KepegawaianController@formdeletepegawai');
	Route::post('/form/ubahpassuser', 'KepegawaianController@formupdatepassuser');
	Route::post('/form/ubahstatuspegawai', 'KepegawaianController@formupdatestatuspegawai');
	Route::post('/form/tambahdikpegawai', 'KepegawaianController@forminsertdikpegawai');
	Route::post('/form/ubahdikpegawai', 'KepegawaianController@formupdatedikpegawai');
	Route::post('/form/hapusdikpegawai', 'KepegawaianController@formdeletedikpegawai');
	Route::post('/form/tambahgolpegawai', 'KepegawaianController@forminsertgolpegawai');
	Route::post('/form/ubahgolpegawai', 'KepegawaianController@formupdategolpegawai');
	Route::post('/form/hapusgolpegawai', 'KepegawaianController@formdeletegolpegawai');
	Route::post('/form/tambahjabpegawai', 'KepegawaianController@forminsertjabpegawai');
	Route::post('/form/ubahjabpegawai', 'KepegawaianController@formupdatejabpegawai');
	Route::post('/form/hapusjabpegawai', 'KepegawaianController@formdeletejabpegawai');

	Route::get('/struktur', 'KepegawaianController@strukturorganisasi');

	Route::get('/entri kinerja', 'KepegawaianController@entrikinerja');
	Route::post('/kinerja tambah', 'KepegawaianController@kinerjatambah');
	Route::get('/getaktivitas', 'KepegawaianController@getaktivitas');
	Route::get('/getdetailaktivitas', 'KepegawaianController@getdetailaktivitas');
	Route::post('/form/tambahkinerja', 'KepegawaianController@forminsertkinerja');
	Route::post('/form/hapuskinerja', 'KepegawaianController@formdeletekinerja');
	Route::post('/form/tambahaktivitas', 'KepegawaianController@forminsertaktivitas');
	Route::get('/form/hapusaktivitas', 'KepegawaianController@formdeleteaktivitas');

	Route::get('/approve kinerja', 'KepegawaianController@approvekinerja');
	Route::post('/form/approvekinerja', 'KepegawaianController@formapprovekinerja');
	Route::post('/form/approvekinerjasingle', 'KepegawaianController@formapprovekinerjasingle');

	Route::get('/laporan kinerja', 'KepegawaianController@laporankinerja');

	Route::get('/status disposisi', 'KepegawaianController@statusdisposisi');

	Route::get('/surat keluar', 'KepegawaianController@suratkeluar');
	Route::get('/surat keluar tambah', 'KepegawaianController@suratkeluartambah');
	Route::post('/surat keluar ubah', 'KepegawaianController@suratkeluarubah');
	Route::post('/form/tambahsuratkeluar', 'KepegawaianController@forminsertsuratkeluar');
	Route::post('/form/ubahsuratkeluar', 'KepegawaianController@formupdatesuratkeluar');
	Route::post('/form/hapussuratkeluar', 'KepegawaianController@formdeletesuratkeluar');
});

Route::group(['prefix' => 'security'], function () {
	Route::get('/group user', 'SecurityController@grupall');
	Route::get('/hak akses', 'SecurityController@hakakses');

	Route::get('/group user/ubah', 'SecurityController@grupubah');
	Route::post('/form/tambahgrup', 'SecurityController@forminsertgrup');
	Route::post('/form/ubahgrup', 'SecurityController@formupdategrup');
	Route::post('/form/hapusgrup', 'SecurityController@formdeletegrup');

	Route::get('/tambah user', 'SecurityController@tambahuser');
	Route::get('/ubah user', 'SecurityController@ubahuser');

	Route::get('/manage user', 'SecurityController@manageuser');
	Route::post('/form/tambahuser', 'SecurityController@forminsertuser');
	Route::post('/form/ubahuser', 'SecurityController@formupdateuser');
	Route::post('/form/ubahpassuser', 'SecurityController@formupdatepassuser');
	Route::post('/form/hapususer', 'SecurityController@formdeleteuser');
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
