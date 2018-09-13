@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Registro de Ofertas</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="{{route('oferta.store')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Selecione a Congregação responsável: (Congregação onde foi recebida a Oferta)</label>
                <select class="col-md-8  form-control" name="id_congregacao" id="id_congregacao">
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">Descrição (Opcional):</label>
                <input class="form-control" name="descricao" id="descricao" type="text">
            </div>

        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="">Data da Oferta:</label>
                <input type="date" required="required" name="dt_oferta" class="form-control col-md-4">
            </div>

            <div class="form-group col-md-3">
                <label for="">Valor da Oferta:</label>
                <input class="form-control dinheiro" required="required" name="val_oferta" id="money" placeholder="R$ 0,00" type="text">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">Registrar Oferta</button>
            </div>
        </div>
    </form>
    <div class="box"></div>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Congregação (Onde foi realizada a oferta)</td>
            <td style="color: #9f191f">Data da Oferta</td>
            <td style="color: #9f191f">Valor da Oferta</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!$ofertas->isEmpty())
            @foreach($ofertas as $oferta)
                <tr>
                    <td>{{$oferta->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{ date('d/m/Y', strtotime($oferta->dt_oferta)) }}</td>
                    <td>{{'R$ '.$oferta->val_oferta}}</td>
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$oferta->id}}"
                           data-nomeigreja="{{$oferta->igrejaCongregacao->nome_igreja}}"
                           data-dt_oferta="{{$oferta->dt_oferta}}"
                           data-val_oferta="{{$oferta->val_oferta}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/oferta/delete/{{$oferta->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5" style="color: #000000;">Ainda não existem registros de Ofertas cadastradas no Sistema</td>
            </tr>
        @endif
    </table>




    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Oferta</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/oferta/{{!empty($oferta->id) ? $oferta->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="create">
                            <input type="hidden" name="id_oferta" id="id_oferta" >

                            <div class="form-group col-md-6">
                                <label for="">Nome da Igreja:</label>
                                <input type="text" disabled="disabled" id="nomeigreja" name="nome_igreja" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Valor da Oferta:</label>
                                <input class="form-control dinheiro" required="required" name="val_oferta" id="val_oferta" placeholder="R$ 0,00" type="text">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Data da Oferta:</label>
                                <input type="date" required="required" id="dt_oferta" name="dt_oferta" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
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
<!--<script src="{{asset('js/jquery.mask.js')}}" ></script> -->
<!--<script src="{{asset('js/jquery.inputmask.js')}}"></script> -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        $('#id_congregacao').select2();
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var nomeigreja = button.data('nomeigreja')
        var dt_oferta = button.data('dt_oferta')
        var val_oferta = button.data('val_oferta')


        var modal = $(this)
        modal.find('.modal-title').text('Editar oferta de: ' + nomeigreja)
        modal.find('#id_oferta').val(recipient)
        modal.find('#nomeigreja').val(nomeigreja)
        modal.find('#dt_oferta').val(dt_oferta)
        modal.find('#val_oferta').val(val_oferta)
    })


</script>
@stop






