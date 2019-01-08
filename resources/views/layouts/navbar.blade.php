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
                    <li class="nav-item {{(Request::is(['admin', 'recept', 'lab/upload', 'doctor', 'pharmacy']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin">DASHBOARD</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept">DASHBOARD</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor">DASHBOARD</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab/upload"><i class="ti-home"></i>LAB REPORT</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy">DASHBOARD</a>
                        @else
                            <a><i></i></a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/user_register', 'recept/queue', 'lab/upload/view', 'doctor/patients', 'pharmacy/addDrugs']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/user_register">USER REGISTRATION</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/queue">QUEUE</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor/patients">PATIENTS</a>
                        @elseif(Request::is(['lab', 'lab/*']))
                            <a class="nav-link" href="/lab/upload/view"><i class="ti-home"></i>DETAILS OF REPORT</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/addDrugs"><i class="ti-home"></i>ADD DRUG</a>
                        @endif
                    </li>
                    <li class="nav-item {{(Request::is(['admin/users', 'recept/patient_register' , 'doctor/labreports', 'pharmacy/emailSend']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/users">USERS</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patient_register">PATIENT REGISTRATION</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor/labreports">LAB REPORTS</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/emailSend"><i class="ti-home"></i>Email Send</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="#"><i class="ti-home"></i>PHARMACY</a>
                        @endif
                    </li>

                    <li class="nav-item {{(Request::is(['admin/patients', 'recept/patients', 'doctor/appointments', 'pharmacy/viewdrugs']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <a class="nav-link" href="/admin/patients">PATIENTS</a>
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/patients">PATIENTS</a>
                        @elseif(Request::is(['doctor', 'doctor/*']))
                            <a class="nav-link" href="/doctor/appointments">APPOINTMENTS</a>
                        @elseif(Request::is(['pharmacy', 'pharmacy/*']))
                            <a class="nav-link" href="/pharmacy/viewdrugs"><i class="ti-home"></i>DETAIL OF DRUGS</a>
                        @endif
                    </li>

                    <li class="nav-item {{(Request::is(['admin/appointments','recept/appointments']) ? 'active' : '')}}">
                        @if(Request::is(['admin', 'admin/*']))
                            <!-- <a class="nav-link" href="/admin/appointments">APPOINTMENTS</a> -->
                        @elseif(Request::is(['recept', 'recept/*']))
                            <a class="nav-link" href="/recept/appointments"><i class="ti-home"></i>APPOINTMENTS</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>

            <!-- End navigation menu -->
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