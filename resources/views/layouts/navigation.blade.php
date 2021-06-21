<nav class="navbar navbar-expand-lg navigation">
        <!-- Logo --> 
        
        @if(Auth::check())
        @if(Auth::user()->type=='admin-systeme' || Auth::user()->type=='admin-structure')
        <a class="navbar-brand logo" href="{{ route('dashboard.index') }}">
            {{ __('GC - PAY') }}
        </a>
        @else
        <a class="navbar-brand logo" href="{{ route('home') }}">
            {{ __('GC - PAY') }}
        </a>
        @endif
        @else
        <a class="navbar-brand logo" href="{{ route('login') }}">
            {{ __('GC - PAY') }}
        </a>
        @endif

        <!-- Right Item -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <span class="nav-item nav-number">+223 20 55 36 14</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.facebook.com/">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Facebook.pn.png/120px-Facebook.pn.png" class="img-social-media" alt=""/>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.instagram.com/?hl=fr">
                        <img src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c521.png" class="img-social-media" alt=""/>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://twitter.com/?lang=fr">
                        <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/c/c8/Twitter_Bird.svg/1200px-Twitter_Bird.svg.png" class="img-social-media" alt=""/>
                    </a>
                </li>
            </ul>
        </div>
</nav>

<nav class="navbar navbar-expand-lg navigation">
        
    <!-- Left Item -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-center">

            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accueil') }}">
                        Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Notification 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Historique
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('entreprise.index')}}">
                        Entreprise
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        A propos 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav align-items-center">
            
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                </form>

                @if (Auth::check())
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
            @else
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        Inscription
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        Connexion 
                    </a>
                </li>
            </ul>
            @endif
        </ul>
    </div>            
</nav>
