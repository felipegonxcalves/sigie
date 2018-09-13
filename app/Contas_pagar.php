<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contas_pagar extends Model
{
    use TenantModels;
    protected $table = 'contas_pagar';

    public function igrejaCongregacao()
    {
        return $this->belongsTo(Igreja_congregacao::class, 'id_congregacao');
    }

    public function search(Array $data)
    {
        $contasPagar = $this->where(function ($query) use($data){
            if (!isset($data['id_congregacao']) && $data['status_conta'] <> 'vencida'){
                $query->where('status_conta', '=', $data['status_conta']);
            }
            elseif (isset($data['id_congregacao']) <> null && !isset($data['status_conta'])){
                $query->where('id_congregacao', '=', $data['id_congregacao']);
            }
            elseif(isset($data['id_congregacao']) <> null && $data['status_conta'] <> null){
                $query->where('id_congregacao', '=', $data['id_congregacao'])->where('status_conta', '=', $data['status_conta']);
            }
            elseif (isset($data['status_conta']) == 'vencida'){
                $query->where('dt_vencimento', '<', date('Y-m-d ' ))->where('status_conta', '<>', 'Pago');
            }

        })->paginate(8);

        return $contasPagar;
    }

    public function filtroPesquisa($data)
    {
        if ($data['id_congregacao'] == null && $data['status_conta'] <> 'vencida'){
            $contasPagar = Contas_pagar::where('status_conta', '=', $data['status_conta'])->paginate(2);
            //$contasPagar = DB::table('contas_pagar')
            //    ->join('igreja_congregacoes', 'contas_pagar.id_congregacao' , '=', 'igreja_congregacoes.id')
            //    ->select('contas_pagar.*', 'igreja_congregacoes.nome_igreja')
            //    ->where('contas_pagar.status_conta', '=', $data['status_conta'])
            //    ->orderBy('contas_pagar.id', 'desc')
            //    ->paginate(2);

            return $contasPagar;
        }
        elseif ($data['id_congregacao'] <> null && $data['status_conta'] <> 'vencida'){
            $contasPagar = DB::table('contas_pagar')
                ->join('igreja_congregacoes', 'contas_pagar.id_congregacao' , '=', 'igreja_congregacoes.id')
                ->select('contas_pagar.*', 'igreja_congregacoes.nome_igreja')
                ->where('contas_pagar.status_conta', '=', $data['status_conta'])
                ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
                ->orderBy('contas_pagar.id', 'desc')
                ->paginate(8);

            return $contasPagar;
        }
        elseif ($data['id_congregacao'] == null && $data['status_conta'] == 'vencida'){
            $contasPagar = DB::table('contas_pagar')
                ->join('igreja_congregacoes', 'contas_pagar.id_congregacao' , '=', 'igreja_congregacoes.id')
                ->select('contas_pagar.*', 'igreja_congregacoes.nome_igreja')
                ->where('contas_pagar.dt_vencimento', '<', date('y/m/d'))
                ->orderBy('contas_pagar.id', 'desc')
                ->paginate(8);

            return $contasPagar;
        }
        elseif ($data['id_congregacao'] <> null && $data['status_conta'] == 'vencida'){
            $contasPagar = DB::table('contas_pagar')
                ->join('igreja_congregacoes', 'contas_pagar.id_congregacao' , '=', 'igreja_congregacoes.id')
                ->select('contas_pagar.*', 'igreja_congregacoes.nome_igreja')
                ->where('contas_pagar.dt_vencimento', '<', date('y/m/d'))
                ->where('igreja_congregacoes.id', '=', $data['id_congregacao'])
                ->orderBy('contas_pagar.id', 'desc')
                ->paginate(8);

            return $contasPagar;
        }
    }

}
