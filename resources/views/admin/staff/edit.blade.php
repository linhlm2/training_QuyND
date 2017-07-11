@extends('admin.layout.index')
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
                        <form action="admin/staff/edit/{{$staff->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
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
<!--                                <input type="text" id="datepicker" class="form-control" name="birthday" value="{{$staff->birthday}}"   />  -->
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
<!--                                <select class="form-control" name="sex" placeholder="fill Sex" >
                                <option value="{{constants::MALE}}" @if($staff->sex == constants::MALE) echo selected @endif>male</option>
                                <option value="{{constants::FEMALE}}" @if($staff->sex == constants::FEMALE) echo selected @endif>female</option>
                                </select>-->
                                <input type="radio" name="sex" value="{{constants::MALE}}" @if($staff->sex == constants::MALE) echo checked @endif> Male
                                <input type="radio" name="sex" value="{{constants::FEMALE}}"> Female<br>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" placeholder="fill Phone" value="{{$staff->phone}}" />
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department"  value="{{$staff->department->name}}" >
                                @foreach($department as $de)
                                <option value={{$de->id}}>{{$de->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" name="position"  value="{{$staff->position->name}}" >
                                @foreach($position as $po)
                                <option value={{$po->id}}>{{$po->name}}</option>
                                @endforeach
                                </select>
                            </div>                    
                            <div class="form-group">
                                <label>Fill Password if you want change</label>
                                <input class="form-control" name="password" placeholder="fill Password" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="fill Mail" value="{{$staff->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Admin</label>
                                <select class="form-control" name="admin" placeholder="fill Admin" >
                                <option value="{{constants::ADMIN}}" @if($staff->is_admin == constants::ADMIN) echo selected @endif>admin</option>
                                <option value="{{constants::USER}}" @if($staff->is_admin == constants::USER) echo selected @endif>user</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>active</label>
                                <select class="form-control" name="active" placeholder="fill active"  >
                                <option value="{{constants::ACTIVE}}" @if($staff->active == constants::ACTIVE) echo selected @endif>actived</option>
                                <option value="{{constants::UNACTIVE}}" @if($staff->active == constants::UNACTIVE) echo selected @endif>unactive</option>
                                </select>
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
<!--  <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
  <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
  <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>-->
@endsection
