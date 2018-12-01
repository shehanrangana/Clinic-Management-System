<div class="topbar" id="clock">
    <div class="row">
        <div class="col-sm" id="left-col">
            System Logo
        </div>
        <div class="col-sm" id="middle-col">
            <clock></clock>
        </div>
        <div class="col-sm" id="right-col">
            <div class="dropdown float-right">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="/images/users/avatar-3.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    <!-- Dynamically set route to profile and logout -->
                    <?php 
                        $route_profile = "#";
                        $route_logout = "#";
                        if(Request::is(['admin', 'admin/*'])){
                            $route_logout = "/admin/logout";
                            $route_profile = "/admin/profile";
                        }else if(Request::is(['recept', 'recept/*'])){
                            $route_logout = "/recept/logout";
                            $route_profile = "/recept/profile";
                        }else if(Request::is(['doctor', 'doctor/*'])){
                            $route_logout = "/doctor/logout";
                            $route_profile = "/doctor/profile";
                        }else if(Request::is(['nurse', 'nurse/*'])){
                            $route_logout = "/nurse/logout";
                            $route_profile = "/nurse/profile";
                        }else if(Request::is(['lab', 'lab/*'])){
                            $route_logout = "/lab/logout";
                            $route_profile = "/lab/profile";
                        }else if(Request::is(['pharmacy', 'pharmacy/*'])){
                            $route_logout = "/pharmacy/logout";
                            $route_profile = "/pharmacy/profile";
                        }
                        
                    ?>
                    <a class="dropdown-item" href="{{ $route_profile }}">Profile</a>
                    <a class="dropdown-item" href="{{ $route_logout }}">Log out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.topbar {
    height: auto;
    background-color: #212121;
    color: #fff;
}
.col-sm {
    height: auto;
    margin: auto;
}
#left-col {
    margin-left: 30px;
}
#middle-col {
    text-align: center;
    font-size: 28px;
    font-family: 'Roboto Condensed';
}
#right-col {
    margin-right: 30px;
}
.dropdown-menu {
    padding: 0.1em!important;
}
</style>