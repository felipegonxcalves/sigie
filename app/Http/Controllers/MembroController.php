<?php

namespace App\Http\Controllers;

use App\Endereco_membro;
use App\Grupo;
use App\Igreja_congregacao;
use App\Membro;
use App\Membro_congregacoes;
use App\Membros_oficiais;
use App\Tipo_membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class MembroController extends Controller
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

        $igrejaCongregacoes = Igreja_congregacao::all();
        $membros = Membro::orderBy('nome')->paginate(10);
        return view('membro.index', compact('membros', 'igrejaCongregacoes'));
    }

    public function search(Request $request, Membro $membro)
    {
        $igrejaCongregacoes = Igreja_congregacao::all();

        $request = $request->except('_token');
        $membros = $membro->search($request);
        return view('membro.index', compact('membros', 'request', 'igrejaCongregacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $membroOficio = Membros_oficiais::orderBy('cargo_oficial')->get();
        $grupos = Grupo::all();
        $tipoMembros = Tipo_membro::all();
        $igrejaCongregacoes = Igreja_congregacao::all();
        //dd($tipoMembros);
        return view('membro.create', compact('tipoMembros', 'igrejaCongregacoes', 'grupos', 'membroOficio'));
    }

    public function verificaMatricula()
    {
        $matriculaMembro = Membro::where('matricula', \request('matricula'))->first();

        if (!empty($matriculaMembro->matricula)){
            echo "existe";
        }
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
        $membros = new Membro();
        $membros->matricula = $params['matricula'];
        $membros->nome = $params['nome'];
        $membros->sexo = $params['sexo'];
        $membros->dt_nascimento = $params['dt_nascimento'];
        $membros->flag_membro = $params['flag_membro'];
        $membros->igreja_anterior_it = $params['igreja_anterior_it'];
        $membros->nome_pastor_it = $params['nome_pastor_it'];
        $membros->tp_membros = $params['tp_membros'];
        $membros->telefone = $params['telefone'];
        $membros->celular = $params['celular'];
        $membros->situacao = $params['situacao'];
        $membros->id_congregacao = $params['membro_congregacao'];
        $membros->id_grupo = $params['id_grupo'];
        $membros->id_membro_oficio = $params['id_membro_oficio'];

        DB::beginTransaction();

        if ($membros->save()){

            $endereco_membros = new Endereco_membro();
            $endereco_membros->logradouro = $params['logradouro'];
            $endereco_membros->cep = $params['cep'];
            $endereco_membros->nro = $params['nro'];
            $endereco_membros->bairro = $params['bairro'];
            $endereco_membros->complemento = $params['complemento'];
            $endereco_membros->cidade = $params['cidade'];
            $endereco_membros->uf = $params['uf'];
            $endereco_membros->id_membro = $membros->id;
            $endereco_membros->save();
            DB::commit();

        }else{
            DB::rollback();
        }
        return redirect('membro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membros = Membro::where('id', '=', $id)->get();

        return view('membro.show', compact('membros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membroOficio = Membros_oficiais::orderBy('cargo_oficial')->get();
        $grupos = Grupo::all();
        $tipoMembros = Tipo_membro::all();
        $igrejaCongregacoes = Igreja_congregacao::all();
        $membros = DB::table('membros')
            ->join('tipo_membros', 'membros.tp_membros', '=', 'tipo_membros.id')
            ->join('igreja_congregacoes',  'membros.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('endereco_membros',  'membros.id', '=', 'endereco_membros.id_membro')
            ->where('membros.id', '=', $id)
            ->select('membros.*', 'membros.id as id_membro', 'igreja_congregacoes.*', 'igreja_congregacoes.id as id_igrejacongregacoes', 'tipo_membros.destipo', 'tipo_membros.id as id_tipomembros',
                'endereco_membros.id as id_endereco', 'endereco_membros.cep as cep_membro', 'endereco_membros.logradouro as log_membro',
                'endereco_membros.nro as nro_membro', 'endereco_membros.bairro as bairro_membro', 'endereco_membros.complemento as complemento_membro',
                'endereco_membros.cidade as cidade_membro', 'endereco_membros.uf as uf_membro')
            ->first();

        return view('membro.edit', compact('membros', 'tipoMembros', 'igrejaCongregacoes', 'grupos', 'membroOficio'));
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
        $membros = Membro::findOrFail($id);
        $membros->nome = $params['nome'];
        $membros->sexo = $params['sexo'];
        $membros->dt_nascimento = $params['dt_nascimento'];
        $membros->flag_membro = $params['flag_membro'];
        $membros->igreja_anterior_it = $params['igreja_anterior_it'];
        $membros->nome_pastor_it = $params['nome_pastor_it'];
        $membros->tp_membros = $params['tp_membros'];
        $membros->telefone = $params['telefone'];
        $membros->celular = $params['celular'];
        $membros->situacao = $params['situacao'];
        $membros->id_congregacao = $params['membro_congregacao'];
        $membros->id_grupo = $params['id_grupo'];
        $membros->id_membro_oficio = $params['id_membro_oficio'];

        DB::beginTransaction();

        if ($membros->save()){

            $endereco_membros = $membros->endereco_membro;
            $endereco_membros->logradouro = $params['logradouro'];
            $endereco_membros->cep = $params['cep'];
            $endereco_membros->nro = $params['nro'];
            $endereco_membros->bairro = $params['bairro'];
            $endereco_membros->complemento = $params['complemento'];
            $endereco_membros->cidade = $params['cidade'];
            $endereco_membros->uf = $params['uf'];
            $endereco_membros->id_membro = $membros->id;
            $endereco_membros->save();
            DB::commit();

        }else{
            DB::rollback();
        }

        return redirect('membro');

    }

    public function delete($id)
    {
        $membro = Membro::findOrFail($id);
        $membro->delete();
        return redirect('membro');
    }

    public function membrosOficiais()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        return view('membro/relatorioMembrosOficiais', compact('igrejaCongregacao'));
    }

    public function gerarRelatorioMembrosOficiais(Request $request)
    {
        if ($request->get('id_congregacao') == 'todas'){
            $sql = "SELECT m.nome,
                           mo.cargo_oficial,
                           ic.nome_igreja
                    FROM membros m, igreja_congregacoes ic, membros_oficiais mo
                    WHERE m.id_membro_oficio = mo.id
                    AND m.id_congregacao = ic.id
                    order by mo.cargo_oficial";
            $membrosOficiais = \DB::select($sql);

            return \PDF::loadView('membro.relMembrosOficiais', compact('membrosOficiais'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        else{

            //QUERY PARA BUSCAR POR CONGREGAÇÃO ESCOLHIDA
            $idCongregacao = $request->get('id_congregacao');
            $sql = "SELECT m.nome,
                           mo.cargo_oficial,
                           ic.nome_igreja
                    FROM membros m, igreja_congregacoes ic, membros_oficiais mo
                    WHERE m.id_membro_oficio = mo.id
                    AND m.id_congregacao = ic.id
                    AND m.id_congregacao = $idCongregacao
                    order by mo.cargo_oficial";
            $membrosOficiais = \DB::select($sql);

            return \PDF::loadView('membro.relMembrosOficiais', compact('membrosOficiais'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
    }

    public function relatorioMembros()
    {
        $igrejaCongregacao = Igreja_congregacao::orderBy('nome_igreja')->get();
        return view('membro.relatorioMembros', [
            'igrejaCongregacao' => $igrejaCongregacao
        ]);
    }

    public function gerarRelatorioLocalidade(Request $request)
    {
        if ($request->get('id_congregacao') == 'todas'){
            $membros = Membro::orderBy('id_congregacao')->orderBy('nome')->get();
            return \PDF::loadView('membro.relMembros', compact('membros'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }else{
            $membros = Membro::where('id_congregacao', $request->get('id_congregacao'))->orderBy('nome')->get();
            return \PDF::loadView('membro.relMembros', compact('membros'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }

    }

    public function historicoIndividualDizimo($id)
    {
        $membros = Membro::findOrFail($id);
        $dizimoDoMembro = $membros->dizimo()->paginate(10);
        return view('membro.historicoDizimoIndividual', compact('dizimoDoMembro'));
    }

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
