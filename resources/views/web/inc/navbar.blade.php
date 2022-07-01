<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand 
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        -->
        <div class="navbar-header">
            <a class="navbar-brand me-2" href="{{ url('/') }}">
            <img
                src="https://upload.wikimedia.org/wikipedia/id/4/44/Logo_PENS.png"
                height="32"
                alt="PENS Logo"
                loading="lazy"
                style="margin-top: -1px;"
            />
            </a>
        </div>
        

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('program') }}">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('program.done') }}">Terlaksana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recap') }}">Rekap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Tentang</a>
                </li>
            </ul>
            <!-- Left links -->
                 
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest                
                    <li class="nav-item">
                        <a class="nav-link btn btn-link px-3 me-2 text-dark" href="{{ route('login') }}">                        
                            Login                        
                        </a>                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary me-2 text-white" href="{{ route('register') }}">                            
                            Register                                             
                        </a>           
                    </li>                
                @else                
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('donor.profile') }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>  
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
