@extends('layouts.layoutFront')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/timeline.css') }}" />
    <style>
        /*:root {
          --primary-color: #9f1853;
          --secondary-color: #918f90;
        }*/
        .dropdown-menu {
            padding: 0px 0px;
        }
        .dropdown-menu>li>a {
            background-color: #918f90;
            padding: 10px;
        }
        .dropdown-menu>li>a:hover {
            background-color: #9f1853;
        }
        .navbar-brand {
            padding: 10px 15px;
        }
        .navbar-default .navbar-nav .open .dropdown-menu>li>a {
            color: #fff;
        }
        .navbar-nav>li>.dropdown-menu {
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            color: #fff;
            background-color: #918f90;
        }
        .card-content {
            width: 100%;
            height: 240px;
            padding: 20px;
            border: 1px solid #9f1853;
        }
        .portfolio .portfolio-item {
          margin: 0 0 15px;
          right: 0;
        }
        .portfolio .portfolio-item .portfolio-link {
          display: block;
          position: relative;
          max-width: 400px;
          margin: 0 auto;
        }
        .portfolio .portfolio-item .portfolio-link .portfolio-hover {
          background: rgba(254, 209, 54, 0.9);
          position: absolute;
          width: 100%;
          height: 100%;
          opacity: 0;
          transition: all ease 0.5s;
          -webkit-transition: all ease 0.5s;
          -moz-transition: all ease 0.5s;
        }
        .portfolio .portfolio-item .portfolio-link .portfolio-hover:hover {
          opacity: 1;
        }
        .portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content {
          position: absolute;
          width: 100%;
          height: 20px;
          font-size: 20px;
          text-align: center;
          top: 50%;
          margin-top: -12px;
          color: white;
        }
        .portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content i {
          margin-top: -12px;
        }
        .portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h3,
        .portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h4 {
          margin: 0;
        }
        .portfolio .portfolio-item .portfolio-caption {
          max-width: 400px;
          margin: 0 auto;
          background-color: white;
          text-align: center;
          padding: 25px;
        }
        .portfolio .portfolio-item .portfolio-caption h4 {
          text-transform: none;
          margin: 0;
        }
        .portfolio .portfolio-item .portfolio-caption p {
          font-family: "Droid Serif", "Helvetica Neue", Helvetica, Arial, sans-serif;
          font-style: italic;
          font-size: 16px;
          margin: 0;
        }
        .portfolio * {
          z-index: 2;
        }
    </style>
@endsection

