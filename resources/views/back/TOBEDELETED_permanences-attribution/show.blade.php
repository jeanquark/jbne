@extends('layouts.layoutBack')

@section('css')
    
@endsection

@section('content')    
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-key"></i><a href="{{ route('back.permissions.index') }}"> Permissions</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails du rôle
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
                                    <td>{{ $permission->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $permission->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Slug</th>
                                    <td>{{ $permission->slug }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $permission->description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $permission->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $permission->updated_at }}</td>
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