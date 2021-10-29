<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/common/css/bootstrap.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/common/css/mdb.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/sidenav.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/responsive.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables-select.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/style.css')}}" media="all">
</head>
<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        @include('admin.header')
        @include('admin.sideNav')
        
        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>

<script type="text/javascript" src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/js/mdb.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/jquery.slimscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/sidebarmenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/sticky-kit.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/custom.min-2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/datatables-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/vendor/tinymce/jquery.tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/vendor/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/common/js/sweetalert2@11.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/backend/js/custom.js')}}"></script>
@yield('scripts')
</body>
</html>







