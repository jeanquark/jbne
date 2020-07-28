@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-list"></i><a href="{{ route('back.index') }}"> Logs</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails de l'erreur
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
                                    <td>{{ $log->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Instance</th>
                                    <td>{{ $log->instance }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Channel</th>
                                    <td>{{ $log->channel }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Level</th>
                                    <td>{{ $log->level }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Level name</th>
                                    <td>{{ $log->level_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Message</th>
                                    <td>{{ $log->message }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Context</th>
                                    <td>{{ $log->context }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Remote address</th>
                                    <td>{{ $log->remot_addr }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">User Agent</th>
                                    <td>{{ $log->user_agent }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created by</th>
                                    <td>{{ $log->created_by }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
                                    <td>{{ $log->created_at }}</td>
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