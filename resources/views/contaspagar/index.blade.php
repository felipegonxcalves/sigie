@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Todas as Contas</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('contaspagar.search')}}" class="form form-group">
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
                <label for="">Status da Conta</label>
                <select class="form-control" name="status_conta" id="status_conta">
                    <option value="">Selecione</option>
                    <option value="Em aberto">Em aberto</option>
                    <option value="Pago">Pago</option>
                    <option value="vencida">Vencida</option>
                </select>
            </div>
            <br/>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success">Pesquisar</button>
                <a href="/contas-pagar" class="btn btn-danger">Limpar Filtro</a>
                <!-- <a href="/contas-pagar/create" class="btn btn-facebook">Cadastrar nova Conta</a> -->
            </div>
        </div>
    </form>

    <div class="box"></div>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Congregação</td>
            <td style="color: #9f191f">Descrição da Conta</td>
            <td style="color: #9f191f">Data de Vencimento</td>
            <td style="color: #9f191f">Valor</td>
            <td style="color: #9f191f">Status</td>
            <td align="center" style="color: #9f191f"><strong>Ações</strong></td>
        </tr>
        @if(!$contasPagar->isEmpty())
            @foreach($contasPagar as $conta)
                <tr>
                    <td>{{$conta->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{$conta->descricao}}</td>
                    <td>{{date('d/m/Y', strtotime($conta->dt_vencimento))}}</td>
                    <td>{{'R$ '.$conta->val_pagar}}</td>
                    <td style="color: #ac2925"><strong>{{$conta->status_conta}}</strong></td>
                    <td align="center"><a class="btn btn-success btn-xs" href="/contas-pagar/{{$conta->id}}/edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/contas-pagar/delete/{{$conta->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a>
                        <a class="{{$conta->status_conta == 'Pago' ? '' : 'btn btn-bitbucket btn-xs'}}" href="/contas-pagar/pagar/{{$conta->id}}"><span class="{{$conta->status_conta == 'Pago' ? '' : 'glyphicon glyphicon-usd'}}"></span> {{$conta->status_conta == 'Em aberto' ? 'Pagar' : ''}}</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5" style="color: #000000;">Ainda não existem registros de contas cadastradas no Sistema</td>
            </tr>
        @endif
    </table>

    @if(isset($param))
        {!! $contasPagar->appends($param)->links() !!}
    @else
        {!! $contasPagar->links() !!}
    @endif

@stop

@section ('js')console
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_congregacao').select2();
        $('#status_conta').select2();
    });
</script>
@stop