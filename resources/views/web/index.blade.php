<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/web.css')}}">
    <link rel="shortcut icon" href="{{asset('images/resources/icon.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Raleway:wght@700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>{{$title}}</title>
</head>
<body>
    <main>
        <header>
            <nav>
                <div class="navbar-logo">
                    <a href="#">
                        <img src="{{asset('images/resources/icon.png')}}" alt="logo">
                        <h5>MarkOsBab Dev</h5>
                    </a>
                </div>
                <ul class="navbar-menu">
                    <li><a href="#aboutUs">Acerca de</a></li>
                    <li><a href="knowladge">Conocimientos</a></li>
                    <li><a href="#">Proyectos</a></li>
                    <li><a href="#">Noticias</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
                <div class="navbar-hamburger" onclick="toggleMenu()">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </nav>
        </header>

        @include('web.pages.about-us')
        @include('web.pages.knowladge')
    </main>

    <script src="{{asset('js/web.js')}}"></script>
</body>
</html>