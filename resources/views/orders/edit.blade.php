@extends('app')

@section('content')

<div class="container edit-order-container">
    {!! Form::open(['method' => 'GET', 'id' => 'search-form', 'url' => route(Route::currentRouteName(), $order->id), 'role'=>'search']) !!}
    {!! Form::close() !!}

    {{ Form::open(['url' => route('orders.update', $order->id), 'class' => 'edit-order-form', 'method' => 'put']) }}

    <h1 class="page-title">Edit Order</h1>

    @csrf
    <div class="form-group">
        <select name="table_id" id="table_id">
            @foreach($tables as $table)
            <option @if($order->table_id == $table->id) selected @endif value="{{$table->id}}">TABLE
                {{ $table->number }}</option>
            @endforeach
        </select>
        <select name="employee_id" id="employee_id">
            @foreach($employees as $employee)
            <option @if($order->employee_id == $employee->id) selected @endif
                value="{{$employee->id}}">{{$employee->role->title}} - {{ $employee->name }}</option>
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
                                @foreach($selected_products as $prod)
                                @if($prod['id'] === $product->id)
                                <?php 
                                                $checked = $product->id;
                                            ?>
                                @endif
                                @endforeach

                                @if(isset($checked) && $checked == $product->id)
                                {{ Form::checkbox("products[$product->id][id]", $product->id, true) }}
                                @else
                                {{ Form::checkbox("products[$product->id][id]", $product->id, false) }}
                                @endif
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
                                @foreach($selected_products as $prod)
                                @if($prod['id'] === $product->id)
                                <?php 
                                            $quantity = $prod['quantity'];
                                        ?>
                                @endif
                                @endforeach

                                @if(isset($quantity))
                                {{ Form::number("products[$product->id][quantity]", $quantity, ['class' => 'quantity']) }}
                                @else
                                {{ Form::number("products[$product->id][quantity]", 1, ['class' => 'quantity']) }}
                                @endif
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
