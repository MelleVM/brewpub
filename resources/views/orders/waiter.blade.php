@extends('app')

@section('content')

<div class="container orders-container">

<div class="table-wrapper">
    <div class="table-header">
            {!! Form::open(['method'=>'GET','url' => route(Route::currentRouteName(),
            Route::current()->parameters()['view'] ), 'role'=>'search']) !!}

            <select onchange="this.form.submit()" class="filter filter-table" name="table_id">
                <option selected disabled>Select Table</option>
                <option value="">All Tables</option>
                @foreach($tables as $table)
                <option @if(Request::get('table_id') == $table->id) selected @endif value="{{$table->id}}">Table {{ $table->number }}</option>
                @endforeach
            </select>

            {!! Form::close() !!}

        <a class="btn btn-create create-order-btn"><i class="ri-add-line"></i> CREATE ORDER</a>

    </div>
    <div class="table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Table</th>
                    <th>Employee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->table->number }}</td>
                    <td>{{ $order->employee->name }}</td>
                    <td class="td-actions">
                        <a class="btn btn-edit" href="{{route('orders.edit', $order->id)}}">EDIT</a>
                        {{ Form::open(['url' => route('orders.delete', $order->id), 'method' => 'delete', 'class' => 'form-delete']) }}
                        {{ Form::submit('DELETE', ['class' => 'btn btn-delete']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>

<div class="modal-parent select-table-modal-parent">
    <div class="modal select-table-modal">
        <div class="tables">
            @foreach($tables as $table)
            <a href="{{route('orders.create', $table->id)}}" class="table">{{$table->number}}</a>
            @endforeach
        </div>
    </div>
</div>

@endsection
