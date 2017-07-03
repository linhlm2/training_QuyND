@extends('user.layout.index')
    
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Danh sách nhân viên</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('note')}}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID staff</th>
                                <th>Name</th>
                                <th>birthday</th>
                                <th>address</th>
                                <th>country</th>
                                <th>sex</th>
                                <th>phone</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($view as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id}}</td>
                                <td>{{$tl->name}}</td>
                                <td>{{$tl->birthday}}</td>
                                <td>{{$tl->address}}</td>
                                <td>{{$tl->country}}</td>
                                <td>{{$tl->sex}}</td>
                                <td>{{$tl->phone}}</td>
                                <td>{{$tl->email}}</td>
                            </tr>
                         @endforeach   
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
@endsection