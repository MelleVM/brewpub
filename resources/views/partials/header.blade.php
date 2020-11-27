<div class="header">
    <div class="header-container">
        <div class="menu-btn">
            <i class="ri-menu-4-fill"></i>
        </div>

        <div class="location">
            @if(Route::currentRouteName() === 'orders.create')
            ORDERS <i class="ri-arrow-right-s-line"></i> CREATE
            @elseif(Route::currentRouteName() === 'orders.edit')
            ORDERS <i class="ri-arrow-right-s-line"></i> EDIT
            @elseif(Route::currentRouteName() === 'orders' && in_array("waiter", Route::current()->parameters()))
            ORDERS <i class="ri-arrow-right-s-line"></i> WAITER
            @elseif(Route::currentRouteName() === 'orders' && in_array("bartender", Route::current()->parameters()))
            ORDERS <i class="ri-arrow-right-s-line"></i> BARTENDER
            @endif
        </div>
    </div>
</div>

<div class="nav-left">
    <div class="menu-btn">
        <i class="ri-menu-4-fill"></i>
    </div>

    <div class="logo-container">
        <img src="/storage/images/logo.png" alt="" class="logo">
    </div>

    <ul class="nav-links">
        <a href="{{ route('orders', "waiter") }}">
            <li class="nav-link @if(Route::currentRouteName() === 'orders' && Route::current()->
                parameters()['view'] === "waiter") active @endif"><i class="ri-file-list-line"></i> Waiter View</li>
        </a>
        <a href="{{ route('orders', "bartender") }}">
            <li class="nav-link @if(Route::currentRouteName() === 'orders' && Route::current()->
                parameters()['view'] === "bartender") active @endif"><i class="ri-file-list-line"></i> Bartender View</li>
        </a>
        {{-- <li class="nav-link create-order-btn @if(Route::currentRouteName() === 'orders.create') active @endif"><i
                class="ri-add-line"></i> Create Order</li> --}}
    </ul>
</div>
