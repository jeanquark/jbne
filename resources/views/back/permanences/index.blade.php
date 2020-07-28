@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- DataTable buttons -->
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Awesome checkboxes -->
    <link rel="stylesheet" href="{{ asset('back/awesome-bootstrap-checkbox.css') }}">

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
        .attributed {
            background-color: yellow;
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
            <i class="fa fa-calendar-check-o"></i> Attribution des Permanences pour les avocats de la 1<sup>ère</sup> heure
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
            @if (isset($calendarNextYearQuarter1[0]) && isset($calendarNextYearQuarter1[0][0]))
                <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="nextYearQuarter1" id="see_nextYearQuarter1">Trimestre I de l'année prochaine {{ $calendarNextYearQuarter1[0][0]->year }}</a>
            @endif
        </div>
        
        <div class="row clearfix" id="">
            <div class="col-md-12">
                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        Disponibilités transmises des avocats dans le cadre des permanences trimestrielles pour l'année {{ $nextQuarterYear }}.
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
                                    <th>Total attr</th>
                                    <th>Dernière modification</th>
                                    <th class="last-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter1 as $key => $quarter)
                                    <tr class="userRow">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif

                                            @if ($month->week1_dispo && $month->week1_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><i class="fa fa-check"></i><span class="hidden">1</span>
                                                </td>
                                            @elseif ($month->week1_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><span class="hidden">0</span></td>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week2_dispo && $month->week2_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week2_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week3_dispo && $month->week3_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week3_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week4_dispo && $month->week4_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week4_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week5_dispo === 1 && $month->week5_attr === 1)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5_dispo === 1)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><span class="hidden">0</span>
                                            @elseif ($month->week5_dispo === 0)
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($loop->last)
                                                <td id="quarterAvailabilityCount1{{$key}}"></td>
                                                <td id="quarterAttributionCount1{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger deletePermanence" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <td colspan="4"><b>Total attributions</b></td>
                                    @foreach ($calendarQuarter1 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalCheckQuarter1"></th>
                                            <th class="totalCheckQuarter1"></th>
                                            <th class="totalCheckQuarter1"></th>
                                            <th class="totalCheckQuarter1"></th>
                                            @if ($month->week5)
                                                <th class="totalCheckQuarter1"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
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
                                    <th>Total attr</th>
                                    <th>Dernière modification</th>
                                    <th class="last-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter2 as $key => $quarter)
                                    <tr class="userRow">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif

                                            @if ($month->week1_dispo && $month->week1_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><i class="fa fa-check"></i><span class="hidden">1</span>
                                                </td>
                                            @elseif ($month->week1_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><span class="hidden">0</span></td>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week2_dispo && $month->week2_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week2_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week3_dispo && $month->week3_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week3_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week4_dispo && $month->week4_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week4_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week5_dispo === 1 && $month->week5_attr === 1)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5_dispo === 1)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><span class="hidden">0</span>
                                            @elseif ($month->week5_dispo === 0)
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($loop->last)
                                                <td id="quarterAvailabilityCount2{{$key}}"></td>
                                                <td id="quarterAttributionCount2{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger deletePermanence" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <td colspan="4"><b>Total attributions</b></td>
                                    @foreach ($calendarQuarter2 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalCheckQuarter2"></th>
                                            <th class="totalCheckQuarter2"></th>
                                            <th class="totalCheckQuarter2"></th>
                                            <th class="totalCheckQuarter2"></th>
                                            @if ($month->week5)
                                                <th class="totalCheckQuarter2"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
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
                                    <th class="no-order">Total dispo</th>
                                    <th class="no-order">Total attr</th>
                                    <th class="lawyer-office">ID de l'Étude</th>
                                    <th>Dernière modification</th>
                                    <th class="last-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter3 as $key => $quarter)
                                    <tr class="userRow">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif

                                            @if ($month->week1_dispo && $month->week1_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><i class="fa fa-check"></i><span class="hidden">1</span>
                                                </td>
                                            @elseif ($month->week1_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><span class="hidden">0</span></td>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week2_dispo && $month->week2_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week2_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week3_dispo && $month->week3_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week3_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week4_dispo && $month->week4_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week4_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week5_dispo === 1 && $month->week5_attr === 1)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5_dispo === 1)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><span class="hidden">0</span>
                                            @elseif ($month->week5_dispo === 0)
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($loop->last)
                                                <td id="quarterAvailabilityCount3{{$key}}"></td>
                                                <td id="quarterAttributionCount3{{$key}}"></td>
                                                <td>{{ $month->lawyer->lawyer_office_id }}</td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger deletePermanence" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <td colspan="4"><b>Total attributions</b></td>
                                    @foreach ($calendarQuarter3 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalCheckQuarter3"></th>
                                            <th class="totalCheckQuarter3"></th>
                                            <th class="totalCheckQuarter3"></th>
                                            <th class="totalCheckQuarter3"></th>
                                            @if ($month->week5)
                                                <th class="totalCheckQuarter3"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>
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
                                    <th>Total attr</th>
                                    <th>Dernière modification</th>
                                    <th class="last-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quarter4 as $key => $quarter)
                                    <tr class="userRow">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif

                                            @if ($month->week1_dispo && $month->week1_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><i class="fa fa-check"></i><span class="hidden">1</span>
                                                </td>
                                            @elseif ($month->week1_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><span class="hidden">0</span></td>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week2_dispo && $month->week2_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week2_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week3_dispo && $month->week3_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week3_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week4_dispo && $month->week4_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week4_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week5_dispo === 1 && $month->week5_attr === 1)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5_dispo === 1)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><span class="hidden">0</span>
                                            @elseif ($month->week5_dispo === 0)
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($loop->last)
                                                <td id="quarterAvailabilityCount4{{$key}}"></td>
                                                <td id="quarterAttributionCount4{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger deletePermanence" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <td colspan="4"><b>Total attributions</b></td>
                                    @foreach ($calendarQuarter4 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalCheckQuarter4"></th>
                                            <th class="totalCheckQuarter4"></th>
                                            <th class="totalCheckQuarter4"></th>
                                            <th class="totalCheckQuarter4"></th>
                                            @if ($month->week5)
                                                <th class="totalCheckQuarter4"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
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
                                    <th>Total attr</th>
                                    <th>Dernière modification</th>
                                    <th class="last-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nextYearQuarter1 as $key => $quarter)
                                    <tr class="userRow">
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $month->lawyer_id }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->username }}</td>
                                            @endif

                                            @if ($month->week1_dispo && $month->week1_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><i class="fa fa-check"></i><span class="hidden">1</span>
                                                </td>
                                            @elseif ($month->week1_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week1"><span class="hidden">0</span></td>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week2_dispo && $month->week2_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week2_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week2"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week3_dispo && $month->week3_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week3_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week3"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week4_dispo && $month->week4_attr)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week4_dispo)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week4"><span class="hidden">0</span>
                                            @else
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($month->week5_dispo === 1 && $month->week5_attr === 1)
                                                <td class="green" value="1" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5_dispo === 1)
                                                <td class="green" value="0" quarter="{{ $month->quarter }}" id="{{ $month->id }}" week="week5"><span class="hidden">0</span>
                                            @elseif ($month->week5_dispo === 0)
                                                <td class="red" value="0"><span class="hidden">0</span></td>
                                            @endif

                                            @if ($loop->last)
                                                <td id="quarterAvailabilityCountNextYear1{{$key}}"></td>
                                                <td id="quarterAttributionCountNextYear1{{$key}}"></td>
                                                <td><span class="hidden">{{ $month->updated_at }}</span>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    {!! Form::open(array('route' => ['back.permanences.destroy', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter], 'class' => 'form-inline')) !!}
                                                        <a class="btn btn-small btn-success" href="{{ route('back.permanences.show', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Montrer</a>
                                                        <a class="btn btn-small btn-info" href="{{ route('back.permanences.edit', $month->lawyer_id . '-' . $month->year . '-' . $month->quarter) }}" style="margin: 5px;">Editer</a>
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        <button class="btn btn-small btn-danger deletePermanence" style="margin: 5px;">Supprimer</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <td colspan="4"><b>Total attributions</b></td>
                                    @foreach ($calendarNextYearQuarter1 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalCheckNextYearQuarter1"></th>
                                            <th class="totalCheckNextYearQuarter1"></th>
                                            <th class="totalCheckNextYearQuarter1"></th>
                                            <th class="totalCheckNextYearQuarter1"></th>
                                            @if ($month->week5)
                                                <th class="totalCheckNextYearQuarter1"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <p class="text-center">Prière de rechager la page pour recalculer le total des attributions si ce logo apparaît: <i class="fa fa-sync"></i></p>
        <div class="text-center">
            {{-- <button class="btn btn-info" id="copyAvailabilities">Faire une copie des disponibilités du trimestre</button><br /> --}}
            {!! Form::open(array('route' => ['back.permanences.copyPermanencesTable'], 'class' => 'form-inline', 'id' => 'copyPermanencesTable')) !!}
                <button class="btn btn-small btn-info" id="copyButton">Faire une copie des données complètes de la table des permanences <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i></button>
            {!! Form::close() !!}
            {{-- <small>(confirmation requise)</small> --}}
            <small>Confirmation requise. Toutes les entrées de la table des permanences seront copiées vers une autre table de la base de données (non visible). <br />Cette opération peut prendre quelques secondes et vise à sauvegarder l'état de la table tel que présenté ci-dessus avant d'appliquer des changements.</small>
            <br /><br />

            {!! Form::open(array('route' => ['back.permanences.generateAttributions', $nextQuarterYear, $nextQuarter], 'class' => 'form-inline', 'class' => 'generateAttributions hidden', 'id' => 'generateAttributionsQuarter')) !!}
                <button class="btn btn-small btn-success" id="generateAttributionsButton" value="{{ $nextQuarter }}">Générer l'attribution aléatoire des permanences pour le {{ $nextQuarter }}<sup>ème</sup> trimestre</button><br />
                <small>(Confirmation requise)</small>
                <br /><br />
            {!! Form::close() !!}

            {!! Form::open(array('route' => ['back.permanences.deletePermanencesAttributions', $nextQuarterYear, $nextQuarter], 'class' => 'form-inline', 'class' => 'deleteAttributions hidden', 'id' => 'deleteAttributionsQuarter')) !!}
                <button class="btn btn-small btn-danger" id="deleteAttributionsButton" value="{{ $nextQuarter }}">Effacer les attributions pour le {{ $nextQuarter }}<sup>ème</sup> trimestre <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i></button><br />
                <small>(Confirmation requise)</small>
                <br />
            {!! Form::close() !!}
            
            <div class="checkbox checkbox-warning">
                <input type="checkbox" class="filled-in" id="showAttributions" @if ($siteParameters->boolean_value) checked @endif>
                {{-- <input type="checkbox" class="filled-in" id="showAttributions" @if (env('DISPLAY_NEXT_QUARTER_ATTRIBUTIONS')) checked @endif> --}}
                <label for="showAttributions">Afficher les attributions de permanence du prochain trimestre sur la page personnelle des avocats <br />(les attributions pour le trimestre en cours sont affichées d'office).</label>
            </div>
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

    <!-- jQuery Datatable export buttons -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

    <!-- Table tooltip -->
    <script>
        $(document).ready(function(){
            // $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>

    <script>
        $(document).ready(function(){
            var year = <?php echo $year; ?>;
            var nextQuarterYear = <?php echo $nextQuarterYear; ?>;
            var nextQuarter = <?php echo $nextQuarter; ?>;
            $('#generatePermanencesListButton').addClass("hidden");
            $('#reGeneratePermanencesListButton').addClass("hidden");
            $('#selectQuarterMessage').addClass("hidden");

            $('#see_quarter' + nextQuarter).removeClass("notActive");
            $('#see_quarter' + nextQuarter).addClass("active");
            $('#quarter' + nextQuarter).removeClass("hidden");

            $(".generateAttributions").addClass("hidden");
            $(".deleteAttributions").addClass("hidden");
            // $("#generateAttributionsQuarter").removeClass("hidden");
            // $("#deleteAttributionsQuarter").removeClass("hidden");

            if ($.fn.dataTable.isDataTable('#table_quarter' + nextQuarter)) {
                $('#table_quarter' + nextQuarter).DataTable();
            }
            else {
                var table = $('#table_quarter' + nextQuarter).DataTable({
                    scrollX: true,
                    columnDefs: [
                        {
                            'targets': 'last-column',
                            'orderable': false
                        },
                        {
                            'targets': 'no-order',
                            "orderable": false
                        }
                    ],
                    select: {
                        // 'style': 'multi',
                    },
                    order: [[1, 'asc']],
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis',
                        'pageLength',
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                        buttons: {
                            colvis: 'Afficher colonnes',
                            pageLength: 'Afficher lignes'
                        }
                    },
                    // To get rid of duplicate footer
                    drawCallback: function () {
                        $('#table_quarter' + nextQuarter + ' tfoot tr').css({ display: 'none' }); 
                    }
                });
                $('.totalCheckQuarter' + nextQuarter).each(function(index) {
                    // console.log(index)
                    $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    // $(this).html('abc');
                });   
                // console.log('table count:');
                // console.log(table.rows().count());
                var totalRows = table.rows().count();
            }
            
            // getTotal();
            getTotalRowAvailability(nextQuarter);
            getTotalRowAttribution(nextQuarter, totalRows);
            // getTotalColumnAttribution(nextQuarter);

            $('#see_quarter1').click(function(e) {
                $('.quarterBtn').removeClass("active");
                $('.quarterBtn').addClass("notActive");
                $('#see_quarter1').removeClass("notActive");
                $('#see_quarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter1').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");
                $(".generateAttributions").addClass("hidden");
                $(".deleteAttributions").addClass("hidden");
                if (nextQuarterYear === year && nextQuarter === 1) {
                    $('#generateAttributionsQuarter').removeClass("hidden");
                    $("#deleteAttributionsQuarter").removeClass("hidden");
                }

                if ($.fn.dataTable.isDataTable('#table_quarter1')) {
                    console.log('#table_quarter1 is already a datatable');
                    var table = $('#table_quarter1').DataTable();
                    // console.log(table);
                    // var table2 = $('#table_quarter1');
                    // // console.log(table2)
                    // console.log($.fn.dataTable($('#table_quarter1')));
                    // $('.totalCheckQuarter1').each(function(index) {
                    //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    // });
                }
                else {
                    var table = $('#table_quarter1').DataTable({
                        scrollX: true,
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
                        order: [[1, 'asc']],
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                        // To get rid of duplicate footer
                        drawCallback: function () {
                              $('#table_quarter1 tfoot tr').css({ display: 'none' }); 
                        }
                    });
                    $('.totalCheckQuarter1').each(function(index) {
                        $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                        // $(this).html('abc');
                    });
                    // getTotalColumnAttribution(1);
                }
                // getTotal();
                var totalRows = table.rows().count();
                getTotalRowAvailability(1);
                getTotalRowAttribution(1, totalRows);
                // $('.totalCheckQuarter1').each(function(index) {
                //     console.log(index)
                //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // });
                // getTotalColumnAttribution(1);
            });
            $('#see_quarter2').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter2').removeClass("notActive");
                $('#see_quarter2').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter2').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");
                $(".generateAttributions").addClass("hidden");
                $(".deleteAttributions").addClass("hidden");
                if (nextQuarter === 2) {
                    $('#generateAttributionsQuarter').removeClass("hidden");
                    $("#deleteAttributionsQuarter").removeClass("hidden");
                }

                if ($.fn.dataTable.isDataTable('#table_quarter2')) {
                    var table = $('#table_quarter2').DataTable();
                }
                else {
                    var table = $('#table_quarter2').DataTable({
                        scrollX: true,
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
                        order: [[1, 'asc']],
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                        // To get rid of duplicate footer
                        drawCallback: function () {
                            $('#table_quarter2 tfoot tr').css({ display: 'none' }); 
                        }
                    });
                    // getTotalColumnAttribution(2);
                    $('.totalCheckQuarter2').each(function(index) {
                        $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    });
                }
                // getTotal();
                var totalRows = table.rows().count();
                getTotalRowAvailability(2);
                getTotalRowAttribution(2, totalRows);
                // $('.totalCheckQuarter2').each(function(index) {
                //     console.log(index)
                //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // });
                // getTotalColumnAttribution(2);
            });
            $('#see_quarter3').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter3').removeClass("notActive");
                $('#see_quarter3').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter3').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");
                $(".generateAttributions").addClass("hidden");
                $(".deleteAttributions").addClass("hidden");
                if (nextQuarter === 3) {
                    $('#generateAttributionsQuarter').removeClass("hidden");
                    $("#deleteAttributionsQuarter").removeClass("hidden");
                }

                if ($.fn.dataTable.isDataTable('#table_quarter3')) {
                    var table = $('#table_quarter3').DataTable();
                }
                else {
                    var table = $('#table_quarter3').DataTable({
                        scrollX: true,
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
                        order: [[1, 'asc']],
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                        // To get rid of duplicate footer
                        drawCallback: function () {
                            $('#table_quarter3 tfoot tr').css({ display: 'none' }); 
                        }
                    });
                    // getTotalColumnAttribution(3);
                    $('.totalCheckQuarter3').each(function(index) {
                        // console.log(index)
                        $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    });
                }
                // getTotal();
                var totalRows = table.rows().count();
                getTotalRowAvailability(3);
                getTotalRowAttribution(3, totalRows);
                // $('.totalCheckQuarter3').each(function(index) {
                //     console.log(index)
                //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // });
                // getTotalColumnAttribution(3);
            });
            $('#see_quarter4').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter4').removeClass("notActive");
                $('#see_quarter4').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter4').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");
                $(".generateAttributions").addClass("hidden");
                $(".deleteAttributions").addClass("hidden");
                if (nextQuarter === 4) {
                    $('#generateAttributionsQuarter').removeClass("hidden");
                    $("#deleteAttributionsQuarter").removeClass("hidden");
                }

                if ($.fn.dataTable.isDataTable('#table_quarter4')) {
                    var table = $('#table_quarter4').DataTable();
                }
                else {
                    var table = $('#table_quarter4').DataTable({
                        scrollX: true,
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
                        order: [[1, 'asc']],
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                        // To get rid of duplicate footer
                        drawCallback: function () {
                            $('#table_quarter4 tfoot tr').css({ display: 'none' }); 
                        }
                    });
                    // getTotalColumnAttribution(4);
                    $('.totalCheckQuarter4').each(function(index) {
                        // console.log(index)
                        $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    });
                }
                // getTotal();
                var totalRows = table.rows().count();
                getTotalRowAvailability(4);
                getTotalRowAttribution(4, totalRows);
                // $('.totalCheckQuarter4').each(function(index) {
                //     console.log(index)
                //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // });
                // getTotalColumnAttribution(4);
            });
            
            $('#see_nextYearQuarter1').click(function(e) {
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_nextYearQuarter1').removeClass("notActive");
                $('#see_nextYearQuarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#nextYearQuarter1').removeClass("hidden");
                $('#selectQuarterMessage').addClass("hidden");
                $(".generateAttributions").addClass("hidden");
                $(".deleteAttributions").addClass("hidden");
                if (nextQuarterYear === year + 1 && nextQuarter === 1) {
                    $('#generateAttributionsQuarter').removeClass("hidden");
                    $("#deleteAttributionsQuarter").removeClass("hidden");
                }

                if ($.fn.dataTable.isDataTable('#table_nextYearQuarter1')) {
                    var table = $('#table_nextYearQuarter1').DataTable();
                }
                else {
                    var table = $('#table_nextYearQuarter1').DataTable({
                        scrollX: true,
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
                        order: [[1, 'asc']],
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                        // To get rid of duplicate footer
                        drawCallback: function () {
                            $('#table_nextYearQuarter1 tfoot tr').css({ display: 'none' }); 
                        }
                    });
                    // getTotalColumnAttribution(4);
                    $('.totalCheckNextYearQuarter1').each(function(index) {
                        // console.log(index)
                        $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                    });
                }
                var totalRows = table.rows().count();
                getTotalRowAvailabilityNextYear(1);
                getTotalRowAttributionNextYear(1, totalRows);
            });
        });
    </script>

    <script>
        function getTotalRowAvailability(quarter) {
            // console.log('getTotalRowAvailability');
            var rowCount = $('#table_quarter' + quarter + ' tr').length;
            for (i = 0; i < rowCount; i++) {
                var countDispo = $("#quarterAvailabilityCount" + quarter + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                $("#quarterAvailabilityCount" + quarter + i).html(countDispo);
                // $("#quarterAvailabilityCount" + quarter + i).attr('value', countDispo);
            }
        }

        function getTotalRowAvailabilityNextYear(quarter) {
            var rowCount = $('#table_nextYearQuarter' + quarter + ' tr').length;
            for (i = 0; i < rowCount; i++) {
                var countDispo = $("#quarterAvailabilityCountNextYear" + quarter + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                $("#quarterAvailabilityCountNextYear" + quarter + i).html(countDispo);
            }
        }

        function getTotalRowAttribution(quarter, totalRows) {
            // console.log('getTotalRowAttribution');
            // console.log(totalRows)
            for (i = 0; i < totalRows; i++) {
                var countAttr = $('#quarterAttributionCount' + quarter + i)
                    .closest('tr')
                    .find("[value=1]")
                    .length;
                $('#quarterAttributionCount' + quarter + i).html(countAttr);
                // $('#quarterAttributionCount' + quarter + i).html('abc');
            }
        }

        function getTotalRowAttributionNextYear(quarter, totalRows) {
            // var rowCount = $('#table_nextYearQuarter' + quarter + ' tr').length;
            for (i = 0; i < totalRows; i++) {
                var countAttr = $("#quarterAttributionCountNextYear" + quarter + i)
                    .closest('tr')
                    .find("[value=1]")
                    .length;
                $("#quarterAttributionCountNextYear" + quarter + i).html(countAttr);
            }
        }

        function getTotalColumnAttribution(quarter) {
            console.log('getTotalColumnAttribution');                    
            // var table = $('#table_quarter' + quarter).DataTable();
            $('.totalCheckQuarter' + quarter).each(function(index) {
                // console.log(index);
                // $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // $(this).html('def');
                $(this).html(Math.abs(table1.column( index + 4 ).data().sum()));
            });
            // $('.totalCheckQuarter1').html('abc');
            // $('#abc').html('abc');
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
        // $('#deletePermanences').click(function(e) {
        //     console.log('click');
        //     e.preventDefault(); // Prevent the href from redirecting directly
        //     form = $(this).closest('form');
        //     warnBeforeRemove();
        // });

        // function warnBeforeRemove() {
        //     swal({
        //         title: "Etes-vous sûr?",
        //         text: "Vous ne serez plus en mesure de récupérer les permanences liées à cet avocat.",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#DD6B55",
        //         confirmButtonText: "Oui, supprimer!",
        //         cancelButtonText: "Non, annuler",
        //         closeOnConfirm: false,
        //         closeOnCancel: false 
        //     },
        //     function(isConfirm) {
        //         if (isConfirm) {
        //             $('.confirm').prop('disabled', true);
        //             form.submit();
        //         } else {
        //             swal("Annulé", "Les permanences sont sauvées :-)", "error");
        //         }
        //     });
        // }
    </script>

    <script>
        // $('#copyAvailabilities').click(function(e){
        //     year = <?php echo $nextQuarterYear; ?>;
        //     quarter = <?php echo $nextQuarter; ?>;
        //     method = 'copyAvailabilities';
        //     warnBeforeRedirectToCopyAvailabilities();
        // });

        // function warnBeforeRedirectToCopyAvailabilities() {
        //     swal({
        //         title: "Etes-vous sûr?",
        //         html: true,
        //         text: "Les données sur la disponibilité des avocats pour le trimestre " + quarter + " de l'année " + year + " vont être copiées dans la table de sauvegarde. Cette action devrait idéalement être effectuée avant chaque modification d'importance dans la table des permanences.",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#337ab7",
        //         confirmButtonText: "Oui!",
        //         cancelButtonText: "Non, annuler",
        //         closeOnConfirm: false,
        //         closeOnCancel: false 
        //     },
        //     function(isConfirm) {
        //         if (isConfirm) {
        //             console.log(year);
        //             console.log(quarter);
        //             $('.confirm').prop('disabled', true);
        //             $.ajax({
        //                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                 type: 'POST',
        //                 url: "{{ URL::route('back.permanences.sendEmail') }}",
        //                 data: {
        //                     method: method,
        //                     year: 2018,
        //                     quarter: 2
        //                     // data: data
        //                 },
        //                 success: function(data) {                                
        //                     swal({
        //                         title: "Succès",
        //                         html: true,
        //                         text: "Les permanences ont été copiées avec succès.",
        //                         type: "success"
        //                     })
        //                 },
        //             });
        //         } else {
        //             swal("Annulé", "Aucun envoi effectué :-)", "error");
        //         }
        //     });
        // }
    </script>

    <script>
        $('#sendEmail').click(function(e){
            method = 'sendEmail';
            ids = [];
            var rows_selected = table.column(0).checkboxes.selected();

            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
                ids.push(parseInt(rowId));
            });
        
            const allLawyers = <?php echo \App\Lawyer::all(); ?>;
            const collection = collect(allLawyers);

            lawyers = collection.whereIn('id', ids).all();

            email = '';
            lawyers.forEach(function (lawyer) {
                email += ("<a href='permanences/email-lawyer/" + lawyer.id + "' target='_blank'>" + lawyer.email + "</a><br />")
            });

            warnBeforeSendEmail();
        });

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
                    console.log(ids);
                    console.log(lawyers);
                    $('.confirm').prop('disabled', true);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: "{{ URL::route('back.permanences.sendEmail') }}",
                        data: {
                            method: method,
                            lawyer_ids: ids,
                            lawyers: lawyers
                        },
                        success: function(data) {                                
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

    <script>
        $('tr.userRow td.green').each(function () {
            $(this).css('cursor', 'pointer');
        });
        $('tr.userRow td.green').click(function() {
            console.log('Click entry');
            // console.log(this);
            // console.log($(this).attr("class"));
            var quarter = $(this).attr('quarter');
            // console.log('quarter: ' + quarter);
            // console.log($(this).html());
            // console.log($(this)('td').length);

            if ($(this).attr('class') != 'red') {
                $(this).effect( "highlight", {}, 1000 );
                if ($(this).attr('value') == '1') {
                    $(this).html('<span class="hidden">0</span>');
                    $(this).attr('value', '0');
                } else {
                    $(this).html('<i class="fa fa-check"></i><span class="hidden">1</span>');
                    $(this).attr('value', '1');
                }
                // $(this).toggleClass('attributed');
                var id = $(this).attr('id');
                var week = $(this).attr('week');
                var value = $(this).attr('value');
                console.log(id);
                console.log(week);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    // type: 'PATCH',
                    type: 'POST',
                    url: "{{ URL::route('back.permanences.update_attribution', ['id' => 1]) }}",
                    data: {
                        'id': id,
                        'week': week,
                        'value': value,
                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        // if (!$.fn.dataTable.isDataTable('#table_quarter1')) {
                            // getTotalColumnAttribution(1);
                        // }
                        // $('.totalCheckQuarter1').append('abc');
                        // getTotalColumnAttribution(1);
                        // $('#abc').append('abc');
                        // console.log(quarter);
                        // getTotalRowAttribution(quarter);

                        $('.totalCheckQuarter' + quarter).each(function(index) {
                            $(this).html('<i class="fa fa-sync"></i>');
                        });
                        $('.totalCheckNextYearQuarter' + quarter).each(function(index) {
                            $(this).html('<i class="fa fa-sync"></i>');
                        });
                        toastr.success('Attribution des permanences pour la semaine ' + data + ' modifiée avec succès', 'Succès');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                        toastr.error('Erreur dans la nouvelle attribution des permanences', 'Erreur');
                    },
                });
                // getTotalRowAvailability();
                // console.log('rows.count():');
                // console.log($('#table_quarter' + quarter).DataTable().rows().count());
                var rowsCount = $('#table_quarter' + quarter).DataTable().rows().count()
                getTotalRowAttribution(quarter, rowsCount);
                getTotalRowAttributionNextYear(quarter, rowsCount);
                // getTotalColumnAvailability();
                // getTotalColumnAttribution();
            }
        });
    </script>

    <script>
        // $('#copyPermanencesTable').click(function(e){
        //     $("#copyButton").attr("disabled", true);
        // 	$("#spinner").removeAttr('style');
        // 	$('#copyPermanencesTable').submit();
        // });
    </script>

    <script>
        $('.deletePermanence').click(function(e) {
            console.log('Click!');
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirectDeletePermanence();
        });

        function warnBeforeRedirectDeletePermanence() {
            swal({
                title: "Etes-vous sûr?",
                text: "Vous ne serez plus en mesure de récupérer cette permanence.",
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
                    swal("Annulé", "La permanence est sauvée :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#copyPermanencesTable').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirectCopyPermanencesTable();
        });

        function warnBeforeRedirectCopyPermanencesTable() {
            swal({
                title: "Etes-vous sûr?",
                text: "La précédente copie va être effacée et remplacée par l'état actuel de la table des permanences. C'est une bonne chose à faire avant d'entreprendre des modifications sur la table actuelle. Beaucoup de calculs sont réalisés. L'opération peut donc prendre jusqu'à 1 minute.",
                type: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, copier les permanences!",
                // confirmButtonId: "copyButton",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    $("#copyButton").attr("disabled", true);
                    $("#spinner").removeAttr('style');                    
                    form.submit();
                } else {
                    swal("Annulé", "La table n'a pas été copiée :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#generateAttributionsButton').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            var quarter = $(this).val();
            warnBeforeRedirectGenerateAttributions(quarter);
        });

        function warnBeforeRedirectGenerateAttributions(quarter) {
            swal({
                title: "Etes-vous sûr?",
                text: "La génération d'une nouvelle attribution des permanences va effacer la répartition actuelle pour le trimestre " + quarter,
                type: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, générer une nouvelle attribution!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {                        
                    form.submit();
                } else {
                    swal("Annulé", "Les attributions n'ont pas été modifiées :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#deleteAttributionsButton').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            var quarter = $(this).val();
            warnBeforeRedirectDeleteAttributions(quarter);
        });

        function warnBeforeRedirectDeleteAttributions(quarter) {
            swal({
                title: "Etes-vous sûr?",
                text: "Toutes les attributions du trimestre " + quarter + " seront effacées.",
                type: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, supprimer!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {                        
                    form.submit();
                } else {
                    swal("Annulé", "Les attributions n'ont pas été modifiées :-)", "error");
                }
            });
        }
    </script>

    <script>
        $('#showAttributions').click(function(e) {
            var isChecked = $(this).is(':checked');
            console.log(isChecked);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                url: "{{ URL::route('back.permanences.toggleShowAttributions') }}",
                data: {
                    'isChecked': isChecked,
                },
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    console.log();
                    toastr.success('La visibilité des attributions du prochain trimestre a été modifiée avec succès', 'Succès');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    toastr.error('La visibilité des attributions du prochain trimestre n\'a pas pu être modifiée', 'Erreur');
                },
            });
        });
    </script>
@endsection