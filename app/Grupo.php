<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use TenantModels;

    public function membros()
    {
        return $this->hasMany(Membro::class, 'id_grupo');
    }
}
