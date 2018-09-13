<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Igreja_congregacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GruposController extends Controller
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
        $grupos = Grupo::orderBy('nome_grupo')->paginate(10);
        return view('grupo/index', compact('grupos'));
    }

    public function filtroGrupo($id)
    {
        $grupo = Grupo::findOrFail($id);
        $igrejaCongregacao = Igreja_congregacao::all();
        return view('grupo/filtroGrupos', compact('igrejaCongregacao', 'grupo'));
    }

    public function gerarListaComponentesGrupo(Request $request)
    {
        $idGrupo = $request->get('id_grupo');
        $idCongregacao = $request->get('id_congregacao');
        $sql = "select m.nome, ic.nome_igreja, g.nome_grupo
                    from membros m, igreja_congregacoes ic, grupos g
                    where m.id_congregacao = ic.id
                    and m.id_grupo = g.id
                    and g.id = $idGrupo
                    and ic.id = $idCongregacao
                    order By m.nome";
        $componentes = \DB::select($sql);


        return \PDF::loadView('grupo.relComponentesGrupo', compact('componentes'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('Relatório.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupos = new Grupo();

        $grupos->nome_grupo = strtoupper($request->get('nome_grupo'));
        $grupos->save();
        return redirect('grupo');

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
        $grupo = Grupo::findOrFail($request->get('id_grupo'));
        $grupo->nome_grupo = strtoupper($request->get('nome_grupo'));
        $grupo->save();
        return redirect('grupo');
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
