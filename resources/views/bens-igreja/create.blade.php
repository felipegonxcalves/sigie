@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Cadastro de Bens da Igreja</h1>
@stop

@section('content')
    <div class="box"></div>
    <form action="{{route('bens-igreja.store')}}" method="post" class="">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Nome do Item: </label>
                <input type="text" placeholder="Ex: Bateria, Guitarra, Cadeira, Mesa, Etc.." required="required" name="nome_item" class="form-control input">
            </div>

            <div class="form-group col-md-4">
                <label for="">Marca do Item (Opcional): </label>
                <input type="text" placeholder="Ex: Tagima, Etc.." name="marca_item" class="form-control input">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>

    </form>

@stop