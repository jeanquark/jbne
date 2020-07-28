@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i><a href="{{ route('back.users.index') }}"> Utilisateurs</a>
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
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <td>{{ $user->firstname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $user->lastname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rue et numéro</th>
                                    <td>{{ $user->rue }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Localité</th>
                                    <td>{{ $user->localite }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Role</th>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }} &nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Permissions</th>
                                    <td>
                                        @foreach ($user->roles as $roles)
                                            @foreach ($roles->permissions as $permission)
                                                {{ $permission->name }} @if (!$loop->last)-@endif&nbsp;
                                            @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nb. d'e-mails envoyés</th>
                                    <td>{{ $user->emails_sent }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Type d'affiliation</th>
                                    <td>{{ $user->type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Statut du membre</th>
                                    <td>{{ $user->statut }}</td>
                                </tr>
                                @if ($user->statut == 'Avocat au Barreau')
                                    <tr>
                                        <th scope="row">Date d'inscription au Barreau</th>
                                        <td>{{ $user->date_inscription_barreau }}</td>
                                    </tr>
                                @endif
                                @if ($user->statut == 'Avocat stagiaire')
                                    <tr>
                                        <th scope="row">Date du début du stage d'avocat</th>
                                        <td>{{ $user->date_debut_stage }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date de fin du stage d'avocat</th>
                                        <td>{{ $user->date_fin_stage }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $user->updated_at }}</td>
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