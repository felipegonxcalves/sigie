<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Oferta extends Model
{
    use TenantModels;

    public function entrada(){
        return $this->hasOne(Entrada::class,'id_oferta');
    }

    public function igrejaCongregacao()
    {
        return $this->belongsTo(Igreja_congregacao::class, 'id_congregacao');
    }

    public function search($request)
    {
        $ofertas = $this->where(function ($query) use ($request){
            if (isset($request['id_congregacao']) && $request['id_congregacao'] <> null){
                $query->where('id_congregacao', $request['id_congregacao']);
            }
        })
        ->paginate(10);

        return $ofertas;
    }

    public function relatorioTodasOfertas()
    {
        $accountId = \Auth::user()->account_id;
        $ofertas = DB::table('ofertas')
            ->join('igreja_congregacoes', 'ofertas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->select('ofertas.val_oferta','ofertas.id', 'ofertas.dt_oferta', 'igreja_congregacoes.nome_igreja')
            ->where('ofertas.account_id', $accountId)
            ->orderBy('ofertas.id', 'desc')
            ->get();

        return $ofertas;
    }

    public function relatorioOfertaCongregacao($data)
    {
        $accountId = \Auth::user()->account_id;
        $ofertas = DB::table('ofertas')
            ->join('igreja_congregacoes', 'ofertas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->select('ofertas.val_oferta','ofertas.id', 'ofertas.dt_oferta', 'igreja_congregacoes.nome_igreja')
            ->where('igreja_congregacoes.id', '=', $data)
            ->where('ofertas.account_id', $accountId)
            ->orderBy('ofertas.id', 'desc')
            ->get();

        return $ofertas;
    }

    public function relatorioOfertaCongregacaoPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $ofertas = DB::table('ofertas')
            ->join('igreja_congregacoes', 'ofertas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->select('ofertas.val_oferta','ofertas.id', 'ofertas.dt_oferta', 'igreja_congregacoes.nome_igreja')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->whereBetween('ofertas.dt_oferta', [$data['dt_inicial'], $data['dt_final']])
            ->where('ofertas.account_id', $accountId)
            ->orderBy('ofertas.id', 'desc')
            ->get();

        return $ofertas;
    }

    public function relatorioOfertaPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $ofertas = DB::table('ofertas')
            ->join('igreja_congregacoes', 'ofertas.id_congregacao', '=', 'igreja_congregacoes.id')
            ->select('ofertas.val_oferta','ofertas.id', 'ofertas.dt_oferta', 'igreja_congregacoes.nome_igreja')
            ->whereBetween('ofertas.dt_oferta', [$data['dt_inicial'], $data['dt_final']])
            ->where('ofertas.account_id', $accountId)
            ->orderBy('ofertas.dt_oferta', 'desc')
            ->get();

        return $ofertas;
    }
}
