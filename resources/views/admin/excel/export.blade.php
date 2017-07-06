@extends('admin.layout.index')
    
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Export list staff </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('note'))
                    <div class="alert alert-success">
                        {{session('note')}}
                    </div>
                    @endif
                     <div class="col-lg-7" style="padding-bottom:120px">
                        <form role="form" action="admin/excel/export" method="POST">
                            <fieldset>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="department"   >
                                        @foreach($department as $de)
                                        <option value={{$de->id}}>{{$de->name}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                <button type="submit" class="btn btn-lg btn-success btn-block">Export</button>
                            </fieldset>
                        </form>
                    </div>                
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
@endsection