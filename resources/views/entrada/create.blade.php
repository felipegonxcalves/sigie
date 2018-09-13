@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>REGISTRO DE ENTRADAS</h1>
@stop

@section('content')
    <div class="box"></div>
    <form method="post" action="/entrada">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-3">
                <label for="tp_entrada">Tipo de entrada:</label>
                <select name="tp_entrada" id="tp_entrada" class="form-control">
                    @foreach($tipoEntrada as $tipoentrada)
                        <option value="{{$tipoentrada->id}}">{{$tipoentrada->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-7">
                <label for="descricao">Descrição da Entrada(Opcional):</label>
                <input type="text" class="form-control" name="descricao">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="tp_entrada">Localidade onde foi Realizada a entrada:</label>
                <select name="id_congregacao" id="id_congregacao" class="form-control">
                    @foreach($igrejaCongregacao as $igreja)
                        <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="val_entrada">Valor Entrada:</label>
                <input type="text" required="required" name="val_entrada" placeholder="R$ 0.00" class="form-control dinheiro">
            </div>

            <div class="form-group col-md-4">
                <label for="">Data da Entrada:</label>
                <input type="date" required="required" name="dt_entrada" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <button type="submit" class="form-control btn btn-success">Cadastrar Entrada</button>
            </div>
        </div>
    </form>
    <div class="box"></div>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Descrição da Entrada</td>
            <td style="color: #9f191f">Data da Entrada</td>
            <td style="color: #9f191f">Valor da Entrada</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($entradas))
            @foreach($entradas as $entrada)
                <tr>

                    <td>{{$entrada->descricao}}</td>
                    <td>{{date('d/m/Y', strtotime($entrada->dt_entrada)) }}</td>
                    <td>{{'R$ '.$entrada->val_entrada}}</td>
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$entrada->id}}"
                           data-val_entrada="{{$entrada->val_entrada}}"
                           data-dt_entrada="{{$entrada->dt_entrada}}"
                           data-descricao="{{$entrada->descricao}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/entrada/deletee/{{$entrada->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
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
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Entrada</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/entrada/{{!empty($entrada->id) ? $entrada->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="create">
                            <input type="hidden" name="id_entrada" id="id_entrada" >

                            <div class="form-group col-md-6">
                                <label for="">Descrição da Entrada(Opcional):</label>
                                <input type="text" id="descricao" name="descricao" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Valor Entrada:</label>
                                <input class="form-control dinheiro" required="required" name="val_entrada" id="val_entrada" placeholder="R$ 0,00" type="text">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Data da Entrada:</label>
                                <input type="date" required="required" id="dt_entrada" name="dt_entrada" class="form-control col-md-4">
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
        $('#tp_entrada').select2();
        $('#id_congregacao').select2();
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var val_entrada = button.data('val_entrada')
        var dt_entrada = button.data('dt_entrada')
        var descricao = button.data('descricao')


        var modal = $(this)
        //modal.find('.modal-title').text('Editar oferta de: ' + nomeigreja)
        modal.find('#id_entrada').val(recipient)
        modal.find('#val_entrada').val(val_entrada)
        modal.find('#dt_entrada').val(dt_entrada)
        modal.find('#descricao').val(descricao)
    })


</script>
@stop