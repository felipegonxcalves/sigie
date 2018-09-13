<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class Saida extends Model
{
    use TenantModels;

    public function igrejaCongregacao()
    {
        return $this->belongsTo(Igreja_congregacao::class, 'id_congregacao');
    }

    public function tipoSaida()
    {
        return $this->belongsTo(Tipo_saida::class, 'tp_saida');
    }

    // MÉTODO DE FILTRO PARA FILTRAR PELA CONGREGAÇÃO
    public function search(Array $request)
    {
        $saidas = $this->where(function ($query) use ($request){
            if (isset($request['id_congregacao']) <> null){
                $query->where('id_congregacao', $request['id_congregacao']);
            }
            if (isset($request['dt_inicial']) && $request['dt_inicial'] <> null && isset($request['id_congregacao']) && $request['id_congregacao'] <> null){
                $query->where('id_congregacao', $request['id_congregacao'])->whereBetween('dt_saida', [$request['dt_inicial'], $request['dt_final']]);
            }
            if (isset($request['dt_inicial']) && $request['dt_inicial'] <> null){
                $query->whereBetween('dt_saida', [$request['dt_inicial'], $request['dt_final']]);
            }
        })
        ->paginate(8);
        return $saidas;
    }

    public function relatorioTodasSaidas()
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioTodasSaidasPorCongregacao($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('igreja_congregacoes.id', '=', $data)
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioCongregacaoTipoSaida($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->where('tipo_saidas.id', '=', $data['tp_saida'])
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioCongregacaoTipoSaidaPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->where('tipo_saidas.id', '=', $data['tp_saida'])
            ->whereBetween('saidas.dt_saida', [$data['dt_inicial'], $data['dt_final']])
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioCongregacaoPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->whereBetween('saidas.dt_saida', [$data['dt_inicial'], $data['dt_final']])
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioTipoSaida($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('tipo_saidas.id', '=', $data)
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioTipoSaidaPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->where('tipo_saidas.id', '=', $data['tp_saida'])
            ->whereBetween('saidas.dt_saida', [$data['dt_inicial'], $data['dt_final']])
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

    public function relatorioPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $saidas = DB::table('saidas')
            ->join('igreja_congregacoes', 'saidas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('tipo_saidas', 'saidas.tp_saida', '=', 'tipo_saidas.id')
            ->select('saidas.*','igreja_congregacoes.nome_igreja', 'igreja_congregacoes.id as id_igreja', 'tipo_saidas.tipo')
            ->whereBetween('saidas.dt_saida', [$data['dt_inicial'], $data['dt_final']])
            ->where('saidas.account_id', $accountId)
            ->orderBy('saidas.dt_saida', 'desc')
            ->get();

        return $saidas;
    }

}
