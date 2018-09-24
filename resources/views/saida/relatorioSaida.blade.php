@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Relatório de Saídas(Pagamentos)</h1>
@stop

@section('content')
    <div class="box-body"></div>
    <form id="gerar-relatorio" method="post" action="{{route('saidas.relatorio')}}" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Selecione a congregação(Opcional)</label>
                <select class="col-md-4  form-control" name="id_congregacao" id="">
                    <option value="">Selecione a congregação</option>
                    @foreach($igrejaCongregacao as $congregacao)
                        <option value="{{$congregacao->id}}">{{$congregacao->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="">Selecione o tipo de saída(Opcional)</label>
                <select class="col-md-3  form-control" name="tp_saida" id="">
                    <option value="">Selecione o tipo de saída</option>
                    @foreach($tipoSaidas as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Inicial(Opcional)</label>
                <input type="date" name="dt_inicial" id="dt_inicial" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Final(Opcional)</label>
                <input type="date" name="dt_final" id="dt_final" class="form-control">
            </div>

        </div>

        <a href="/saida" class="btn btn-danger">Voltar</a>
        <button type="submit" class="btn btn-success">Gerar Relatório</button>

    </form>
@stop