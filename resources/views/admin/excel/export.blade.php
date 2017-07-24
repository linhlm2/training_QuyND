@extends('user.layout.index')
    
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Export list staff </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if(session('fail'))
                    <div class="alert alert-danger">
                        {{session('fail')}}
                    </div>
                    @endif
                     <div class="col-lg-7" style="padding-bottom:120px">
                        <form role="form" action="{{route('user.exportfile.post')}}" method="POST">
                            <fieldset>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Department: {{$department->name}}</label> 
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