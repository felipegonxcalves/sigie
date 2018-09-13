<?php
/**
 * Created by PhpStorm.
 * User: felip
 * Date: 30/08/2018
 * Time: 10:11
 */

 function valor($valor) {

    $verificaPonto = ".";
    if(strpos("[".$valor."]", "$verificaPonto")):
        $valor = str_replace('.','', $valor);
        $valor = str_replace(',','.', $valor);
    else:
        $valor = str_replace(',','.', $valor);
    endif;

    return $valor;
}