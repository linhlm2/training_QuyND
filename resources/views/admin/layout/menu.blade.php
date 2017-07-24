<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{route('admin.staff.list.get')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('admin.staff.list.get')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Staff<span class="fa arrow"></span></a>  
                        </li>
                        <li>
                            <a href="{{route('admin.department.list.get')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Department<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.position.list.get')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Position<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.staff.resetaccount.get')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Reset muti password account<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="{{route('user.edit.get')}}"><i class="fa fa-bar-chart-o fa-fw"></i> User Area<span class="fa arrow"></span></a>
                        </li>
                        
                                            </ul>
                </div>
                <!-- /.sidebar-collapse -->
</div>
