@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        [data-tooltip] {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }
        /* Hide the tooltip content by default */
        [data-tooltip]:before, [data-tooltip]:after {
            visibility: hidden;
            z-indexms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            pointer-events: none;
        }
        /* Position tooltip above the element */
        [data-tooltip]:before {
            position: absolute;
            bottom: -80%;
            left: 50%;
            margin-bottom: 5px;
            margin-left: -80px;
            padding: 7px;
            width: 220px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background-color: #000;
            /*background-color: hsla(0, 0%, 20%, 0.9);*/
            color: #fff;
            content: attr(data-tooltip);
            text-align: center;
            font-size: 14px;
            line-height: 1.2;
        }
        /* Triangle hack to make tooltip look like a speech bubble */
        [data-tooltip]:after {
            position: absolute;
            bottom: 0%;
            left: 50%;
            margin-left: -5px;
            width: 0;
            border-top: 5px solid #000;
            /*border-top: 5px solid hsla(0, 0%, 20%, 0.9);*/
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            content: " ";
            font-size: 0;
            line-height: 0;
        }
        /* Show tooltip content on hover */
        [data-tooltip]:hover:before, [data-tooltip]:hover:after {
            visibility: visible;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }
        .red {
            background: #ec971f;
        }
        .green {
            background: #5cb85c;
        }
        /*div.dataTables_wrapper {
            width: 800px;
            margin: 0 auto;
        }*/
        #radioBtn .notActive{
            color: #3276b1;
            background-color: #fff;
        }
        .hidden {
            visibility: hidden;
        }
        .vertical-center {
          min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
          min-height: 100vh; /* These two lines are counted as one :-)       */
          display: flex;
          align-items: center;
        }
        .valign {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-business"></i> Permanences des Avocats
        </li>
    </ol>

    <ul class="nav navbar-nav pull-left">
        <li><a href="{{ route('back.permanences.index') }}">Voir toutes les permanences</a></li>
    </ul>

    <div id="radioBtn" class="btn-group pull-right">
        <a class="btn btn-primary btn-sm active" data-toggle="permanences" data-title="see4" id="button_see4">4 prochaines semaines</a>
        <a class="btn btn-primary btn-sm notActive" data-toggle="permanences" data-title="seeAll" id="button_seeAll">Année complète</a>
    </div>

    <div class="vertical-center" id="loading">
        <div class="container text-center">
            <img src="{{ asset('images/ajax-loader.gif') }}" alt="loading...">
        </div>
    </div>

    <div class="row clearfix hidden" id="panel_see4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des permanences pour le 4 prochaines semaines. Cette semaine est la semaine n° {{ $week_nb }} de l'année {{ date('Y') }}.
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover permanence-table" id="table_see4">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>E-mail</th>
                                <th class="demo"><span data-tooltip="Semaine {{ date("W") }}">Cette semaine</span></th>
                                <th class="demo"><span data-tooltip="Semaine {{ date("W", strtotime("+1 week")) }}">La semaine prochaine</span></th>
                                <th class="demo"><span data-tooltip="Semaine {{ date("W", strtotime("+2 week")) }}">Dans 2 semaines</span></th>
                                <th class="demo"><span data-tooltip="Semaine {{ date("W", strtotime("+3 week")) }}">Dans 3 semaines</span></th>
                                {{-- <th>Remarques</th> --}}
                                {{-- <th>Date de création</th> --}}
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permanences as $key=>$permanence)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $permanence->lawyer->lastname }}</td>
                                    <td>{{ $permanence->lawyer->firstname }}</td>
                                    <td>{{ $permanence->lawyer->email }}</td>
                                    @if ($permanence['week'. $week_nb])
                                        <td class="green"><i class="fa fa-check"></i><span class="hidden">{{ 1 }}</span></td>
                                    @else
                                        <td class="red"><i class="fa fa-times"></i><span class="hidden">{{ 0 }}</span></td>
                                    @endif
                                    @if ($permanence['week' . ($week_nb+1)])
                                        <td class="green"><i class="fa fa-check"></i><span class="hidden">{{ 1 }}</span></td>
                                    @else
                                        <td class="red"><i class="fa fa-times"></i><span class="hidden">{{ 0 }}</span></td>
                                    @endif
                                    @if ($permanence['week' . ($week_nb+2)])
                                        <td class="green"><i class="fa fa-check"></i><span class="hidden">{{ 1 }}</span></td>
                                    @else
                                        <td class="red"><i class="fa fa-times"></i><span class="hidden">{{ 0 }}</span></td>
                                    @endif
                                    @if ($permanence['week' . ($week_nb+3)])
                                        <td class="green"><i class="fa fa-check"></i><span class="hidden">{{ 1 }}</span></td>
                                    @else
                                        <td class="red"><i class="fa fa-times"></i><span class="hidden">{{ 0 }}</span></td>
                                    @endif
                                    {{-- <td>{{ $permanence->remarks }}</td> --}}
                                    {{-- <td>{{ Date::parse($permanence->created_at)->format('j F Y') }}</td> --}}
                                    <td>{{ Date::parse($permanence->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/permanences/' . $permanence->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/permanences/' . $permanence->id) }}" style="margin: 5px;"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/permanences/' . $permanence->id . '/edit') }}" style="margin: 5px;"><i class="fa fa-pencil"></i></a>
                                            {{-- {!! Form::hidden('_method', 'DELETE') !!} --}}
                                            {{-- {!! Form::submit('x', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!} --}}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            <button class="btn btn-small btn-danger" style="margin: 5px;"><i class="fa fa-times"></i></button>
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

    <div class="row clearfix hidden" id="panel_seeAll" style="">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des permanences année 2018
                </div>
                <div class="panel-body">
                    <table id="table_seeAll" class="table table-border table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>E-mail</th>
                                @foreach ($calendar as $month)
                                    <th class="demo"><span data-tooltip="{{ $month->week1 }}">{{ 'W' . $month->week1_nb }}</span></th>
                                    <th class="demo"><span data-tooltip="{{ $month->week2 }}">{{ 'W' . $month->week2_nb }}</span></th>
                                    <th class="demo"><span data-tooltip="{{ $month->week3 }}">{{ 'W' . $month->week3_nb }}</span></th>
                                    <th class="demo"><span data-tooltip="{{ $month->week4 }}">{{ 'W' . $month->week4_nb }}</span></th>
                                    @if ($month->week5)
                                        <th class="demo"><span data-tooltip="{{ $month->week5 }}">{{ 'W' . $month->week5_nb }}</span></th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permanences as $key=>$permanence)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $permanence->lawyer->lastname }}</td>
                                    <td>{{ $permanence->lawyer->firstname }}</td>
                                    <td>{{ $permanence->lawyer->email }}</td>
                                    @for ($i = 1; $i <= 53; $i++)
                                        @if ($permanence['week' . $i])
                                            <td class="green text-center"><i class="fa fa-check"></i></td>
                                        @else
                                            <td class="red text-center"><i class="fa fa-times"></i></td>
                                        @endif
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->

    <div class="row">
        <button class="btn btn-success center-block" id="generateList">Générer liste aléatoire de 4 avocats disponibles par semaine</button>
        
        <br /><br /><hr><br /><br />
        
        <div id="table_generateList">
    </div>
