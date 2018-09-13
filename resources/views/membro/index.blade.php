@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Listagem de Membros/Congregados</h1>
@stop

@section('content')
    <div class="box"></div>
    <!-- <a href="/planos/create" class="btn btn-success">Cadastrar Cliente</a> -->
    <form method="post" action="{{route('membro.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Pesquisar por Nome do Membro:</label>
                <input placeholder="Pesquisar por nome" type="text" name="nome" class="form-control col-md-7">
            </div>
            <div class="form-group col-md-5">
                <label for="membro_congregacao">Selecione a Congregação(Localidade):</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    <option value="">TODAS</option>
                    @foreach($igrejaCongregacoes as $igrejaCongregacao)
                        <option value="{{$igrejaCongregacao->id}}">{{$igrejaCongregacao->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/membro" class="btn btn-danger">Limpar Filtro</a>
    </form>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Congregação</th>
                    <th>Celular</th>
                    <th>Tipo membro</th>
                    <th>Tipo congregação</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>


                @foreach($membros as $membro)
                    <tr>
                        <td>{{!empty($membro->matricula) ? $membro->matricula : '--'}}</td>
                        <td>{{$membro->nome}}</td>
                        <td>{{$membro->igrejaCongregacao->nome_igreja}}</td>
                        <td>{{$membro->celular}}</td>
                        <td>{{$membro->tipoMembro->destipo}}</td>
                        <td>{{$membro->igrejaCongregacao->tp_igreja == 's' ? 'Sede' : 'Congregação'}}</td>
                        <td>{{$membro->situacao}}</td>
                        <td><a class="btn btn-success btn-xs" href="/membro/{{$membro->id}}"><span class="glyphicon glyphicon-eye-open"></span> Visualizar</a>&nbsp;
                            <a class="btn btn-primary btn-xs" href="membro/{{$membro->id}}/edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                         &nbsp;&nbsp; <a class="btn btn-danger btn-xs" href="/membro/delete/{{$membro->id}}"><span class="glyphicon glyphicon-trash"></span> Excluir</a>
                        </td>
                         &nbsp;&nbsp;
                    </tr>
                @endforeach

            </table>

        </div>
    </div>

    @if(isset($request))
        {!! $membros->appends($request)->links() !!}
    @else
        {!! $membros->links() !!}
    @endif

@stop

@section ('js')console

<script type="text/javascript">

    $(document).ready(function(){
        $('#id_congregacao').select2();
    });
</script>
@stop