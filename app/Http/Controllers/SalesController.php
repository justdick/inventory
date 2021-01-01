<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\sales;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $first_day = Carbon::now()->startOfMonth()->toDateString();
        $today = Carbon::now()->toDateString();
        $cashier = 'all';

        $approved_sales =  sales::where('approved', 1)
        ->whereBetween('date', [$first_day, $today])
        ->join('users', 'users.id', '=', 'sales.user_id')
        ->orderBy('sales.id', 'DESC')->get();

        //for filtering on front end
        $usernames = User::all();//->select('username' ,'id')->get();
        return view('all_sales', compact('approved_sales', 'usernames', 'first_day' , 'today', 'cashier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unapproved_sales =  sales::where('approved', 0)->join('users', 'users.id', '=', 'sales.user_id')
        ->select('sales.id', 'sales.total', 'sales.date', 'users.name', 'users.id as user_id', 'users.username')->get();

        return view('confirm_sales', compact('unapproved_sales'));
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
     * @param  \App\Models\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales $sale)
    {
        $sale->update([
            'approved' => 1
        ]);

        return back()->with('success', 'Sales Approved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales $sales)
    {
        //
    }


    //view sales details
    public function sales_details(Request $request)
    {
        $user = User::find($request->user_id);
        $sales_details = $user->orders()->where('date', $request->date)->get();

        foreach($sales_details as $details){
            Arr::add($details, 'price', $details->product->price);
            Arr::add($details, 'brand_name', $details->product->brand_name);
            Arr::add($details, 'model_name', $details->product->model_name);
        }

        return view('sales_details', compact('sales_details'));
    }


    //search with date and/or username
    public function search(Request $request)
    {
        $request->validate([
            'cashier' => 'required|string',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        if($request->cashier == 'all'){
            $approved_sales =  sales::where('approved', 1)
            ->whereBetween('date', [$request->from, $request->to])
            ->join('users', 'users.id', '=', 'sales.user_id')->orderBy('sales.id', 'DESC')
            ->get();
        }else{
            $approved_sales =  sales::where('approved', 1)
            ->whereBetween('date', [$request->from, $request->to])
            ->join('users', 'users.id', '=', 'sales.user_id')->orderBy('sales.id', 'DESC')
            ->get();
        }

        $first_day = $request->from;
        $today = $request->to;
        $cashier = $request->cashier;

        $usernames = User::all();
        // dd($usernames);
        return view('all_sales', compact('approved_sales', 'usernames', 'first_day' , 'today', 'cashier'));
    }
}
