 @extends('admin.layout.index')
 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Staff
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
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
                        <form action="admin/staff/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="fill name staff"  />
                            </div>
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" placeholder="fill Birthday"  />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" placeholder="fill Address"  />
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" placeholder="fill Country"  />
                            </div>
                            <div class="form-group">
                                <label>Sex</label>
                                <select class="form-control" name="sex" placeholder="fill Sex" >
                                <option value="{{constants::MALE}}" >male</option>
                                <option value="{{constants::FEMALE}}" >female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" placeholder="fill Phone"  />
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department"   >
                                @foreach($department as $de)
                                <option value={{$de->id}}>{{$de->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" name="position"   >
                                @foreach($position as $po)
                                <option value={{$po->id}}>{{$po->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" placeholder="fill Password" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="fill Mail" />
                            </div>
                            <div class="form-group">
                                <label>Admin</label>
                                <select class="form-control" name="admin" placeholder="fill Admin" >
                                <option value="{{constants::ADMIN}}" >admin</option>
                                <option value="{{constants::USER}}" >user</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">staff Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
 @endsection       