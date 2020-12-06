<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBNE - Enregistrement Avocats</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/agency.css') }}" rel="stylesheet">

    <style>
        .login-page {
            background-color: var(--header-color);
        }

        .btn-link {
            color: var(--secondary-color);
        }

        /* Checkbox and Radio buttons */
        .form-group input[type="radio"],
        .form-group input[type="checkbox"] {
            display: none;
        }

        .form-group input[type="checkbox"]+.btn-group>label,
        .form-group input[type="radio"]+.btn-group>label {
            white-space: normal;
        }

        .form-group input[type="checkbox"]+.btn-group>label.btn-default,
        .form-group input[type="radio"]+.btn-group>label.btn-default {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .form-group input[type="radio"]+.btn-group>label span:first-child,
        .form-group input[type="checkbox"]+.btn-group>label span:first-child {
            display: none;
        }

        .form-group input[type="radio"]+.btn-group>label span:first-child+span,
        .form-group input[type="checkbox"]+.btn-group>label span:first-child+span {
            display: inline-block;
        }

        .form-group input[type="radio"]:checked+.btn-group>label span:first-child,
        .form-group input[type="checkbox"]:checked+.btn-group>label span:first-child {
            display: inline-block;
        }

        .form-group input[type="radio"]:checked+.btn-group>label span:first-child+span,
        .form-group input[type="checkbox"]:checked+.btn-group>label span:first-child+span {
            display: none;
        }

        .form-group input[type="checkbox"]+.btn-group>label span[class*="fa-"],
        .form-group input[type="radio"]+.btn-group>label span[class*="fa-"] {
            width: 15px;
            float: left;
            margin: 4px 0 2px -2px;
        }

        .form-group input[type="checkbox"]+.btn-group>label span.content,
        .form-group input[type="radio"]+.btn-group>label span.content {
            margin-left: 10px;
        }

        /* End::Checkbox and Radio buttons */
    </style>
</head>

<body class="login-page">
    <div class="container">
        <div class="row">
            <br /><br /><br />
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><img src="{{ asset('images/logo2.png') }}" width="30px" /> -
                        JBNE Enregistrement des Avocats</div>

                    <div class="panel-body">
                        @if (session('confirmation-success'))
                        <div class="alert alert-success">
                            {{ session('confirmation-success') }}
                        </div>
                        @endif
                        <span class="">Veuillez utiliser le formulaire ci-dessous pour vous enregistrer. Vous pourrez
                            ensuite nous transmettre vos semaines de disponibilité dans le cadre de la permanence des
                            avocats de la 1<sup>ère</sup> heure. En cas de problème ou de question, n'hésitez-pas à nous
                            <a href="{{ route('home', '#contact') }}">contacter</a>.</span>
                        <br /><br />
                        {{-- <form class="form-horizontal" method="POST" action="{{ route('lawyer.register.submit') }}">
                        --}}
                        {!! Form::open(array('route' => 'lawyer.register.submit', 'method' => 'POST', 'class' =>
                        'form-horizontal', 'id' => 'lawyer_registration')) !!}

                        {{-- {{ csrf_field() }} --}}

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ( $errors->all() as $error )
                            <strong>{{ $error }}</strong><br />
                            @endforeach
                        </div><!-- /.alert alert-danger -->
                        @endif

                        <h5 class="text-center">Informations de connexion:</h5>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Nom
                                d'utilisateur<br><small>(Identifiant de connexion)</small></label>
                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username"
                                    value="{{ old('username') }}" placeholder="" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse e-mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmation mot de
                                passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <hr>

                        <h5 class="text-center">Informations personnelles:<br />
                            <small class="">(Sert uniquement à prendre contact avec vous)</small>
                            <br />
                        </h5>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Nom</label>
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname"
                                    value="{{ old('lastname') }}" placeholder="" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">Prénom</label>
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname"
                                    value="{{ old('firstname') }}" placeholder="" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_mobile') ? ' has-error' : '' }}">
                            <label for="phone_mobile" class="col-md-4 control-label">Numéro de permanence (numéro de
                                tél. portable)</label>
                            <div class="col-md-6">
                                <input id="phone_mobile" type="text" class="form-control" name="phone_mobile"
                                    value="{{ old('phone_mobile') }}" placeholder="(079)-987-65-43" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('other_languages') ? ' has-error' : '' }}">
                            <label for="languages" class="col-md-4 control-label">Langues juridiques maîtrisées</label>
                            <div class="col-md-6">
                                <input type="checkbox" name="languages[]" id="french" value="français"
                                    autocomplete="off" disabled checked />
                                <div class="btn-group">
                                    <label for="french" class="btn btn-default">
                                        <span class="fa fa-check-square-o fa-lg"></span>
                                        <span class="fa fa-square-o fa-lg"></span>
                                        <span class="content">français</span>
                                    </label>
                                </div>

                                <input type="checkbox" name="languages[]" id="german" value="allemand"
                                    autocomplete="off" @if(is_array(old('languages')) && in_array('allemand',
                                    old('languages'))) checked @endif />
                                <div class="btn-group">
                                    <label for="german" class="btn btn-default">
                                        <span class="fa fa-check-square-o fa-lg"></span>
                                        <span class="fa fa-square-o fa-lg"></span>
                                        <span class="content">allemand</span>
                                    </label>
                                </div>

                                <input type="checkbox" name="languages[]" id="italian" value="italien"
                                    autocomplete="off" @if(is_array(old('languages')) && in_array('italien',
                                    old('languages'))) checked @endif />
                                <div class="btn-group">
                                    <label for="italian" class="btn btn-default">
                                        <span class="fa fa-check-square-o fa-lg"></span>
                                        <span class="fa fa-square-o fa-lg"></span>
                                        <span class="content">italien</span>
                                    </label>
                                </div>

                                <br /><br />

                                <input type="checkbox" name="languages[]" id="english" value="anglais"
                                    autocomplete="off" @if(is_array(old('languages')) && in_array('anglais',
                                    old('languages'))) checked @endif />
                                <div class="btn-group">
                                    <label for="english" class="btn btn-default">
                                        <span class="fa fa-check-square-o fa-lg"></span>
                                        <span class="fa fa-square-o fa-lg"></span>
                                        <span class="content">anglais</span>
                                    </label>
                                </div>

                                <br /><br />

                                <input type="checkbox" name="other_languages_check[]" id="other_languages" value="1"
                                    autocomplete="off" @if(is_array(old('other_languages_check')) && in_array(1,
                                    old('other_languages_check'))) checked @endif />
                                <div class="btn-group {{ $errors->has('other_languages_input') ? ' has-error' : '' }}">
                                    <label for="other_languages" class="btn btn-default">
                                        <span class="fa fa-check-square-o fa-lg"></span>
                                        <span class="fa fa-square-o fa-lg"></span>
                                        <span class="content">Autre:</span><br /><br />
                                        <input id="other_languages_input" type="text" class="form-control"
                                            name="other_languages_input" value="{{ old('other_languages_input') }}"
                                            disabled autofocus>
                                    </label>
                                </div>
                            </div>
                        </div><!-- ./form-group -->

                        <hr>

                        {{-- <h5 class="text-center">Informations sur votre étude:<br /></h5>
                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                        <label for="street" class="col-md-4 control-label">Rue et numéro</label>
                        <div class="col-md-6">
                            <input id="street" type="text" class="form-control" name="street"
                                value="{{ old('street') }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city" class="col-md-4 control-label">Numéro postal et localité</label>
                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"
                                autofocus>
                        </div>
                    </div> --}}

                    {{-- <div class="form-group{{ $errors->has('phone_office') ? ' has-error' : '' }}">
                    <label for="phone_office" class="col-md-4 control-label">Numéro de téléphone prof.</label>
                    <div class="col-md-6">
                        <input id="phone_office" type="text" class="form-control" name="phone_office"
                            value="{{ old('phone_office') }}" autofocus>
                    </div>
                </div> --}}

                {{-- <div class="form-group{{ $errors->has('fax_office') ? ' has-error' : '' }}">
                <label for="fax_office" class="col-md-4 control-label">Numéro de fax prof.</label>
                <div class="col-md-6">
                    <input id="fax_office" type="text" class="form-control" name="fax_office"
                        value="{{ old('fax_office') }}" placeholder="(032)-987-65-43" autofocus>
                </div>
            </div> --}}

            <br />

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::captcha() !!}
                </div>
            </div>

            <br />

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        S'enregistrer&nbsp;
                        <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i>
                    </button>
                </div>
            </div>
            <a class="btn btn-link pull-left" href="{{ route('home') }}">
                &larr; Retour au site
            </a>
            <a class="btn btn-link pull-right" href="{{ route('lawyer.login') }}">
                Aller au login &rarr;
            </a>
            {!! Form::close() !!}
        </div><!-- /.panel-body -->
    </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
    </div><!-- /.container -->
</body>

</html>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script>
    $("#lawyer_registration").submit(function( event ) {
        console.log('click submit');
        $("#submitButton").attr("disabled", true);
        $("#spinner").removeAttr('style');
    });

    if ($("#other_languages").is(':checked')) {
        $("#other_languages_input").prop('disabled', false);
    }
    $("#other_languages").change(function() {
        if(this.checked) {
            // console.log('checked');
            $("#other_languages_input").prop('disabled', false);
        } else {
            // console.log('unchecked');
            $("#other_languages_input").prop('disabled', true);
        }
    });
</script>

<!-- jQuery Mask -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> --}}
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#phone_mobile').mask('(000)-000-00-00');
        $('#fax_office').mask('(000)-000-00-00');
    });
</script>