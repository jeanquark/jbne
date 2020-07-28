@extends('layouts.layoutBack')

@section('css')
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css" rel="stylesheet">
    <style>
        .form-group input[type="checkbox"] {
            display: none;
        }
        .form-group input[type="checkbox"] + .btn-group > label span {
            width: 20px;
        }
        .form-group input[type="checkbox"] + .btn-group > label span:first-child {
            display: none;
        }
        .form-group input[type="checkbox"] + .btn-group > label span:last-child {
            display: inline-block;   
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
            display: inline-block;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
            display: none;   
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label {
            background-color: #449d44;
            border-color: #449d44;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label.active {
            background-color: #c6e1c6;
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
        table.dataTable tbody td.select-checkbox:before, table.dataTable tbody td.select-checkbox:after {
            top: 50%;
        }
        /*table.dataTable tbody td {
            vertical-align: top;
        }*/
        .swal {
            max-height: 80%;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="container"> --}}
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-user-tie"></i> Avocats inscrits</li>
    </ol>
    {{-- </div>./container --}}
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.lawyers.index') }}">Voir tous les avocats</a></li>
        <li><a href="{{ route('back.lawyers.create') }}">Ajouter un avocat</a>
    </ul><!-- /.nav navbar-nav -->

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des avocats
                </div>

                <div class="panel-body" style="display: none;">
                    <table class="table table-bordered table-striped table-hover dataTable" id="table_lawyers" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>N°</th>
                                <th>ID</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Nom d'utilisateur</th>
                                <th>E-mail</th>
                                <th>Adresse</th>
                                <th>Ville</th>
                                <th>Téléphone mobile</th>
                                <th>Téléphone prof.</th>
                                <th>Fax prof.</th>
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lawyers as $key=>$lawyer)
                                <tr>
                                    <td style="padding-top: 40px;"></td>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $lawyer->id }}</td>
                                    <td>{{ $lawyer->firstname }}</td>
                                    <td>{{ $lawyer->lastname }}</td>
                                    <td>{{ $lawyer->username }}</td>
                                    <td>{{ $lawyer->email }}</td>
                                    <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->street }} @endif</td>
                                    <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->city }} @endif</td>
                                    <td>{{ $lawyer->phone_mobile }}</td>
                                    <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->phone_office }} @endif</td>
                                    <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->fax_office }} @endif</td>
                                    <td>{{ Date::parse($lawyer->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($lawyer->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/lawyers/' . $lawyer->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/lawyers/' . $lawyer->id) }}" style="margin: 5px;">Montrer</i></a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/lawyers/' . $lawyer->id . '/edit') }}" style="margin: 5px;">Editer</i></a>
                                            {{-- <a class="btn btn-small btn-primary" id="{{$lawyer->id}}" href="{{ URL::to('back/lawyers/email-lawyer') }}" data-email="{{$lawyer->email}}" style="margin: 5px;">Envoyer e-mail</a> --}}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!} --}}
                                            <button class="btn btn-small btn-danger disabled{{$lawyer->id}}" data-lastname="{{$lawyer->lastname}}" style="margin: 5px;">Supprimer</button>
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
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.panel-body').removeAttr('style');
            var table = $('#table_lawyers').DataTable( {
                // "responsive": true,
                scrollX: true,
                columnDefs: [
                    {
                        "targets": [0],
                        "className": "select-checkbox",
                    },
                    {
                        "targets": [2,7,9,10,11,12],
                        "visible": false,
                    },
                    { 
                        "targets": [0,14], 
                        "orderable": false 
                    }
                ],
                order: [[1, 'asc']],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'selectAll',
                    'selectNone',
                    {
                        'text': 'Envoyer E-mail',
                        'className': 'buttonSendEmail',
                        'action': function() {
                            // console.log(table.rows({ selected: true }).data());
                            var rawData = table.rows({ selected: true }).data();
                        
                            var lawyersArray = [];
                            var lawyers = {};
                            for (var i = 0; i < rawData.length; i++) {
                                lawyersArray.push({'id': rawData[i][2], 'email': rawData[i][6]})
                                lawyers[rawData[i][6]] = {
                                    'id': rawData[i][2],
                                    'firstname': rawData[i][3],
                                    'lastname': rawData[i][4],
                                    'email': rawData[i][6]
                                }
                            }

                            // console.log(lawyers);
                            var lawyerInfo = lawyersArray.map(function(lawyer) { 
                                return "<a href='email-lawyer/" + lawyer.id + "' target='_blank'>" + lawyer.email + "</a><br />";
                            }).join('');

                            swal({
                                title: "Etes-vous sûr?",
                                html: true,
                                text: "Vous êtes sur le point d'envoyer un e-mail indiquant l'ouverture de la période de transmission des disponibilités pour la permanence à: <br /><b>" + lawyerInfo + "</b>",
                                type: "warning",
                                customClass: 'swal',
                                showCancelButton: true,
                                confirmButtonColor: "#337ab7",
                                confirmButtonText: "Oui!",
                                cancelButtonText: "Non, annuler",
                                closeOnConfirm: false,
                                closeOnCancel: false 
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    $('.confirm').prop('disabled', true);
                                    // console.log('lawyer: ', lawyers)
                                    // return
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ URL::route('back.lawyers.sendEmail') }}",
                                        data: {
                                            '_token': $('input[name=_token]').val(),
                                            'lawyers': lawyers
                                        },
                                        success: function(data) {                                
                                            swal("Succès", "Les emails vont être envoyés d'ici quelques minutes.", "success");
                                        },
                                    });
                                }
                                else {
                                    swal("Annulé", "Aucun envoi effectué :-)", "error");
                                }
                            });
                        }
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                    buttons: {
                        colvis: 'Afficher colonnes',
                        pageLength: 'Afficher lignes',
                        selectAll: 'Tout sélectionner',
                        selectNone: 'Tout désélectionner'
                    }
                },
            });
            // $('#table_lawyers').DataTable({
            //     responsive: true,
            //     //dom: 'Bfrtip',
            //     // order: [[0, 'desc']],
            //     lengthMenu: [
            //             [ 10, 25, 50, -1 ],
            //             [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            //         ],
            //     columnDefs: [
            //         {
            //             "targets": [6,7],
            //             "visible": false,
            //         },
            //         { 
            //             "targets": [7], 
            //             "orderable": false 
            //         }
            //     ],
            //     oLanguage: {
            //         sUrl: "//cdn.datatables.net/plug-ins/1.10.13/i18n/French.json"
            //     }
            // });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.btn-danger').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                form = $(this).closest('form');
                lastname = $(this).attr('data-lastname');
                warnBeforeRedirect(form);
            });

            function warnBeforeRedirect() {
                swal({
                    title: "Etes-vous sûr?",
                    html: true,
                    text: "Vous ne serez plus en mesure de récupérer Me " + lastname + ". Vous allez aussi effacer toutes les permanences associées à cet avocat (il n'apparaîtra plus dans la liste des avocats de la 1ère heure).",
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
                        swal("Annulé", "L'avocat est sauvé :-)", "error");
                    }
                });
            }

            $('.buttonSendEmail').click(function(e) {
                console.log('abc');
                e.preventDefault(); // Prevent the href from redirecting directly
                abc = $(this).table.rows({ selected: true }).count();
                console.log(abc);
                // id = $(this).attr('id');
                // email = $(this).attr('data-email');
                // warnBeforeSend();
            });
        });
    </script>
@endsection

