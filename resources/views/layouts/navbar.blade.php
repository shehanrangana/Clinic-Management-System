<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item {{(Request::is(['admin', 'recept', 'doctor']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin">Dashboard</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept">Dashboard</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor">Dashboard</a>
                        @else
                            <a><i></i></a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/user_register', 'recept/patient_register']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/user_register"></i>User Registration</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patient_register"><i class="ti-home"></i>Patient Registration</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="#"><i class="ti-home"></i>Patients</a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/users', 'recept/patients']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/users"></i>Users</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patients"><i class="ti-home"></i>Patients</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="index.html"><i class="ti-home"></i>Pharmacy</a>
                        @endif
                    </li>

                    <li class="nav-item {{(Request::is(['admin/patients']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/patients"></i>Patients</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="index.html"><i class="ti-home"></i>Appointments</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="index.html"><i class="ti-home"></i>Lab Reports</a>
                        @endif
                    </li>

                    <li class="has-submenu" >
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="index.html"></i>Appointments</a>
                        @endif
                    </li>

                    <li class="has-submenu" >
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="index.html"></i>Pharmacy</a>
                        @endif
                    </li>
                </ul>
            </div>
</nav>









        <!-- <div id="navigation"> -->
            <!-- Navigation Menu-->
            <!-- <ul class="navigation-menu">

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
                
                <li class="{{(Request::is(['admin/user_register', 'recept/patient_register']) ? 'has-submenu active' : '')}}">
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/user_register"></i>User Registration</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="/recept/patient_register"><i class="ti-home"></i>Patient Registration</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="#"><i class="ti-home"></i>Patients</a>
                    @endif
                </li>

                <li class="{{(Request::is(['admin/users', 'recept/patients']) ? 'has-submenu active' : '')}}">
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/users"></i>Users</a>
                    @elseif(Request::is(['recept', 'recept/*']))
                        <a href="/recept/patients"><i class="ti-home"></i>Patients</a>
                    @elseif(Request::is(['doctor', 'doctor/*']))
                        <a href="index.html"><i class="ti-home"></i>Pharmacy</a>
                    @endif
                </li>

                <li class="{{(Request::is(['admin/patients']) ? 'has-submenu active' : '')}}">
                    @if(Request::is(['admin', 'admin/*']))
                        <a href="/admin/patients"></i>Patients</a>
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
                
            </ul> -->
            <!-- End navigation menu -->
        <!-- </div> end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->

<style>
.nav-item::after{
    content:'';
    display:block;
    width:0px;
    height:2px;
    background:#fec400;
    transition: 0.2s;
}
.nav-item:hover::after{
    width:100%;
}

.nav-link{
    padding:7px 5px;
    transition:0.2s;
    font-size: 18px;
    font-family: sans-serif;
}
</style>