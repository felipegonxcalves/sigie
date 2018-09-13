@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Todas as Entradas Registradas</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('entrada.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="form-group col-md-6">
            <select class="col-md-6  form-control" name="id_congregacao" id="id_congregacao">
                <option value="">Selecione a Congregação para filtrar</option>
                @foreach($igrejaCongregacao as $igreja)
                    <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/entrada" class="btn btn-danger">Limpar Filtro</a>
        <a href="/entrada/create" class="btn btn-facebook">Registrar nova Entrada</a>
    </form>



    <div class="box"></div>

    <table class="table table-responsive">
        <tr>            
            <td style="color: #9f191f">Congregação onde entrada foi registrada</td>            
            <td style="color: #9f191f">Descrição da Entrada</td>
            <td style="color: #9f191f">Data da Entrada</td>
            <td style="color: #9f191f">Valor da Entrada</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($entradas))
            @foreach($entradas as $entrada)
                <tr>                    
                    <td>{{$entrada->igrejaCongregacao->nome_igreja}}</td>                    
                    <td>{{$entrada->descricao}}</td>
                    <td>{{date('d/m/Y', strtotime($entrada->dt_entrada)) }}</td>
                    <td>{{'R$ '.$entrada->val_entrada}}</td>
                    <td><a class="btn btn-success btn-xs" href="/entrada/{{$entrada->id}}/edit"><span class="glyphicon glyphicon-pencil"></span>Editar</a>
                        <a class="btn btn-danger btn-xs" href="/entrada/delete/{{$entrada->id}}"><span class="glyphicon glyphicon-trash"></span>Apagar</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5" style="color: #000000;">Ainda não existem registros de Ofertas cadastradas no Sistema</td>
            </tr>
        @endif
    </table>

    @if(isset($request))
        {!! $entradas->appends($request)->links() !!}
    @else
        {!! $entradas->links() !!}
    @endif


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#id_congregacao').select2();
        });
    </script>

@stop