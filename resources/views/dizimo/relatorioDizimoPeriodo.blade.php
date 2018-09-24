@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Relatório de Dízimos (Todos, Por Congregação, Por Período)</h1>
@stop

@section('content')
    <div class="box-body"></div>
    <form method="post" action="{{route('dizimos.gerarrelatoriodizimos')}}" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Selecione a congregação(Opcional)</label>
                <select class="col-md-4  form-control" name="id_congregacao" id="">
                    <option value="">Selecione a Congregação para filtrar</option>
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Inicial(Opcional)</label>
                <input type="date" name="dt_inicial" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Final(Opcional)</label>
                <input type="date" name="dt_final" class="form-control">
            </div>

        </div>

        <a href="" class="btn btn-danger">Voltar</a>
        <button type="submit" class="btn btn-success">Gerar Relatório</button>

    </form>
@stop