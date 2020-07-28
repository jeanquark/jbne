@extends('layouts.layoutFront')

@section('css')
    <style>
        body {
            background-color: var(--header-color);
        }        
        .btn-link {
            color: var(--secondary-color);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <br /><br /><br />
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Enregistrement des membres</div>
                    
                    <div class="alert alert-info alert-dismissable" style="margin: 30px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                        <strong style="text-align: center;">Important </strong><br /><u>Avocats stagiaires:</u> remplissez le formulaire ci-dessous pour vous enregistrer. Dans un premier temps, votre compte ne sera pas actif, si bien que vous ne pourrez pas vous connecter. Nous allons examiner votre demande et vérifier que vous être bien inscrit comme avocat stagiaire dans le Canton de Neuchâtel. Nous activerons ensuite votre compte et vous recevrez une confirmation par e-mail. Vous pourrez dès lors vous connecter et accèder à du contenu strictement réservé à nos membres. Il s'agit d'une série de documents (exercices, anciens examens) qui vous aideront dans votre préparation de l'examen du Barreau. <br /><u>Une dernière chose:</u> si vous rencontrez un quelconque soucis au cours de l'enregistrement, ou si vous vous inquiétez de ne pas voir votre compte activé (généralement le prochain jour ouvrable), veuillez nous contacter via le formulaire de contact ou par e-mail à l'adresse suivante: info@jbne.ch.
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('member.register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-4 control-label">Nom</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-4 control-label">Prénom</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <label for="password-confirm" class="col-md-4 control-label">Confirmation Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        S'enregistrer
                                    </button>
                                </div>
                            </div>

                            <a class="btn btn-link pull-left" href="{{ route('home') }}">
                                &larr; Retour au site
                            </a>
                            <a class="btn btn-link pull-right" href="{{ route('login') }}">
                                Aller au login &rarr;
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
