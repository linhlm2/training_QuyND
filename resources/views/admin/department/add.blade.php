 @extends('admin.layout.index')
 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Department
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
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                        <form action="admin/department/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Name Department</label>
                                <input class="form-control" name="name" placeholder="fill name department"  />
                            </div>
                            <div class="form-group">
                                <label>Adress Department</label>
                                <input class="form-control" name="adress" placeholder="fill adress department"  />
                            </div>
                            <div class="form-group">
                                <label>Phone Department</label>
                                <input class="form-control" name="phone" placeholder="fill phone department"  />
                            </div>
                            <button type="submit" class="btn btn-default">department Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
 @endsection       