<?php

namespace App\Http\Controllers;

use App\Caixa;
use App\Entrada;
use App\Igreja_congregacao;
use App\Oferta;
use App\Tipo_entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;
use function Sodium\compare;

class OfertasController extends Controller
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
        $ofertas = Oferta::orderBy('ofertas.id', 'desc')->paginate(15);

        return view('oferta/index', compact('ofertas', 'igrejaCongregacao'));
    }

    public function search(Request $request, Oferta $oferta)
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $request = $request->except('_token');
        $ofertas = $oferta->search($request);

        return view('oferta/index', compact('ofertas', 'igrejaCongregacao', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $ofertas = Oferta::orderBy('ofertas.id', 'desc')->limit(5)->get();

        return view('oferta/create', compact('igrejaCongregacao', 'ofertas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tpEntrada = Tipo_entrada::select('id')->where('tipo', 'OFERTA')->first();

        $oferta = new Oferta();
        $oferta->id_congregacao = $request->id_congregacao;
        $oferta->dt_oferta = $request->dt_oferta;
        $oferta->val_oferta = valor($request->val_oferta);
        $oferta->descricao = $request->descricao;
        DB::beginTransaction();
        if ($oferta->save()){
            $entrada = new Entrada();
            $entrada->val_entrada = $oferta->val_oferta;
            $entrada->tp_entrada = $tpEntrada->id;
            $entrada->id_congregacao = $oferta->id_congregacao;
            $entrada->id_oferta = $oferta->id;
            $entrada->dt_entrada = $oferta->dt_oferta;
            $entrada->save();

            DB::commit();
        }else{
            DB::rollback();
        }

        return redirect('oferta/create');
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
        $oferta = Oferta::findOrFail($request->id_oferta);
        $oferta->val_oferta = valor($request->val_oferta);
        $oferta->dt_oferta = $request->dt_oferta;
        DB::beginTransaction();
        if ($oferta->save()){
            $entrada = $oferta->entrada;
            $entrada->val_entrada = $oferta->val_oferta;
            $entrada->dt_entrada = $oferta->dt_oferta;
            $entrada->save();
            DB::commit();
        }else{
            DB::rollback();
        }

        if ($request->form == 'index'){
            return redirect('oferta');
        }
        else if($request->form == 'create'){
            return redirect('oferta/create');
        }
    }

    public function delete($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->delete();
        return redirect('oferta/create');
    }

    public function deleteIndex($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->delete();
        return redirect('oferta');
    }

    public function relatorioOferta()
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        return view('oferta/relatorioOferta', compact('igrejaCongregacao'));
    }

    public function gerarRelatorio(Request $request, Oferta $oferta)
    {
        if ($request->get('id_congregacao') == null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $ofertas = $oferta->relatorioTodasOfertas();
            $title = 'Relatório Todas Ofertas';
            return \PDF::loadView('oferta.relOfertas', compact('ofertas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('dt_inicial') == null && $request->get('dt_final') == null){
            $ofertas = $oferta->relatorioOfertaCongregacao($request->get('id_congregacao'));
            $title = 'Relatório de Ofertas';
            return \PDF::loadView('oferta.relOfertas', compact('ofertas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') <> null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $ofertas = $oferta->relatorioOfertaCongregacaoPeriodo($request->all());
            $title = 'Relatório de Ofertas por Período';
            return \PDF::loadView('oferta.relOfertas', compact('ofertas', 'title'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }
        elseif ($request->get('id_congregacao') == null && $request->get('dt_inicial') <> null && $request->get('dt_final') <> null){
            $ofertas = $oferta->relatorioOfertaPeriodo($request->all());
            $title = 'Relatório de Ofertas por Período';
            return \PDF::loadView('oferta.relOfertas', compact('ofertas', 'title'))
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
