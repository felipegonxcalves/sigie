@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <form id="gerar-relatorio" method="post" action="{{route('membro.relatorio')}}" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-7">
                <h4><label for="">SELECIONE A LOCALIDADE DESEJADA: (RELATÓRIO DE MEMBROS POR LOCALIDADE)</label></h4>
                <select class="col-md-4  form-control" name="id_congregacao" id="id_congregacao">
                    <option value="todas">TODAS LOCALIDADES</option>
                    @foreach($igrejaCongregacao as $congregacao)
                        <option value="{{$congregacao->id}}">{{$congregacao->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <button type="submit" class="btn btn-success">Gerar Relatório de Membros</button>

    </form>
@stop

@section ('js')console

<script type="text/javascript">

    $(document).ready(function(){
        $('#id_congregacao').select2();
    });
</script>
@stop