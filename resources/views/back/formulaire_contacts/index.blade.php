@extends('layouts.layoutBack')

@section('css')
	<!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- awesome checkboxes -->
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
    </style>
@endsection

@section('content')
    
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-comments"></i> Contacts
        </li>
    </ol>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.formulaire-contacts.index') }}">Voir tous les messages</a></li>
    </ul>

    <div class="checkbox checkbox-success">
        <input type="checkbox">
    </div>

    <div class="checkbox checkbox-primary">
      <input id="checkbox" type="checkbox" checked>
    </div>
    
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des messages
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover dataTable" style="display: none;">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>E-Mail</th>
                                <th>Message</th>
                                <th>Date de création</th>
                                <th>Message lu?</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key=>$contact)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $contact->nom }}</td>
                                    <td>{{ $contact->prenom }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td>{{ Date::parse($contact->created_at)->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <div class="checkbox checkbox-warning">
                                            <input type="checkbox" class="filled-in" id="{{$contact->id}}" @if ($contact->is_read) checked @endif>
                                            <label for="{{$contact->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/formulaire-contacts/' . $contact->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/formulaire-contacts/' . $contact->id) }}" style="margin: 5px;">Montrer</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!}
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
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    
    <!-- Custom Js -->
    <script>
        $(document).ready(function() {
            $( ".table" ).css("display", "" );

            $('.table').dataTable({
                //responsive: true,
                order: [[0, 'asc']],
                lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
                columnDefs: [
                    /*{
                        "targets": [],
                        "visible": false,
                    },*/
                    { 
                        "targets": [6, 7], 
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
        $(document).ready(function(){
            // Warning before status change
            $('.filled-in').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                id = $(this).attr('id');
                warnBeforeCheck();
            });
            function warnBeforeCheck() {
                swal({
                    title: "Etes-vous sûr?",
                    text: "Vous allez changer le statut de ce message",
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
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            url: "{{ URL::route('back.contacts.changeStatus') }}",
                            data: {
                                // '_token': $('input[name=_token]').val(),
                                'id': id
                            },
                            success: function(data) {                                
                                swal("Succès", "Statut du message modifié avec succès", "success");
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
    <script>
        $('.btn-warning').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer ce message.",
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
                    swal("Annulé", "Le message est sauvée :)", "error");
                }
            });
        }
    </script>
@endsection