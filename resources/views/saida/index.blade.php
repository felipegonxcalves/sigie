@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Todas as Saídas Registradas</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('saida.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Selecione a congregação(Opcional)</label>
                <select class="col-md-4  form-control" name="id_congregacao" id="id_congregacao">
                    <option value="">Selecione a Congregação para filtrar</option>
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Inicial(Opcional)</label>
                <input type="date" name="dt_inicial" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <label for="">Data Final(Opcional)</label>
                <input type="date" name="dt_final" class="form-control">
            </div>

        </div>

        <button type="submit" class="btn btn-success">Pesquisar</button>
        <a href="/saida" class="btn btn-danger">Limpar Filtro</a>
        <a href="/saida/create" class="btn btn-facebook">Registrar nova Saida</a>
    </form>

    <div class="box"></div>

    <table class="table table-responsive">
        <tr>            
            <td style="color: #9f191f">Congregação</td>
            <td style="color: #9f191f">Descrição da Saída</td>
            <td style="color: #9f191f">Data da Saída</td>
            <td style="color: #9f191f">Tipo da Saída</td>
            <td style="color: #9f191f">Valor da Saída</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($saidas))
            @foreach($saidas as $saida)
                <tr>                    
                    <td>{{$saida->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{$saida->descricao}}</td>
                    <td>{{date('d/m/Y', strtotime($saida->dt_saida))}}</td>
                    <td>{{$saida->tipoSaida->tipo}}</td>
                    <td>{{'R$ '.$saida->val_saida}}</td>
                    <td><a class="btn btn-success btn-xs" href="/saida/{{$saida->id}}/edit"><span class="glyphicon glyphicon-pencil"></span>Editar</a>
                        <a class="btn btn-danger btn-xs" href="/saida/delete/{{$saida->id}}"><span class="glyphicon glyphicon-trash"></span>Apagar</a>
                        <a target="_blank" class="btn btn-facebook btn-xs" href="/saida/comprovante/{{$saida->id}}">Comprovante</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5" style="color: #000000;">Ainda não existem registros de Ofertas cadastradas no Sistema</td>
            </tr>
        @endif
    </table>

    @if(isset($request))
        {!! $saidas->appends($request)->links() !!}
    @else
        {!! $saidas->links() !!}
    @endif


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