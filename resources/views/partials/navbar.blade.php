@section('title', 'Navbar')

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<header>
    <nav id="header" class="navbar fixed-top navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="{{ url('/homepage') }}"><i id="logo" class="icon-logo align-middle"></i></a>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
            <i class="icon-menu"></i>
        </button>
        
        <div id="navbarCollapse" class="collapse navbar-collapse" >
            <section id="collapsed_profile" class="d-md-none d-flex flex-row justify-content-center align-items-center flex-wrap">
                <a class="nav-link" href="profile1.php"><i class="icon-user align-middle"></i></a>
                <section class="d-flex flex-column">
                    <span>{{Auth::user() -> name}}</span>
                    <span>{{Auth::user() -> student_number}}</span>
                </section>
            </section>

            <form id="search" class="form-inline my-2 my-lg-0" action="../actions/search.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button type="submit" class="btn btn-light"><i class="icon-search"></i></button>
            </form>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-message align-middle"></i></a>
                    <span class="d-md-none"> Messages</span>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="#"><i class="icon-user align-middle"></i></a>
                    <span class="d-md-none"> Profile</span>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link" href="#"><i class="icon-cu align-middle"></i></i></a>
                    <span> My CU's</span>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link" href="#"><i class="icon-manage_cu align-middle"></i></a>
                    <span> Manage CU's</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-question align-middle"></i></a>
                    <span class="d-md-none"> Help</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}"><i class="icon-log-out align-middle"></i></a> 
                    <span class="d-md-none"> Logout</span>
                </li>
            </ul>
        </div>
    </nav>
</header>