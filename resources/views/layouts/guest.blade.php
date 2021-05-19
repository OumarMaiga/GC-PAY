<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <header class="bg-blue-800 shadow colo">
                
                
                <h1>GC-PAY</h1>
                
    
            <div class="droite">
                 <div classe="top">
                    <div class="haut2">
                        <p class="flotte">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Circle-icons-phone.svg/1200px-Circle-icons-phone.svg.png" alt=""/>
                        </p>
                        <p>+223 20 55 36 14</p>
                    </div>

                    <div >
                        <p class="flotte"><a href="https://www.facebook.com/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Facebook.pn.png/120px-Facebook.pn.png" alt=""/></p></a>
                    </div>
                    <div >
                        <p class="flotte"><a href="https://www.instagram.com/?hl=fr"><img src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c521.png" alt=""/></p></a>
                    </div>

                    <div >
                        <p class="flotte"><a href="https://twitter.com/?lang=fr"><img src="https://upload.wikimedia.org/wikipedia/fr/thumb/c/c8/Twitter_Bird.svg/1200px-Twitter_Bird.svg.png" alt=""/></p><a>
                    </div>

                </div>

                <div class="bas">
                    <div>
                    <a href="{{ route('register') }}"> <h1 class="haut2">INSCRIPTION</h1></a>
                    </div>
                    <div>
                    <a href="{{ route('login') }}"> <h1 class="haut2 bg-blue-800 noborder">CONNEXION</h1></a>
                    </div>
                    <div >
                        <p class="flotte"><a href=""><img src="https://cdn.pixabay.com/photo/2014/04/02/16/17/magnifying-glass-306823_960_720.png" alt=""/></p></a>
                    </div>
                    
                </div>
            </div>

                <div class="liens">
                <a class="underline text-white hover:text-gray-900" href="{{ route('login') }}"> 
                    {{ __('Acceuil') }}
                </a>
                </div>
                <div class="liens">
                <a class="underline  text-white hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('A propos') }}
                </a>
                </div>
                <div class="liens">
                <a class="underline  text-white hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Contact') }}
                </a>
                </div>
            </header> 
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <!-- BOOTSTRAP JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    </body>
</html>
