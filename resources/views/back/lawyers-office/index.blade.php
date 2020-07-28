@extends('layouts.layoutBack')

@section('css')
	<!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- awesome checkboxes -->
    <link rel="stylesheet" href="{{ asset('back/awesome-bootstrap-checkbox.css') }}">

    <style>
        .dataTables_wrapper .dt-buttons a.dt-button {
            color: #000;
            background-image: none;
            background-color: #f5f5f5;
        }
        .dataTables_wrapper .dt-buttons a.dt-button:hover:not(.disabled) {
            border: none;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        table.dataTable thead th {
            vertical-align: middle;
            white-space: nowrap;
        }
        table.dataTable tbody td {
            vertical-align: middle;
        }
        .checkbox {
            padding-left: 0px;
        }
        .checkbox label::after {
            padding-left: 0px;
        }
    </style>
@endsection

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-building"></i> Études d'avocats
        </li>
    </ol>

    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.lawyers-office.index') }}">Voir toutes les Études</a></li>
        <li><a href="{{ route('back.lawyers-office.create') }}">Créer une nouvelle Étude</a>
    </ul>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des Études d'avocats
                </div>

                <div class="panel-body" style="display: none;">
                    <table class="table table-bordered table-striped table-hover dataTable" style="width:100%;">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Rue</th>
                                <th>Localité</th>
                                <th>Tél</th>
                                <th>Fax</th>
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $key=>$office)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $office->name }}</td>
                                    <td>{{ $office->street }}</td>
                                    <td>{{ $office->city }}</td>
                                    <td>{{ $office->phone_office }}</td>
                                    <td>{{ $office->fax_office }}</td>
                                    <td>{{ Date::parse($office->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($office->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/lawyers-office/' . $office->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/lawyers-office/' . $office->id) }}" style="margin: 5px;">Montrer</a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/lawyers-office/' . $office->id . '/edit') }}" style="margin: 5px;">Editer</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!} --}}
                                            <button class="btn btn-small btn-danger disabled{{$office->id}}" style="margin: 5px;">Supprimer</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
@endsection

@section('scripts')
	 <!-- Jquery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    {{-- <script src="{{ asset('back/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('back/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script> --}}
    {{-- <script src="{{ asset('back/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> --}}
        
    {{-- <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script>
    	$(document).ready(function() {
            $('.panel-body').removeAttr('style');
            $('.table').DataTable({
                // responsive: true,
                //dom: 'Bfrtip',
                // order: [[0, 'desc']],
                scrollX: true,
                lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
                columnDefs: [
                    /*{
                        "targets": [6,7],
                        "visible": false,
                    },*/
                    { 
                        "targets": [7], 
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
        $('.btn-danger').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer cette Étude.",
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
                    swal("Annulé", "L'Étude est sauvée :-)", "error");
                }
            });
        }
    </script>
@endsection