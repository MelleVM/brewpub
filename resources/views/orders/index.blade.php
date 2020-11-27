@extends('app')

@section('content')

<div class="container orders-container">

<div class="table-wrapper">
    <div class="table-header">
        <h1 class="page-title">Orders</h1>

        <a href="/orders/create" class="btn btn-yellow"><i class="ri-add-line"></i> CREATE ORDER</a>

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


@endsection
