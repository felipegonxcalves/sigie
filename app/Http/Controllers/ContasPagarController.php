<?php

namespace App\Http\Controllers;

use App\Contas_pagar;
use App\Igreja_congregacao;
use App\Saida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class ContasPagarController extends Controller
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
        $igrejaCongregacao = Igreja_congregacao::all();
        $contasPagar = Contas_pagar::orderBy('id', 'desc')->paginate(10);

        return view('contaspagar/index', compact('igrejaCongregacao', 'contasPagar'));
    }

    public function search(Contas_pagar $contas_pagar, Request $request)
    {
        $igrejaCongregacao = Igreja_congregacao::all();
        $param = $request->except('_token');
        $contasPagar = $contas_pagar->search($param);        

        return view('contaspagar/index', compact('igrejaCongregacao', 'contasPagar', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contasPagar = Contas_pagar::orderBy('id', 'desc')->limit(5)->get();

        $igrejaCongregacao = Igreja_congregacao::all();
        return view('contaspagar/create', compact('igrejaCongregacao', 'contasPagar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contasPagar = new Contas_pagar();
        $contasPagar->descricao = $request->get('descricao');
        $contasPagar->id_congregacao = $request->get('id_congregacao');
        $contasPagar->val_pagar = valor($request->get('val_pagar'));
        $contasPagar->dt_vencimento = $request->get('dt_vencimento');
        $contasPagar->status_conta = "Em aberto";
        $contasPagar->save();

        return redirect('contas-pagar/create');

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
        $igrejaCongregacao = Igreja_congregacao::all();
        $contasPagar = DB::table('contas_pagar')
            ->join('igreja_congregacoes', 'contas_pagar.id_congregacao' , '=', 'igreja_congregacoes.id')
            ->select('contas_pagar.*', 'igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja')
            ->where('contas_pagar.id', '=', $id)
            ->first();

        return view('contaspagar.edit', compact('igrejaCongregacao', 'contasPagar'));
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
            $contasPagar = Contas_pagar::findOrFail($request->get('id_contaspagar'));
            $contasPagar->descricao = $request->get('descricao');
            $contasPagar->val_pagar = valor($request->get('val_pagar'));
            $contasPagar->dt_vencimento = $request->get('dt_vencimento');
            $contasPagar->save();
            return redirect('contas-pagar/create');
        }
        elseif ($request->get('form') == 'index'){
            $contasPagar = Contas_pagar::findOrFail($id);
            $contasPagar->descricao = $request->get('descricao');
            $contasPagar->id_congregacao = $request->get('id_congregacao');
            $contasPagar->val_pagar = valor($request->get('val_pagar'));
            $contasPagar->dt_vencimento = $request->get('dt_vencimento');
            $contasPagar->save();
            return redirect('contas-pagar');
        }
    }

    public function delete($id)
    {
        $contasPagar = Contas_pagar::findOrFail($id);
        $contasPagar->delete();
        return redirect('contas-pagar/create');
    }

    public function deleteIndex($id)
    {
        $contasPagar = Contas_pagar::findOrFail($id);
        $contasPagar->delete();
        return redirect('contas-pagar');
    }

    public function pagarConta($id)
    {
        $contasPagar = Contas_pagar::findOrFail($id);
        $contasPagar->status_conta = 'Pago';
        $contasPagar->save();
        return redirect('contas-pagar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
