@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Associar Responsável à Congregação</h1>
@stop

@section('content')
    <div class="box"></div>
    <!-- <a href="/planos/create" class="btn btn-success">Cadastrar Cliente</a> -->
    <form method="post" action="/igreja-congregacao/associar-responsavel/search" class="form form-inline">
        {{csrf_field()}}

        <input placeholder="Pesquisar congregação" type="text" align="rigth" name="nome" class="form-control col-md-7">
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/igreja-congregacao" class="btn btn-danger">Limpar Filtro</a>
    </form>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nome </th>
                    <th>Nome Curto</th>
                    <th>Logradouro</th>
                    <th>Bairro</th>
                    <th>Nº</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
                @foreach($igrejaCongregacao as $igreja)
                    <tr>
                        <td>{{$igreja->nome_igreja}}</td>
                        <td>{{$igreja->nome_curto}}</td>
                        <td>{{$igreja->logradouro}}</td>
                        <td>{{$igreja->bairro}}</td>
                        <td>{{$igreja->nro}}</td>
                        <td>{{$igreja->tp_igreja == 's' ? 'Sede' : 'Congregação'}}</td>
                        <td><a href="/igreja-congregacao/associar-responsavel/{{$igreja->id}}">{{!empty($igreja->id_responsavel) ? 'Alterar Dirigente' : 'Alocar Dirigente'}}</a>&nbsp;&nbsp; <a href="sede/{{$igreja->id}}/edit">Editar</a>&nbsp;&nbsp; <a href="/sede/delete/{{$igreja->id}}">Excluir</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{$igrejaCongregacao->links()}}
@stop