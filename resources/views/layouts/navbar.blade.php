<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="{{(Request::is(['admin', 'recept', 'doctor']) ? 'has-submenu active' : '')}}">
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin">Dashboard</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="/recept">Dashboard</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="/doctor">Dashboard</a>
                    @else
                        <a><i></i></a>
                    @endif
                </li>
                
                <li class="{{(Request::is(['admin/user_register']) ? 'has-submenu active' : '')}}">
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/user_register"></i>User Registration</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="#"><i class="ti-home"></i>Patient Registration</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="#"><i class="ti-home"></i>Patients</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/users"></i>Users</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="index.html"><i class="ti-home"></i>Patients</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"></i>Patients</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="index.html"><i class="ti-home"></i>Appointments</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Lab Reports</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"></i>Appointments</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"></i>Pharmacy</a>
                    @endif
                </li>
                
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->