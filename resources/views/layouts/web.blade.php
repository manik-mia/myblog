<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title> @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/common/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" media="all">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/templatemo-stand-blog.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/owl.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">

  </head>

  <body>


    <!-- Header -->
    @include('frontend.header')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          @yield('content')
          
        </div>
      </div>
    </section>
    @include('frontend.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Additional Scripts -->
    <script src="{{asset('assets/frontend/js/custom.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.js')}}"></script>
    <script src="{{asset('assets/frontend/js/slick.js')}}"></script>
    <script src="{{asset('assets/frontend/js/isotope.js')}}"></script>
    <script src="{{asset('assets/frontend/js/accordions.js')}}"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>