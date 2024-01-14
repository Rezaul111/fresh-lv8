
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item border-bottom border-white">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" >
                        @isset(Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image)}}" alt="user" class="rounded-circle" width="40">
                        @else
                            <img src="{{asset('/')}}admin/assets/images/users/2.jpg" alt="user" class="rounded-circle" width="40">
                        @endisset
                        <span class="ml-2">Logout</span> <i class="mdi mdi-logout m-r-5 m-l-5"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
                @if(Request::is('admin/*'))
                    <li class="sidebar-item">
                        <a class="sidebar-link  waves-effect waves-dark" href="{{url('admin/dashboard')}}" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="hide-menu">DASHBOARD</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-account-multiple-plus"></i>
                            <span class="hide-menu">User Management</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @role(['admin','manager'])
                            <li class="sidebar-item">
                                <a href="{{url('admin/resources')}}" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Resources</span>
                                </a>
                            </li>
                            @endrole
                            <li class="sidebar-item">
                                <a href="{{url('admin/permissions')}}" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Permissions</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{url('admin/roles')}}" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Roles</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{url('admin/users')}}" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout m-r-5 m-l-5"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

    </div>
    <!-- End Sidebar scroll-->
</aside>

