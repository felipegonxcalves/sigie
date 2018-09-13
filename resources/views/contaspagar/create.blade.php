@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Contas a Pagar</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/contas-pagar">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-10">
                <label for="descricao">Descrição da conta(Opcional):</label>
                <input type="text" class="form-control" name="descricao">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <label for="id_congregacao">Congregação responsável pela conta:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="val_saida">Valor da Conta:</label>
                <input type="text" required="required" name="val_pagar" placeholder="R$ 0.00" class="form-control dinheiro">
            </div>

            <div class="form-group col-md-3">
                <label for="dt_saida">Data do Vencimento:</label>
                <input type="date" required="required" name="dt_vencimento" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <button type="submit" class="form-control btn btn-success">Cadastrar Conta</button>
            </div>
        </div>
    </form>
    <div class="box"></div>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Descrição da Conta</td>
            <td style="color: #9f191f">Data de Vencimento</td>
            <td style="color: #9f191f">Valor</td>
            <td style="color: #9f191f">Status</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!$contasPagar->isEmpty())
            @foreach($contasPagar as $conta)
                <tr>

                    <td>{{$conta->descricao}}</td>
                    <td>{{date('d/m/Y', strtotime($conta->dt_vencimento))}}</td>
                    <td>{{'R$ '.$conta->val_pagar}}</td>
                    <td>{{$conta->status_conta}}</td>
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$conta->id}}"
                           data-descricao="{{$conta->descricao}}"
                           data-dt_vencimento="{{$conta->dt_vencimento}}"
                           data-val_pagar="{{$conta->val_pagar}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/contas-pagar/deletee/{{$conta->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5" style="color: #141a1d;">Ainda não existem Contas a Pagar cadastradas</td>
            </tr>
        @endif
    </table>


    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Conta</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/contas-pagar/{{!empty($conta->id) ? $conta->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="create">
                            <input type="hidden" name="id_contaspagar" id="id_contaspagar" >

                            <div class="form-group col-md-10">
                                <label for="">Descrição da Conta(Opcional):</label>
                                <input type="text" id="descricao" name="descricao" class="form-control col-md-10">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Valor:</label>
                                <input class="form-control dinheiro" required="required" name="val_pagar" id="val_pagar" placeholder="R$ 0,00" type="text">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Data de Vencimento:</label>
                                <input type="date" required="required" id="dt_vencimento" name="dt_vencimento" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

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

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var val_pagar = button.data('val_pagar')
        var dt_vencimento = button.data('dt_vencimento')
        var descricao = button.data('descricao')


        var modal = $(this)
        //modal.find('.modal-title').text('Editar oferta de: ' + nomeigreja)
        modal.find('#id_contaspagar').val(recipient)
        modal.find('#val_pagar').val(val_pagar)
        modal.find('#dt_vencimento').val(dt_vencimento)
        modal.find('#descricao').val(descricao)
    })
</script>
@stop