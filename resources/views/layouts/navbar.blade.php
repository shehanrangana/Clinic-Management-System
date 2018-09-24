<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    @if(Request::is(['admin', 'admin/*']) || Request::is(['recept', 'recept/*']) || Request::is(['doctor', 'doctor/*']))
                        <a href="/admin"><i class="ti-home"></i>Dashboard</a>
                    @else
                        <a href="#"><i></i></a>
                    @endif
                </li>
                
                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/user_register"><i class="ti-home"></i>User Registration</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="index.html"><i class="ti-home"></i>Patient Registration</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Patients</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"><i class="ti-home"></i>Users</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="index.html"><i class="ti-home"></i>Patients</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"><i class="ti-home"></i>Patients</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="index.html"><i class="ti-home"></i>Appointments</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Lab Reports</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"><i class="ti-home"></i>Appointments</a>
                    @endif
                </li>

                <li class="has-submenu" >
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                    @endif
                </li>
                
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->