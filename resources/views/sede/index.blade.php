@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Listagem de Congregações</h1>
@stop

@section('content')
    <div class="box"></div>
    <!-- <a href="/planos/create" class="btn btn-success">Cadastrar Cliente</a> -->
    <form method="post" action="{{route('sede.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="form-group col-md-7">
        <input placeholder="Pesquisar congregação" type="text" align="rigth" name="nome" class="form-control col-md-7">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/sede" class="btn btn-danger">Limpar Filtro</a>
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
                    <td align="center"><strong>Ações</strong></td>
                </tr>
                    @foreach($igrejaCongregacao as $igreja)
                        <tr>
                            <td>{{$igreja->nome_igreja}}</td>
                            <td>{{$igreja->nome_curto}}</td>
                            <td>{{$igreja->logradouro}}</td>
                            <td>{{$igreja->bairro}}</td>
                            <td>{{$igreja->nro}}</td>
                            <td>{{$igreja->tp_igreja == 's' ? 'Sede' : 'Congregação'}}</td>
                            <td><a class="btn btn-success btn-xs" href="/sede/{{$igreja->id}}"><span class="glyphicon glyphicon-eye-open"></span> Visualizar</a>&nbsp;&nbsp;
                                <a class="btn btn-primary btn-xs" href="sede/{{$igreja->id}}/edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>&nbsp;&nbsp;
                                <a class="btn btn-danger btn-xs" href="/sede/delete/{{$igreja->id}}"><span class="glyphicon glyphicon-trash"></span> Excluir</a>
                                <a class="btn btn-bitbucket btn-xs" href="/sede/alocardirigente/{{$igreja->id}}">{{!empty($igreja->id_responsavel) ? 'Mudar Dirigente' : 'Alocar dirigente'}}</a></td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>

    @if(isset($request))
        {!! $igrejaCongregacao->appends($request)->links() !!}
    @else
        {!! $igrejaCongregacao->links() !!}
    @endif

@stop