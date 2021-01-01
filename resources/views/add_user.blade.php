@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add User</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form action="{{route('user.store')}}" method="POST">
                @csrf
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success col-8" role="alert">
                                   {{session('success')}}
                                </div>
                            @endif
                            <h4 class="card-title">User details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                    </div>

                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role:</label>
                                        <select class="form-control" name="role" required>
                                            <option value="" readonly></option>
                                            <option value="Admin"> Admin</option>
                                            <option value="Sales">Sales</option>
                                        </select>
                                    </div>

                                    @if ($errors->has('role'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" placeholder="Will be used for login purposes" name="username" value="{{old('username')}}" required>
                                    </div>

                                    @if ($errors->has('username'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control " name="password" required>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">

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
