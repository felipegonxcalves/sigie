@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Relatório Geral</h1>
@stop

@section('content')
    <div class="box-body"></div>
    <form id="gerar-relatorio" method="post" action="/gerar-relatorio-geral/" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-2">
                <label for="">Data Inicial(Opcional)</label>
                <input type="date" name="dt_inicial" id="dt_inicial" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Final(Opcional)</label>
                <input type="date" name="dt_final" id="dt_final" class="form-control">
            </div>

        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <a href="/entrada" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-success">Gerar Relatório</button>
            </div>
        </div>
    </form>
@stop