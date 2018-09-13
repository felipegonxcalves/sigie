<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Endereco_membro extends Model
{
    use TenantModels;
    public function membro(){
        return $this->belongsTo(Membro::class, 'id_membro');
    }
}
