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


Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();


//Rotas para Auth
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

$this->get('list-users', 'UserController@showUser');
$this->get('edit-profile/{id}', 'UserController@editProfile');
$this->get('register-user', 'UserController@formNewUser');
$this->post('/save-user', 'UserController@saveUser');
$this->get('/delete-user/{id}', 'UserController@deleteUser');

//Página inicial Home
Route::get('/home', 'HomeController@index')->name('home');


//Banner
Route::get('/banner', 'BannerController@list');
Route::get('/form-banner', 'BannerController@formBanner');
Route::get('/status-banner/{id}', 'BannerController@disableBanner');
Route::post('save-banner',['as'=>'image.upload','uses'=>'BannerController@saveBanner']);

Route::get('/form-logo', 'LogoController@formLogo');
Route::post('save-logo',['as'=>'image.upload','uses'=>'LogoController@saveLogo']);



//Especialidades
Route::get('/especialidades', 'EspecialidadesController@verEspecialidades');
Route::get('/cad-especialidades', 'EspecialidadesController@cadastroEspecialidades');
Route::get('/list-especialidades', 'EspecialidadesController@verEspecialidades');
Route::post('/save-especialidades', 'EspecialidadesController@saveEspecialidades');
Route::get('/edit-especialidades/{id}', 'EspecialidadesController@editEspecialidades');
Route::get('/delete-especialidades/{id}', 'EspecialidadesController@deleteConteudo');

//Blog
Route::get('/blog', 'BlogController@listarConteudo');
Route::get('/cad-conteudo', 'BlogController@cadastroConteudo');
Route::get('/edit-conteudo/{id}', 'BlogController@editConteudo');
Route::get('/delete-conteudo/{id}', 'BlogController@deleteConteudo');
Route::post('/save-conteudo', 'BlogController@saveConteudo');

//Quem somos
Route::get('/quem-somos', 'QuemSomosController@gerenciarConteudo');
Route::post('/save-quem-somos', 'QuemSomosController@saveConteudo');

//Convenio
Route::get('/convenios', 'ConvenioController@verConvenios');
Route::get('/cad-convenio', 'ConvenioController@cadConvenio');
Route::get('/edit-convenio/{id}', 'ConvenioController@editConvenio');
Route::post('/convenios', 'ConvenioController@gerenciarConvenio');
Route::get('/delete-convenio/{id}', 'ConvenioController@deleteConvenio');

//Cursos
Route::get('/cursos', 'CursosController@listarCursos');
Route::get('/cad-cursos', 'CursosController@formCursos');
Route::post('/save-cursos', 'CursosController@saveCursos');
Route::get('/edit-curso/{id}', 'CursosController@editCurso');
Route::get('/delete-curso/{id}', 'CursosController@deleteCurso');

//E-Books
Route::get('/list-ebooks', 'EbookController@listarEbooks');
Route::get('/cad-ebooks', 'EbookController@formEbooks');
Route::get('/edit-ebook/{id}', 'EbookController@editEbook');
Route::post('/save-ebook', 'EbookController@saveEbook');
Route::get('/delete-ebook/{id}', 'EbookController@deleteEbook');

//Relatórios
Route::get('/pedidos', 'RelatorioController@listaPedidos');
Route::get('/detalhe-pedido/{id}', 'RelatorioController@listaDetalhesPedido');
Route::get('/listar-alunos', 'RelatorioController@listarAlunos');

//Pacientes
Route::get('/pacientes', 'PacienteController@allPacientes');
Route::get('/cad-paciente', 'PacienteController@formPacientes');
Route::get('/edit-paciente/{id}', 'PacienteController@editPaciente');
Route::get('/dados-paciente/{id}', 'PacienteController@showPaciente');
Route::post('/save-paciente', 'PacienteController@savePacientes');
Route::get('/delete-paciente/{id}', 'PacienteController@deletePaciente');
Route::get('/export-csv', 'PacienteController@export');



