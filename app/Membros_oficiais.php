<?php

namespace App;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Membros_oficiais extends Model
{
    use TenantModels;
    protected $table = 'membros_oficiais';
}
