<form action="{{url()->current()}}" method="GET" class="form-inline">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-search"></span>
            </div>
            <input type="text" class="form-control" name="search" placeholder="Pesquisar" value="{{\Request::get('search')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Pesquisar</button>
</form>
@if(count($table->rows()))
    <table class="table table-striped">
        <thead>
        <tr>
            @foreach($table->columns() as $column)
                <th>{{$column['label']}}</th>
            @endforeach
            @if(count($table->actions()))
                <th>Ações</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($table->rows() as $row)
            <tr>
                @foreach($table->columns() as $column)
                    <td>{{ $row->{$column['name']} }}</td>
                @endforeach
                @if(count($table->actions()))
                    <td>
                        @foreach($table->actions() as $action)
                            @include($action['template'], [
                                'row' => $row,
                                'action' =>$action,
                            ])
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $table->rows()->appends(['search' => \Request::get('search')])->links() !!}
@else
    <table class="table-responsive">
        <tr>
            <td>Nenhum registro encontrado</td>
        </tr>
    </table>
@endif
