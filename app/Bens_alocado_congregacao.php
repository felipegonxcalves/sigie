<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Bens_alocado_congregacao extends Model
{
    use TenantModels;
    protected $table = 'bens_alocado_congregacao';
}
