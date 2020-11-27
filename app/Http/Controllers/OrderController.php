<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Order;
use App\Models\Table;
use App\Models\Product;
use App\Models\Employee;
use DB;

class OrderController extends Controller
{
    public function index(Request $request) {
        $table_id = \Request::get('table_id');

        $data['orders'] = Order::with('Table')->with('Employee')->where('table_id', 'like', '%'.$table_id.'%')->get();
        $data['tables'] = Table::all();

        if($request->view === "waiter") {
            return view('orders.waiter', $data);
        } elseif($request->view === "bartender") {
            return view('orders.bartender', $data);
        }
    }

    public function create() {
        $search = \Request::get('search');

        $data['products'] = Product::where('name', 'like', '%'.$search.'%')->get();
        $data['tables'] = Table::all();
        $data['employees'] = Employee::with('Role')->get();

        return view('orders.create', $data);
    }

    public function edit(Request $request) {
        $search = \Request::get('search');

        $data['products'] = Product::where('name', 'like', '%'.$search.'%')->get();
        $data['order'] = Order::find($request->id);
        $data['order_product'] = DB::table('order_product')->where('order_id', $request->id)->get();
        $data['tables'] = Table::all();
        $data['employees'] = Employee::with('Role')->get();

        $selected_products = [];

        foreach($data['order_product'] as $op) {
            $selected_products[] = ['id' => $op->product_id, 'quantity' => $op->quantity];
        }

        $data['selected_products'] = $selected_products;

        return view('orders.edit', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(['table_id' => 'required', 'employee_id' => 'required', 'products' => 'required']);

        $order = Order::create([
            'table_id' => $validatedData['table_id'],
            'employee_id' => $validatedData['employee_id']
        ]);

        foreach($validatedData['products'] as $prod) {
            if(isset($prod['id'])) {
                $product = Product::find($prod['id']);
            }
            $quantity = $prod['quantity'];

            if(isset($product)) {
                $order->products()->attach($product, ['quantity' => $quantity]);
            }
        }

        return redirect(route('orders', "waiter"));
    }

    public function update(Request $request) {
        $order = Order::find($request->id);
        $validatedData = $request->validate(['table_id' => '', 'employee_id' => '', 'products' => '', 'status' => '']);

        if(isset($validatedData['table_id'])) {
            $order->table_id = $validatedData['table_id'];
        } 
        
        if(isset($validatedData['employee_id'])) {
            $order->employee_id = $validatedData['employee_id'];
        }
        
        if(isset($validatedData['status'])) {
            $order->status = $validatedData['status'];
        }

        $order->save();

        if(isset($validatedData['products'])) {
            $order->products()->detach();

            foreach($validatedData['products'] as $prod) {
                if(isset($prod['id'])) {
                    $product = Product::find($prod['id']);
                }
                $quantity = $prod['quantity'];

                if(isset($product)) {
                    $order->products()->attach($product, ['quantity' => $quantity]);
                    $order->products()->updateExistingPivot(
                                $product,
                                ['quantity' => $quantity]
                            );
                }
            }
        }

        if(isset($validatedData['status'])) {
            return back();
        } else {
            return redirect(route('orders', "waiter"));
        }
    }

    public function delete(Request $request) {
        $order = Order::find($request->id);
        $order->delete();

        return back();
    }
}
