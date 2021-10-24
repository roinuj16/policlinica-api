<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/homeInfo', 'FrontController@apiHomeInfo');
Route::get('/quem-somos', 'FrontController@apiQuemSomos');
Route::get('/especialidades', 'FrontController@apiEspecialidades');
Route::get('/especialidades-detalhes/{id}', 'FrontController@apiEspecialidadesDetalhes');
Route::get('/post', 'FrontController@apiPosts');
Route::get('/post-recentes', 'FrontController@apiPostsRecentes');
Route::get('/post-detalhes/{id}', 'FrontController@apiPostsDetalhes');
Route::get('/cursos/{tipo}', 'FrontController@apiCursos');
Route::get('/ebooks', 'FrontController@apiEbook');
Route::get('/convenios', 'FrontController@apiConvenios');
Route::get('/banner', 'FrontController@apiBanner');
Route::get('/banner', 'FrontController@apiBanner');
Route::get('/logo', 'FrontController@apiLogo');

Route::post('/init-session-ps', 'PagseguroController@initSessionPs');
Route::post('/init-ps-transaction', 'PagseguroController@initPsTransaction');
Route::post('/comprar-curso', 'PagseguroController@paymentCreditCard');
Route::post('/gerar-boleto', 'PagseguroController@paymentBillet');
Route::post('/contato', 'FrontController@apiContato');
Route::post('/send-ebook', 'FrontController@apiSendEbook');

Route::get('/download/{file}', 'PagseguroController@download');



