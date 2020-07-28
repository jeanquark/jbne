<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSFR token for ajax call -->
    {{-- <meta name="_token" content="{{ csrf_token() }}"/> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JBNE Admin</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('css/font-awesome-4.7.0.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet" type="text/css">

    <!-- SweetAlert -->
    <link href="{{ asset('back/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.css" rel="stylesheet" /> --}}

    <!-- noUiSlider -->
    <link href="{{ asset('back/nouislider/nouislider.min.css') }}" rel="stylesheet" />

    <!-- Toastr notifications -->
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('front/toastr/toastr.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        body {
            height: 100%;
            background-color: #fff;
        }
        .side-nav>li>ul>.active {
            color: yellow;
            background-color: #080808;
        }
        .side-nav>li>ul>.active>a {
            color: #fff;
        }
    </style>

    @yield('css')

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">&larr; Retour vers le site</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::guard('member')->user()->firstname }} {{ Auth::guard('member')->user()->lastname }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="{{ active_class(if_route(['member.profile.show', 'member.profile.edit'])) }}">
                            <a href="{{ route('member.profile.show', ['id' => Auth::guard('member')->user()->id ])}}"><i class="fa fa-black-tie"></i> Profile</a>
                        </li>
                        <li>
                            {{-- <a href="javascript: submitform()">
                                {!! Form::open(array('url' => '/logout', 'name' => 'logout')) !!}
                                    <i class="fa fa-power-off"></i> Logout
                                {!! Form::close() !!}
                            </a> --}}
                            <a href="{{ route('member.logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="{{ active_class(if_route(['back.index'])) }}">
                        <a href="{{ route('back.index') }}"><i class="fa fa-fw fa-tachometer-alt"></i> Admin</a>
                    </li>
                    {{-- <li class="{{ active_class(if_route(['back.pages.index', 'back.pages.show', 'back.pages.show', 'back.pages.edit'])) }}">
                        <a href="{{ route('back.pages.index') }}"><i class="fa fa-file-text"></i> Gestion du contenu</a>
                    </li> --}}
                    {{-- <li class="{{ active_class(if_route(['back.permanences.index'])) }}">
                        <a href="{{ route('back.permanences.index') }}"><i class="fa fa-calendar"></i> Gestion des permanences</a>
                    </li> --}}
                    <li class="{{ active_class(if_route(['back.calendar.index', 'back.calendar.create', 'back.calendar.show', 'back.calendar.edit'])) }}">
                        <a href="{{ route('back.calendar.index') }}"><i class="fa fa-calendar"></i> Calendrier</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.permanences.index', 'back.permanences.edit'])) }}">
                        <a href="{{ route('back.permanences.index') }}"><i class="fa fa-calendar-check"></i> Permanences</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.members.index', 'back.members.create', 'back.members.show', 'back.members.edit'])) }}">
                        <a href="{{ route('back.members.index') }}"><i class="fa fa-users"></i> Gestion des membres</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.lawyers.index', 'back.lawyers.create', 'back.lawyers.show', 'back.lawyers.edit'])) }}">
                        <a href="{{ route('back.lawyers.index') }}"><i class="fa fa-user-tie"></i> Gestion des avocats</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.lawyers-office.index', 'back.lawyers-office.show', 'back.lawyers-office.create', 'back.lawyers-office.edit'])) }}">
                        <a href="{{ route('back.lawyers-office.index') }}"><i class="fa fa-building"></i> Gestion des Études d'avocats</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.formulaire-contacts.index', 'back.formulaire-contacts.show'])) }}">
                        <a href="{{ route('back.formulaire-contacts.index') }}"><i class="fa fa-comments"></i> Gestion des messages (<?php echo App\FormulaireContact::where('is_read', '=', 0)->count(); ?>)</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.roles.index', 'back.roles.create', 'back.roles.show', 'back.roles.edit'])) }}">
                        <a href="{{ route('back.roles.index') }}"><i class="fa fa-id-badge"></i> Gestion des rôles</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.permissions.index', 'back.permissions.create', 'back.permissions.show', 'back.permissions.edit'])) }}">
                        <a href="{{ route('back.permissions.index') }}"><i class="fa fa-key"></i> Gestion des permissions</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.files.index'])) }}">
                        <a href="{{ route('back.files.index') }}"><i class="fa fa-file-pdf"></i> Fichiers partagés</a>
                    </li>
                    <li class="{{ active_class(if_route(['back.activities.index', 'back.activities.create', 'back.activities.show', 'back.activities.edit', 'back.agenda.index', 'back.team.index', 'back.trainees.index'])) }}">
                        <a href="javascript:;" data-toggle="collapse" data-target="#pages"><i class="fa fa-file-alt"></i> Gestion du contenu <i class="fa fa-fw fa-caret-down"></i></a>
                        {{-- <ul id="content" class="collapse"> --}}
                        <ul id="pages" <?php if (substr(Route::currentRouteName(), 0, 7) == 'back.ac' || substr(Route::currentRouteName(), 0, 7) == 'back.ag' || substr(Route::currentRouteName(), 0, 7) == 'back.te' || substr(Route::currentRouteName(), 0, 7) === 'back.tr') echo 'class="collapse collapse in"'; else echo 'class="collapse"'; ?>>
                            <li class="{{ active_class(if_route(['back.activities.index', 'back.activities.create', 'back.activities.show', 'back.activities.edit'])) }}">
                                <a href="{{ route('back.activities.index') }}"><i class="fa fa-wine-glass"></i> Activités</a>
                            </li>
                            <li class="{{ active_class(if_route(['back.agenda.index', 'back.agenda.create', 'back.agenda.show', 'back.agenda.edit'])) }}">
                                <a href="{{ route('back.agenda.index') }}"><i class="fa fa-calendar"></i> Agenda</a>
                            </li>
                            <li class="{{ active_class(if_route(['back.team.index', 'back.team.create', 'back.team.show', 'back.team.edit'])) }}">
                                <a href="{{ route('back.team.index') }}"><i class="fa fa-users"></i> Comité</a>
                            </li>
                            <li class="{{ active_class(if_route(['back.trainees.index', 'back.trainees.create', 'back.trainees.show', 'back.trainees.edit'])) }}">
                                <a href="{{ route('back.trainees.index') }}"><i class="fa fa-user-tie"></i> Avocats-stagiaires</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! $message !!}
                    </div>
                    {{ Session::forget('success') }}
                @endif

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

            </div><!-- /.container-fluid -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- jQuery -->
    {{-- For an unknown reason, file management does not work when providing local jQuery --}}
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    
    <!-- SweetAlert -->
    <script src="{{ asset('back/sweetalert/sweetalert.min.js') }}"></script>
    {{-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.all.min.js"></script> --}}

    <!-- noUiSlider -->
    <script src="{{ asset('back/nouislider/nouislider.min.js') }}"></script>
    
    <!-- Toastr notifications -->
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script src="{{ asset('front/toastr/toastr.min.js') }}"></script>
    {!! Toastr::render() !!}

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
