<?php

namespace App\Http\Controllers;

use App\Caixa;
use App\Dizimo;
use App\Entrada;
use App\Igreja_congregacao;
use App\Membro;
use App\Tipo_entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DizimosController extends Controller
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
        //Para listar no filtro de pesquisa
        $igrejaCongregacao = Igreja_congregacao::all();
        $dizimos = Dizimo::orderBy('dizimos.id', 'desc')->paginate(10);

        return view('dizimo/index', compact('dizimos', 'igrejaCongregacao'));
    }

    public function search(Request $request, Dizimo $dizimo)
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $request = $request->except('_token');
        $dizimos = $dizimo->search($request);


        return view('dizimo/index', compact('dizimos', 'request', 'igrejaCongregacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $membros = Membro::orderBy('nome')->get();
        $dizimos = Dizimo::orderBy('dizimos.id', 'desc')->limit(5)->get();

        return view('dizimo/create', compact('igrejaCongregacao', 'membros', 'dizimos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tpEntrada = Tipo_entrada::select('id')->where('tipo', 'DÍZIMO')->first();

        $dizimos = new Dizimo();
        $dizimos->id_congregacao = $request->id_congregacao;
        $dizimos->id_membro = $request->id_membro;
        $dizimos->dt_dizimo = $request->dt_dizimo;
        $dizimos->val_dizimo = valor($request->val_dizimo);
        DB::beginTransaction();

        if ($dizimos->save()){
            $entradas = new Entrada();
            $entradas->val_entrada = $dizimos->val_dizimo;
            $entradas->tp_entrada = $tpEntrada->id;
            $entradas->id_dizimo = $dizimos->id;
            $entradas->id_congregacao = $dizimos->id_congregacao;
            $entradas->dt_entrada = $dizimos->dt_dizimo;
            $entradas->save();

            DB::commit();
        }else{
            DB::rollback();
        }

        return redirect('dizimo/create');
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

        $dizimo = Dizimo::findOrFail($request->id_dizimo);
        $dizimo->val_dizimo = valor($request->val_dizimo);
        $dizimo->dt_dizimo = $request->dt_dizimo;

        DB::beginTransaction();
        if ($dizimo->save()){
            $entrada = $dizimo->entrada;
            $entrada->val_entrada = $dizimo->val_dizimo;
            $entrada->dt_entrada = $dizimo->dt_dizimo;
            $entrada->save();
            DB::commit();
        }else{
            DB::rollback();
        }

        if ($request->form == 'index'){
            return redirect('dizimo');
        }
        else if($request->form == 'create'){
            return redirect('dizimo/create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $dizimo = Dizimo::findOrFail($id);
        $dizimo->delete();
        return redirect('dizimo/create');
    }

    public function deleteindex($id)
    {
        $dizimo = Dizimo::findOrFail($id);
        $dizimo->delete();
        return redirect('dizimo');
    }


    public function relatorioDizimoPeriodo()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        return view('dizimo/relatorioDizimoPeriodo', compact('igrejaCongregacao'));
    }

    public function gerarRelatorio(Request $request, Dizimo $dizimo)
    {
        if ($request->get('id_congregacao') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $dizimos = $dizimo->relatorioTodosDizimos();
            $title = 'Relatório Todos os Dízimos';
            return \PDF::loadView('dizimo.relDizimos', compact('dizimos', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $dizimos = $dizimo->relatorioDizimoCongregacao($request->get('id_congregacao'));
            $title = 'Relatório de Dízimos';
            return \PDF::loadView('dizimo.relDizimos', compact('dizimos', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('dt_inicial') <> null  && $request->get('dt_final') <> null){
            $dizimos = $dizimo->relatorioDizimoPorPeriodo($request->all());
            $title = 'Relatório de Dízimos por Período';
            return \PDF::loadView('dizimo.relDizimos', compact('dizimos', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('dt_inicial') <> null  && $request->get('dt_final') <> null){
            $dizimos = $dizimo->relatorioDizimoCongregacaoPeriodo($request->all());
            $title = 'Relatório de Dízimos por Período';
            return \PDF::loadView('dizimo.relDizimos', compact('dizimos', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
    }

    public function destroy($id)
    {

    }
}
