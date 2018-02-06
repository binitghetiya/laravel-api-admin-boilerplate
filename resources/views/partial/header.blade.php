<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">{{config('app.name')}}</a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->

                        @if(Session::get('user')['profile_picture'])
                        <img src="{{Session::get('user')['profile_picture']}}" class="user-image" alt="User Image"/>
                        @else
                        <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
                        @endif

                        @if(Session::get('admin')['name'])
                        <span class="hidden-xs">Welcome, {{Session::get('admin')['name']}}</span>
                        @else
                        <span class="hidden-xs">Welcome, Admin</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <!--                        <li class="user-header">
                                                    @if(Session::get('user')['profile_picture'])
                                                    <img src="{{Session::get('user')['profile_picture']}}" class="user-image" alt="User Image"/>
                                                    @else
                                                    <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
                                                    @endif
                                                    <p>{{(Session::get('user')['name']) ? Session::get('user')['name'] : 'Admin'  }}</p>
                                                </li>
                                                 Menu Body 
                                                <li class="user-body">
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Followers</a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Sales</a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Friends</a>
                                                    </div>
                                                </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{config('app.url')}}/admin/change_password" class="btn btn-primary btn-flat" style="width: 250px;">Change Password</a>
                                <a href="{{config('app.url')}}/admin/logout" class="btn btn-primary btn-flat" style="width: 250px;margin-top: 3px;">Sign out</a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script>
    Loading(true);
</script>