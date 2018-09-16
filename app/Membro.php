<?php

namespace App;

use App\Scopes\TenantModels;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Membro extends Model
{
    use TenantModels;

    public function endereco_membro(){
        return $this->hasOne(Endereco_membro::class,'id_membro');
    }

    public function membros_oficiais(){
        return $this->belongsTo(Membros_oficiais::class, 'id_membro_oficio');
    }

    public function search($request)
    {
        if (isset($request['nome']) <> null){
            $membro = Membro::where('nome', 'LIKE', '%'.$request['nome'].'%')->orderBy('nome')->paginate(10);
            return $membro;
        }
        elseif (isset($request['id_congregacao']) <> null){
            $membro = Membro::where('id_congregacao',  $request['id_congregacao'])->orderBy('nome')->paginate(10);
            return $membro;
        }

    }

    public function igreja_congregacao()
    {
        return $this->hasOne(Igreja_congregacao::class, 'id_responsavel');
    }

    public function igrejaCongregacao(){
        return $this->belongsTo(Igreja_congregacao::class, 'id_congregacao');
    }

    public function tipoMembro(){
        return $this->belongsTo(Tipo_membro::class, 'tp_membros');
    }

    public function grupo(){
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function dizimo(){
        return $this->hasMany(Dizimo::class, 'id_membro');
    }

/*
    //ESCOPO MULT-TENANCY
    public function scopeByAccount(Builder $query, $accountId){

    }
*/

}
