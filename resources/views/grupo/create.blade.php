@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Cadastro de Grupos</h1>
@stop

@section('content')
    <div class="box"></div>
    <form action="{{route('grupo.store')}}" method="post" class="">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
            <label for="">Nome do grupo: </label>
                <input type="text" placeholder="Ex: Senhora, Senhores, Etc.." required="required" name="nome_grupo" class="form-control input">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
        
    </form>
    
@stop