@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Confirmed Sales</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="card-box">
                Default Selects First day of current Month to today <br/><br/>
                <form action="/sales/search" method="POST">
                    @csrf
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                            <div class="form-group select-focus">
                                <label class="focus-label">Cashier</label>
                                <select class="select" name="cashier" required>
                                    <option value="all" {{$cashier == 'all' ? 'selected' : ''}}>All</option>
                                    @foreach ($usernames as $username)
                                        <option value="{{$username['id']}} {{$cashier == $username ? 'selected' : ''}} ">{{$username['username']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                            <div class="form-group">
                                <label class="focus-label">From</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="from" value="{{$first_day}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                            <div class="form-group">
                                <label class="focus-label">To</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="to" value="{{$today}}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                            <input type="submit" href="#" class="btn btn-success btn-block mb-1 mt-3" value="Search">
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">

                        <h4 class="card-title">Sales details</h4>

                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $gt = 0;
                                    @endphp

                                    @foreach ($approved_sales as $sales)
                                        <tr>
                                            <td>{{$sales['name']}}</td>
                                            <td>{{$sales['username']}}</td>
                                            <td>{{$sales['date']}}</td>
                                            <td class="total_amount">{{$sales['total']}} GHS</td>
                                            <td>
                                                <div class="d-flex">

                                                    <form method="POST" action="{{route('sales_details')}}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$sales['user_id']}}">
                                                        <input type="hidden" name="date" value="{{$sales['date']}}">
                                                        <button type="submit" class="btn btn-warning mr-2">View Details</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $gt = $gt + $sales['total'];
                                        @endphp
                                    @endforeach
                                    @php
                                        session(['totalAmount' => $gt]);
                                    @endphp
                                </tbody>
                            </table>
                        </div>

                        <br><br>
                        <div class="d-flex">
                            <h2 class="mr-3">Grand Total: <span class="total">{{$gt ?? ''}}</span> GHS</h2>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection
