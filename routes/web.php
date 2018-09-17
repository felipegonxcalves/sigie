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
    return view('welcome');
});

//ROute::resource('empresas', 'EmpresasController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ROute::resource('igreja', 'IgrejaCongregacaoController');

ROute::resource('sede', 'SedeController');
Route::get('/sede/delete/{id}', 'SedeController@delete');
Route::any('/sede-search/', 'SedeController@search')->name('sede.search');
Route::get('/sede/alocardirigente/{id}', 'SedeController@alocarDirigente');
Route::get('/sede/insertdirigente/{id}', 'SedeController@insertDirigente');

ROute::resource('congregacoes', 'IgrejaCongregacaoController');
Route::get('/igreja-congregacao/', 'IgrejaCongregacaoController@associarResponsavel')->name('associarresponsavel');
Route::get('/igreja-congregacao/associar-responsavel/{id}', 'IgrejaCongregacaoController@associarResponsavel')->name('associarresponsavel');
Route::post('/igreja-congregacao/associar-responsavel/', 'IgrejaCongregacaoController@inserirResponsavel');
Route::any('/igreja-congregacao/associar-responsavel/search/', 'IgrejaCongregacaoController@search');

ROute::resource('membro', 'MembroController');
Route::get('/membro/delete/{id}', 'MembroController@delete');
Route::get('/relatorio-oficiais/', 'MembroController@membrosOficiais');
Route::get('/relatorio-membros/', 'MembroController@relatorioMembros');
Route::post('/gerar-relatorio-oficiais/', 'MembroController@gerarRelatorioMembrosOficiais');
Route::post('/gerar-relatorio-membros/', 'MembroController@gerarRelatorioLocalidade')->name('membro.relatorio');
Route::any('/membro-search/', 'MembroController@search')->name('membro.search');
Route::post('/verifica-matricula/', 'MembroController@verificaMatricula')->name('membro.matricula');
Route::get('/historico-individual-dizimo/{id}', 'MembroController@historicoIndividualDizimo')->name('dizimo.historico');
Route::get('/listar-membros-ministerio/', 'MembroController@listarMembrosMinisterio')->name('membro.ministerio');
Route::get('/ficha-ministerio/{id}', 'MembroController@fichaMinisterial')->name('ficha.ministerio');
Route::post('/insert-ficha-ministerio/{id}', 'MembroController@insertFichaMinisterial')->name('cadastrar.ministerio');
Route::get('/ficha-ministerio/delete/{id}', 'MembroController@deleteFichaMinisterial')->name('deletar.ministerio');
Route::get('/imprimir-ficha/{id}', 'MembroController@imprimirFicha')->name('imprimir.ficha');
Route::any('/ministerio-search/', 'MembroController@searchMinisterio')->name('ministerio.search');

ROute::resource('dizimo', 'DizimosController');
Route::get('/dizimo/delete/{id}', 'DizimosController@delete');
Route::get('/dizimo/deletee/{id}', 'DizimosController@deleteindex');
Route::any('/dizimo-search/', 'DizimosController@search')->name('dizimo.search');
Route::get('/relatorio-por-periodo-dizimo/', 'DizimosController@relatorioDizimoPeriodo');
Route::any('/dizimo/gerar-relatorio/', 'DizimosController@gerarRelatorio');

ROute::resource('oferta', 'OfertasController');
Route::get('/oferta/delete/{id}', 'OfertasController@delete');
Route::get('/oferta/deletee/{id}', 'OfertasController@deleteindex');
Route::any('/oferta-search/', 'OfertasController@search')->name('oferta.search');
Route::get('/relatorio-oferta/', 'OfertasController@relatorioOferta');
Route::any('/oferta/gerar-relatorio/', 'OfertasController@gerarRelatorio')->name('oferta.gerarrelatorio');

ROute::resource('entrada', 'EntradasController');
Route::get('/entrada/deletee/{id}', 'EntradasController@delete');
Route::get('/entrada/delete/{id}', 'EntradasController@deleteIndex');
Route::any('/entrada-search/', 'EntradasController@search')->name('entrada.search');
Route::get('/relatorio-entrada/', 'EntradasController@relatorioEntrada');
Route::any('/entrada/gerar-relatorio-entrada/', 'EntradasController@gerarRelatorioEntrada');
Route::get('/relatorio-geral/', 'EntradasController@relatorioGeral');
Route::post('/gerar-relatorio-geral/', 'EntradasController@gerarRelatorioGeral');

ROute::resource('saida', 'SaidasController');
Route::get('/saida/deletee/{id}', 'SaidasController@delete');
Route::get('/saida/delete/{id}', 'SaidasController@deleteIndex');
Route::any('/saida-search/', 'SaidasController@search')->name('saida.search');
Route::get('/saida/comprovante/{id}', 'SaidasController@comprovanteSaida');
Route::get('/relatorio-saida/', 'SaidasController@relatorioSaida');
Route::any('/saida/gerar-relatorio-saida/', 'SaidasController@gerarRelatorioSaida');

ROute::resource('contas-pagar', 'ContasPagarController');
Route::get('/contas-pagar/deletee/{id}', 'ContasPagarController@delete');
Route::get('/contas-pagar/delete/{id}', 'ContasPagarController@deleteIndex');
Route::any('/contas-search/', 'ContasPagarController@search')->name('contaspagar.search');
Route::get('/contas-pagar/pagar/{id}', 'ContasPagarController@pagarConta');

ROute::resource('grupo', 'GruposController');
Route::get('/grupo-filtro/{id}', 'GruposController@filtroGrupo');
Route::post('/grupo-componentes', 'GruposController@gerarListaComponentesGrupo');

ROute::resource('oficiais-igreja', 'MembrosOficiaisController');

ROute::resource('bens-igreja', 'Bens_igrejaController');
Route::get('/bens-igreja/delete/{id}', 'Bens_igrejaController@delete');
Route::get('/alocar-bens-igreja', 'Bens_igrejaController@alocarBensIgreja');
Route::post('/salvar-bens-igreja', 'Bens_igrejaController@insertBensIgreja');
Route::get('/listar-bens-igreja', 'Bens_igrejaController@listarBens');
Route::post('/relatorio-listagem-bens', 'Bens_igrejaController@gerarRelatorioListagemBens');


