<?php

namespace App\Http\Controllers;

use App\Igreja_congregacao;
use App\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $paginate = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$igrejaCongregacao = Igreja_congregacao::all();
        $membro = DB::table('membros')->where('situacao', '=', 'Ativo')->get();
        $igrejaCongregacao = Igreja_congregacao::orderBy('nome_igreja')->paginate(15);
        return view('sede.index', compact('igrejaCongregacao', 'membro'));

    }

    public function search(Request $request, Igreja_congregacao $igreja_congregacao)
    {
        $request = $request->except('_token');
        $igrejaCongregacao = $igreja_congregacao->search($request);
        return view('sede.index', compact('igrejaCongregacao', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sede.create', compact('membro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->all();
        $igrejaCongregacao = new Igreja_congregacao();
        $igrejaCongregacao->nome_igreja = $params['nome'];
        $igrejaCongregacao->nome_curto = $params['nome_curto'];
        $igrejaCongregacao->descricao = $params['descricao'];
        $igrejaCongregacao->logradouro = $params['logradouro'];
        $igrejaCongregacao->cep = $params['cep'];
        $igrejaCongregacao->nro = $params['nro'];
        $igrejaCongregacao->bairro = $params['bairro'];
        $igrejaCongregacao->cidade = $params['cidade'];
        $igrejaCongregacao->uf = $params['uf'];
        $igrejaCongregacao->tp_igreja = 's';

        $igrejaCongregacao->save();
        return redirect('sede');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$igrejaCongregacao = Igreja_congregacao::findOrFail($id);
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);

        return view('sede.show', compact('igrejaCongregacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$igrejaCongregacao = DB::table('igreja_congregacoes')->where('id_igreja', '=', $id)->get();
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);

        return view('sede.edit',  compact('igrejaCongregacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);
        $igrejaCongregacao->nome_igreja = $params['nome'];
        $igrejaCongregacao->nome_curto = $params['nome_curto'];
        $igrejaCongregacao->descricao = $params['descricao'];
        $igrejaCongregacao->logradouro = $params['logradouro'];
        $igrejaCongregacao->cep = $params['cep'];
        $igrejaCongregacao->nro = $params['nro'];
        $igrejaCongregacao->bairro = $params['bairro'];
        $igrejaCongregacao->cidade = $params['cidade'];
        $igrejaCongregacao->uf = $params['uf'];

        $igrejaCongregacao->save();
        return redirect('sede');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);
        $igrejaCongregacao->delete();
        return redirect('sede');
    }

    public function alocarDirigente($id)
    {
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);
        $membro = Membro::where('tp_membros', '<>', '8')->where('tp_membros', '<>', '9')->get();
        //$membro = DB::table('membros')->where('tp_membros', '<>', '8')->where('tp_membros', '<>', '9')->get();

        return view('sede/alocarDirigente', compact('igrejaCongregacao', 'membro'));
    }

    public function insertDirigente(Request $request, $id)
    {
        $igrejaCongregacao = Igreja_congregacao::findOrFail($id);
        $igrejaCongregacao->id_responsavel = $request->idresponsavel;
        $igrejaCongregacao->save();
        return redirect('sede');
    }
}
