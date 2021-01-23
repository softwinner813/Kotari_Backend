<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>House|Room</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .carousel-item {
              height: 100vh;
              min-height: 350px;
              background: no-repeat center center scroll;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
        </style>


        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <script type="text/javascript" src="/js/lib/dummy.js"></script>

        <link rel="stylesheet" type="text/css" href="/css/result-light.css">

          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
          <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script id="insert"></script>

    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background-color: #0000003b!important;color: white;">
          <div class="container" >
            <a class="navbar-brand" href="#" style="color: white;font-size: 25px;">Kotari</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">

                @guest
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('login') }}"  style="color: white;text-decoration: underline;">Login
                        <!-- <span class="sr-only">(current)</span> -->
                      </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}" style="color: white;text-decoration: underline;">Register</a>
                </li>

                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('dashboard') }}" style="color: white;text-decoration: underline;">Admin</a>
                </li>
                @endif
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li> -->
              </ul>
            </div>
          </div>
        </nav>

        <header>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <!-- Slide One - Set the background image for this slide in the line below -->
              <div class="carousel-item active" style="background-image: url('/image/slide1.jpg')">
                <div class="carousel-caption d-none d-md-block">
                  <!-- <h2 class="display-4">First Slide</h2>
                  <p class="lead">This is a description for the first slide.</p> -->
                </div>
              </div>
              <!-- Slide Two - Set the background image for this slide in the line below -->
              <div class="carousel-item" style="background-image: url('/image/slide2.jpg')">
                <div class="carousel-caption d-none d-md-block">
                  <!-- <h2 class="display-4">Second Slide</h2>
                  <p class="lead">This is a description for the second slide.</p> -->
                </div>
              </div>
              <!-- Slide Three - Set the background image for this slide in the line below -->
              <div class="carousel-item" style="background-image: url('/image/slide3.jpg')">
                <div class="carousel-caption d-none d-md-block">
                  <!-- <h2 class="display-4">Third Slide</h2>
                  <p class="lead">This is a description for the third slide.</p> -->
                </div>
              </div>


              <!-- Slide Four - Set the background image for this slide in the line below -->
              <div class="carousel-item" style="background-image: url('/image/slide4.jpg')">
                <div class="carousel-caption d-none d-md-block">
                  <!-- <h2 class="display-4">Third Slide</h2>
                  <p class="lead">This is a description for the third slide.</p> -->
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
          </div>
        </header>

    </body>
</html>
