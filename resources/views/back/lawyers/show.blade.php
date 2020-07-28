@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-user-tie"></i><a href="{{ route('back.lawyers.index') }}"> Avocats</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails de l'avocat
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
                                    <td>{{ $lawyer->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <td>{{ $lawyer->firstname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $lawyer->lastname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom d'utilisateur</th>
                                    <td>{{ $lawyer->username }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td>{{ $lawyer->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rue et numéro</th>
                                    <td>{{ $lawyer->street }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Localité</th>
                                    <td>{{ $lawyer->city }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Téléphone mobile</th>
                                    <td>{{ $lawyer->phone_mobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Téléphone prof.</th>
                                    <td>{{ $lawyer->phone_office }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fax</th>
                                    <td>{{ $lawyer->fax_office }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Langues</th>
                                    <td>{{ $lawyer->languages }}</td>
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $lawyer->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $lawyer->updated_at }}</td>
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