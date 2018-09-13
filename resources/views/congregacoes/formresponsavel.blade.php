@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Alocar Dirigente a Congregação</h1>
@stop

@section('content')
    <br/>
    <form action="/igreja-congregacao/associar-responsavel/" method="post">
        {{csrf_field()}}
        <div class="form-group col-md-10">
            <label for="congregacao"><strong style="color: #9f191f">Nome da Congregação: </strong> {{$igrejaCongregacao->nome_igreja}} </label>
            <input type="hidden" name="id_congregacao" value="{{$igrejaCongregacao->id}}">
        </div>
        <hr/>
        <div class="form-group col-md-10">
            <label for="congregacao"><strong style="color: #9f191f">Nome do Dirigente: </strong> </label>
        </div>
        <div class="form-group col-md-10">
            <select name="responsavel" class="form-control col-md-10">
                @foreach($membro as $membro)
                    <option value="{{$membro->id}}">{{$membro->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-5">
            <a href="/igreja-congregacao" class="btn btn-danger">Voltar</a>
            <button type="submit" class="btn btn-primary">Alocar dirigente</button>
        </div>
    </form>
@stop