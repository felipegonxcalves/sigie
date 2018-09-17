<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Ficha_ministerial extends Model
{
    use TenantModels;

    protected $table = 'ficha_ministerial';

    public function membroMinisterio(){
        return $this->belongsTo(Membro::class, 'id_membro_ministerio');
    }
}
