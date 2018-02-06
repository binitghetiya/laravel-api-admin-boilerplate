<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="{{ Request::is( '*home*') ? "active" : ""}}"><a href="{{config('app.url')}}/admin/home"><span>Home</span></a></li>
            <li class="treeview {{ Request::is( '*/user_management/*') ? "active" : ""}}">
                <a href="{{config('app.url')}}/admin/user_management"><span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu {{ Request::is( '*/user_management/*') ? "menu-open" : ""}}" style="{{ Request::is( '*/user_management/*') ? "" : "display: none;"}}">
                    <li><a href="{{config('app.url')}}/admin/user_management/create" style="{{ Request::is( '*/user_management/create*') ? "color:white" : ""}}">User Create</a></li>
                    <li><a href="{{config('app.url')}}/admin/user_management/list" style="{{ Request::is( '*/user_management/list*') ? "color:white" : ""}}">User List</a></li>
                </ul>
            </li> 
        </ul>
    </section>
</aside>