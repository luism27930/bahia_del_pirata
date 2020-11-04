<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bahia del Pirata</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
          
            html, body {
                background-image:url("images/background.jpg");
                color: #ffffff;
                font-family: 'Nunito', sans-serif;
                font-weight: 600;
                height: 100vh;
                margin: 0;
        
            }
      
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #ffffff;
                font-family: 'Nunito', sans-serif;
                font-weight: 600;
                padding: 0 25px;
                font-size: 20px;
                height: 100vh;
                margin: 0;
                text-decoration: none;

            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    
                        <a href="{{ url('/home') }}">Ir al Menú</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar sesión</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('login') }}">Registrarme</a>
                        @endif --}}
                    @endauth
                </div>
            @endif
            <div class="content" style="margin-top: -30%">
                <div class="title m-b-md">
                    ¡Bienvenido a la Bahía del Pirata!
                </div>
                <div>
                  <h2>  Inicia sesión para que empieces a guardar tus videos favoritos y descargarlos cuando quieras! </h2>
                </div>
            </div>
        </div>
    </body>
</html>
