@extends('admin.layout.index')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Department </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/department/edit/{{$department->id}}" method="POST">
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
                            @if(session('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="fill name department" value="{{$department->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Address Department</label>
                                <input class="form-control" name="address" placeholder="fill address department" value="{{$department->address}}" />
                            </div>
                            <div class="form-group">
                                <label>Phone Department</label>
                                <input class="form-control" name="phone" placeholder="fill phone department" value="{{$department->phone}}" />
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