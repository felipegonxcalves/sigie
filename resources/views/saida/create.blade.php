@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Registro de Saídas (Pagamentos)</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/saida">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-3">
                <label for="tp_saida">Tipo de Saida:</label>
                <select name="tp_saida" id="tp_saida" class="form-control">
                    @foreach($tipoSaidas as $tipoSaida)
                        <option value="{{$tipoSaida->id}}">{{$tipoSaida->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-7">
                <label for="descricao">Descrição da Saida(Opcional):</label>
                <input type="text" class="form-control" name="descricao">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="id_congregacao">Congregação onde foi Realizada a saída:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="val_saida">Valor Saída:</label>
                <input type="text" required="required" name="val_saida" placeholder="R$ 0.00" class="form-control dinheiro">
            </div>

            <div class="form-group col-md-4">
                <label for="dt_saida">Data da Saída:</label>
                <input type="date" required="required" name="dt_saida" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <button type="submit" class="form-control btn btn-success">Registrar Saída</button>
            </div>
        </div>
    </form>
    <div class="box"></div>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Descrição da Saída</td>
            <td style="color: #9f191f">Data da Saída</td>
            <td style="color: #9f191f">Tipo da Saída</td>
            <td style="color: #9f191f">Valor da Saída</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($saidas))
            @foreach($saidas as $saida)
                <tr>

                    <td>{{$saida->descricao}}</td>
                    <td>{{ date('d/m/Y', strtotime($saida->dt_saida)) }}</td>
                    <td>{{$saida->tipo}}</td>
                    <td>{{'R$ '.$saida->val_saida}}</td>
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$saida->id}}"
                           data-val_saida="{{$saida->val_saida}}"
                           data-dt_saida="{{$saida->dt_saida}}"
                           data-descricao="{{$saida->descricao}}"
                           data-tp_saida="{{$saida->tipo}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/saida/deletee/{{$saida->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
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
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Saída</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/saida/{{!empty($saida->id) ? $saida->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="create">
                            <input type="hidden" name="id_saida" id="id_saida" >

                            <div class="form-group col-md-6">
                                <label for="">Descrição da Saida(Opcional):</label>
                                <input type="text" id="descricao" name="descricao" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Valor Saída:</label>
                                <input class="form-control dinheiro" required="required" name="val_saida" id="val_saida" placeholder="R$ 0,00" type="text">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Data da Saída:</label>
                                <input type="date" required="required" id="dt_saida" name="dt_saida" class="form-control col-md-4">
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
        $('#tp_saida').select2();

    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var val_saida = button.data('val_saida')
        var dt_saida = button.data('dt_saida')
        var descricao = button.data('descricao')


        var modal = $(this)
        //modal.find('.modal-title').text('Editar oferta de: ' + nomeigreja)
        modal.find('#id_saida').val(recipient)
        modal.find('#val_saida').val(val_saida)
        modal.find('#dt_saida').val(dt_saida)
        modal.find('#descricao').val(descricao)
    })
</script>
@stop