@extends('app')

@section('content')

<div class="container create-order-container">
    {!! Form::open(['method' => 'GET', 'id' => 'search-form', 'url' => route(Route::currentRouteName(),
    Route::current()->parameters() ), 'role'=>'search']) !!}
    {!! Form::close() !!}


    {{ Form::open(['url' => route('orders.store'), 'class' => 'create-order-form']) }}
    @csrf
    <h1 class="page-title">Create Order</h1>


    <div class="form-group">
        <select name="table_id" id="table_id">
            @foreach($tables as $table)
            <option @if(Route::current()->parameters()['table_id'] == $table->id) selected @endif
                value="{{$table->id}}">TABLE {{ $table->number }}</option>
            @endforeach
        </select>
        <select name="employee_id" id="employee_id">
            @foreach($employees as $employee)
            <option value="{{$employee->id}}">{{$employee->role->title}} - {{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="products-container">
        <div class="table-wrapper">
            <div class="table-header">

                <input value="{{Request::get('search')}}" placeholder="search" form="search-form" type="text" name="search" class="search">
                <button form="search-form" class="btn btn-search" type="submit"><i class="ri-search-2-line"></i></button>

            </div>
            <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{ Form::checkbox("products[$product->id][id]", $product->id) }}
                        </td>
                        <td>
                            @if(isset($product->cat_name))
                            {{$product->cat_name}}
                            @else
                            Unknown
                            @endif
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{price($product->price)}}</td>
                        <td>
                            {{ Form::number("products[$product->id][quantity]", 1, ['class' => 'quantity']) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-submit']) }}
    {{ Form::close() }}
</div>

@endsection
