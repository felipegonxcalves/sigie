@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Relatório de Ofertas (Todas, Por Congregação, Por Período)</h1>
@stop

@section('content')
    <div class="box-body"></div>
    <form id="gerar-relatorio" method="post" action="{{route('oferta.gerarrelatorio')}}" class="form form-group" target="_blank">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Selecione a congregação(Opcional)</label>
                <select class="col-md-4  form-control" name="id_congregacao" id="">
                    <option value="">Selecione a Congregação para filtrar</option>
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Inicial(Opcional)</label>
                <input type="date" name="dt_inicial" id="dt_inicial" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Final(Opcional)</label>
                <input type="date" name="dt_final" id="dt_final" class="form-control">
            </div>

        </div>

        <a href="/oferta" class="btn btn-danger">Voltar</a>
        <button type="submit" class="btn btn-success">Gerar Relatório</button>

    </form>
@stop

@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="{{asset('js/jquery.maskMoney.js')}}" ></script>
<script src="{{asset('js/jquery.mask.js')}}" ></script>
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>

<script type="text/javascript">

    $("#gerar-relatorio").submit(function(){
        $("#dt_inicial").blur(function(){

                $("#dt_final").att('required', 'required'); //E o torna obrigatório

        });
    });



    function validarData() {
        var dt_inicial = document.getElementById('dt_inicial');
        var dt_final = document.getElementById('dt_final');

        if (dt_inicial != null && dt_final == null || dt_final != null && dt_inicial == null ){
            alert("Por favor Preencha a data final e a data Inicial!");
        }
    }


</script>
@stop