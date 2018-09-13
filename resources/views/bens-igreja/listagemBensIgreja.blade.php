@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Listar Bens da Congregação</h1>
@stop

@section('content')
    <div class="box"></div>
    <form action="/relatorio-listagem-bens" target="_blank" method="post" class="">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Selecione a Congregação: *</label>
                <select class="col-md-8  form-control" required="required" name="id_congregacao" id="id_congregacao">
                    <option value="todas">Todas Congregações</option>
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Listar Bens</button>
            </div>
        </div>

    </form>

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