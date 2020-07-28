@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- awesome checkboxes -->
    <link rel="stylesheet" href="{{ asset('back/awesome-bootstrap-checkbox.css') }}">

    <style>
        /*.dataTables_wrapper .dt-buttons a.dt-button {
            color: #000;
            background-image: none;
            background-color: #f5f5f5;
        }
        .dataTables_wrapper .dt-buttons a.dt-button:hover:not(.disabled) {
            border: none;
        }*/
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
            <i class="fa fa-users"></i> Utilisateurs
        </li>
    </ol>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.users.index') }}">Voir tous les utilisateurs</a></li>
        <li><a href="{{ route('back.users.create') }}">Créer un utilisateur</a>
    </ul>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des utilisateurs
                </div>

                <div class="panel-body" style="display: none;">
                    <table class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Actif?</th>
                                <th>Nb d'emails envoyés</th>
                                {{-- <th>Type</th> --}}
                                {{-- <th>Statut</th> --}}
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="checkbox checkbox-warning">
                                            <input type="checkbox" class="filled-in" id="{{$user->id}}" @if ($user->is_active) checked @endif>
                                            <label for="{{$user->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="text-center" id="{{'emailsent' . $user->id}}">{{ $user->emails_sent }}</td>
                                    {{-- <td>{{ $user->type }}</td> --}}
                                    {{-- <td>{{ $user->statut }}</td> --}}
                                    <td>{{ Date::parse($user->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($user->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/users/' . $user->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/users/' . $user->id) }}" style="margin: 5px;">Montrer</a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/users/' . $user->id . '/edit') }}" style="margin: 5px;">Editer</a>
                                            <a class="btn btn-small btn-primary" id="{{$user->id}}" href="{{ URL::to('back/users/email-user') }}" data-email="{{$user->email}}" style="margin: 5px;">Envoyer e-mail</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!} --}}
                                            <button class="btn btn-small btn-warning disabled{{$user->id}}" style="margin: 5px;">Supprimer</button>
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
    
    <!-- User cannot delete its own account -->
    <script>
        var auth = <?php echo Auth::user()->id; ?>;
        // console.log(auth);
        $(".disabled" + auth).attr("disabled", true);
        $(".disabled1").attr("disabled", true);
    </script>

    <script>
        $(document).ready(function(){
            $('.filled-in').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                id = $(this).attr('id');
                warnBeforeCheck();
            });
            function warnBeforeCheck() {
                // Check if checkbox is checked
                if ($('#' + id).is(':checked')) {
                    swal({
                        title: "Etes-vous sûr?",
                        text: "Vous allez rendre ce compte actif. Un membre actif obtient l'accès aux fichiers en téléchargement. N'oubliez pas de lui indiquer son changement de statut en lui envoyant un email.",
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
                            $.ajax({
                                type: 'POST',
                                url: "{{ URL::route('back.users.changeStatus') }}",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    if ($('#' + id).is(":checked")) {
                                        //console.log('Checkbox is checked!');
                                        $('#' + id).prop('checked', false);
                                    } else {
                                        //console.log('Checkbox is not checked!');
                                        $('#' + id).prop('checked', true);
                                    }        
                                    swal("Succès", "Statut du membre modifié avec succès", "success");
                                },
                            });
                        } else {
                            swal("Annulé", "Pas de changement :)", "error");
                        }
                    });
                } else {
                    swal({
                        title: "Etes-vous sûr?",
                        text: "Vous allez rendre ce compte inactif. Le membre ne pourra plus accéder aux fichiers en téléchargement.",
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
                            $.ajax({
                                type: 'POST',
                                url: "{{ URL::route('back.users.changeStatus') }}",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    if ($('#' + id).is(":checked")) {
                                        //console.log('Checkbox is checked!');
                                        $('#' + id).prop('checked', false);
                                    } else {
                                        //console.log('Checkbox is not checked!');
                                        $('#' + id).prop('checked', true);
                                    }        
                                    swal("Succès", "Statut du membre modifié avec succès", "success");
                                },
                            });
                        } else {
                            swal("Annulé", "Pas de changement :)", "error");
                        }
                    });
                }
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
                text: "Vous ne serez plus en mesure de récupérer cet utilisateur.",
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
                    swal("Annulé", "L'utilisateur est sauvé :-)", "error");
                }
            });
        }
    </script>
    <script>
        $(document).ready(function(){
            $('.btn-primary').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                id = $(this).attr('id');
                email = $(this).attr('data-email');
                warnBeforeSend();
            });
            function warnBeforeSend() {
                swal({
                    title: "Etes-vous sûr?",
                    html: true,
                    text: "Vous êtes sur le point d'envoyer un e-mail de confirmation d'activation de compte à <b>" + email + "</b>. <br /><a href=email-user/" + id + " target='_blank'>Voir le modèle de l'e-mail</a>",
                    // text: "Vous êtes sur le point d'envoyer un e-mail de confirmation d'activation de compte à <b>" + email + id + "</b>. <br /><a href='{{ route('back.users.showEmail', ['id' => "id"]) }}' target='_blank'>Voir le modèle de l'e-mail</a>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#337ab7",
                    confirmButtonText: "Oui!",
                    cancelButtonText: "Non, annuler",
                    closeOnConfirm: false,
                    closeOnCancel: false 
                },
                function(isConfirm) {
                    if (isConfirm) {
                        // Disable button
                        $('.confirm').prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: "{{ URL::route('back.users.sendEmail') }}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id,
                                'email': email
                            },
                            success: function(data) {                                
                                swal("Succès", "L'email va être envoyé dans la prochaine minute.", "success");
                                $("#emailsent" + id).text(data.emails_sent);
                            },
                        });
                    } else {
                        swal("Annulé", "Aucun envoi effectué :-)", "error");
                    }
                });
            }
        });
    </script>
@endsection