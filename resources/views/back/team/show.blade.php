@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i><a href="{{ route('back.team.index') }}"> Membres du Comité</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails de l'utilisateur
                </div>

                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Champ:</th>
                                    <th>Valeur:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>{{ $team_member->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <td>{{ $team_member->firstname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $team_member->lastname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Statut</th>
                                    <td>{{ $team_member->status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Image</th>
                                    <td><img src="{{ asset($team_member->image_path) }}" width="100" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td>{{ $team_member->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Website</th>
                                    <td>{{ $team_member->website }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">LinkedIn</th>
                                    <td>{{ $team_member->linkedIn }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ordre d'apparition</th>
                                    <td>{{ $team_member->order_of_appearance }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $team_member->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $team_member->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.dataTable_wrapper -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row <-->
@endsection

@section('scripts')

@endsection