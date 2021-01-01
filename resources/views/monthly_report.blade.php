@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Monthly Report</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="POST" class="select_month">
                                    @csrf
                                    <label>Select Month</label>
                                    <div class="form-group d-flex mr-2">
                                        <select name="month" class="form-control month">
                                            <option value="01" {{$month == 'January' ? 'selected': ''}}>January</option>
                                            <option value="02" {{$month == 'February' ? 'selected': ''}}>February</option>
                                            <option value="03" {{$month == 'March' ? 'selected': ''}}>March</option>
                                            <option value="04" {{$month == 'April' ? 'selected': ''}}>April</option>
                                            <option value="05" {{$month == 'May' ? 'selected': ''}}>May</option>
                                            <option value="06" {{$month == 'June' ? 'selected': ''}}>June</option>
                                            <option value="07" {{$month == 'July' ? 'selected': ''}}>July</option>
                                            <option value="08" {{$month == 'August' ? 'selected': ''}}>August</option>
                                            <option value="09" {{$month == 'September' ? 'selected': ''}}>September</option>
                                            <option value="10" {{$month == 'October' ? 'selected': ''}}>October</option>
                                            <option value="11" {{$month == 'November' ? 'selected': ''}}>November</option>
                                            <option value="12" {{$month == 'December' ? 'selected': ''}}>December</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br/>
                        @isset ($amount_days)
                            <h5 class="page-title">Daily Sales for {{$month}}</h5>
                            <div class="col-sm-12">
                                <canvas id="bargraph"></canvas>
                            </div>
                        @endisset

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

    <script>
        $(document).ready(function(){
            $('.submit').click(function(){
                    var action = "http://localhost:8000/reports/monthly/" + $(".month").val();
                    $('.select_month').attr('action', action);

                });
        });
    </script>

    @isset($amount_days)
        <script>
            $(document).ready(function(){
                //Morris chart
                // Bar Chart
                var barChartData = {
                    labels: ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th','13th','14th','15th','16th','17th','18th','19th','20th','21st','22nd','23rd','24th','25th','26th','27th','28th','29th','30th','31st'],
                    datasets: [{
                        label: 'GHC',
                        backgroundColor: 'rgba(204, 0, 102, 0.5)',
                        borderColor: 'rgba(204, 0, 102, 1)',
                        borderWidth: 1,
                        data: @JSON($amount_days)
                    }]
                };

                var ctx = document.getElementById('bargraph').getContext('2d');
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                        }
                    }
                });
            });

        </script>
    @endisset


@endsection
