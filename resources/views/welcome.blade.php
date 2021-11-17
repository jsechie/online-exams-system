<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
<title>Welcome</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="online exams" />
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
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
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