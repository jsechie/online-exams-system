{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
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
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Online Exams System Under Development
                </div>
            </div>
        </div>
    </body>
</html>
 --}}

 <!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
<title>Welcome</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Tutorage a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
{{-- <!-- menu -->
<link type="text/css" rel="stylesheet" href="{{asset('Welcome/css/cm-overlay.css')}}" />
//menu
<link href="{{asset('Welcome/css/jquery.fatNav.css')}}" rel="stylesheet" type="text/css"> --}}
<!--FlexSlider-->
<link rel="stylesheet" href="{{asset('Welcome/css/flexslider.css')}}" type="text/css" media="screen" />
<!--//FlexSlider-->
<!-- custom css theme files -->
<link rel="stylesheet" href="{{asset('Welcome/css/bootstrap.css')}}" type="text/css" media="all">
<link rel="stylesheet" href="{{asset('Welcome/css/font-awesome.css')}}" />
<link rel="stylesheet" href="{{asset('Welcome/css/style.css')}}" type="text/css" media="all">
<!-- //custom css theme files -->
<!-- google fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- //google fonts -->
</head>
<!-- Body -->
<body>
<!-- banner -->
<section class="w3l-banner">
<div class="wthree-dot">
    <!-- //Header -->
        <div class="container">
            <div class="flexslider-info">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                            <div class="w3l-info">
                                <h3>get started with our online exams system.</h3>
                                <p>We have the perfect examination system for you. Visit Your Portal.</p><br>
                                <div class="row">
                                    <div class="col-md-6"><a href="{{url('/login')}}" class="btn btn-danger btn-block btn-lg"><h4>Students Portal</h4></a></div>
                                    <div class="col-md-6"><a href="{{url('admin/login')}}" class="btn btn-primary btn-block btn-lg"><h4>Lecturers Portal</h4></a></div>
                                </div>
                                
                                
                            </div>
                            </li>
                            {{-- <li>
                                <div class="w3l-info">
                                <h2>Making best future popular education</h2>
                                <p>We have the perfect accommodation for you.</p>
                                
                            </div>
                            </li>
                            <li>
                                <div class="w3l-info">
                                <h3>Start Learning For successful future</h3>
                                <p>We have the perfect accommodation for you.</p>
                                
                            </div>
                            </li> --}}
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- //footer -->
<!-- Default-JavaScript-File -->
    <script type="text/javascript" src="{{asset('Welcome/js/jquery-2.2.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Welcome/js/bootstrap.js')}}"></script>
<!-- //Default-JavaScript-File -->
<!--menu script-->
<script type="text/javascript" src="{{asset('Welcome/js/modernizr-2.6.2.min.js')}}"></script>
    
<!--Start-slider-script-->
    <script defer src="{{asset('Welcome/js/jquery.flexslider.js')}}"></script>
        <script type="text/javascript">
        
        $(window).load(function(){
          $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
              $('body').removeClass('loading');
            }
          });
        });
      </script>
<!--End-slider-script-->
</body>
<!-- //Body -->
</html>