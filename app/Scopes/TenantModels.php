<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;

trait TenantModels{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope());

        //TODA VEZ NA CRIAÇÃO DE UM NOVO REGISTRO SALVA O ACCOUNT_ID DO USUARIO LOGADO
        static::creating(function (Model $model){
            $accountId = \Auth::user()->account_id;
            $model->account_id = $accountId;
        });
    }
}