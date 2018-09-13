@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Todos as Ofertas Registradas</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('oferta.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="form-group col-md-6">
            <select class="col-md-6  form-control" name="id_congregacao" id="id_congregacao">
                <option value="">Selecione a Congregação</option>
                @foreach($igrejaCongregacao as $igreja)
                    <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/oferta" class="btn btn-danger">Limpar Filtro</a>
        <a href="/oferta/create" class="btn btn-facebook">Registrar nova Oferta</a>
    </form>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Congregação (Onde foi realizada a oferta)</td>
            <td style="color: #9f191f">Descrição</td>
            <td style="color: #9f191f">Data da Oferta</td>
            <td style="color: #9f191f">Valor da Oferta</td>            
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($ofertas))
            @foreach($ofertas as $oferta)
                <tr>
                    <td>{{$oferta->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{!empty($oferta->descricao) ? $oferta->descricao : '--'}}</td>
                    <td>{{date('d/m/Y', strtotime($oferta->dt_oferta))}}</td>
                    <td>{{'R$ '.$oferta->val_oferta}}</td>                                        
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$oferta->id}}"
                           data-nomeigreja="{{$oferta->igrejaCongregacao->nome_igreja}}"
                           data-dt_oferta="{{$oferta->dt_oferta}}"
                           data-val_oferta="{{$oferta->val_oferta}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/oferta/deletee/{{$oferta->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5">Ainda não existem registros de Ofertas cadastradas no Sistema</td>
            </tr>
        @endif
    </table>

    @if(isset($request))
        {!! $ofertas->appends($request)->links() !!}
    @else
        {!! $ofertas->links() !!}
    @endif

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
                            <input type="hidden" name="form" value="index">
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
<script src="{{asset('js/jquery.mask.js')}}" ></script>
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
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

    $(document).ready(function(){
        $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        $('#id_congregacao').select2();
    });
</script>
@stop