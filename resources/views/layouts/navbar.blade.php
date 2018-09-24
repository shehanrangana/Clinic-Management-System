<!-- MENU Start -->
<div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu" >
                                @if(Request::is('admin') || Request::is('recept') || Request::is('doctor'))
                                    <a href="index.html"><i class="ti-home"></i>Dashboard</a>
                                @else 
                                    <a href="index.html"><i></i></a>
                                @endif
                            </li>
                            
                            <li class="has-submenu" >
                                @if(Request::is('admin'))
                                    <a href="index.html"><i class="ti-home"></i>User Registration</a>
                                @elseif(Request::is('recept'))
                                    <a href="index.html"><i class="ti-home"></i>Patient Registration</a>
                                @elseif(Request::is('doctor'))
                                    <a href="index.html"><i class="ti-home"></i>Patients</a>
                                @endif
                            </li>

                            <li class="has-submenu" >
                                @if(Request::is('admin'))
                                    <a href="index.html"><i class="ti-home"></i>Users</a>
                                @elseif(Request::is('recept'))
                                    <a href="index.html"><i class="ti-home"></i>Patients</a>
                                @elseif(Request::is('doctor'))
                                    <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                                @endif
                            </li>

                            <li class="has-submenu" >
                                @if(Request::is('admin'))
                                    <a href="index.html"><i class="ti-home"></i>Patients</a>
                                @elseif(Request::is('recept'))
                                    <a href="index.html"><i class="ti-home"></i>Appointments</a>
                                @elseif(Request::is('doctor'))
                                    <a href="index.html"><i class="ti-home"></i>Lab Reports</a>
                                @endif
                            </li>

                            <li class="has-submenu" >
                                @if(Request::is('admin'))
                                    <a href="index.html"><i class="ti-home"></i>Appointments</a>
                                @endif
                            </li>

                            <li class="has-submenu" >
                                @if(Request::is('admin'))
                                    <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                                @endif
                            </li>
                            

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->