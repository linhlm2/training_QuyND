@extends('admin.layout.index')
    
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
                    @if(session('note'))
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
                                <th>department</th>
                                <th>position</th>
                                <th>email</th>
                                <th>admin</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id}}</td>
                                <td>{{$tl->name}}</td>
                                <td>{{$tl->birthday}}</td>
                                <td>{{$tl->address}}</td>
                                <td>{{$tl->country}}</td>
                                <td>{{$tl->sex}}</td>
                                <td>{{$tl->phone}}</td>
                                <td>{{$tl->department->name}}</td>
                                <td>{{$tl->position->name}}</td>
                                <td>{{$tl->email}}</td>
                                <td>{{$tl->is_admin}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/staff/delete/{{$tl->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/staff/edit/{{$tl->id}}">Edit</a></td>
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