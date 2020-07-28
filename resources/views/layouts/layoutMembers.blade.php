<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Le site du Jeune Barreau neuchâtelois, avec sa composition, ses membres et son actualité">
    <meta name="author" content="">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>JBNE - Jeune Barreau Neuchâtelois</title>

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

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="{{ asset('css/agency.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-71694605-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-71694605-6');
    </script>

    <style>
        .item_name {
          width: 120px;
          overflow:hidden;
          white-space:nowrap;
          text-overflow: ellipsis;
        }

        .clickable {
          cursor: pointer;
        }

        .img-preview {
          background-color: #f7f7f7;
          overflow: hidden;
          width: 100%;
          text-align: center;
          height: 200px;
        }

        .hidden {
          display: none;
        }

        .square {
          width: 100%;
          padding-bottom: 100%;
          position: relative;
          border: 1px solid rgb(221, 221, 221);
          border-radius: 3px;
          // max-width: 210px;
          max-height: 210px;
        }
        .visible-xs .square {
          width: 60px;
        }
        .square > img {
          padding: 5px;
          position: absolute;
          max-width: 100%;
          max-height: 100%;
          margin: 0 auto;
          display: inline-block;
          vertical-align: middle;
        }
        .square > i {
          font-size: 80px;
          padding: 5px;
          position: absolute;
          top: calc(50% - 40px);
          left: calc(50% - 40px);
        }
        .visible-xs .square > i {
          font-size: 50px;
          padding: 0px auto;
          padding-top: 5px;
          top: calc(50% - 25px);
          left: calc(50% - 25px);
        }

        .caption {
          margin-top: 10px;
          margin-bottom: 20px;
        }
        .caption > .btn-group {
          width: 100%;
        }
        .caption > .btn-group > .item_name {
          width: calc(100% - 25px);
        }
        .caption > .btn-group > .dropdown-toggle {
          width: 25px;
        }
        .dropdown-menu {
          padding: 0px 0px;
        }
        .dropdown-menu>li>a {
          background-color: #ccc;
          color: #fff;
          padding: 20px;
        }
        .dropdown-menu>li>a:hover {
          color: #555;
          background-color: #e7e7e7;
        }
        .dropdown-menu>li>a.active {
          color: #555;
          background-color: #e7e7e7;
        }
        .navbar-custom {
          padding: 0px;
        }
        .navbar-brand {
          margin-top: -5px;
        }
        .navbar-default .navbar-nav .open .dropdown-menu>li>a {
          color: #555;
          padding: 10px;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
          color: #555;
          background-color: #e7e7e7;
        }
        ul .dropdown-menu {
          padding: 0px;
        }
    </style>

    @yield('css')
</head>

<body>
    <!-- Fixed navbar -->
    {{-- <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('home') }}">JBNE</a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('fichiers_en_partage') }}">Fichiers en partage</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" style="">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->email }}
                <span class="caret"></span></a>
                <ul class="dropdown-menu" style="">
                    <li><a class="" href="#"><i class="fa fa-black-tie"> Profil</i></a></li>
                    <li><a href="javascript: submitform()">
                        {!! Form::open(array('url' => '/logout', 'name' => 'logout')) !!}
                            <i class="fa fa-fw fa-power-off"></i> Logout
                        {!! Form::close() !!}
                    </a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> --}}

    {{-- <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">JBNE</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Présentation</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Activités</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Agenda</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Comité</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Nous contacter</a>
                    </li>
                    <li class="dropdown" style="">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->email }}
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="">
                            <li><a class="" href="back/index"><i class="fa fa-black-tie"> Admin</i></a></li>
                            <li><a href="fichiers-en-partage"><i class="fa fa-file-pdf-o"> Fichiers en partages</i></a></li>
                            <li><a href="javascript: submitform()">
                                {!! Form::open(array('url' => '/logout', 'name' => 'logout')) !!}
                                    <i class="fa fa-fw fa-power-off"></i> Logout
                                {!! Form::close() !!}
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav> --}}


    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background: #ccc; padding: 10px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" class="img-responsive" width="120px;" /></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown" style="">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::guard('member')->user()->email }}
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="">
                            @if (Entrust::hasRole('Admin'))
                                <li><a class="" href="{{ route('back.index') }}"><i class="fa fa-fw fa-dashboard"> Admin</i></a></li>
                            @endif
                            <li><a class="{{ active_class(if_route(['member.files'])) }}" href="{{ route('member.files') }}"><i class="fa fa-download"> Fichiers à télécharger</i></a></li>
                            <li><a class="{{ active_class(if_route(['member.profile.show'])) }}" href="{{ route('member.profile.show', ['id' => Auth::guard('member')->user()->id ]) }}"><i class="fa fa-black-tie"> Profil</i></a></li>
                            {{-- <li><a href="javascript: submitform()">
                              {!! Form::open(array('url' => '/logout', 'name' => 'logout')) !!}
                                <i class="fa fa-fw fa-power-off"></i>Logout
                              {!! Form::close() !!}
                            </a></li> --}}
                            <li><a href="{{ route('member.logout') }}"><i class="fa fa-fw fa-power-off"></i>Logout</a></li>
                            <li></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 100px;">
      <div class="row">
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
      </div><!-- /.row -->
    </div><!-- /.col-md-8 -->

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <!-- Plugin JavaScript -->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script> --}}

    <!-- Toastr notifications -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="{{ asset('front/toastr.min.js') }}"></script> --}}
    {!! Toastr::render() !!}

    <!-- Contact Form JavaScript -->
    {{-- <script src="js/jqBootstrapValidation.js"></script> --}}
    {{-- <script src="js/contact_me.js"></script> --}}

    <!-- Theme JavaScript -->
    {{-- // <script src="js/agency.min.js"></script> --}}
    <script src="{{ asset('js/agency.js') }}"></script>

    <!-- Logout button is embedded inside a form -->
    <script>
        // function submitform()
        // {
        //     document.logout.submit();
        // }
    </script>

    @yield('scripts')

</body>

</html>
