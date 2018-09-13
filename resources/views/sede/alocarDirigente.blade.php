@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Alocar Dirigente a Congregação: <strong style="color: #9f191f">{{$igrejaCongregacao->nome_igreja}}</strong></h1>
@stop

@section('content')
    <div class="box"></div>
    <form action="/sede/insertdirigente/{{$igrejaCongregacao->id}}">
        {{csrf_field()}}
        <div class="form-group col-md-10">
            <label for="congregacao"><strong style="color: #9f191f">Dirigente da Congregação: </strong> </label>
        </div>
        <div class="form-group col-md-10">
            <select name="idresponsavel" id="responsavel" class="form-control col-md-10">
                    @foreach($membro as $membro)
                        <option value="{{$membro->id}}">{{$membro->nome}}</option>
                    @endforeach
            </select>
        </div>
        <br/>

            <div class="form-group col-md-5">
                <a href="/sede" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-success">Alocar Dirigente à congregação</button>
            </div>

    </form>

@stop

@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#responsavel').select2();
    });
</script>
@stop