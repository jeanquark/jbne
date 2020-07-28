@extends('layouts.layoutMembers')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2" style="">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i><a href="{{ route('home') }}"> Accueil</a>
            </li>
            <li class="active">
                <i class="fa fa-black-tie"></i> Profil
            </li>
        </ol>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! $message !!}
            </div>
            {{ Session::forget('success') }}
        @endif
                        
    	<div class="row clearfix">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profil
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Champ:</th>
                                    <th>Valeur:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <td>{{ $profile->firstname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $profile->lastname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td>{{ $profile->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rue et numéro</th>
                                    <td>{{ $profile->rue }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Localité</th>
                                    <td>{{ $profile->localite }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rôle</th>
                                    <td>
                                        @foreach ($profile->roles as $role) 
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Type d'affiliation</th>
                                    <td>{{ $profile->type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Statut du membre</th>
                                    <td>{{ $profile->statut }}</td>
                                </tr>
                                @if ($profile->statut == 'Avocat au Barreau')
                                    <tr>
                                        <th scope="row">Date d'inscription au Barreau</th>
                                        <td>{{ $profile->date_inscription_barreau }}</td>
                                    </tr>
                                @endif
                                @if ($profile->statut == 'Avocat stagiaire')
                                    <tr>
                                        <th scope="row">Date du début du stage d'avocat</th>
                                        <td>{{ $profile->date_debut_stage }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date de fin du stage d'avocat</th>
                                        <td>{{ $profile->date_fin_stage }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ Date::parse($profile->created_at)->format('j F Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ Date::parse($profile->created_at)->format('j F Y') }}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><a href="{{ route('member.profile.edit', $profile->id) }}" class="btn btn-small btn-primary">Editer</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.col-md-8 -->
@endsection