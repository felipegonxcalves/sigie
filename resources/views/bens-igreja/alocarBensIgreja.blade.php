@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Alocação de Bens da Congregação</h1>
@stop

@section('content')
    @if( Session::has( 'success' ))
        <div class="flash-message">
            <p class="alert alert success" style="color: #9f191f"><strong>{{ Session::get( 'success' ) }}</strong></p>
        </div>
    @elseif( Session::has( 'warning' ))
        {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
    @endif

    <div class="box"></div>
    <form action="/salvar-bens-igreja" method="post" class="">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Selecione a Congregação: *</label>
                <select class="col-md-8  form-control" required="required" name="id_congregacao" id="id_congregacao">
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="">Selecione o Item: *</label>
                <select class="col-md-8  form-control" required="required" name="id_item" id="id_item">
                    @foreach($bensIgreja as $bens)
                        <option value="{{$bens->id}}">{{$bens->nome_item}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Quantidade: *</label>
                <input type="number" required="required" name="qtd_item" class="form-control input">
            </div>

            <!--<div class="form-group col-md-6">
                <label for="">Descrição: </label>
                <input type="text" placeholder="Opcional" name="descricao" class="form-control input">
            </div> -->
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Adicionar Bens</button>
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

    $(document).ready(function(){
        $('#id_item').select2();
    });
</script>
@stop