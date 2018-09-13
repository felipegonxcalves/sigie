@extends('adminlte::page')

@section('title', 'Sigie')

@section('content_header')
    <h1>Bens</h1>
@stop

@section('content')
    <div class="box"></div>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <td><strong>Nome do Item</strong></td>
            <td><strong>Marca</strong></td>
            <td><strong>Ações</strong></td>
        </tr>
        </tbody>
        @if(!$bensIgreja->isEmpty())
            @foreach($bensIgreja as $bens)
                <tr>
                    <td>{{$bens->nome_item}}</td>
                    <td>{{ !empty($bens->marca_item) ? $bens->marca_item : '--' }}</td>
                    <td><a class="btn btn-primary btn-xs" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$bens->id}}"
                           data-nomeitem="{{$bens->nome_item}}"
                           data-marcaitem="{{$bens->marca_item}}"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a class="btn btn-danger btn-xs" href="/bens-igreja/delete/{{$bens->id}}"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td align="center" style="color: #c9302c">Nenhum item cadastrado</td>
            </tr>
        @endif
    </table>

    {{ $bensIgreja->links() }}

    <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Atualizar Grupo</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/bens-igreja/{{!empty($bens->id) ? $bens->id : ''}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <input type="hidden" name="form" value="index">
                            <input type="hidden" name="id_bens" id="id_bens" >

                            <div class="form-group col-md-6">
                                <label for="">Nome do Item:</label>
                                <input type="text" id="nome_item" name="nome_item" class="form-control col-md-4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Marca:</label>
                                <input type="text" id="marca_item" name="marca_item" class="form-control col-md-4">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="/bens-igreja" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> -->
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
<script src="{{asset('js/jquery.maskMoney.js')}}" ></script>
<script src="{{asset('js/jquery.mask.js')}}" ></script>
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var nomeitem = button.data('nomeitem')
        var marcaitem = button.data('marcaitem')

        var modal = $(this)
        modal.find('.modal-title').text('Editar bens : ' + nomeitem)
        modal.find('#id_bens').val(recipient)
        modal.find('#nome_item').val(nomeitem)
        modal.find('#marca_item').val(marcaitem)
    })
</script>
@stop