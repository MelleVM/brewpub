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


        </div>
        <div class="table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Table</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->table->number }}</td>
                        <td>{{ $order->employee->name }}</td>
                        <td>
                            @if($order->status === 0)
                            <b class="text-orange">
                                <div class="display-flex flex-align-center"><i
                                        class="ri-loader-3-fill"></i>&nbsp;&nbsp;In progress</div>
                            </b>
                            @elseif($order->status === 1)
                            <b class="text-green">
                                <div class="display-flex flex-align-center"><i
                                        class="ri-check-line"></i>&nbsp;&nbsp;Ready</div>
                            </b>
                            @elseif($order->status === 2)
                            <b class="text-blue">
                                <div class="display-flex flex-align-center"><i
                                        class="ri-bank-card-line"></i>&nbsp;&nbsp;Paid</div>
                            </b>
                            @endif
                        </td>
                        <td class="td-actions">

                            {{ Form::open(['url' => route('orders.edit', $order->id), 'method' => 'put']) }}
                            {{-- {{ Form::submit('DELETE', ['class' => 'btn btn-edit']) }} --}}
                            <select onchange="this.form.submit()" name="status" id="status">
                                <option @if($order->status === 0) selected @endif name="0" value="0">In Progress
                                </option>
                                <option @if($order->status === 1) selected @endif name="1" value="1">Ready</option>
                                <option @if($order->status === 2) selected @endif name="2" value="2">Paid</option>
                            </select>
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
