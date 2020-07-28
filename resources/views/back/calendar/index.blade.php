@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        table.dataTable th {
            padding: 3px 10px;
            width: 1px;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-calendar"></i> Calendrier
        </li>
    </ol>

    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.calendar.index') }}">Voir le calendrier complet</a></li>
        <li><a href="{{ route('back.calendar.create') }}">Ajouter un mois</a>
    </ul><!-- /.nav navbar-nav -->

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Calendrier
                </div>

                <div class="panel-body" style="">
                    <table class="table table-bordered table-striped table-hover dataTable" id="calendar_table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Année</th>
                                <th>Trimestre</th>
                                <th>Mois</th>
                                <th>Semaine 1</th>
                                <th>N° semaine 1</th>
                                <th>Semaine 2</th>
                                <th>N° semaine 2</th>
                                <th>Semaine 3</th>
                                <th>N° semaine 3</th>
                                <th>Semaine 4</th>
                                <th>N° semaine 4</th>
                                <th>Semaine 5</th>
                                <th>N° semaine 5</th>
                                <th>Date de création</th>
                                <th>Dernière modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calendar as $key=>$month)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $month->year }}</td>
                                    <td>{{ $month->quarter }}</td>
                                    <td>{{ $month->month }}</td>
                                    <td>{{ $month->week1 }}</td>
                                    <td>{{ $month->week1_nb }}</td>
                                    <td>{{ $month->week2 }}</td>
                                    <td>{{ $month->week2_nb }}</td>
                                    <td>{{ $month->week3 }}</td>
                                    <td>{{ $month->week3_nb }}</td>
                                    <td>{{ $month->week4 }}</td>
                                    <td>{{ $month->week4_nb }}</td>
                                    <td>{{ $month->week5 }}</td>
                                    <td>{{ $month->week5_nb }}</td>
                                    <td>{{ Date::parse($month->created_at)->format('j F Y') }}</td>
                                    <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'back/calendar/' . $month->id, 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-info" href="{{ URL::to('back/calendar/' . $month->id . '/edit') }}" style="margin: 5px;">Editer</a>
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
            $('#calendar_table').DataTable({
                // responsive: true,
                scrollX: true,
                // order: [[3, 'asc']],
            });
        });
    </script>
@endsection