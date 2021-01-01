@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Confirm Sales</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('success'))
                            <div class="alert alert-success col-8" role="alert">
                                {{session('success')}}
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning col-8" role="alert">
                                {{session('warning')}}
                            </div>
                        @endif

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

                                        @foreach ($unapproved_sales as $sales)
                                            <tr>
                                                <td>{{$sales['name']}}</td>
                                                <td>{{$sales['username']}}</td>
                                                <td>{{$sales['date']}}</td>
                                                <td class="total_amount">{{$sales['total']}} GHS</td>
                                                <td>
                                                    <div class="d-flex">

                                                        <form method="POST" action="details">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{$sales['user_id']}}">
                                                            <input type="hidden" name="date" value="{{$sales['date']}}">
                                                            <button type="submit" class="btn btn-warning mr-2">View Details</button>
                                                        </form>

                                                        <form method="POST" action="{{route('sales.update', $sales['id'])}}" onsubmit="return confirm('Please click Ok to confirm approval');">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" id="{{$sales['id']}}" class="btn btn-primary approve" data-toggle="modal" data-target="#myModal" aria-expanded="false">
                                                                Approve
                                                            </button>
                                                        </form>


                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $gt = $gt + $sales['total_amount'];
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

    <div id="myModal" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">

                    <h4>Please confirm accounts of  </h4> <h2 class="gtotal"> </h2><br>
                    <h4>for <span class="name"></span> dated  <span class="date"></span> </h4>
                    <br><br>
                    Click Yes to confirm. <br>
                    Close to Cancel.

                    <div class="m-t-20">
                        <form class="mapprove" method="POST" action="">
                            @csrf
                            @method("PATCH")
                            <button type="submit" class="btn btn-success text-white">Yes</button>
                        </form>

                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.approve').click(function(){
            $('.name').text($(this).closest('tr').find('td:eq(0)').text());
            $('.date').text($(this).closest('tr').find('td:eq(2)').text());
            $('.gtotal').text($(this).closest('tr').find('td:eq(3)').text());

            var action = "http://localhost:8000/user/accounts/" + $(this).attr('id');
            $('.mapprove').attr('action', action);

        });
    </script>
@endsection
