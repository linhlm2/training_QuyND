@extends('admin.layout.index')
    
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID Nhân viên</th>
                                <th>Họ Tên</th>
                                <th>ngày sinh</th>
                                <th>quê quán</th>
                                <th>dân tộc</th>
                                <th>giới tính</th>
                                <th>email</th>
                                <!--<th></th>-->
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($danhsach as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id_nv}}</td>
                                <td>{{$tl->hoten}}</td>
                                <td>{{$tl->ngaysinh}}</td>
                                <td>{{$tl->quequan}}</td>
                                <td>{{$tl->dantoc}}</td>
                                <td>{{$tl->gioitinh}}</td>
                                <td>{{$tl->email}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/xoa/{{$tl->id_nv}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$tl->id_nv}}">Edit</a></td>
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