@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Yearly Report</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="POST" class="select_year">
                                    @csrf
                                    <label>Select Month</label>
                                    <div class="form-group d-flex mr-2">
                                        <select name="year" class="form-control year" required>
                                            <option value="2020" {{$year == '2020' ? 'selected': ''}}>2020</option>
                                            <option value="2021" {{$year == '2021' ? 'selected': ''}}>2021</option>
                                            <option value="2022" {{$year == '2022' ? 'selected': ''}}>2022</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br/>
                        @isset ($amount_months)
                            <h5 class="page-title">Yearly Sales for {{$year}}</h5>
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
            var action = "http://localhost:8000/reports/yearly/" + $(".year").val();
            $('.select_year').attr('action', action);

        });
    });
</script>


@isset($amount_months)
    <script>
        $(document).ready(function(){
            //Morris chart
            // Bar Chart
            var barChartData = {
                labels: ['January','February','March','April','May','June','July','August','September','October','November','December' ],
                datasets: [{
                    label: 'GHC',
                    backgroundColor: 'rgba(204, 0, 102, 0.5)',
                    borderColor: 'rgba(204, 0, 102, 1)',
                    borderWidth: 1,
                    data: @JSON($amount_months)
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
