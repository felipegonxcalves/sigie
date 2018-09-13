@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <form id="gerar-relatorio" method="post" action="/grupo-componentes" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <h4><label for="">Selecione a congregação de onde deseja ver os componentes do grupo de {{$grupo->nome_grupo}}</label></h4>
                <input type="hidden"  name="id_grupo" value="{{$grupo->id}}">
                <select class="col-md-4  form-control" name="id_congregacao" id="id_congregacao">
                    @foreach($igrejaCongregacao as $congregacao)
                        <option value="{{$congregacao->id}}">{{$congregacao->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <a href="/grupo" class="btn btn-danger">Voltar</a>
        <button type="submit" class="btn btn-success">Ver componentes</button>

    </form>

@stop

@section ('js')console
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        //SELECT 2
        $(document).ready(function(){
            $('#id_congregacao').select2();
        });
    </script>
@stop
