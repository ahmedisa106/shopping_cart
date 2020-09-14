<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/assets/admin')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>@lang('commonmodule::site.dashboard')</span>


                </a>

            </li>

            <li class=" treeview">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>@lang('commonmodule::site.products')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i>@lang('commonmodule::site.categories')</a>
                        <a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i>@lang('commonmodule::site.products')</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('users.index')}}">
                    <i class="fa fa-users"></i> <span>@lang('commonmodule::site.clients')</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>


            <li class=" treeview">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-gear"></i> <span>@lang('commonmodule::site.settings')</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        @foreach($config_cats as $cat)
                            <a href="{{url('admin-panel/showConfig/'.$cat->id)}}">
                                <i class=" fa fa-circle-o">

                                </i>
                                {{$cat->title}}

                            </a>
                        @endforeach
                    </li>
                </ul>
            </li>


            <li>
                <a href="{{route('languages.index')}}">
                    <i class="fa fa-th"></i> <span>@lang('commonmodule::site.languages')</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
