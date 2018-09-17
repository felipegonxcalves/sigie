@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>MINISTÉRIO</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('ministerio.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="nome" placeholder="DIGITE O NOME PARA PESQUISAR (Opcional)">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="{{route('membro.ministerio')}}" class="btn btn-danger">Limpar Filtro</a>
    </form>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">LOCALIDADE</td>
            <td style="color: #9f191f">NOME</td>
            <td style="color: #9f191f">OFÍCIO</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!$membrosMinisterio->isEmpty())
            @foreach($membrosMinisterio as $ministerio)
                <tr>
                    <td>{{$ministerio->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{$ministerio->nome}}</td>
                    <td>{{$ministerio->membros_oficiais->cargo_oficial}}</td>
                    <td>
                        <a class="btn btn-success btn-xs" href="{{route('ficha.ministerio', $ministerio->id)}}"><span class="glyphicon glyphicon-trash"></span> Histórico Ministerial</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5">Ainda não foi registrado o Ministério</td>
            </tr>
        @endif
    </table>

    @if(isset($request))
        {!! $membrosMinisterio->appends($request)->links() !!}
    @else
        {!! $membrosMinisterio->links() !!}
    @endif

@stop