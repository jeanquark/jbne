<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBNE - Login Avocats</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}
    
    <!-- Toastr notifications -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    
    <link href="{{ asset('css/agency.css') }}" rel="stylesheet">

    <style>
        .login-page {
            background-color: var(--header-color);
        }        
        .btn-link {
            color: var(--secondary-color);
        }
    </style>
</head>

<body class="login-page">
    <div class="container">
        <div class="row">
            <br /><br /><br />
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><img src="{{ asset('images/logo2.png') }}" width="30px" /> - JBNE Login Avocats</div>

                    <div class="panel-body">
                        Bienvenue sur la page de login pour avocats. Vous pouvez ici vous enregistrer afin d'annoncer vos disponibilités pour la permanence d'avocats. Afin que vos données soient validées, vous devez bien entendu être un <b>avocat enregistré</b> dans le Canton de Neuchâtel.
                        <br /><br />
                        Commencez donc par vous enregistrer <a href="{{ route('lawyer.register') }}">ici</a>. 
                        Si toutefois vous disposez déjà d'un compte, veuillez entrer vos informations de connexion ci-dessous:
                        <br /><br />

                        {{--@if (session('confirmation-success'))
                            <div class="alert alert-success">
                                {{ session('confirmation-success') }}
                            </div>
                        @endif
                        @if (session('confirmation-danger'))
                            <div class="alert alert-danger">
                                {!! session('confirmation-danger') !!}
                            </div>
                        @endif--}}
                        
                        {{--@if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {!! session('error') !!}
                            </div>
                        @endif--}}


                        {{-- <form class="form-horizontal" method="POST" action="{{ route('lawyer.login.submit') }}"> --}}
                        {!! Form::open(array('route' => 'lawyer.login.submit', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'lawyer_login')) !!}

                            {{-- {{ csrf_field() }} --}}
                            
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Succès:</strong> {!! $message !!}
                                </div>
                                {{ Session::forget('success') }}
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Erreur:</strong> {!! $message !!}
                                </div>
                                {{ Session::forget('error') }}
                            @endif

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-5 control-label">Nom d'utilisateur</label>

                                <div class="col-md-5">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-5 control-label">Mot de passe</label>

                                <div class="col-md-5">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-5 col-md-offset-5">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary" id="submitButton">
                                        Login&nbsp;
                                        <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i>
                                    </button>

                                    <a class="btn btn-link" href="{{ route('lawyer.password.request') }}">
                                        Mot de passe oublié?
                                    </a>
                                    {{-- <a class="btn btn-link" href="{{ route('home', '#contact') }}">Un problème, une question?</a> --}}
                                </div>
                            </div>
                            {{--  --}}
                            <a class="btn btn-link pull-left" href="{{ route('home') }}">
                                &larr; Retour au site
                            </a>
                            <a class="btn btn-link pull-right" href="{{ route('lawyer.register') }}">
                                S'enregistrer &rarr;
                            </a>
                        {!! Form::close() !!}
                        {{-- </form> --}}
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->

        <div class="row">
            
        </div>
    </div><!-- /.container -->

</body>

</html>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Toastr notifications -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::render() !!}

<script>
    $("#lawyer_login").submit(function( event ) {
        console.log('click submit');
        $("#submitButton").attr("disabled", true);
        $("#spinner").removeAttr('style');
    });
</script>