@endsection

@section('scripts')
	<!-- Jquery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#generateList').click(function(e) {
                console.log('click');
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::route('back.permanences.generateList') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'year': 2018,
                        'quarter': 2,
                        'number': 4
                    },
                    beforeSend: function() {
                        $('#table_generateList').html('');
                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        // swal("Succès", "Statut du membre modifié avec succès", "success");
                        $('#table_generateList').append('' +
                            '<table><tbody>' +
                            '<tr>' +
                                '<td><span></span></td>' +
                                '<td>1</td>' +
                                '<td>2</td>' +
                                '<td></td>' +
                                '<td>0</td>' +
                            '</tr>' +
                            '</tbody></table>' +
                        '');
                    },
                });
            });
        });
    </script>

    <script>
        // $(function () {
        //     $('#table_see4').DataTable({
        //         responsive: true,
        //         scrollX: true,
        //         dom: 'Bfrtip',
        //         order: [[0, 'desc']],
        //         lengthMenu: [
        //                 [ 10, 25, 50, -1 ],
        //                 [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        //             ],
        //         buttons: [
        //             'copy', 'csv', 'excel', 'pdf', 'print'
        //         ],
        //         columnDefs: [
        //             {
        //                 "targets": [6,7],
        //                 "visible": false,
        //             },
        //             { 
        //                 "targets": [5], 
        //                 "orderable": false 
        //             }
        //         ],
        //         oLanguage: {
        //             sUrl: "//cdn.datatables.net/plug-ins/1.10.13/i18n/French.json",
        //             buttons: {
        //                 copy: 'Copier',
        //                 print: 'Imprimer'
        //             }
        //         }
        //     });
        // });
    </script>

    <script>

    </script>
    
    <script>
        // $(document).ready(function() {
        //     $('#panel_seeAll').hide();
        //     $('#table_see4').DataTable({
        //         // "responsive": true,
        //         scrollX: true,
        //         // sScrollX: "100%",
        //     });
        // });
    </script>

    <script>
        // $(document).ready(function() {
        //     $('#table_seeAll').DataTable({
        //         // responsive: true,
        //         scrollX: true,
        //         // sScrollX: "100%",
        //         // order: [[3, 'asc']],
        //     });
        // });
    </script>

    <script>

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
                text: "Vous ne serez plus en mesure de récupérer cette permission.",
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
                    swal("Annulé", "La permission est sauvée :)", "error");
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#loading').hide();
            $('#panel_see4').removeClass( "hidden" );
            $('#table_see4').DataTable({
                // "responsive": true,
                scrollX: true,
            }).columns.adjust();
            $( "#button_seeAll" ).click(function() {
                $('#panel_seeAll').removeClass( "hidden" );
                console.log('Click on seeAll button');
                if ($.fn.dataTable.isDataTable('#table_seeAll')) {
                    $('#table_seeAll').DataTable();
                }
                else {
                    $('#table_seeAll').DataTable({
                        scrollX: true
                    }).columns.adjust();
                }
                $('#panel_see4').hide();
                $('#panel_seeAll').show();
                $('#button_seeAll').removeClass( "notActive" ).addClass( "active" );
                $('#button_see4').removeClass( "active" ).addClass( "notActive" );
            });
            $( "#button_see4" ).click(function() {  
                console.log('Click on see4 button');
                // $('#table_seeAll').DataTable().destroy();
                // $('#table_seeAll').DataTable({
                //     retrieve: true,
                //     destroy: true
                // });
                $('#panel_seeAll').hide();
                $('#panel_see4').show();
                $('#button_see4').removeClass( "notActive" ).addClass( "active" );
                $('#button_seeAll').removeClass( "active" ).addClass( "notActive" );    
            });
        });
    </script>

    <script>
        // $('#radioBtn a').on('click', function(){
        //     var sel = $(this).data('title');
        //     var tog = $(this).data('toggle');
        //     $('#'+tog).prop('value', sel);
            
        //     $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        //     $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        // })
    </script>
@endsection