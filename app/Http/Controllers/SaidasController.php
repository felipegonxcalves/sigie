<?php

namespace App\Http\Controllers;

use App\Igreja_congregacao;
use App\Saida;
use App\Tipo_saida;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class SaidasController extends Controller
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
        $saidas = Saida::orderBy('saidas.id', 'desc')->paginate(10);

        return view('saida/index', compact('igrejaCongregacao', 'saidas'));
    }

    public function search(Request $request, Saida $saida)
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $request = $request->except('_token');
        $saidas = $saida->search($request);

        return view('saida/index', compact('igrejaCongregacao', 'saidas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->orderBy('saidas.id', 'desc')
            ->limit(5)
            ->get();

        $igrejaCongregacao = Igreja_congregacao::all();
        $tipoSaidas = Tipo_saida::all();
        return view('saida/create', compact('tipoSaidas', 'igrejaCongregacao', 'saidas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saidas = new Saida();
        $saidas->tp_saida = $request->get('tp_saida');
        $saidas->descricao = $request->get('descricao');
        $saidas->id_congregacao = $request->get('id_congregacao');
        $saidas->val_saida = valor($request->get('val_saida'));
        $saidas->dt_saida = $request->get('dt_saida');
        $saidas->save();

        return redirect('saida/create');

    }

    public function comprovanteSaida($id)
    {

        $saida = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo', 'tipo_saidas.id as id_tp_saidas')
            ->where('saidas.id', '=', $id)
            ->first();
        return \PDF::loadView('saida.comprovante', compact('saida'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('comprovante.pdf');

        //$pdf = PDF::loadView('saida.comprovante', compact('saida'));
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
        //return $pdf->download('comprovante.pdf');
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
        $saida = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo', 'tipo_saidas.id as id_tp_saidas')
            ->where('saidas.id', '=', $id)
            ->first();

        $igrejaCongregacao = Igreja_congregacao::all();
        $tipoSaidas = Tipo_saida::all();

        return view('saida/edit', compact('saida', 'igrejaCongregacao', 'tipoSaidas'));
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
            $saida = Saida::findOrFail($request->get('id_saida'));
            $saida->descricao = $request->get('descricao');
            $saida->val_saida = valor($request->get('val_saida'));
            $saida->dt_saida = $request->get('dt_saida');
            $saida->save();

            return redirect('saida/create');
        }
        elseif ($request->get('form') == 'index'){
            $saida = Saida::findOrFail($id);
            $saida->tp_saida = $request->get('tp_saida');
            $saida->descricao = $request->get('descricao');
            $saida->id_congregacao = $request->get('id_congregacao');
            $saida->val_saida = valor($request->get('val_saida'));
            $saida->dt_saida = $request->get('dt_saida');
            $saida->save();

            return redirect('saida');
        }
    }

    public function delete($id)
    {
        $saida = Saida::findOrFail($id);
        $saida->delete();

        return redirect('saida/create');
    }

    public function deleteIndex($id)
    {
        $saida = Saida::findOrFail($id);
        $saida->delete();

        return redirect('saida');
    }

    public function relatorioSaida()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $tipoSaidas = Tipo_saida::all();
        return view('saida.relatorioSaida', compact('igrejaCongregacao', 'tipoSaidas'));
    }

    public function gerarRelatorioSaida(Request $request, Saida $saida)
    {
        if ($request->get('id_congregacao') == null && $request->get('tp_saida') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $saidas = $saida->relatorioTodasSaidas();
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_saida') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $saidas = $saida->relatorioTodasSaidasPorCongregacao($request->get('id_congregacao'));
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_saida') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $saidas = $saida->relatorioCongregacaoTipoSaida($request->all());
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_saida') <> null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $saidas = $saida->relatorioCongregacaoTipoSaidaPeriodo($request->all());
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('tp_saida') == null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $saidas = $saida->relatorioCongregacaoPeriodo($request->all());
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_saida') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $saidas = $saida->relatorioTipoSaida($request->get('tp_saida'));
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_saida') <> null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $saidas = $saida->relatorioTipoSaidaPeriodo($request->all());
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('tp_saida') == null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $saidas = $saida->relatorioPeriodo($request->all());
            return \PDF::loadView('saida.relSaidas', compact('saidas'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
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
