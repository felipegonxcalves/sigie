@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Registro de Entradas</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/entrada/{{$entradas->id}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <input type="hidden" name="form" value="index">
        <div class="row">
            <input type="hidden" value="index" name="form">
            <div class="form-group col-md-3">
                <label for="tp_entrada">Tipo de entrada:</label>
                <select name="tp_entrada" id="tp_entrada" class="form-control">
                    @foreach($tipoEntrada as $tipoentrada)
                        <option {{$tipoentrada->id == $entradas->tp_entrada ? 'selected' : '' }} value="{{$tipoentrada->id}}">{{$tipoentrada->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-7">
                <label for="descricao">Descrição da Entrada(Opcional):</label>
                <input type="text" class="form-control" name="descricao" value="{{$entradas->descricao}}">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="tp_entrada">Congregação onde foi Realizada a entrada:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option {{$igreja->id == $entradas->id_congregacao ? 'selected' : ''}} value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="val_entrada">Valor Entrada:</label>
                <input type="text" required="required" name="val_entrada" value="{{$entradas->val_entrada}}" placeholder="R$ 0.00" class="form-control dinheiro">
            </div>

            <div class="form-group col-md-4">
                <label for="">Data da Entrada:</label>
                <input type="date" required="required" name="dt_entrada" value="{{$entradas->dt_entrada}}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <a href="/entrada" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-success">Editar Entrada</button>
            </div>
        </div>
    </form>

@stop

@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('js/jquery.maskMoney.js')}}" ></script>
<script src="{{asset('js/jquery.mask.js')}}" ></script>
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        $('#tp_entrada').select2();
        $('#id_congregacao').select2();
    });
</script>
@stop