@extends('layouts.layoutBack')

@section('css')
	<!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Awesome checkboxes -->
    <link rel="stylesheet" href="{{ asset('back/awesome-bootstrap-checkbox.css') }}">
    <style>
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
        input[type="checkbox"].styled:checked + label:after,
        input[type="radio"].styled:checked + label:after,
        .checkbox input[type=checkbox]:checked + label:after {
            font-family: 'Glyphicons Halflings';
            content: "\e013";
        }

        input[type="checkbox"].styled:checked label:after,
        input[type="radio"].styled:checked label:after,
        .checkbox label:after {
            padding-left: 2px;
            padding-top: 2px;
            font-size: 9px;
        }
    </style>
@endsection

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-glass"></i> Comité
        </li>
    </ol>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.team.index') }}">Voir toutes les membres du Comité</a></li>
        <li><a href="{{ route('back.team.create') }}">Ajouter un membre</a>
    </ul>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comité
                </div>

                <div class="panel-body" style="display: none;">
                    <table class="table table-bordered table-striped table-hover dataTable full-width">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Titre</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Statut</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Site web</th>
                                <th>LinkedIn</th>
                                <th>Publié?</th>
                                <th>Ordre d'apparition</th>
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($team_members as $key=>$member)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $member->title }}</td>
                                    <td>{{ $member->firstname }}</td>
                                    <td>{{ $member->lastname }}</td>
                                    <td>{{ $member->status }}</td>
                                    <td class="text-center"><img src="{{ asset($member->image_path) }}" width="100px"></td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->website }}</td>
                                    <td>{{ $member->linkedIn }}</td>
                                    <td class="text-center">
                                        <div class="checkbox checkbox-warning">
                                            <input type="checkbox" class="filled-in" id="{{$member->id}}" @if ($member->is_published) checked @endif>
                                            <label for="{{$member->id}}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $member->order_of_appearance }}</td>
                                    <td>{{ Date::parse($member->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($member->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/team/' . $member->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/team/' . $member->id) }}" style="margin: 5px;">Montrer</a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/team/' . $member->id . '/edit') }}" style="margin: 5px;">Editer</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
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
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.panel-body').removeAttr('style');
            $('.table').DataTable({
                // responsive: true,
                scrollX: true,
                //dom: 'Bfrtip',
                order: [[0, 'desc']],
                lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
                columnDefs: [
                    {
                        "targets": [6, 7, 8],
                        "visible": false,
                    },
                    { 
                        "targets": [13], 
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
        // awesome checkboxes
        $(document).ready(function(){
            $('.filled-in').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                id = $(this).attr('id');
                warnBeforeCheck();
            });
            function warnBeforeCheck() {
                swal({
                    title: "Etes-vous sûr?",
                    text: "Vous allez changer le statut de ce membre",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#8BC34A",
                    confirmButtonText: "Oui!",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false,
                    closeOnCancel: false 
                },
                function(isConfirm) {
                    if (isConfirm) {
                        if($('#' + id).is(":checked")) {
                            //console.log('Checkbox is checked!');
                            $('#' + id).prop('checked', false);
                        } else {
                            //console.log('Checkbox is not checked!');
                            $('#' + id).prop('checked', true);
                        }
                        $.ajax({
                            type: 'POST',
                            url: "{{ URL::route('back.team.changeStatus') }}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id
                            },
                            success: function(data) {                                
                                swal("Succès", "Statut du membre modifié avec succès", "success");
                            },
                        });
                        //$('.filled-in').val($(this).is(':checked'));
                    } else {
                        swal("Annulé", "Pas de changement :)", "error");
                    }
                });
            }
        });
    </script>

    <!-- Warn before delete -->
    <script>
        $('.btn-warning').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer ce membre.",
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
                    swal("Annulé", "Le membre est sauvé :-)", "error");
                }
            });
        }
    </script>
@endsection