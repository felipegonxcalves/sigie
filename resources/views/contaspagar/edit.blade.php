@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Atualizar conta</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/contas-pagar/{{$contasPagar->id}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="row">
            <input type="hidden" name="form" value="index">
            <input type="hidden" name="id_contaspagar" id="id_contaspagar" >

            <div class="form-group col-md-10">
                <label for="">Descrição da Conta(Opcional):</label>
                <input type="text" id="descricao" value="{{$contasPagar->descricao}}" name="descricao" class="form-control col-md-10">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <label for="id_congregacao">Congregação responsável pela conta:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option {{$contasPagar->id_igreja == $igreja->id ? 'selected' : '' }} value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="">Valor:</label>
                <input class="form-control dinheiro" value="{{$contasPagar->val_pagar}}" required="required" name="val_pagar" id="val_pagar" placeholder="R$ 0,00" type="text">
            </div>

            <div class="form-group col-md-3">
                <label for="">Data de Vencimento:</label>
                <input type="date" required="required" value="{{$contasPagar->dt_vencimento}}" id="dt_vencimento" name="dt_vencimento" class="form-control col-md-4">
            </div>
        </div>

        <div class="form-group col-md-4">
            <a href="/contas-pagar" class="btn btn-danger" >Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
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
    });
</script>
@stop