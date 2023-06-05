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

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EstablecimientoExport;

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/intro', 'HomeController@intro')->name('intro');
Route::get('/setintro', 'HomeController@setIntro')->name('setIntro');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aviso-de-privacidad', 'HomeController@aviso')->name('aviso');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/categoria/{categoria}', 'HomeController@categorias')->name('categoria');
Route::get('/noticias', 'HomeController@noticias')->name('noticias');
Route::get('/trueque', 'HomeController@trueque')->name('trueque');
Route::get('/noticias/{slug}', 'HomeController@noticiasInt')->name('noticiasInt');
Route::get('/establecimientos/{src}', 'HomeController@busquedaGet')->name('busquedaGet');
Route::post('/contacto', 'HomeController@sendComentario')->name('contacto');
Route::post('/ciudades', 'HomeController@ciudades')->name('ciudades');
Route::post('/like', 'HomeController@doLike')->name('like');
Route::post('/unlike', 'HomeController@unlike')->name('unlike');


Route::get('/registro', 'HomeController@registro')->name('registro')->middleware('auth');
Route::get('/registro/thank-you', 'HomeController@thankYou')->name('gracias')->middleware('auth');
Route::post('/registro', 'HomeController@registro')->name('registro')->middleware('auth');
Route::post('/ajaxData', 'HomeController@ajaxData')->name('ajaxData');


Route::get('/catalogo', 'HomeController@mainInit')->name('catalogo');

Route::post('/add-registro' , 'HomeController@sendNegocio')->name('addRegistro');

Route::group(['prefix' => 'admTemplate'], function () {
  Voyager::routes();
});


Route::group(['middleware' => ['verified']], function () {
  Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth');
  Route::get('/dashboard/mi-negocio', 'HomeController@miNegocio')->name('minegocio')->middleware('auth');
  Route::get('/dashboard/mi-galeria', 'HomeController@miGaleria')->name('migaleria')->middleware('auth');
  Route::get('/dashboard/mis-favoritos', 'HomeController@misFavoritos')->name('migaleria')->middleware('auth');
  Route::get('/dashboard/mis-productos', 'HomeController@misProductos')->name('productos')->middleware('auth');
  Route::post('/galeria', 'HomeController@addGaleria')->name('adGaleria')->middleware('auth');
  Route::post('/upd-gal', 'HomeController@updateGaleria')->name('updateGaleria')->middleware('auth');
  Route::post('/dlt-gal', 'HomeController@deleteGaleria')->name('deleteGaleria')->middleware('auth');
  Route::post('/update-usuario', 'HomeController@updateInformacion')->name('updateInformacion')->middleware('auth');
  Route::post('/update-establecimiento', 'HomeController@updateEstablecimiento')->name('updateEstablecimiento')->middleware('auth');
  Route::post('/agrega-producto', 'HomeController@agregarProducto')->name('agregaProducto')->middleware('auth');
  Route::post('/actualiza-producto', 'HomeController@actualizarProducto')->name('actualizaProducto')->middleware('auth');
  Route::delete('/borra-producto', 'HomeController@borrarProducto')->name('borraProducto')->middleware('auth');
});

Route::post('/vota-producto', 'HomeController@votarProducto')->name('votarProducto');
Route::any('/busqueda' ,'HomeController@busqueda')->name('busqueda');
Route::get('/logout' ,'HomeController@logout')->name('logout')->middleware('auth');
Route::get('/negocio/{id}/{slug}' ,'HomeController@interiorNegocio')->name('negocioInterior');
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('/download/App/Models/{model}',function($model){
  switch ($model){
    case 'Establecimiento':
    return Excel::download(new EstablecimientoExport, 'establecimientos.xlsx');
    break;
}
});
