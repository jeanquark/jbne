@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-file-text"></i><a href="{{ route('back.pages.index') }}"> Contenus</a>
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
                                    <td>{{ $page->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $page->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Slug</th>
                                    <td>{{ $page->slug }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Contenu</th>
                                    <td>{{ $page->content }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Publié?</th>
                                    <td>{{ $page->is_published }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $page->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $page->updated_at }}</td>
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