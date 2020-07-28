<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBNE - Login Avocats stagiaires</title>

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
            background-color: #9f1853;
        }        
        .btn-link {
            color: #918f90;
        }
        .btn-link:hover {
            color: #9f1853;
        }
    </style>
</head>

<body class="login-page">
    <div class="container">
        <div class="row">
            <br /><br /><br />
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><img src="{{ asset('images/logo2.png') }}" width="30px" /> - Login Membres & Avocats stagiaires - Veuillez entrer vos informations de connexion</div>
                    <div class="panel-body">
                            
                        {!! Form::open(array('route' => 'member.login.submit', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'member_login')) !!}
                            
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Erreur:</strong> {!! $message !!}
                                </div>
                                {{ Session::forget('error') }}
                            @endif

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse e-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="submitButton">
                                        Login&nbsp;
                                        <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i>
                                    </button>

                                    <a class="btn btn-link" href="{{ route('member.password.request') }}">
                                        Mot de passe oublié?
                                    </a>
                                    
                                    {{-- <a class="btn btn-link" href="{{ route('home') }}">
                                        Retour au site
                                    </a> --}}
                                </div>
                            </div>
                            {{--  --}}
                            <a class="btn btn-link pull-left" href="{{ route('home') }}">
                                &larr; Retour au site
                            </a>
                            {{-- <a class="btn btn-link pull-right" href="{{ route('member.register') }}">
                                S'enregistrer &rarr;
                            </a> --}}
                        {!! Form::close() !!}
                        {{-- </form> --}}
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    
</body>

</html>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Toastr notifications -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::render() !!}


<script>
    $(document).ready(function() {
        $("#member_login").submit(function( event ) {
            console.log('click submit');
            $("#submitButton").attr("disabled", true);
            $("#spinner").removeAttr('style');
        });
    });
</script>