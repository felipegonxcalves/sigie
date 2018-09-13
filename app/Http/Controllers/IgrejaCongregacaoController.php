<?php

namespace App\Http\Controllers;

use App\Igreja_congregacao;
use App\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class IgrejaCongregacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$membro = DB::table('membros')->where('tp_membros', '<>', '8')->where('tp_membros', '<>', '9')->get();
        return view('congregacoes.create', compact('membro'));
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
        $igrejaCongregacao->tp_igreja = 'c';
        //$igrejaCongregacao->id_responsavel = $params['responsavel'];
        //dd($params);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
/*
    public function associarResponsavel($id = 0)
    {
        //$igrejaCongregacao = Igreja_congregacao::paginate(15);
        $igrejaCongregacao = DB::table('igreja_congregacoes')->paginate(15);

        if ($id <> 0){
            $igrejaCongregacao = DB::table('igreja_congregacoes')->where('id', '=', $id)->first();
            $membro = DB::table('membros')->where('tp_membros', '<>', '8')->where('tp_membros', '<>', '9')->get();

            return view('congregacoes.formresponsavel', compact('membro', 'igrejaCongregacao'));
        }

        return view('congregacoes.associarresponsavel', compact('igrejaCongregacao'));
    }

    public function inserirResponsavel(Request $request)
    {
        if ($request->has('id_congregacao', 'responsavel')){
            $igrejaCongregacao = DB::table('igreja_congregacoes')
                ->where('id', '=', $request->id_congregacao)
                ->update(['id_responsavel' => $request->responsavel]);

            return redirect('/igreja-congregacao');
        }
    }

    public function search(Request $request, Igreja_congregacao $igreja_congregacao)
    {
        $param = $request->get('nome');
        $igrejaCongregacao = $igreja_congregacao->search($param);
        return view('congregacoes.associarresponsavel', compact('igrejaCongregacao'));
    }
*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
