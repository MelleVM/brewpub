@extends('app')

@section('content')

<div class="container container-center cm-create-order-container">
    <div class="page-title">
        <h1>Make an order!</h1>
    </div>
    <div class="sections">
        <div class="section">
            <div class="products">
                @foreach($products as $product)
                <div class="product">{{$product->name}}
                    <div class="product-add">
                        <i class="ri-add-circle-line"></i>
                    </div>
                </div>
                @endforeach
            </div>

            {{$table->id}}
        </div>
        <div class="section section-order-summary">
            <h2>Summary</h2>
            <div class="summary-products">
                <div class="summary-product">Product 1
                    <div class="price">$12.50</div>
                </div>
                <div class="summary-product">Product 1
                    <div class="price">$12.50</div>
                </div>
                <div class="summary-product">Product 1
                    <div class="price">$12.50</div>
                </div>
                <div class="summary-product">Product 1
                    <div class="price">$12.50</div>
                </div>
            </div>
            <div class="summary-total">
                Total
                <div class="price">$50.00</div>
            </div>
        </div>
        <div class="section"></div>
        <div class="section"></div>
    </div>
</div>

@endsection
