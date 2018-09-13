<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function valor($valor) {
        $verificaPonto = ".";
        if(strpos("[".$valor."]", "$verificaPonto")):
            $valor = str_replace('.','', $valor);
            $valor = str_replace(',','.', $valor);
        else:
            $valor = str_replace(',','.', $valor);
        endif;

        return $valor;
    }
}
