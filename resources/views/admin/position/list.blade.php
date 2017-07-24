@extends('admin.layout.index')
    
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                         <h3 class="page-header">
                            <a href="{{route('admin.position.add.get')}}">Add Position</a>
                         </h3>
                    </div>
                    <div class="col-lg-12">
                        <h1 class="page-header"> List Position </h1>
                    </div>
                    <!-- /.col-lg-12 -->
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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID position</th>
                                <th>Name</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id}}</td>
                                <td>{{$tl->name}}</td>
                                @if(!in_array($tl->id,$poid))
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('admin.position.delete.get',$tl->id)}}"> Delete</a></td>
                                @else 
                                    <td class="center">can not delete</td>
                                @endif
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('admin.position.edit.get',$tl->id)}}">Edit</a></td>
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