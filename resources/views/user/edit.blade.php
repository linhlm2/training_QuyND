@extends('user.layout.index')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Name: {{$staff->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ URL::route('user.edit.post') }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                            @if(session('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                            @endif
                            @if(session('note'))
                            <div class="alert alert-success">
                                {{session('note')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="fill name staff" value="{{$staff->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" placeholder="fill Birthday" value="{{$staff->birthday}}" />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" placeholder="fill Address" value="{{$staff->address}}" />
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" placeholder="fill Country" value="{{$staff->country}}" />
                            </div>
                            <div class="form-group">
                                <label>Sex :</label>
                                <input type="radio" name="sex" value="{{constants::MALE}}" @if($staff->sex == constants::MALE) echo checked @endif> Male
                                <input type="radio" name="sex" value="{{constants::FEMALE}}"> Female<br>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" placeholder="fill Phone" value="{{$staff->phone}}" />
                            </div>                  
                            <div class="form-group">
                                <label>Fill Password if you want change</label>
                                <input class="form-control" name="password" placeholder="fill Password" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="fill Mail" value="{{$staff->email}}" />
                            </div>
                            <button type="submit" class="btn btn-default">save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection