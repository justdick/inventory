<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Models\sales;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receipt_id = Receipt::create([]);

        $inputs = $request->except('_method', '_token');

        $receipt_product[] = [];
        $c=0;
        foreach ($inputs as $key=>$value) {

            foreach($value as $k=>$v){
                $total = (float) $v['price'] * $v['quantity'];
                $v['price'] = str_replace(' GHS','',$v['price']);

                Order::create($v + [
                    'customer_name' => $inputs['cart'][0]['customer_name'],
                    'customer_phone' => $inputs['cart'][0]['customer_phone'],
                    'receipt_id' => $receipt_id->id,
                    'served_by' => Auth::id(),
                    'date' => Carbon::today()->toDateString()
                ]);

                //update product quantity
                $product = Product::find($v['product_id']);
                $product->quantity_available = $product->quantity_available - $v['quantity'];
                $product->save();

                //convert to event and listeners on update
                //update sales account
                $sales = sales::where(['user_id' => Auth::id(), 'date' => Carbon::today()->toDateString()])->first();
                if ($sales === null) {
                    sales::create([
                        'user_id' => Auth::id(),
                        'date' => Carbon::today()->toDateString(),
                        'total' => $total
                    ]);

                }else{
                    // dd($total);
                    $sales->update([
                        'total' => $sales->total + $total,
                    ]);
                }
            }
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function receipt()
    {
        $last_receipt = Receipt::latest()->first();
        $orders = $last_receipt->orders;

        foreach($orders as $order){
            Arr::add($order, 'price', $order->product->price);
            Arr::add($order, 'brand_name', $order->product->brand_name);
            Arr::add($order, 'model_name', $order->product->model_name);
        }
        return view('print_receipt', compact('orders'));
    }
}
