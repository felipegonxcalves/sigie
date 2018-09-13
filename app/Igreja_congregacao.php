<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class Igreja_congregacao extends Model
{
    use TenantModels;
    protected $table = "igreja_congregacoes";


    public function search($data)
    {
        $congragacao = Igreja_congregacao::where('nome_igreja', 'LIKE', '%'.$data['nome'].'%')->paginate(1);
        //$congragacao = DB::table('igreja_congregacoes')->where('nome_igreja', 'LIKE', '%'.$data.'%')->paginate();
        return $congragacao;
    }

    public function contas_pagar(){
        return $this->hasMany(Contas_pagar::class, 'id_congregacao');
    }

    public function membro()
    {
        return $this->belongsTo(Membro::class, 'id_responsavel');
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'id_congregacao');
    }


}
