<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use SplFixedArray;
use App\Models\sales;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monthly_index()
    {
        $month  = ''; $amount_days = [];
        return view('monthly_report', compact('month'));
    }

    public function monthly($month)
    {
        $date = Carbon::now();

        $reports = sales::whereYear('date', $date->year)
            ->whereMonth('date', $month)
            ->where('approved', 1)->get()
            ->groupBy('date');
            // ->sum('total_amount');//->get();\

        $amount_days = new SplFixedArray(31);

        //create dynamic variable (eg. day1)
        for($i=1; $i<=31; $i++){
            ${'day'. $i}  = 0;
        }

        //iterate and sum each day and assign to amount_days var
        foreach($reports as $report){
            foreach($report as $rep){
                //get day in date (eg. 27)
                $i = substr($rep->date, -2);
                $i = intval($i);

                ${'day' . $i} += $rep->total;
            }

            //assign day and total as key value pairs
            $amount_days[$i] = ${'day'.$i};
        }

        $amount_days = $amount_days->toArray();
        $month = Carbon::create()->month($month);
        $month = $month->format('F');

        return view('monthly_report', compact('amount_days', 'month') );
    }

    public function yearly_index()
    {
        $year = $amount_days = '';
        return view('yearly_report', compact('year'));
    }





    public function yearly($year)
    {
        $reports = sales::whereYear('date', $year)
            ->where('approved', 1)->get()
            ->groupBy(function($d) {
                return Carbon::parse($d->date)->format('m');
            });

        $months = $reports->keys();
        $amount_months = new SplFixedArray(12);

        $total = $c = 0;
        //iterate and sum each month and assign to amount_months variable
        foreach($reports as $report){
            foreach($report as $rep){
                $total += $rep->total;
            }

            $amount_months[$months[$c] - 1] = $total;
            $c++;

            //reset total after a month calculation
            $total = 0;

        }

        $amount_months = $amount_months->toArray();

        return view('yearly_report', compact('amount_months', 'year') );
    }

}
