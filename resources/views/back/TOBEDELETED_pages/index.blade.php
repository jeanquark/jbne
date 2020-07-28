@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('back/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/buttons.datatable.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        /*.dataTables_wrapper .dt-buttons a.dt-button {
            color: #000;
            background-image: none;
            background-color: #f5f5f5;
        }
        .dataTables_wrapper .dt-buttons a.dt-button:hover:not(.disabled) {
            border: none;
        }*/
        table.dataTable thead th {
            vertical-align: middle;
            white-space: nowrap;
        }
        table.dataTable tbody td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-file-text"></i> Contenus
        </li>
    </ol>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.activities.index') }}">Voir toutes les activités</a></li>
        <li><a href="{{ route('back.activities.create') }}">Créer une activité</a>
    </ul>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Activités
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Slug</th>
                                <th>Contenu</th>
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($activities as $key=>$activity)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $activity->nom }}</td>
                                    <td>{{ $activity->slug }}</td>
                                    <td>{{ $activity->contenu }}</td>
                                    <td>{{ Date::parse($activity->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($activity->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/activitys/' . $activity->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/activities/' . $activity->id) }}" style="margin: 5px;">Montrer</a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/activities/' . $activity->id . '/edit') }}" style="margin: 5px;">Editer</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div><!-- /.panel-body -->
            </div><!-- /.panel panel-default -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row clearfix -->
@endsection

@section('scripts')
    <!-- Jquery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    {{-- <script src="{{ asset('back/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('back/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('back/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> --}}
        
    {{-- <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $(function () {
            $('.js-basic-example').DataTable({
                // responsive: true,
                //dom: 'Bfrtip',
                order: [[0, 'desc']],
                lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
                /*buttons: [
                    'pageLength', 'colvis', {
                        text: 'Ajouter un utilisateur',
                        className: 'dt-button buttons-collection buttons-colvis bg-pink waves-effect waves-light',
                        action: function ( e, dt, node, config ) {
                            location.href = "pages/create";
                        }
                    }, {
                        text: 'Manage Roles',
                        className: 'dt-button buttons-collection buttons-colvis bg-purple waves-effect waves-light',
                        action: function ( e, dt, node, config ) {
                            location.href = "roles";
                        }
                    }, {
                        text: 'Manage Permissions',
                        className: 'dt-button buttons-collection buttons-colvis bg-indigo waves-effect waves-light',
                        action: function ( e, dt, node, config ) {
                            location.href = "permissions";
                        }
                    }
                ],*/
                columnDefs: [
                    /*{
                        "targets": [6,7],
                        "visible": false,
                    },*/
                    { 
                        "targets": [6], 
                        "orderable": false 
                    }
                ],
                oLanguage: {
                    sUrl: "//cdn.datatables.net/plug-ins/1.10.13/i18n/French.json"
                }
            });
        });
    </script>
    <script>
        $('.bg-orange').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer cette page.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, supprimer!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {                        
                    form.submit();
                } else {
                    swal("Annulé", "La page est sauvée :-)", "error");
                }
            });
        }
    </script>
@endsection