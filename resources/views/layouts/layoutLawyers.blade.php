<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>JBNE - Disponibilité des avocats</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Google indexing -->
    <meta name="google-site-verification" content="G39Uml7mXCH_53xNipqlliuSAk17kHpxul5eYuExM1I" />
    
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Toastr notifications -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

    <!-- Theme CSS -->
    <link href="{{ asset('css/agency.css') }}" rel="stylesheet">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-71694605-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-71694605-6');
    </script>

    @yield('css')

    <style>
        /*.navbar .navbar-default {
            background-color: ;    
        },*/
        .navbar-default .navbar-brand {
            color: #fff;
        }
        .navbar-default .navbar-nav>li>a {
            color: #fff;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            /*background-color: #FF543B;*/
            /*background-color: #918f90;*/
            /*background-color: var(--secondary-color);*/
            background-color: var(--tertiary-color);
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top" style="background-color: var(--primary-color);">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    &larr; Retour sur le site
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guard('lawyer')->guest())
                        <li><a href="{{ route('lawyer.login') }}">Login</a></li>
                        <li><a href="{{ route('lawyer.register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                               {{ Auth::guard('lawyer')->user()->firstname }} {{ Auth::guard('lawyer')->user()->lastname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('lawyer.index') }}"><i class="fa fa-black-tie"></i> Mes infos</a></li>
                                <li><a href="{{ route('lawyer.logout') }}"><i class="fa fa-power-off"></i> Se déconnecter</a></li>
                                {{-- <li><a href="{{ route('lawyer.logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Se déconnecter 2
                                    </a>

                                    <form id="logout-form" action="{{ route('lawyer.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li> --}}
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!-- /.collapse navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <div class="container-fluid" style="">
        @if ($errors->any())        
            <div class='flash alert alert-danger alert-dismissable'> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                @foreach ( $errors->all() as $error )               
                    <p>{{ $error }}</p>         
                @endforeach     
            </div>  
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Erreur:</strong> {!! $message !!}
            </div>
            {{ Session::forget('error') }}
        @endif
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Avertissement:</strong> {!! $message !!}
            </div>
            {{ Session::forget('error') }}
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! $message !!}
            </div>
            {{ Session::forget('success') }}
        @endif
    </div><!-- /.container-fluid -->

    @yield('content')

    {{-- @if(Auth::guard('web')->check())
        <p class="text-success">
            You are logged In as a <strong>USER</strong>
        </p>
    @else
        <p class="text-danger">
            You are Logged Out as a <strong>USER</strong>
        </p>
    @endif
    @if(Auth::guard('lawyer')->check())
        <p class="text-success">
            You are logged In as a <strong>LAWYER</strong>
        </p>
    @else
        <p class="text-danger">
            You are Logged Out as a <strong>LAWYER</strong>
        </p>
    @endif --}}

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <!-- Toastr notifications -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="{{ asset('front/toastr.min.js') }}"></script> --}}
    {!! Toastr::render() !!}

    @yield('scripts')

</body>

</html>
