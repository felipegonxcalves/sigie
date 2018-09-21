<?php

namespace App\Http\Controllers;

use App\Entrada;
use App\Igreja_congregacao;
use App\Saida;
use App\Tipo_entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EntradasController extends Controller
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
        $igrejaCongregacao = Igreja_congregacao::all();
        $entradas = Entrada::where('tp_entrada', '<>', '1')
                            ->where('tp_entrada', '<>', '2')
                            ->orderBy('entradas.id', 'desc')
                            ->paginate(10);

        return view('entrada/index', compact('entradas', 'igrejaCongregacao'));
    }

    public function search(Request $request, Entrada $entrada)
    {

        $igrejaCongregacao = Igreja_congregacao::all();
        $request = $request->except('_token');

        $entradas = Entrada::when($request['id_congregacao'], function ($query) use ($request){
            $query->where('id_congregacao', $request['id_congregacao'])->where('tp_entrada', '<>', '1')->where('tp_entrada', '<>', '2');
        })->paginate(10);

        return view('entrada/index', compact('igrejaCongregacao', 'entradas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tpDizimo = Tipo_entrada::select('id')->where('tipo', 'DÍZIMO')->first();
        $tpOferta = Tipo_entrada::select('id')->where('tipo', 'OFERTA')->first();

        $entradas = Entrada::orderBy('dt_entrada', 'desc')
                            ->where('tp_entrada', '<>', $tpDizimo->id)
                            ->where('tp_entrada', '<>', $tpOferta->id)
                            ->limit(5)
                            ->get();
        $igrejaCongregacao = Igreja_congregacao::all();
        $tipoEntrada = DB::table('tipo_entradas')->where('id', '<>', $tpDizimo->id)->where('id', '<>', $tpOferta->id)->get();
        return view('entrada/create', compact('tipoEntrada', 'igrejaCongregacao', 'entradas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradas = new Entrada();
        $entradas->val_entrada = valor($request->get('val_entrada'));
        $entradas->tp_entrada = $request->get('tp_entrada');
        $entradas->descricao = $request->get('descricao');
        $entradas->id_congregacao = $request->get('id_congregacao');
        $entradas->dt_entrada = $request->get('dt_entrada');
        $entradas->save();

        return redirect('entrada/create');
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
        $tipoEntrada = DB::table('tipo_entradas')->where('id', '<>', '1')->where('id', '<>', '2')->get();
        $igrejaCongregacao = Igreja_congregacao::all();
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja')
            ->where('entradas.id', '=', $id)
            ->first();

        return view('entrada/edit', compact('entradas', 'igrejaCongregacao', 'tipoEntrada'));
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

        if ($request->get('form') == 'create'){
            $entrada = Entrada::findOrFail($request->get('id_entrada'));
            $entrada->descricao = $request->get('descricao');
            $entrada->val_entrada = valor($request->get('val_entrada'));
            $entrada->dt_entrada = $request->get('dt_entrada');
            $entrada->save();

            return redirect('entrada/create');
        }
        elseif ($request->get('form') == 'index'){
            $entrada = Entrada::findOrFail($id);
            $entrada->tp_entrada = $request->get('tp_entrada');
            $entrada->descricao = $request->get('descricao');
            $entrada->id_congregacao = $request->get('id_congregacao');
            $entrada->val_entrada = valor($request->get('val_entrada'));
            $entrada->dt_entrada = $request->get('dt_entrada');
            $entrada->save();

            return redirect('entrada');
        }
    }

    public function delete($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return redirect('entrada/create');
    }

    public function deleteIndex($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return redirect('entrada');
    }

    public function relatorioEntrada()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $tipoEntrada = Tipo_entrada::all();
        return view('entrada.relatorioEntrada', compact('tipoEntrada', 'igrejaCongregacao'));
    }

    public function gerarRelatorioEntrada(Request $request, Entrada $entrada)
    {

        if ($request->get('id_congregacao') == null && $request->get('tp_entrada') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $entradas = $entrada->relatorioTodasEntradas();
            $title = 'Relátorio de Todas Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_entrada') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $entradas = $entrada->relatorioTodasEntradasPorCongregacao($request->get('id_congregacao'));
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_entrada') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $entradas = $entrada->relatorioCongregacaoTipoEntrada($request->all());
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_entrada') <> null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $entradas = $entrada->relatorioCongregacaoTipoEntradaPeriodo($request->all());
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_entrada') == null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $entradas = $entrada->relatorioCongregacaoPeriodo($request->all());
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_entrada') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $entradas = $entrada->relatorioTipoEntrada($request->get('tp_entrada'));
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas' , 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_entrada') <> null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $entradas = $entrada->relatorioTipoEntradaPeriodo($request->all());
            $title = 'Relátorio de Entradas por Período';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_entrada') == null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $entradas = $entrada->relatorioPeriodo($request->all());
            $title = 'Relátorio de Entradas';
            return \PDF::loadView('entrada.relEntradas', compact('entradas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
    }

    public function relatorioGeral()
    {
        return view('entrada.relatorioGeral');
    }

    public function gerarRelatorioGeral(Request $request)
    {
        $accountId = \Auth::user()->account_id;
        if ($request->get('dt_inicial') == null || $request->get('dt_final') == null){
            $sqlEntradas = "select ic.nome_igreja,
                                   e.dt_entrada,
                                   tp.tipo,		 
                                   e.val_entrada as valorEntrada
                        from entradas e, igreja_congregacoes ic, tipo_entradas tp
                        where e.id_congregacao = ic.id
                        and e.tp_entrada = tp.id
                        and e.account_id = $accountId
                        order by ic.nome_igreja, e.dt_entrada";

            $sqlSaidas = "select ic.nome_igreja,
                                 s.descricao,
                                 s.dt_saida,
                                 ts.tipo,
                                 s.val_saida as totalSaida
                      from saidas s, igreja_congregacoes ic, tipo_saidas ts
                      where s.id_congregacao = ic.id
                      and s.tp_saida = ts.id
                      and s.account_id = $accountId
                      order by ic.nome_igreja, s.dt_saida";
        }else{
            $dataInicial = $request->get('dt_inicial');
            $dataFinal = $request->get('dt_final');

            $sqlEntradas = "select ic.nome_igreja,
                               	   e.dt_entrada,
                                   tp.tipo,
                                   e.val_entrada as valorEntrada
                        from entradas e, igreja_congregacoes ic, tipo_entradas tp
                        where e.id_congregacao = ic.id
                        and e.tp_entrada = tp.id
                        and e.dt_entrada between '$dataInicial' and '$dataFinal'
                        and e.account_id = $accountId
                        order by ic.nome_igreja, e.dt_entrada";

            $sqlSaidas = "select ic.nome_igreja,
                                 s.descricao,
                                 s.dt_saida,
                                 ts.tipo,
                                 s.val_saida as totalSaida
                      from saidas s, igreja_congregacoes ic, tipo_saidas ts
                      where s.id_congregacao = ic.id
                      and s.tp_saida = ts.id
                      and s.dt_saida between '$dataInicial' and '$dataFinal'                      
                      and s.account_id = $accountId
                      order by ic.nome_igreja, s.dt_saida";
        }


        $entradas = \DB::select($sqlEntradas);
        $saidas = \DB::select($sqlSaidas);
        return \PDF::loadView('entrada.relRelatorioGeral', compact('igrejaCongregacao', 'entradas', 'saidas'))
            ->setPaper('a4', 'landscape')
            ->stream('Relatório.pdf');
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
