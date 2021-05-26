<nav class="navbar navbar-expand-lg navigation">
        <!-- Logo -->
        <a class="navbar-brand logo" href="{{ route('dashboard') }}">
            {{ __('GC - PAY') }}
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
                    <a class="nav-link" href="#">
                        Acceuil
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
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Acceuil
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
                    <?php 
                        $filename=$_SERVER['DOCUMENT_ROOT']."/storage/profil_pictures/picture_user_1.jpg";
                        if(file_exists($filename))
                        {
                            echo" <img src='/storage/profil_pictures/picture_user_1.jpg' style='width:32px;height:32px;position:absolute; top:10px;left:10px; border-radius:50%'/> ";
                        }
                        else
                        {
                            echo" <img src='/storage/profil_pictures/default.jpg' style='width:32px;height:32px;position:absolute; top:10px;left:10px; border-radius:50%'/> ";
                        }
                    ?>
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
                <!--<div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="">
                                <div>{{ Auth::user()->email }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>-->
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
