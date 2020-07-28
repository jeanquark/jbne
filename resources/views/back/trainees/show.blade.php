@extends('layouts.layoutBack')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <style>
    p {
        font-size: 14px;
        font-family: "Roboto Slab", "Helvetica Neue", Helvetica, Arial, sans-serif;
        line-height: 1.75;
        margin-bottom: 30px;
        text-align: center;
    }
    h2 {
        font-size: 3em;
        font-family: 'Montserrat', 'Helvetica Neue', Helvetica;
        margin-bottom: 15px;
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
    }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('back.trainees.index') }}">Avocats-stagiaires</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Montrer
        </li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="modal-body">
                    <h2 style="">{{ $trainee->title }}</h2>
                    <img class="img-responsive img-centered" style="margin-bottom: 30px;" src="{{ asset($trainee->image_path) }}" alt="image d'illustration">
                    <p style="">{!! $trainee->content !!}</p>
                    <div class="text-center">
                        <a href="{{ route('back.trainees.index') }}" class="btn btn-primary" data-dismiss="modal" style=""><i class="fa fa-times"></i> Fermer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection