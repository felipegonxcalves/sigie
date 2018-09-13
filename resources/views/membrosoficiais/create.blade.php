@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Cadastro de Ofícios da Igreja</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/oficiais-igreja">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Tipo de Ofício</label>
                <input type="text" required="required" placeholder="Ex: Porteiro, Levita, Dirigente de Círculo de Oração, etc.." class="form-control" name="cargo_oficial">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <a class="btn btn-danger" href="/oficiais-igreja">Voltar</a>
                <button class="btn btn-success" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
@stop