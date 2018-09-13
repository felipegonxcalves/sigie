@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Atualizar registro de Saídas (Pagamentos)</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/saida/{{$saida->id}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="row">
            <div class="form-group col-md-3">
                <input type="hidden" name="form" value="index">
                <label for="tp_saida">Tipo de Saida:</label>
                <select name="tp_saida" id="tp_saida" class="form-control">
                    @foreach($tipoSaidas as $tipoSaida)
                        <option {{$tipoSaida->id == $saida->id_tp_saidas ? 'selected' : ''}} value="{{$tipoSaida->id}}">{{$tipoSaida->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-7">
                <label for="descricao">Descrição da Saida(Opcional):</label>
                <input type="text" class="form-control" value="{{$saida->descricao}}" name="descricao">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="id_congregacao">Congregação onde foi Realizada a saída:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option {{$igreja->id == $saida->id_igreja ? 'selected' : ''}} value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="val_saida">Valor Saída:</label>
                <input type="text" required="required" name="val_saida" value="{{$saida->val_saida}}" placeholder="R$ 0.00" class="form-control dinheiro">
            </div>

            <div class="form-group col-md-4">
                <label for="dt_saida">Data da Saída:</label>
                <input type="date" required="required" name="dt_saida" value="{{$saida->dt_saida}}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <a href="/saida" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-success">Atualizar Saída</button>
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
        $('#id_congregacao').select2();
        $('#tp_saida').select2();
    });
</script>
@stop