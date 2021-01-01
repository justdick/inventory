@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Check Receipt</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('already_paid'))
                            <div class="alert alert-warning col-8" role="alert">
                                {{session('already_paid')}}
                            </div>
                        @endif

                        @if(session('received'))
                            <div class="alert alert-success col-8" role="alert">
                               {{session('received')}}
                            </div>
                        @endif

                        @if(session('invalid_receipt'))
                            <div class="alert alert-danger col-8" role="alert">
                                {{session('invalid_receipt')}}
                            </div>
                        @endif

                        <h4 class="card-title">Receipt details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{route('receipt.check')}}" method="POST">
                                    @csrf
                                    <label>Receipt No.</label>
                                    <div class="form-group d-flex mr-2">
                                        <input type="number" min="1" placeholder="Please Enter Receipt Number" value="{{$cart[0]['receipt_id'] ?? ''}}" name="receipt_id" class="form-control mr-3 ">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br/>
                        @isset ($orders)

                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
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
                                            $qty = 0;
                                        @endphp

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order['customer_name']}}</td>
                                                <td>{{$order['customer_phone']}}</td>
                                                <td>{{$order['brand_name']}}</td>
                                                <td>{{$order['model_name']}}</td>
                                                <td>{{$order['price']}} GHS</td>
                                                <td>{{$order['quantity']}} Pieces</td>
                                                <td>{{$order['price'] * $order['quantity']}} GHS</td>
                                                {{-- <td>
                                                    <button type="submit" class="btn add btn-primary">Add to orderrt</button>
                                                </td> --}}
                                            </tr>
                                            @php
                                                $gt = $gt + ($order['price'] * $order['quantity']);
                                                $qty += $order['quantity'];
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <br><br>
                            <div class="d-flex">
                                <h2 class="mr-3">Grand Total: <span class="total">{{$gt ?? ''}}</span> GHS</h2>
                                {{-- <button type="submit" class="btn btn-primary received" data-toggle="modal" data-target="#myModal" aria-expanded="false">Payment Received</button> --}}
                            </div>
                        @endisset

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@isset ($orders)
    <div id="myModal" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">

                    <h4>Please Confirm you have received and amount of</h4> <h2 class="mtotal"> </h2><br>
                    Click Yes to confirm. <br>
                    Close to Cancel.

                    <div class="m-t-20">
                        <form method="POST" action="check_receipt/{{$orders[0]["receipt_id"]}}">
                            @csrf
                            <input type="hidden" name="total" class="amount_total">
                            <input type="hidden" name="quantity" value="{{$qty}}">
                            <button type="submit" class="btn btn-success text-white">Yes</button>
                        </form>

                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset

<script>
    $('.received').click(function(){
        $('.mtotal').text($('.total').text() + ' GHS');
        $('.amount_total').val($('.total').text());
    });
</script>
@endsection
