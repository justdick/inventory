<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStockRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('add_stocks', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(AddStockRequest $request)
    {
        $data = $request->validated();
        $product_id = (int) array_key_last($request->all());

        Stock::create([
            'product_id' => $product_id,
            'quantity' =>  $data['quantity']
        ]);

        $product = Product::find($product_id);
        $product->quantity_available += $data['quantity'];
        $product->save();

        return redirect()->route('product.index')->with('updated', 'Stocks Added successfully for ' . $product->brand_name . ' ' . $product->model_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
