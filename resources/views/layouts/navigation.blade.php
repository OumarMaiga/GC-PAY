<nav class="navbar navbar-expand-lg navigation">
        <!-- Logo --> 
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_small.png') }}" style=" width: 100px;" >
            </a>

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
                    <a class="nav-link" href="{{ route('notification.list') }}">
                        Notification <?= (number_notification()) ? "<span class='badge badge-danger badge-notif'>".number_notification()."</span>" : "" ?>
                    </a>
                </li>
                @if(Auth::user()->type=='usager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('historique.list') }}">
                            Historique
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('usager.entreprise')}}">
                            Entreprise
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
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
            
                <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search') }}">
                <input class="form-control mr-sm-2" type="search" placeholder="Recherche service" name="search">
                
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
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profil', Auth::user()->email) }}">
                            {{ (Auth::user()->prenom || Auth::user()->nom) ? Auth::user()->prenom." ".Auth::user()->nom : Auth::user()->email }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            Parametre
                        </a>
                        <div class="dropdown-divider"></div>
                        @if (Auth::user()->type == "admin-systeme" || Auth::user()->type == "admin-structure" || Auth::user()->type == "agent")
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
