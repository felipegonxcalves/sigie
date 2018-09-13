<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membro;
use App\Oferta;
use App\Dizimo;
use App\Igreja_congregacao;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qtdMembro = Membro::count();

        $whereOferta = 'MONTH(dt_oferta) = MONTH(CURDATE())';
        $ofertaMesAtual = Oferta::select(DB::raw('SUM(val_oferta)as somaoferta'))->whereRaw($whereOferta)->first();
        $whereDizimo = 'MONTH(dt_dizimo) = MONTH(CURDATE())';
        $dizimoMesAtual = Dizimo::select(DB::raw('SUM(val_dizimo)as somaodizimo'))->whereRaw($whereDizimo)->first();
        //dd($dizimoMesAtual->somaodizimo);
        $qtdCongregacoes = Igreja_congregacao::count();

        return view('home', compact('qtdMembro', 'ofertaMesAtual', 'qtdCongregacoes', 'dizimoMesAtual'));
    }
}
