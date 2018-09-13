<?php

namespace App\Http\Controllers;

use App\Bens_alocado_congregacao;
use App\Bens_igreja;
use App\Igreja_congregacao;
use Illuminate\Http\Request;

class Bens_igrejaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bensIgreja = Bens_igreja::orderBy('nome_item')->paginate(8);
        return view('bens-igreja/index', compact('bensIgreja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bens-igreja/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bensIgreja = new Bens_igreja();
        $bensIgreja->nome_item = strtoupper($request->get('nome_item'));
        $bensIgreja->marca_item = strtoupper($request->get('marca_item'));
        $bensIgreja->save();

        return redirect('bens-igreja');
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
        $bensIgreja = Bens_igreja::findOrFail($request->get('id_bens'));
        $bensIgreja->nome_item = strtoupper($request->get('nome_item'));
        $bensIgreja->marca_item = strtoupper($request->get('marca_item'));
        $bensIgreja->save();

        return redirect('bens-igreja');
    }

    public function delete($id)
    {
        $bensIgreja = Bens_igreja::findOrFail($id);
        $bensIgreja->delete();

        return redirect('bens-igreja');
    }

    public function alocarBensIgreja()
    {
        $igrejaCongregacao = Igreja_congregacao::orderBy('nome_igreja')->get();
        $bensIgreja = Bens_igreja::orderBy('nome_item')->get();
        return view('bens-igreja/alocarBensIgreja', compact('igrejaCongregacao', 'bensIgreja'));
    }

    public function insertBensIgreja(Request $request)
    {
        //Faço uma query pra saber se esse bem já exista para essa congregação
        $bensAlocadoExistente = Bens_alocado_congregacao::where('id_congregacao', '=', $request->get('id_congregacao'))
                                                        ->where('id_item', '=', $request->get('id_item'))
                                                        ->first();
        //SE EXISTIR EU VOU APENAS DA UM UPDATE NA QUANTIDA DO ITEM NA TABELA
        if ($bensAlocadoExistente){
            $bensAlocadoExistente->qtd_item = $bensAlocadoExistente->qtd_item + $request->get('qtd_item');
            $bensAlocadoExistente->save();

            return redirect('alocar-bens-igreja')->withSuccess('Item adicionado com sucesso!');
        }
        else{
            $bensAlocadoCongregacao = new Bens_alocado_congregacao();
            $bensAlocadoCongregacao->id_congregacao = $request->get('id_congregacao');
            $bensAlocadoCongregacao->id_item = $request->get('id_item');
            $bensAlocadoCongregacao->qtd_item = $request->get('qtd_item');
            $bensAlocadoCongregacao->save();

            return redirect('alocar-bens-igreja')->withSuccess('Item adicionado com sucesso!');
        }
    }

    public function listarBens()
    {
        $igrejaCongregacao = Igreja_congregacao::orderBy('nome_igreja')->get();
        return view('bens-igreja/listagemBensIgreja', compact('igrejaCongregacao'));
    }

    public function gerarRelatorioListagemBens(Request $request)
    {
        if ($request->get('id_congregacao') == 'todas'){
            $sql = "SELECT ic.nome_igreja,
                           bi.nome_item,
                           bi.marca_item,
                           bac.qtd_item                           
                    FROM bens_alocado_congregacao bac, igreja_congregacoes ic, bens_igrejas bi
                    WHERE bac.id_congregacao = ic.id
                    AND bac.id_item = bi.id
                    ORDER BY ic.nome_igreja";

            $bensCongregacao = \DB::select($sql);
            return \PDF::loadView('bens-igreja.relListagemBens', compact('bensCongregacao'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('Relatório.pdf');
        }else{
            $idCongregacao = $request->get('id_congregacao');
            $sql = "SELECT ic.nome_igreja,
                           bi.nome_item,
                           bi.marca_item,
                           bac.qtd_item                           
                    FROM bens_alocado_congregacao bac, igreja_congregacoes ic, bens_igrejas bi
                    WHERE bac.id_congregacao = ic.id
                    AND bac.id_item = bi.id
                    AND ic.id = $idCongregacao
                    ORDER BY ic.nome_igreja";

            $bensCongregacao = \DB::select($sql);
            return \PDF::loadView('bens-igreja.relListagemBens', compact('bensCongregacao'))
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
