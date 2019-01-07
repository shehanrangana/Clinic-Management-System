<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav nav-pills nav-fill">
                    <li class="nav-item {{(Request::is(['admin', 'recept', 'doctor','lab' ,'pharmacy']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin">DASHBOARD</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept">DASHBOARD</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor">DASHBOARD</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab">DASHBOARD</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy">DASHBOARD</a>
                        @else
                            <a><i></i></a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/user_register', 'recept/queue', 'doctor/patients', 'lab/upload','pharmacy/addDrugs']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/user_register">USER REGISTRATION</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/queue">QUEUE</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor/patients">PATIENTS</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab/upload"><i class="ti-home"></i>LAB REPORT</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/addDrugs"><i class="ti-home"></i>ADD DRUG</a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/users', 'recept/patient_register', 'doctor/labreports', 'lab/upload/view','pharmacy/searchPrescription']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/users">USERS</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patient_register">PATIENT REGISTRATION</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor/labreports">LAB REPORTS</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab/upload/view"><i class="ti-home"></i>DETAILS OF REPORT</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab/upload/view"><i class="ti-home"></i>DETAILS OF REPORT</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/searchPrescription"><i class="ti-home"></i>SEARCH PRESCRIPTION</a>
                        @endif
                    </li>

                    <li class="nav-item {{(Request::is(['admin/patients', 'recept/patients','pharmacy/viewdrugs']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/patients">PATIENTS</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patients">PATIENTS</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/viewdrugs"><i class="ti-home"></i>DETAIL OF DRUGS</a>
                        @endif
                    </li>

                    <li class="nav-item {{(Request::is(['admin/appointments']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/appointments">APPOINTMENTS</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/appointments">APPOINTMENTS</a>
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
</div> <!-- end navbar -->

<style>
.navbar {
    padding: 0;
}
.bg-light {
    background-color:#212121!important;
}
.navbar-custom .container-fluid {
    padding-left: 0;
    padding-right: 0;
}
.navbar-dark .navbar-nav .nav-link {
    padding: 15px 30px;
}
.nav-pills .nav-link {
    transition:0.2s;
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 18px;
}
.active {
    background: #0064b7;
}
.nav-item::after{
    content:'';
    display:block;
    width:0px;
    height:2px;
    background:#fff;
    transition: 0.2s;
}
.nav-item:hover::after{
    width:100%;
}
</style>