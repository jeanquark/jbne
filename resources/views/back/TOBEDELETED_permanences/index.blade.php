@extends('layouts.layoutBack')

@section('css')
    <!-- jQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- jQuery DataTable Select extension -->
    <link href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css" rel="stylesheet">

    <!-- jQuery Datatables Checkboxes -->
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css" rel="stylesheet" />

    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        .red {
            background: #ec971f;
        }
        .green {
            background: #5cb85c;
        }
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
        .sweet-alert {
            max-height: 500px;
            overflow-y : auto !important;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-business"></i> Permanences des Avocats
        </li>
    </ol>

    <div class="vertical-center" id="loading">
        <div class="container text-center">
            <img src="{{ asset('images/ajax-loader.gif') }}" alt="loading...">
        </div>
    </div>

    <div id="displayContent" class="hidden">

        <ul class="nav navbar-nav pull-left">
            <li><a href="{{ route('back.permanences.index') }}">Voir les disponibilités du prochain trimestre</a></li>
        </ul>

        <div id="radioBtn" class="btn-group pull-right">
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter1" id="see_quarter1">Trimestre I</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter2" id="see_quarter2">Trimestre II</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter3" id="see_quarter3">Trimestre III</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter4" id="see_quarter4">Trimestre IV</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="year" id="see_whole_year">Année complète {{ $calendarWholeYear[0]->year }}</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="nextYearQuarter1" id="see_nextYearQuarter1">Trimestre I de l'année prochaine {{ $calendarNextYearQuarter1[0][0]->year }}</a>
        </div>
        
        <div class="row clearfix" id="">
            <div class="col-md-12">
                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        Disponibilités transmises des avocats dans le cadre des permanences trimestrielles pour l'année.
                    </div>

                    <!-- First quarter -->
                    <div class="panel-body hidden" id="quarter1">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarQuarter1 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter1 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="quarter1Count{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline', 'id' => 'permanences_crud')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger" id="deletePermanences" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Second quarter -->
                    <div class="panel-body hidden" id="quarter2">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarQuarter2 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter2 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            {{-- {{ $month }} --}}
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="quarter2Count{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline', 'id' => 'permanences_crud')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger" id="deletePermanences" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Third quarter -->
                    <div class="panel-body hidden" id="quarter3">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarQuarter3 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter3 as $key => $quarter)
                                    <tr class="abc">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="quarter3Count{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline', 'id' => 'permanences_crud')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger" id="deletePermanences" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Fourth quarter -->
                    <div class="panel-body hidden" id="quarter4">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarQuarter4 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter4 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="quarter4Count{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline', 'id' => 'permanences_crud')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger" id="deletePermanences" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Whole year -->
                    <div class="panel-body hidden" id="wholeYear">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_wholeYear">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarWholeYear as $month)
                                        <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                        <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                        <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                        <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                        @if ($month->week5)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                        @endif
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wholeYear as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="wholeYearCount{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->

                    <!-- First quarter next year -->
                    <div class="panel-body hidden" id="nextYearQuarter1">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_nextYearQuarter1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'utilisateur</th>
                                    @foreach ($calendarNextYearQuarter1 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total dispo</th>
                                    <th>Dernière modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nextYearQuarter1 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="nextYearQuarter1Count{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline', 'id' => 'permanences_crud')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger" id="deletePermanences" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->

        <div class="row clearfix text-center">
            <div id="generatePermanencesListButton">
                {!! Form::open(array('route' => array('back.permanences-attribution.store'), 'method' => 'POST', 'id' => 'generate_attribution_form')) !!}
                    {!! Form::hidden('year', $nextQuarterYear, array('id' => 'submitYear')) !!}
                    {!! Form::hidden('quarter', $nextQuarter, array('id' => 'submitQuarter')) !!}
                    {!! Form::submit('Générer l\'attribution aléatoire des permanences du trimestre II', array('class' => 'btn btn-success', 'id' => 'generatePermanencesListButtonSuccess')) !!}
                    <br /><small>(confirmation requise)</small>
                {!! Form::close() !!}
            </div>
            
            <div id="reGeneratePermanencesListButton">
                {!! Form::open(array('route' => array('back.permanences-attribution.reGeneratePermanencesList'), 'method' => 'POST', 'id' => 'regenerate_attribution_form')) !!}
                    {!! Form::hidden('year', $nextQuarterYear, array('id' => 'submitYear')) !!}
                    {!! Form::hidden('quarter', $nextQuarter, array('id' => 'submitQuarter')) !!}
                    {!! Form::submit('Regénérer l\'attribution aléatoire des permanences du trimestre II', array('class' => 'btn btn-warning', 'id' => 'reGeneratePermanencesListButtonWarning')) !!}
                    <br /><small>(confirmation requise)</small>
                {!! Form::close() !!}
            </div>

            <h3 class="hidden" id="selectQuarterMessage">Veuillez sélectionner une période <i class="fa fa-arrow-up"></i></h3>
        </div><!-- /.row clearfix -->
        
        <br />

        <div class="row clearfix text-center">
            <button class="btn btn-info" id="copyAvailabilities">Faire une copie des disponibilités du trimestre</button><br />
            <small>(confirmation requise)</small>
            <br /><br />
            <button class="btn btn-primary" id="sendEmail">Envoi E-mail ouverture des permanences aux avocats séléctionnés</button><br />
            <small>(confirmation requise)</small>
            <br /><br />
        </div>

    </div><!-- /#content -->

@endsection

@section('scripts')
    <!-- To use npm packages -->
    <script src="/js/app.js"></script>

    <!-- jQuery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.16/api/sum().js"></script>
    
    <!-- jQuery DataTable Select extension -->
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>

    <!-- jQuery Datatable Checkboxes -->
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>

    <!-- Table tooltip -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>

    <script>
        $(document).ready(function(){
            var nextQuarterYear = <?php echo $nextQuarterYear; ?>;
            var nextQuarter = <?php echo $nextQuarter; ?>;
            $('#generatePermanencesListButton').addClass("hidden");
            $('#reGeneratePermanencesListButton').addClass("hidden");
            $('#selectQuarterMessage').addClass("hidden");

            var permanencesQuarter = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear)->where('quarter', '=', $nextQuarter)->count(); ?>;

            $('#see_quarter' + nextQuarter).removeClass("notActive");
            $('#see_quarter' + nextQuarter).addClass("active");
            $('#quarter' + nextQuarter).removeClass("hidden");
            if (permanencesQuarter > 0) {
                $('#generatePermanencesListButton').addClass("hidden");
                $('#reGeneratePermanencesListButton').removeClass("hidden");
            } else {
                $('#generatePermanencesListButton').removeClass("hidden");
                $('#reGeneratePermanencesListButton').addClass("hidden");
            }
            if ($.fn.dataTable.isDataTable('#table_quarter' + nextQuarter)) {
                $('#table_quarter' + nextQuarter).DataTable();
            }
            else {
                table = $('#table_quarter' + nextQuarter).DataTable({
                    scrollX: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                    },
                    columnDefs: [
                        {
                            'targets': 0,
                            'checkboxes': {
                                'selectRow': true
                            }
                        }
                    ],
                    select: {
                        'style': 'multi',
                    },
                    order: [[1, 'asc']]
                });
            }
            getTotal();

            $('#see_quarter1').click(function(e) {
                $('.quarterBtn').removeClass("active");
                $('.quarterBtn').addClass("notActive");
                $('#see_quarter1').removeClass("notActive");
                $('#see_quarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter1').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                var permanencesQuarter1 = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear)->where('quarter', '=', 1)->count(); ?>;
                if (permanencesQuarter1 > 0) {
                    $('#generatePermanencesListButton').addClass("hidden");
                    $('#reGeneratePermanencesListButton').removeClass("hidden");
                } else {
                    $('#generatePermanencesListButton').removeClass("hidden");
                    $('#reGeneratePermanencesListButton').addClass("hidden");
                }
                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(1);
                $('#generatePermanencesListButtonSuccess').val('Générer l\'attribution aléatoire des permanences du trimestre I');
                $('#reGeneratePermanencesListButtonWarning').val('Regénérer l\'attribution aléatoire des permanences du trimestre I');

                if ($.fn.dataTable.isDataTable('#table_quarter1')) {
                    table = $('#table_quarter1').DataTable();
                }
                else {
                    table = $('#table_quarter1').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        },
                        columnDefs: [
                            {
                                'targets': 0,
                                'checkboxes': {
                                    'selectRow': true
                                }
                            }
                        ],
                        select: {
                            'style': 'multi',
                        },
                        order: [[1, 'asc']]
                    });
                }
                getTotal();
            });
            $('#see_quarter2').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter2').removeClass("notActive");
                $('#see_quarter2').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter2').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                var permanencesQuarter2 = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear)->where('quarter', '=', 2)->count(); ?>;
                if (permanencesQuarter2 > 0) {
                    $('#generatePermanencesListButton').addClass("hidden");
                    $('#reGeneratePermanencesListButton').removeClass("hidden");
                } else {
                    $('#generatePermanencesListButton').removeClass("hidden");
                    $('#reGeneratePermanencesListButton').addClass("hidden");
                }
                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(2);
                $('#generatePermanencesListButtonSuccess').val('Générer l\'attribution aléatoire des permanences du trimestre II');
                $('#reGeneratePermanencesListButtonWarning').val('Regénérer l\'attribution aléatoire des permanences du trimestre II');

                if ($.fn.dataTable.isDataTable('#table_quarter2')) {
                    table = $('#table_quarter2').DataTable();
                }
                else {
                    table = $('#table_quarter2').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        },
                        columnDefs: [
                            {
                                'targets': 0,
                                'checkboxes': {
                                    'selectRow': true
                                }
                            }
                        ],
                        select: {
                            'style': 'multi'
                        },
                        order: [[1, 'asc']]
                    });
                }
                getTotal();
            });
            $('#see_quarter3').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter3').removeClass("notActive");
                $('#see_quarter3').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter3').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                var permanencesQuarter3 = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear)->where('quarter', '=', 3)->count(); ?>;
                if (permanencesQuarter3 > 0) {
                    $('#generatePermanencesListButton').addClass("hidden");
                    $('#reGeneratePermanencesListButton').removeClass("hidden");
                } else {
                    $('#generatePermanencesListButton').removeClass("hidden");
                    $('#reGeneratePermanencesListButton').addClass("hidden");
                }
                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(3);
                $('#generatePermanencesListButtonSuccess').val('Générer l\'attribution aléatoire des permanences du trimestre III');
                $('#reGeneratePermanencesListButtonWarning').val('Regénérer l\'attribution aléatoire des permanences du trimestre III');

                if ($.fn.dataTable.isDataTable('#table_quarter3')) {
                    $('#table_quarter3').DataTable();
                }
                else {
                    $('#table_quarter3').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        }
                    });
                }
                getTotal();
            });
            $('#see_quarter4').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter4').removeClass("notActive");
                $('#see_quarter4').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter4').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                var permanencesQuarter4 = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear)->where('quarter', '=', 4)->count(); ?>;
                if (permanencesQuarter4 > 0) {
                    $('#generatePermanencesListButton').addClass("hidden");
                    $('#reGeneratePermanencesListButton').removeClass("hidden");
                } else {
                    $('#generatePermanencesListButton').removeClass("hidden");
                    $('#reGeneratePermanencesListButton').addClass("hidden");
                }

                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(4);
                $('#generatePermanencesListButtonSuccess').val('Générer l\'attribution aléatoire des permanences du trimestre IV');
                $('#reGeneratePermanencesListButtonWarning').val('Regénérer l\'attribution aléatoire des permanences du trimestre IV');

                if ($.fn.dataTable.isDataTable('#table_quarter4')) {
                    $('#table_quarter4').DataTable();
                }
                else {
                    $('#table_quarter4').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        }
                    });
                }
                getTotal();
            });
            $('#see_whole_year').click(function(e) {
                $('.quarterBtn').removeClass("active");
                $('.quarterBtn').addClass("notActive");
                $('#see_whole_year').removeClass("notActive");
                $('#see_whole_year').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#wholeYear').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                $('#generatePermanencesListButton').addClass("hidden");
                $('#reGeneratePermanencesListButton').addClass("hidden");

                if ($.fn.dataTable.isDataTable('#table_wholeYear')) {
                    $('#table_wholeYear').DataTable();
                }
                else {
                    $('#table_wholeYear').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        }
                    });
                }
                getTotal();
            });
            $('#see_nextYearQuarter1').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_nextYearQuarter1').removeClass("notActive");
                $('#see_nextYearQuarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#nextYearQuarter1').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");

                var permanencesQuarter1NextYear = <?php echo App\PermanenceAttribution::where('year', '=', $nextQuarterYear+1)->where('quarter', '=', 1)->count(); ?>;
                if (permanencesQuarter1NextYear > 0) {
                    $('#generatePermanencesListButton').addClass("hidden");
                    $('#reGeneratePermanencesListButton').removeClass("hidden");
                } else {
                    $('#generatePermanencesListButton').removeClass("hidden");
                    $('#reGeneratePermanencesListButton').addClass("hidden");
                }
                $("#submitYear").val(nextQuarterYear+1);
                $('#submitQuarter').val(1);
                $('#generatePermanencesListButtonSuccess').val('Générer l\'attribution aléatoire des permanences du trimestre I de l\'année prochaine');
                $('#reGeneratePermanencesListButtonWarning').val('Regénérer l\'attribution aléatoire des permanences du trimestre I de l\'année prochaine');

                if ($.fn.dataTable.isDataTable('#table_nextYearQuarter1')) {
                    $('#table_nextYearQuarter1').DataTable();
                }
                else {
                    $('#table_nextYearQuarter1').DataTable({
                        scrollX: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                        }
                    });
                }
                getTotal();
            });
        });
    </script>

    <script>
        function getTotal() {
            var rowCount1 = $('#table_quarter1 tr').length;
            // console.log(rowCount1);
            for (i = 0; i < rowCount1 - 1; i++) {
                var count1 = $("#quarter1Count" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter1Count" + i).html(count1);
            }

            var rowCount2 = $('#table_quarter2 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount2 - 1; i++) {
                var count2 = $("#quarter2Count" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter2Count" + i).html(count2);
            }

            var rowCount3 = $('#table_quarter3 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount3 - 1; i++) {
                var count3 = $("#quarter3Count" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter3Count" + i).html(count3);
            }

            var rowCount4 = $('#table_quarter4 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount4 - 1; i++) {
                var count4 = $("#quarter4Count" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter4Count" + i).html(count4);
            }

            var rowCountWholeYear = $('#table_wholeYear tr').length;
            // console.log(rowCountWholeYear);
            for (i = 0; i < rowCountWholeYear - 1; i++) {
                var countWholeYear = $("#wholeYearCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#wholeYearCount" + i).html(countWholeYear);
            }

            var rowCountNextYear1 = $('#table_nextYearQuarter1 tr').length;
            // console.log(rowCount1);
            for (i = 0; i < rowCountNextYear1 - 1; i++) {
                var countNextYearQuarter1 = $("#nextYearQuarter1Count" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#nextYearQuarter1Count" + i).html(countNextYearQuarter1);
            }
        }
    </script>

    <script>
        $(window).on("load", function() {
            // console.log("window loaded");
            $('#loading').addClass("hidden");
            $('#displayContent').removeClass("hidden");
        });
    </script>

    <script>
        $('#generatePermanencesListButton').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            // form = $(this).closest('form');
            warnBeforeGenerate();
        });

        function warnBeforeGenerate() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous allez générer l'attribution aléatoire des permanences pour l'entier de la période définie. Le calcul peut prendre quelques secondes.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#286090",
                confirmButtonText: "Oui, générer la table des permanences!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {
                    console.log('send generate form');
                    $('.confirm').prop('disabled', true);
                    $("#generate_attribution_form").submit();                   
                } else {
                    swal("Annulé", "Aucune modification effectuée :-)", "error");
                }
            });
        }

        $('#reGeneratePermanencesListButton').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            // form = $(this).closest('form');
            warnBeforeRegenerate();
        });

        function warnBeforeRegenerate() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous allez effacer l'attribution actuelle et générer une nouvelle attribution aléatoire des permanences pour l'entier de la période définie. Le calcul peut prendre quelques secondes.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#286090",
                confirmButtonText: "Oui, redéfinir la table des permanences!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {
                    $('.confirm').prop('disabled', true);
                    $("#regenerate_attribution_form").submit();
                } else {
                    swal("Annulé", "Aucune modification effectuée :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#deletePermanences').click(function(e) {
            console.log('click');
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRemove();
        });

        function warnBeforeRemove() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer les permanences liées à cet avocat.",
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
                    $('.confirm').prop('disabled', true);
                    // $("#permanences_crud").submit();                  
                    form.submit();
                } else {
                    swal("Annulé", "Les permanences sont sauvées :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#copyAvailabilities').click(function(e){
            year = <?php echo $nextQuarterYear; ?>;
            quarter = <?php echo $nextQuarter; ?>;
            method = 'copyAvailabilities';
            warnBeforeRedirectToCopyAvailabilities();
        });

        function warnBeforeRedirectToCopyAvailabilities() {
            swal({
                title: "Etes-vous sûr?",
                html: true,
                text: "Les données sur la disponibilité des avocats pour le trimestre " + quarter + " de l'année " + year + " vont être copiées dans la table de sauvegarde. Cette action devrait idéalement être effectuée avant chaque modification d'importance dans la table des permanences.",
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
                    console.log(year);
                    console.log(quarter);
                    $('.confirm').prop('disabled', true);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: "{{ URL::route('back.permanences.sendEmail') }}",
                        data: {
                            method: method,
                            year: 2018,
                            quarter: 2
                            // data: data
                        },
                        success: function(data) {                                
                            swal({
                                title: "Succès",
                                html: true,
                                text: "Les permanences ont été copiées avec succès.",
                                type: "success"
                            })
                        },
                    });
                } else {
                    swal("Annulé", "Aucun envoi effectué :-)", "error");
                }
            });
        }
    </script>

    <script>
        // $(document).ready(function () {
            $('#sendEmail').click(function(e){
                // var form = this;
                method = 'sendEmail';
                ids = [];
                var rows_selected = table.column(0).checkboxes.selected();
                // console.log(rows_selected);

                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    ids.push(parseInt(rowId));
                });
                // ids = [1, 3, 15];
                // console.log(ids);
            
                const allLawyers = <?php echo \App\Lawyer::all(); ?>;
                // console.log(allLawyers);
                // ids = [1, 3];
                // console.log(ids);
                const collection = collect(allLawyers);
                // console.log(collection);

                lawyers = collection.whereIn('id', ids).all();
                // console.log(lawyers);

                email = '';
                // console.log(lawyers);
                lawyers.forEach(function (lawyer) {
                    email += ("<a href='permanences/email-lawyer/" + lawyer.id + "' target='_blank'>" + lawyer.email + "</a><br />")
                });

                warnBeforeSendEmail();
            });
        // });

        // $('#sendEmail2').click(function(e) {
        //     e.preventDefault(); // Prevent the href from redirecting directly
        //     form = $(this).closest('form');
        //     lawyers = <?php echo \App\Lawyer::all(); ?>;
        //     email = '';
        //     lawyers.forEach(function (lawyer) {
        //         email += ("<a href='permanences/email-lawyer/" + lawyer.id + "' target='_blank'>" + lawyer.email + "</a><br />")
        //     });
        //     var table = $('#table_quarter2');
        //     console.log(table);
        //     var rows_selected = table.column(0).checkboxes.selected();
        //     // console.log(rows_selected);
        //     // warnBeforeRedirect();
        // });

        function warnBeforeSendEmail() {
            swal({
                title: "Etes-vous sûr?",
                html: true,
                text: "Vous êtes sur le point d'envoyer un e-mail aux avocats de la liste suivante pour leur indiquer l'ouverture des permanences. Voici les modèles d'envoi:<br/><br/>" + email,
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
                    // return ids;
                    console.log(ids);
                    console.log(lawyers);
                    $('.confirm').prop('disabled', true);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: "{{ URL::route('back.permanences.sendEmail') }}",
                        data: {
                            // '_token': $('input[name=_token]').val(),
                            method: method,
                            lawyer_ids: ids,
                            lawyers: lawyers
                        },
                        success: function(data) {                                
                            // swal("Succès", "Les emails ont été envoyés au serveur de <a href=https://www.mailgun.com/ target=_blank>Mailgun</a>. Ils parviendront dont quelques minutes aux destinataires.", "success");
                            swal({
                                title: "Succès",
                                html: true,
                                text: "Les emails ont été envoyés au serveur de <a href=https://www.mailgun.com/ target=_blank>Mailgun</a>. Ils parviendront dans quelques minutes aux destinataires.",
                                type: "success"
                            })
                        },
                    });
                } else {
                    swal("Annulé", "Aucun envoi effectué :-)", "error");
                }
            });
        }
    </script>
@endsection