<?php

namespace App;

use App\Scopes\TenantModels;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Entrada extends Model
{
    use TenantModels;

    public function dizimo(){
        return $this->belongsTo(Dizimo::class, 'id_dizimo');
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class, 'id_oferta');
    }

    public function igrejaCongregacao()
    {
        return $this->belongsTo(Igreja_congregacao::class,'id_congregacao');
    }


    public function relatorioTodasEntradas()
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada')
            ->orderBy('entradas.tp_entrada')
            ->get();

        return $entradas;
    }

    public function relatorioTodasEntradasPorCongregacao($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('igreja_congregacoes.id', '=', $data)
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioCongregacaoTipoEntrada($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->where('tipo_entradas.id', '=', $data['tp_entrada'])
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioCongregacaoTipoEntradaPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->where('tipo_entradas.id', '=', $data['tp_entrada'])
            ->whereBetween('entradas.dt_entrada', [$data['dt_inicial'], $data['dt_final']])
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioCongregacaoPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->whereBetween('entradas.dt_entrada', [$data['dt_inicial'], $data['dt_final']])
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioTipoEntrada($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('tipo_entradas.id', '=', $data)
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioTipoEntradaPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->where('tipo_entradas.id', '=', $data['tp_entrada'])
            ->whereBetween('entradas.dt_entrada', [$data['dt_inicial'], $data['dt_final']])
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }

    public function relatorioPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $entradas = DB::table('entradas')
            ->join('igreja_congregacoes', 'entradas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_entradas', 'entradas.tp_entrada', '=', 'tipo_entradas.id')
            ->select('entradas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_entradas.tipo')
            ->whereBetween('entradas.dt_entrada', [$data['dt_inicial'], $data['dt_final']])
            ->where('entradas.account_id', $accountId)
            ->orderBy('entradas.dt_entrada', 'desc')
            ->get();

        return $entradas;
    }
}
