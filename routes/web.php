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
Route::post('/mail', 'HomeController@feedback');
Route::post('/post', 'ProfilController@test');

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

Route::group(['prefix' => 'profil'], function () {
	Route::get('/disposisi', 'ProfilController@disposisi');
	Route::get('/tambah disposisi', 'ProfilController@disposisitambah');
	Route::post('/lihat disposisi', 'ProfilController@disposisilihat');
	Route::post('form/lihatdisposisi', 'ProfilController@formviewdisposisi');
	Route::post('form/tambahdisposisi', 'ProfilController@forminsertdisposisi');
	Route::post('form/hapusdisposisi', 'ProfilController@formdeletedisposisi');

	Route::get('/pegawai', 'ProfilController@pegawai');
	Route::post('/form/ubahidpegawai', 'ProfilController@formupdateidpegawai');
	Route::post('/form/tambahdikpegawai', 'ProfilController@forminsertdikpegawai');
	Route::post('/form/ubahdikpegawai', 'ProfilController@formupdatedikpegawai');
	Route::post('/form/hapusdikpegawai', 'ProfilController@formdeletedikpegawai');
});

Route::group(['prefix' => 'cms'], function () {
	Route::get('/menu', 'CmsController@menuall');
	Route::post('/form/tambahmenu', 'CmsController@forminsertmenu');
	Route::post('/form/ubahmenu', 'CmsController@formupdatemenu');
	Route::post('/form/hapusmenu', 'CmsController@formdeletemenu');

	Route::get('/kategori', 'CmsController@kategoriall');
	Route::post('/form/tambahkategori', 'CmsController@forminsertkategori');
	Route::post('/form/ubahkategori', 'CmsController@formupdatekategori');
	Route::post('/form/hapuskategori', 'CmsController@formdeletekategori');

	Route::get('/subkategori', 'CmsController@subkategoriall');
	Route::post('/form/tambahsubkategori', 'CmsController@forminsertsubkategori');
	Route::post('/form/ubahsubkategori', 'CmsController@formupdatesubkategori');
	Route::post('/form/hapussubkategori', 'CmsController@formdeletesubkategori');

	Route::get('/content', 'CmsController@contentall');
	Route::get('/tambah content', 'CmsController@contenttambah');
	Route::post('/ubah content', 'CmsController@contentubah');
	Route::get('/form/apprcontent', 'CmsController@formapprcontent');
	Route::post('/form/tambahcontent', 'CmsController@forminsertcontent');
	Route::post('/form/ubahcontent', 'CmsController@formupdatecontent');
	Route::post('/form/hapuscontent', 'CmsController@formdeletecontent');
});

Route::group(['prefix' => 'internal'], function () {
	Route::get('/agenda', 'InternalController@agenda');
	Route::get('/agenda tambah', 'InternalController@agendatambah');
	Route::post('/agenda ubah', 'InternalController@agendaubah');
	Route::get('/form/appragenda', 'InternalController@formappragenda');
	Route::post('/form/tambahagenda', 'InternalController@forminsertagenda');
	Route::post('/form/ubahagenda', 'InternalController@formupdateagenda');
	Route::post('/form/hapusagenda', 'InternalController@formdeleteagenda');

	Route::get('/berita', 'InternalController@berita');
	Route::get('/berita tambah', 'InternalController@beritatambah');
	Route::post('/berita ubah', 'InternalController@beritaubah');
	Route::get('/form/apprberita', 'InternalController@formapprberita');
	Route::post('/form/tambahberita', 'InternalController@forminsertberita');
	Route::post('/form/ubahberita', 'InternalController@formupdateberita');
	Route::post('/form/hapusberita', 'InternalController@formdeleteberita');
});

Route::group(['prefix' => 'kepegawaian'], function () {
	Route::get('/data pegawai', 'KepegawaianController@pegawaiall');
	Route::get('/tambah pegawai', 'KepegawaianController@pegawaitambah');
	Route::post('/ubah pegawai', 'KepegawaianController@pegawaiubah');
	Route::post('/form/tambahpegawai', 'KepegawaianController@forminsertpegawai');
	Route::post('/form/ubahpegawai', 'KepegawaianController@formupdatepegawai');
	Route::post('/form/hapuspegawai', 'KepegawaianController@formdeletepegawai');

	Route::get('/entri kinerja', 'KepegawaianController@entrikinerja');
	Route::get('/kinerja tambah', 'KepegawaianController@kinerjatambah');
	Route::get('/getaktivitas', 'KepegawaianController@getaktivitas');
	Route::post('/form/hapusaktivitas', 'KepegawaianController@formdeleteaktivitas');
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