@section('content')
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                {{-- <a class="navbar-brand page-scroll" href="#page-top">JBNE</a> --}}
                <a class="navbar-brand page-scroll" href="#page-top"><img src="{{ asset('images/logo.png') }}" class="img-responsive" width="120px;" style=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#presentation">Présentation</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#activities">Activités</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#agenda">Agenda</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Comité</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#trainees">Avocats-stagiaires</a>
                    </li>
                    @if (Auth::guard('lawyer')->check())
                        <li class="dropdown" style="">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::guard('lawyer')->user()->username }}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="">
                                <li><a href="{{ route('lawyer.index', ['id' => Auth::guard('lawyer')->user()->id ]) }}"><i class="fa fa-black-tie"> Profil</i></a></li>

                                <li><a href="{{ route('lawyer.permanences.index') }}"><i class="fa fa-calendar"> Mes permanences</i></a></li>
                                <li><a href="{{ route('lawyer.logout') }}">
                                    <i class="fa fa-fw fa-power-off"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    @else
                        <li>
                            @if (!Auth::guard('member')->check())
                                {{-- <a class="page-scroll" href="#login">Login Avocats 1<sup>ère</sup> heure/Membres</a> --}}
                                <a class="page-scroll" href="#login">Login</a>
                            @else
                                <a class="page-scroll" href="#login">Login Avocats</a>
                            @endif
                        </li>
                    @endif
                    @if (Auth::guard('member')->check())
                        <li class="dropdown" style="">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::guard('member')->user()->email }}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="">
                                @if (Auth::guard('member')->user()->hasRole('Admin'))
                                    <li><a class="" href="{{ route('back.index') }}"><i class="fa fa-fw fa-dashboard"> Admin</i></a></li>
                                @endif
                                <li><a class="" href="{{ route('member.profile.show', ['id' => Auth::guard('member')->id() ]) }}"><i class="fa fa-black-tie"> Profil</i></a></li>
                                <li><a href="{{ route('member.files') }}"><i class="fa fa-file-pdf-o"> Fichiers à télécharger</i></a></li>
                                {{-- <li><a href="javascript: submitform()">
                                    {!! Form::open(array('url' => '/logout', 'name' => 'logout')) !!}
                                        <i class="fa fa-fw fa-power-off"></i> Logout
                                    {!! Form::close() !!}
                                </a></li> --}}
                                <li><a href="{{ route('member.logout') }}">
                                    <i class="fa fa-fw fa-power-off"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    @elseif (Auth::guard('lawyer')->check())
                        <li>
                            <a class="page-scroll" href="#login">Login Membres</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>


    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Bienvenue sur le site du</div>
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive" style="display: inline;" />
                    {{-- <h1>Jeune Barreau neuchâtelois</h1> --}}
                </div>
                {{-- <div class="intro-heading">
                    Jeune Barreau neuchâtelois
                </div> --}}
                {{-- <a href="#services" class="page-scroll btn btn-xl" style="background-color: #eeeeee; border: 1px solid #ccc;">En savoir plus</a> --}}
            </div>
        </div>
    </header>
                        
    <!-- Presentation Section -->
    <section id="presentation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Présentation</h2>
                    <h3 class="section-subheading text-muted">Le Jeune Barreau neuchâtelois se présente.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-dot-circle-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Objectif</h4>
                    <p class="text-muted">Le Jeune Barreau a pour but de défendre et promouvoir les intérêts propres de ses membre et à développer les liens confraternels et professionnels avec l’Ordre des Avocats Neuchâtelois, d’autres Jeunes Barreaux suisse et étranger ou d’autres associations professionnelles. A l’écoute des préoccupations de ses membres, le Jeune Barreau entend également être un interlocuteur dans les discussions professionnelles et juridiques à l’exercice de la profession d’avocat.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-sitemap fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Organisation</h4>
                    <p class="text-muted">Le Jeune Barreau accueille en son sein les jeunes avocats de moins de 10 ans de pratique ainsi que les avocats stagiaires de la République et Canton de Neuchâtel. Sous l’impulsion d’un Premier Secrétaire, son comité est formé par la Commission des Jeunes Avocats et la Commission des Avocats-stagiaires.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-file-text-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Statuts</h4>
                    <p class="text-muted">Le Jeune Barreau Neuchâtelois est une association de droit privé à but non lucratif au sens des art. 60 ss du Code Civil Suisse. Pour télécharger nos statuts, <a href="{{ asset('documents/statuts.pdf') }}" target="_blank">cliquez ici</a>.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <section id="activities" class="portfolio bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Activités</h2>
                    <h3 class="section-subheading text-muted">Une liste non exhaustive de ce que nous faisons.</h3>
                </div>
            </div>

            @foreach($activities->chunk(3) as $activities_chunk)
                <div class="row" style="">
                    @foreach ($activities_chunk as $activity)
                        <div class="col-md-4 col-sm-6 portfolio-item" style="">
                            <a href="#ActivityModal{{ $activity->id }}" class="portfolio-link" data-toggle="modal">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                        <i class="fa fa-plus fa-3x"></i>
                                    </div>
                                </div>
                                <img src="{{ asset($activity->image_path) }}" class="img-responsive" alt="Image d'illustration">
                            </a>
                            <div class="portfolio-caption">
                                <h4>{{ $activity->title }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            {{-- </div> --}}
            @endforeach
        </div><!-- /.container -->
    </section>




    <div id="agenda"></div>

    <!-- Agenda Section (small devices) -->
    <section class="visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Agenda</h2>
                    <h3 class="section-subheading text-muted">Suivez le fil de notre actualité.</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline" style="">
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="background-color: #9f1853;">
                                <h4>Poursuivons<br>
                                    l'aventure<br>
                                    ensemble
                                </h4>
                            </div>
                        </li>
                        @foreach ($agendas as $key=>$agenda)
                            <li <?php if ($key % 2 != 0) echo 'class="timeline-inverted"'; ?> style="">
                                <div class="timeline-image" style="background-color: #fff;">
                                    <img class="img-circle img-responsive" src="{{ asset($agenda->image_path) }}" alt="image d'illustration">
                                </div>
                                <div class="timeline-panel align-middle" style="">
                                    <div class="timeline-heading" style="">
                                        <h4 style="">{{ $agenda->title }}</h4>
                                    </div>
                                    <div class="timeline-body" style="">
                                        <p class="text-muted" style="">{{ $agenda->content }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Agenda Section (medium and large devices) -->
    <section class="hidden-xs" style="padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Agenda</h2>
                    <h3 class="section-subheading text-muted">Suivez le fil de notre actualité.</h3>
                </div>
                <div class="text-center">
                    <button class="btn" id="left-button" type="button" style="color: #fff; background: #9f1853;">&larr;</button>
                    <button class="btn" id="right-button" type="button" style="color: #fff; background: #9f1853;">&rarr;</button>
                </div>
            </div>

            <div class="row">
                <div style="display:inline-block; width:100%; overflow-y:auto;" id="content">
                    <ul class="timeline timeline-horizontal">
                        <li class="timeline-item">
                            <div class="timeline-badge primary" style="background-color: #9f1853;">
                                <h4>
                                    <br /><br />
                                    Poursuivons<br>
                                    l'aventure<br>
                                    ensemble
                                </h4>
                            </div>
                        </li>
                        @foreach ($agendas as $key=>$agenda)                  
                            <li class="timeline-item">
                                <div class="timeline-badge primary" style="">
                                    <img class="img-circle img-responsive" src="{{ asset($agenda->image_path) }}" alt="image d'illustration">
                                </div>
                                <div class="<?php if ($key % 2 != 0) echo 'timeline-panel-bottom'; else echo 'timeline-panel-top'; ?>">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $agenda->title }}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $agenda->content }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- /#content -->
            </div><!-- /.row -->
        </div>
    </section>
        

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Comité</h2>
                    <h3 class="section-subheading text-muted">Qui sommes-nous?</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($team_members as $member)
                    <div class="col-sm-4">
                        <div class="team-member">
                            <img src="{{ $member->image_path }}" class="img-responsive img-circle" alt="photo {{ $member->firstname }} {{ $member->lastname }}">
                            <h4>{{ $member->title }} {{ $member->firstname }} {{ $member->lastname }}</h4>
                            <br />
                            <p class="text-muted">
                                {{ $member->status }}
                            </p>
                            <br />
                        </div>
                    </div>
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /#team -->


    <!-- Trainees Section -->
    @if (count($trainees) > 0)
        <section id="trainees" class="portfolio bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Avocats-stagiaires</h2>
                        <h3 class="section-subheading text-muted"></h3>
                    </div>
                </div>

                @foreach($trainees->chunk(3) as $trainees_chunk)
                    <div class="row">
                        @foreach($trainees_chunk as $trainee)
                            <div class="col-md-4 col-sm-6 portfolio-item" style="">
                                @if ($trainee->image_path)
                                    <a href="#TraineeModal{{ $trainee->id }}" class="portfolio-link" data-toggle="modal">
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content">
                                                <i class="fa fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                        <img src="{{ asset($trainee->image_path) }}" class="img-responsive" alt="Image d'illustration">
                                    </a>
                                    <div class="portfolio-caption">
                                        <h4>{{ $trainee->title }}</h4>
                                    </div>
                                @else
                                    <a href="#TraineeModal{{ $trainee->id }}" class="portfolio-link" data-toggle="modal">
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content">
                                                <i class="fa fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                        <div class="card-content" style="">
                                            {!! Str::words($trainee->content, 10, '...') !!}
                                        </div>
                                    </a>
                                    <div class="portfolio-caption">
                                        <h4>{{ $trainee->title }}</h4>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{--<div class="row">
                        @foreach ($trainees_chunk as $trainee)
                            <div class="col-md-4 col-sm-6 portfolio-item" style="border: 0px solid orange;">
                                @if ($trainee->image_path)
                                    <div class="portfolio-caption text-center">
                                        <h4>{{ $trainee->title }}</h4>
                                    </div>
                                    <a href="#TraineeModal{{ $trainee->id }}" class="portfolio-link" data-toggle="modal">
                                        <img src="{{ asset($trainee->image_path) }}" class="img-responsive" alt="image d'illustration">
                                        <br />
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content text-center">
                                                <i class="fa fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div>
                                        <h4 class="text-center">{{ $trainee->title }}</h4>
                                        <p>{!! Str::words($trainee->content, 5, '...') !!}</p>
                                    </div>
                                    
                                    <div class="text-center">
                                        <a href="#TraineeModal{{ $trainee->id }}" class="portfolio-link" data-toggle="modal">
                                            <i class="fa fa-plus fa-3x"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>--}}
                @endforeach
            </div><!-- /.container -->
        </section>
    @endif

    
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nous contacter</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(array('route' => 'formulaire_contact', 'method' => 'POST', 'id' => 'contactForm', 'class' => '', 'style' => '', 'name' => 'sentMessage')) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ ($errors->has('nom')) ? 'has-error' : '' }}">
                                    {!! Form::text('nom', Input::old('nom'), array('class' => 'form-control', 'placeholder' => 'Votre nom *')) !!}
                                    @if ($errors->has('nom') )
                                        <span class="help-block" style="background-color: #fff; border-radius: 4px; padding: 5px;">{{ $errors->first('nom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ ($errors->has('prenom')) ? 'has-error' : '' }}">
                                    {!! Form::text('prenom', Input::old('prenom'), array('class' => 'form-control', 'placeholder' => 'Votre prénom *')) !!}
                                    @if ($errors->has('prenom') )
                                        <span class="help-block" style="background-color: #fff; border-radius: 4px; padding: 5px;">{{ $errors->first('prenom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                                    {!! Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Votre email *')) !!}
                                    @if ($errors->has('email') )
                                        <span class="help-block" style="background-color: #fff; border-radius: 4px; padding: 5px;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ ($errors->has('message')) ? 'has-error' : '' }}">
                                    {!! Form::textarea('message', Input::old('message'), array('class' => 'form-control', 'placeholder' => 'Votre message *')) !!}
                                    @if ($errors->has('message') )
                                        <span class="help-block" style="background-color: #fff; border-radius: 4px; padding: 5px;">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                {!! Form::submit('Envoyer Message', array('class'=>'btn btn-xl')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>


    <!-- Activity Modal -->
    @foreach ($activities as $activity)
        <div class="portfolio-modal modal fade" id="ActivityModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    <h2>{{ $activity->title }}</h2>
                                    @if (!$activity->file_path)
                                        <img class="img-responsive img-centered" src="{{ asset($activity->image_path) }}" alt="image d'illustration">
                                    @else 
                                        <a href="{{ asset($activity->file_path) }}" download>
                                            <img class="img-responsive img-centered" src="{{ asset($activity->image_path) }}" alt="image d'illustration" width="300" style="border: 1px solid #ccc;">
                                            Document à télécharger
                                        </a>
                                    @endif
                                    <p>{!! $activity->content !!}</p>
                                    
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Trainee Modal -->
    @foreach ($trainees as $trainee)
        <div class="portfolio-modal modal fade" id="TraineeModal{{ $trainee->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body" style="">
                                    <h2 class="text-xs-center">{{ $trainee->title }}</h2>
                                    @if ($trainee->image_path)
                                        <img class="img-responsive img-centered" src="{{ asset($trainee->image_path) }}" alt="image d'illustration">
                                    @endif
                                    <div style="text-align: left">
                                        {!! $trainee->content !!}
                                    </div>
                                    
                                    <button type="button" class="btn btn-primary text-xs-center" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        
    <!-- Permanences Section -->
    <section id="login" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Login des avocats de la 1<sup>ère</sup> heure et des membres</h2>
                    <h3 class="section-subheading text-muted">Connectez vous pour nous transmettre vos disponibilités ou accèder à nos ressources en ligne</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-gavel fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading" style="">Avocats de la 1<sup>ère</sup> heure <img src="{{ asset('images/neuchatel.png') }}" width="20px" style="vertical-align: middle;" /></h4>
                    <p class="text-muted">
                        @if(Auth::guard('lawyer')->check())
                            <a href="{{ route('lawyer.permanences.index') }}">Voir mes permanences</a>
                        @else
                            <p style="font-size: 1.2em;"><a href="{{ route('lawyer.login') }}">Connectez-vous</a> pour indiquer vos disponibilités dans le cadre de la <b>permanence</b> des avocats de la 1<sup>ère</sup> heure.<br /> Toutefois, au préalable, vous devez vous <a href="{{ route('lawyer.register') }}">enregistrer</a>.</p>
                            <div class="well hidden" id="pwa">
                                Pour un accès facilité, vous pouvez ajouter le site du JBNE à votre écran d'accueil:<br /><br />
                                <button class="btn btn-default btn-sm" id="pwa_addButton" style="color: #fff; background-color: #9f1853;">Ajouter à mon écran d'accueil</button><br />
                            </div>
                        @endif
                    </p>
                </div>
                {{-- <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-graduation-cap fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading" style="">Membres du JBNE <img src="{{ asset('images/neuchatel.png') }}" width="20px" style="vertical-align: middle;" /></h4>
                    <p class="text-muted">
                        @if(Auth::guard('member')->check())
                            <a href="{{ route('member.files') }}">Voir les documents partagés</a>
                        @else
                            <p style="font-size: 1.2em;"><a href="{{ route('member.login') }}">Connectez-vous</a> pour accéder à notre <b>documentation</b> en ligne (exemple de recours/jurisprudence, anciens examens du barreau).<br /> Toutefois, au préalable, vous devez vous <a href="{{ route('member.register') }}">enregistrer</a>.</p>
                        @endif
                    </p>
                </div> --}}
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-graduation-cap fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading" style="">Membres du JBNE <img src="{{ asset('images/neuchatel.png') }}" width="20px" style="vertical-align: middle;" /></h4>
                    <p class="text-muted">
                        @if(Auth::guard('member')->check())
                            <a href="{{ route('member.files') }}">Voir les documents partagés</a><br />
                            <a href="{{ route('member.logout') }}">Logout membre</a>
                        @else
                            <p style="font-size: 1.2em;"><a href="{{ route('member.login') }}">Connectez-vous</a> pour accéder à notre <b>documentation</b> en ligne (exemple de recours/jurisprudence, anciens examens du barreau).<br /> Toutefois, au préalable, vous devez vous <a href="{{ route('member.register') }}">enregistrer</p></a>
                        @endif
                    </p>
                </div>
                {{-- <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-file fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Espace Membres</h4>
                    <p class="text-muted">
                        @if(Auth::guard('web')->check())
                            <p class="text-success">
                                You are logged in as a <strong>MEMBER</strong>
                                <a href="{{ route('member.files') }}">Fichiers en téléchargement</a>
                            </p>
                        @else
                            <p class="text-danger">
                                You are logged out as a <strong>MEMBER</strong>
                                Enregistrez-vous <a href="{{ route('member.register') }}">ici</a> pour accéder à nos ressources
                            </p>
                        @endif
                    </p>
                </div> --}}
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#right-button').click(function() {
                event.preventDefault();
                $('#content').animate({
                    scrollLeft: "+=500px"
                }, "slow");
            });

            $('#left-button').click(function() {
                event.preventDefault();
                $('#content').animate({
                    scrollLeft: "-=500px"
                }, "slow");
            });
        });
    </script>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
            .register('/sw.js')
            .then(function() { console.log("Service Worker Registered"); });
        }

        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('beforinstallprompt called!')
            document.getElementById("pwa").classList.remove("hidden");
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
        });

        const pwaAddButton = document.getElementById("pwa_addButton");
        if (pwaAddButton) {
            document.getElementById("pwa_addButton").addEventListener('click', (e) => {
                console.log('e: ', e)
                document.getElementById("pwa").classList.add("hidden");
                // Show the prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                deferredPrompt.userChoice
                    .then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the A2HS prompt');
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                    });
            });
        }

        function getExcerpt($str, $startPos=0, $maxLength=100) {
            if(strlen($str) > $maxLength) {
                $excerpt   = substr($str, $startPos, $maxLength-3);
                $lastSpace = strrpos($excerpt, ' ');
                $excerpt   = substr($excerpt, 0, $lastSpace);
                $excerpt   = '...';
            } else {
                $excerpt = $str;
            }
            
            return $excerpt;
        }
        // document.getElementById("loginLink").addEventListener('click', (e) => {
        //     console.log('Click login button')
        //     console.log('e: ', e)
            // hide our user interface that shows our A2HS button
            // btnAdd.style.display = 'none';
            // // Show the prompt
            // deferredPrompt.prompt();
            // // Wait for the user to respond to the prompt
            // deferredPrompt.userChoice
            //     .then((choiceResult) => {
            //         if (choiceResult.outcome === 'accepted') {
            //             console.log('User accepted the A2HS prompt');
            //         } else {
            //             console.log('User dismissed the A2HS prompt');
            //         }
            //         deferredPrompt = null;
            //     });
        // });
    </script>
@endsection