<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dizimo extends Model
{
    use TenantModels;
    //
    public function entrada(){
        return $this->hasOne(Entrada::class,'id_dizimo');
    }

    public function membro()
    {
        return $this->belongsTo(Membro::class, 'id_membro');
    }

    public function igrejaCongregacao()
    {
        return $this->belongsTo(Igreja_congregacao::class, 'id_congregacao');
    }

    //MÉTODO DE FILTRO PARA FILTRAR PELO NOME
    public function search($request)
    {
        //$query->whereHas('igreja_congregacoes', 'igreja_congregacoes', '%'.$request['nome'].'%');
        $dizimos = $this->where(function ($query) use ($request){
            if (isset($request['nome']) && $request['nome'] <> null){
                //NOME DA RELAÇÃO E DEPOIS O NOME DO CAMPO , OPERADOR E PARÂMETRO
                $query->whereHas('membro', function ($query) use ($request){
                    $query->where('nome', 'LIKE', '%'.$request['nome'].'%');
                });
            }
            if (isset($request['id_congregacao']) && $request['id_congregacao'] <> null){
                $query->where('id_congregacao', $request['id_congregacao']);
            }
        })
        ->paginate(10);

        return $dizimos;
    }

    public function relatorioTodosDizimos()
    {
        $accountId = \Auth::user()->account_id;
        $dizimos = DB::table('dizimos')
            ->join('igreja_congregacoes', 'dizimos.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('membros', 'dizimos.id_membro', '=', 'membros.id')
            ->select('membros.nome', 'dizimos.val_dizimo','dizimos.id', 'dizimos.dt_dizimo', 'igreja_congregacoes.nome_igreja')
            ->where('dizimos.account_id', $accountId)
            ->orderBy('dizimos.dt_dizimo', 'desc')
            ->get();

        return $dizimos;
    }

    public function relatorioDizimoCongregacao($data)
    {
        $accountId = \Auth::user()->account_id;
        $dizimos = DB::table('dizimos')
            ->join('igreja_congregacoes', 'dizimos.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('membros', 'dizimos.id_membro', '=', 'membros.id')
            ->select('membros.nome', 'dizimos.val_dizimo','dizimos.id', 'dizimos.dt_dizimo', 'igreja_congregacoes.nome_igreja')
            ->where('igreja_congregacoes.id', '=', $data)
            ->where('dizimos.account_id', $accountId)
            ->orderBy('dizimos.dt_dizimo', 'desc')
            ->get();

        return $dizimos;
    }

    public function relatorioDizimoPorPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $dizimos = DB::table('dizimos')
            ->join('igreja_congregacoes', 'dizimos.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('membros', 'dizimos.id_membro', '=', 'membros.id')
            ->select('membros.nome', 'dizimos.val_dizimo','dizimos.id', 'dizimos.dt_dizimo', 'igreja_congregacoes.nome_igreja')
            ->whereBetween('dizimos.dt_dizimo', [$data['dt_inicial'], $data['dt_final']])
            ->where('dizimos.account_id', $accountId)
            ->orderBy('dizimos.dt_dizimo', 'desc')
            ->get();

        return $dizimos;
    }

    public function relatorioDizimoCongregacaoPeriodo($data)
    {
        $accountId = \Auth::user()->account_id;
        $dizimos = DB::table('dizimos')
            ->join('igreja_congregacoes', 'dizimos.id_congregacao', '=', 'igreja_congregacoes.id')
            ->join('membros', 'dizimos.id_membro', '=', 'membros.id')
            ->select('membros.nome', 'dizimos.val_dizimo','dizimos.id', 'dizimos.dt_dizimo', 'igreja_congregacoes.nome_igreja')
            ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
            ->whereBetween('dizimos.dt_dizimo', [$data['dt_inicial'], $data['dt_final']])
            ->where('dizimos.account_id', $accountId)
            ->orderBy('dizimos.dt_dizimo', 'desc')
            ->get();

        return $dizimos;
    }
}
