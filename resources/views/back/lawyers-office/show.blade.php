@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-building"></i><a href="{{ route('back.lawyers-office.index') }}"> Étude d'avocat</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails de l'Étude d'avocat
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
                                    <td>{{ $office->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $office->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rue et numéro</th>
                                    <td>{{ $office->street }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Code postal et localité</th>
                                    <td>{{ $office->city }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Téléphone</th>
                                    <td>{{ $office->phone_office }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fax</th>
                                    <td>{{ $office->fax_office }}</td>
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