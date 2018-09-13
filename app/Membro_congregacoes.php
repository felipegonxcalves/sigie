<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Membro_congregacoes extends Model
{
    use TenantModels;
    protected $table = "membro_congregacoes";
}
