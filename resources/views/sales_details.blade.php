@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Sales Details</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title">Sales details</h4>

                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>DateTime</th>
                                            <th>Brand Name</th>
                                            <th>Model Name</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $gt = 0;
                                        @endphp

                                        @foreach ($sales_details as $details)
                                            <tr>
                                                <td>{{$details['created_at']}}</td>
                                                <td>{{$details['brand_name']}}</td>
                                                <td>{{$details['model_name']}}</td>
                                                <td>{{$details['price']}} GHS</td>
                                                <td>{{$details['quantity']}} Pieces</td>
                                                <td>{{$details['price'] * $details['quantity']}} GHS</td>
                                                {{-- <td>
                                                    <button type="submit" class="btn add btn-primary">Add to Cart</button>
                                                </td> --}}
                                            </tr>
                                            @php
                                                $gt = $gt + ($details['price'] * $details['quantity']);
                                            @endphp
                                        @endforeach

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
