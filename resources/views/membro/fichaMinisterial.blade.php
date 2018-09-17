@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1><strong>FICHA MINISTERIAL DE : </strong> {{$membroMinisterial->nome}} </h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('cadastrar.ministerio', $membroMinisterial->id)}}" class="form form-group">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-10">
                <label for="experiencias_campo"> Experiências de Campo *</label>
                <input required="required" type="text" name="experiencias_campo" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-10">
                <label for="experiencias_campo"> Observações (Opcional)</label>
                <input type="text" name="observacao" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <a class="btn btn-danger" href="{{route('membro.ministerio')}}">Voltar</a>
                <button type="submit" class="btn btn-primary">Registrar Histórico</button>
                <a class="btn btn-success pull-right" target="_blank" href="{{route('imprimir.ficha', $membroMinisterial->id)}}">Imprimir Ficha</a>
            </div>
        </div>
    </form>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Experiência de Campo</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(!$fichaMembro->isEmpty())
                @foreach($fichaMembro as $ficha)
                    <tr>
                        <td>{{$ficha->experiencias_campo}}</td>
                        <td>{{!empty($ficha->observacao) ? $ficha->observacao : '-----'}}</td>
                        <td>
                            <a class="btn btn-danger btn-xs" href="{{route('deletar.ministerio', $ficha->id )}}">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td align="center">Ainda não foi registrado nenhum histórico</td>
                </tr>
            @endif
        </tbody>
    </table>

@stop



@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#id_congregacao').select2();
    });
</script>
@stop