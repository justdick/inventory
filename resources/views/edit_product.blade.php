@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Product</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form action="{{route('product.update', $product['id'])}}" method="POST" style="height: 100vh">
                @csrf
                @method('PATCH')
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Product details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Brand Name:</label>
                                            <input type="text" class="form-control" placeholder="Eg. Nokia" name="brand_name" value="{{$product['brand_name']}}" readonly>

                                        </div>

                                        @if ($errors->has('brand_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('brand_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model Name:</label>
                                        <input type="text" class="form-control" placeholder="Eg. Nokia 3310" name="model_name" value="{{$product['model_name']}}" required>
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
                                        <label>Unit Price:</label>
                                        <input type="number" step="0.5" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="price" value="{{$product['price']}}" required>
                                    </div>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
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
@endsection
