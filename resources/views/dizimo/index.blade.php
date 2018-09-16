@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Todos os Dízimos Registrados</h1>
@stop

@section('content')
    <div class="box"></div>

    <form method="post" action="{{route('dizimo.search')}}" class="form form-group">
        {{csrf_field()}}
        <div class="form-group col-md-5">
            <input placeholder="Pesquisar Dizimista" type="text" name="nome" class="form-control col-md-7">
        </div>
        <div class="form-group col-md-3">
            <select class="col-md-3  form-control" name="id_congregacao" id="id_congregacao">
                <option value="">Selecione a Congregação</option>
                @foreach($igrejaCongregacao as $igreja)
                    <option value="{{$igreja->id}}">{{$igreja->nome_igreja}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <a href="/dizimo" class="btn btn-danger">Limpar Filtro</a>
        <a href="/dizimo/create" class="btn btn-facebook">Registrar novo Dízimo</a>
    </form>

    <table class="table table-responsive">
        <tr>
            <td style="color: #9f191f">Nome do Dizimista(Membro)</td>
            <td style="color: #9f191f">Congregação (Onde foi realizada o dízimo)</td>
            <td style="color: #9f191f">Data do Dízimo</td>            
            <td style="color: #9f191f">Valor do Dízimo</td>
            <td style="color: #9f191f">Ações</td>
        </tr>
        @if(!empty($dizimos))
            @foreach($dizimos as $dizimo)
                <tr>
                    <td>{{$dizimo->membro->nome}}</td>
                    <td>{{$dizimo->igrejaCongregacao->nome_igreja}}</td>
                    <td>{{date('d/m/Y', strtotime($dizimo->dt_dizimo))}}</td>                    
                    <td>{{'R$ '.$dizimo->val_dizimo}}</td>
                    <td><a class="btn btn-success btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$dizimo->id}}"
                           data-whatevernome="{{$dizimo->membro->nome}}"
                           data-nomeigreja="{{$dizimo->igrejaCongregacao->nome_igreja}}"
                           data-dt_dizimo="{{$dizimo->dt_dizimo}}"
                           data-val_dizimo="{{$dizimo->val_dizimo}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/dizimo/deletee/{{$dizimo->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" colspan="5">Ainda não existem registros de Dízimos cadastrados no Sistema</td>
            </tr>
        @endif
    </table>

    @if(isset($request))
        {!! $dizimos->appends($request)->links() !!}
    @else
        {!! $dizimos->links() !!}
    @endif

    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Dízimo</h4>
                </div>
                <div class="modal-body">
                    <form name="index" method="post" action="/dizimo/{{!empty($dizimo->id) ? $dizimo->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="index">
                            <input type="hidden" name="id_dizimo" id="id_dizimo" >
                            <div class="form-group col-md-6">
                                <label for="">Nome do Dízimista:</label>
                                <input type="text" disabled="disabled" id="nome" name="nome" class="form-control col-md-4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Nome da Igreja:</label>
                                <input type="text" disabled="disabled" id="nomeigreja" name="nome_igreja" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Valor do Dízimo:</label>
                                <input class="form-control dinheiro" required="required" name="val_dizimo" id="val_dizimo" placeholder="R$ 0,00" type="text">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Data do dízimo:</label>
                                <input type="date" required="required" id="dt_dizimo" name="dt_dizimo" class="form-control col-md-4">
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
        var nome = button.data('whatevernome')
        var nomeigreja = button.data('nomeigreja')
        var dt_dizimo = button.data('dt_dizimo')
        var val_dizimo = button.data('val_dizimo')


        var modal = $(this)
        modal.find('.modal-title').text('Editar dízimo')
        modal.find('#id_dizimo').val(recipient)
        modal.find('#nome').val(nome)
        modal.find('#nomeigreja').val(nomeigreja)
        modal.find('#dt_dizimo').val(dt_dizimo)
        modal.find('#val_dizimo').val(val_dizimo)
    })

    $(document).ready(function(){
        $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        $('#id_congregacao').select2();
    });
</script>
@stop