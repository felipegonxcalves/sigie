@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ !empty($dizimoMesAtual->somaodizimo) ? 'R$ '.$dizimoMesAtual->somaodizimo : 'R$ 0.00'  }}</h3>

              <p>Dízimos até o momento do Mês Atual</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="dizimo" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <!-- <h3>{{ $ofertaMesAtual->somaoferta }}<sup style="font-size: 20px">%</sup></h3> -->
              <h3>{{ 'R$ '. $ofertaMesAtual->somaoferta }}<sup style="font-size: 20px"></sup></h3>

              <p>Ofertas até o momento do Mês Atual</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="oferta" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 align="center">{{ $qtdMembro }}</h3>

              <p>Membros Cadastrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="membro" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 align="center">{{ $qtdCongregacoes }}</h3>

              <p>Congregações registradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="sede" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
@stop