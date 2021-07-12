<nav class="navbar navbar-expand-lg navigation dashboard-nav">
    <!-- Logo -->
    <a class="navbar-brand logo" href="{{route('accueil')}}">
        {{ __('GC - PAY') }}
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-center">
            
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            </form>

            <!-- Settings Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative; padding-left:50px">
                    @if (photo_profil())
                        <img src="{{ photo_profil() }}" style="width:32px;height:32px;position:absolute; top:10px;left:10px; border-radius:50%">
                    @else
                        <img src='/storage/profil_pictures/default.jpg' style='width:32px;height:32px;position:absolute; top:10px;left:10px; border-radius:50%'/>
                    @endif
                    {{ Auth::user()->email }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profil', Auth::user()->email) }}">
                        Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        Parametre
                    </a>
                    <div class="dropdown-divider"></div>
                    @if (Auth::user()->type == "admin-systeme" || Auth::user()->type == "admin-structure")
                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                            Deconnexion
                        </a>
                    </form>

                </div>
            </li>
        </ul>
    </div>   

</nav>
