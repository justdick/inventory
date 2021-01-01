@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Stocks for {{$product->brand_name}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form class="stockform" method="POST" action="{{route('stock.store', $product->id)}}">
                @csrf
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">

                            <h4 class="card-title">Stock details</h4>
                            <div class="row">
                                <input type="hidden" name="drug_id" class="drug_id" required>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand Name:</label>
                                        <input type="text" class="form-control brand_name" name="brand_name" value="{{$product->brand_name}}" required readonly>
                                    </div>

                                    @if ($errors->has('brand_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('brand_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model Name:</label>
                                        <input type="text" class="form-control brand_company" name="model_name" value="{{$product->model_name}}" required readonly>
                                    </div>

                                    @if ($errors->has('model_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('model_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity:</label>
                                        <input type="text" class="form-control quantity" name="quantity" value="{{old('quantity')}}" required>
                                    </div>

                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>

    $(document).ready(function() {
        table = $('.drugstable').DataTable();

        // var cartrowid = 0;

        $('.table tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $('.drug_id').val($(this).closest('tr').find('td:eq(0)').attr('id'));
            $('.brand_name').val(data[1]);
            $('.brand_company').val(data[2]);
            $('.generic_name').val(data[3]);
            $('.wholesale_price').val(parseFloat(data[4]));
            $('.price').val(parseFloat(data[5]));
            $('.type').val(data[7]);
        } );


        Echo.channel('stockAdded')
            .listen('.stockAddedEvent', (data) =>{
                // alert('fff');
                $.each( data.data, function(key, value) {
                    $('#'+this.id+'q').html(this.quantity + ' Pieces');
                });

                //refresh datatable
                table.destroy();

                table = $('.drugstable').DataTable();
        });



        $('.stockform').on('submit',function(e){
            e.preventDefault();
            // alert($('.stockform').serialize());
            $.ajax({
                url: "{{route('stocks.store')}}",
                type:"POST",
                data:$('.stockform').serialize(),
                success:function(response){
                    $('.stockform')[0].reset();
                    alert(JSON.stringify(response));
                },
                error:function(error){
                    console.log(error);
                }
            });
        });
    } );
</script> --}}
@endsection
