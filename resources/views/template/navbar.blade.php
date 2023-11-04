<div class="header">

    <div class="header-left">
        <a href="https://www.csab.edu.ph/" class="logo">
            <img src="https://www.csab.edu.ph/wp-content/uploads/2023/09/logo22.png" alt="logo">
            {{--            <img src="{{asset("assets/img/logo.png")}}" alt="Logo">--}}
        </a>
        <a href="index-2.html" class="logo logo-small">
            <img src="{{asset("assets/img/logo-small.png")}}" alt="Logo">
        </a>
    </div>

    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>


    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>


    <ul class="nav user-menu">


        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<span class="user-img">
<img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-02.jpg")}}" width="31" alt="Ryan Taylor">
<div class="user-text">
<h6>John Doe</h6>
<p class="text-muted mb-0">Administrator</p>
</div>
</span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{asset("assets/img/profiles/avatar-01.jpg")}}" alt="User Image"
                             class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>Ryan Taylor</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="profile.html">Settings</a>
                <a class="dropdown-item" href="/">Logout</a>
            </div>
        </li>

    </ul>

</div>
