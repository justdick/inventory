<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ReceiptController extends Controller
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
        return view('check_receipt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //print receipt
    public function print_receipt()
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


    //check recipt
    public function check(Request $request){
        $data = $request->validate([
            'receipt_id' => 'required|numeric'
        ]);

        $receipt = Receipt::whereKey($data['receipt_id'])->first();
        $orders = $receipt->orders;

        foreach($orders as $order){
            Arr::add($order, 'price', $order->product->price);
            Arr::add($order, 'brand_name', $order->product->brand_name);
            Arr::add($order, 'model_name', $order->product->model_name);
        }

        return view('check_receipt', compact('orders'));
    }
}
