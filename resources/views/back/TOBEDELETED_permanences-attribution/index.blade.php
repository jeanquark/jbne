@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- DataTable buttons -->
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">

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

    <div id="displayContent" class="">

        <ul class="nav navbar-nav pull-left">
            <li><a href="{{ route('back.permanences-attribution.index') }}">Voir les attributions du prochain trimestre</a></li>
            <li><a href="{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => 2018, 'quarter' => 2]) }}">Ajouter un avocat</a></li>
        </ul>

        <div id="radioBtn" class="btn-group pull-right">
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter1" id="see_quarter1">Trimestre I</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter2" id="see_quarter2">Trimestre II</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter3" id="see_quarter3">Trimestre III</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="quarter4" id="see_quarter4">Trimestre IV</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="year" id="see_whole_year">Année complète</a>
            <a class="btn btn-primary btn-sm quarterBtn notActive" data-toggle="permanences" data-title="nextYearQuarter1" id="see_nextYearQuarter1">Trimestre I de l'année prochaine</a>
        </div>
        
        <div class="row clearfix" id="">
            <div class="col-md-12">
                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        Attribution des permanences des avocats dans le cadre des permanences trimestrielles.
                    </div>

                    <!-- First quarter -->
                    <div class="panel-body hidden" id="quarter1">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
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
                                    <th>Total attributions</th>
                                    <th>Total disponibilités</th>
                                    <th>Diff.</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permanenceQuarter1 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
                                            @endif
                                            @if ($month->week1)
                                                <td class="green col{{$month->week1_nb}}" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red col{{$month->week1_nb}}" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week2)
                                                <td class="green col{{$month->week2_nb}}" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red col{{$month->week2_nb}}" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week3)
                                                <td class="green col{{$month->week3_nb}}" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red col{{$month->week3_nb}}" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week4)
                                                <td class="green col{{$month->week4_nb}}" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @else
                                                <td class="red col{{$month->week4_nb}}" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($month->week5 === 1)
                                                <td class="green col{{$month->week5_nb}}" value="1"><i class="fa fa-check"></i><span class="hidden">1</span></td>
                                            @elseif ($month->week5 === 0)
                                                <td class="red col{{$month->week5_nb}}" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                                            @endif
                                            @if ($loop->last)
                                                <td id="quarter1AttributionCount{{$key}}"></td>
                                                <td id="quarter1AvailabilityCount{{$key}}" data="{{ $month->lawyer_id }}"></td>
                                                <td id="quarter1Diff{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5"><b>Total</b></td>
                                    @foreach ($calendarQuarter1 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenQuarter1"></th>
                                            <th class="totalGreenQuarter1"></th>
                                            <th class="totalGreenQuarter1"></th>
                                            <th class="totalGreenQuarter1"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenQuarter1"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b>Editer</b></td>
                                    @foreach ($calendarQuarter1 as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
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
                                <tr class="titlerow">
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    @foreach ($calendarQuarter2 as $quarter)
                                        @foreach ($quarter as $month)
                                            <th class="col" data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th class="col" data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th class="col" data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th class="col" data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th class="col" data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total attributions</th>
                                    <th>Total disponibilités</th>
                                    <th>Diff.</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permanenceQuarter2 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $key2 => $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
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
                                                <td id="quarter2AttributionCount{{$key}}"></td>
                                                <td id="quarter2AvailabilityCount{{$key}}" data="{{ $month->lawyer_id }}"></td>
                                                <td id="quarter2Diff{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5"><b>Total</b></td>
                                    @foreach ($calendarQuarter2 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenQuarter2"></th>
                                            <th class="totalGreenQuarter2"></th>
                                            <th class="totalGreenQuarter2"></th>
                                            <th class="totalGreenQuarter2"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenQuarter2"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b>Editer</b></td>
                                    @foreach ($calendarQuarter2 as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
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
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
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
                                    <th>Total attributions</th>
                                    <th>Total disponibilités</th>
                                    <th>Diff.</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permanenceQuarter3 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
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
                                                <td id="quarter3AttributionCount{{$key}}"></td>
                                                <td id="quarter3AvailabilityCount{{$key}}" data="{{ $month->lawyer_id }}"></td>
                                                <td id="quarter3Diff{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5"><b>Total</b></td>
                                    @foreach ($calendarQuarter3 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenQuarter3"></th>
                                            <th class="totalGreenQuarter3"></th>
                                            <th class="totalGreenQuarter3"></th>
                                            <th class="totalGreenQuarter3"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenQuarter3"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b>Editer</b></td>
                                    @foreach ($calendarQuarter3 as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Fourth quarter -->
                    <div class="panel-body hidden" id="quarter4">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_quarter4">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
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
                                    <th>Total attributions</th>
                                    <th>Total disponibilités</th>
                                    <th>Diff.</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permanenceQuarter4 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
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
                                                <td id="quarter4AttributionCount{{$key}}"></td>
                                                <td id="quarter4AvailabilityCount{{$key}}" data="{{ $month->lawyer_id }}"></td>
                                                <td id="quarter4Diff{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5"><b>Total</b></td>
                                    @foreach ($calendarQuarter4 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenQuarter4"></th>
                                            <th class="totalGreenQuarter4"></th>
                                            <th class="totalGreenQuarter4"></th>
                                            <th class="totalGreenQuarter4"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenQuarter4"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b>Editer</b></td>
                                    @foreach ($calendarQuarter4 as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- Whole year -->
                    <div class="panel-body hidden" id="wholeYear">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_wholeYear">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    @foreach ($calendarWholeYear as $month2)
                                        @foreach ($month2 as $month)
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">S.{{ $month->week1_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">S.{{ $month->week2_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">S.{{ $month->week3_nb }}</th>
                                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">S.{{ $month->week4_nb }}</th>
                                            @if ($month->week5)
                                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">S.{{ $month->week5_nb }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <th>Total attributions</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permanenceWholeYear as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
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
                                                <td id="wholeYearAttributionCount{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5">Total</td>
                                    @foreach ($calendarWholeYear as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenWholeYear"></th>
                                            <th class="totalGreenWholeYear"></th>
                                            <th class="totalGreenWholeYear"></th>
                                            <th class="totalGreenWholeYear"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenWholeYear"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="5">Editer</td>
                                    @foreach ($calendarWholeYear as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div><!-- /.panel-body -->


                    <!-- First quarter next year -->
                    <div class="panel-body hidden" id="nextYearQuarter1">
                        <table class="table table-bordered table-striped table-hover permanence-table" id="table_nextYearQuarter1">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
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
                                    <th>Total attributions</th>
                                    <th>Dernière modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permanenceNextYearQuarter1 as $key => $quarter)
                                    <tr>
                                        @foreach ($quarter as $month)
                                            @if ($loop->first)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $month->lawyer->lastname }}</td>
                                                <td>{{ $month->lawyer->firstname }}</td>
                                                <td>{{ $month->lawyer->email }}</td>
                                                <td>{{ $month->lawyer->phone_mobile }}</td>
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
                                                <td id="nextYearQuarter1AttributionCount{{$key}}"></td>
                                                <td>{{ Date::parse($month->updated_at)->diffForHumans() }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="totalColumn">
                                    <td colspan="5"><b>Total</b></td>
                                    @foreach ($calendarNextYearQuarter1 as $quarter)
                                        @foreach ($quarter as $key => $month)
                                            <th class="totalGreenNextYearQuarter1"></th>
                                            <th class="totalGreenNextYearQuarter1"></th>
                                            <th class="totalGreenNextYearQuarter1"></th>
                                            <th class="totalGreenNextYearQuarter1"></th>
                                            @if ($month->week5)
                                                <th class="totalGreenNextYearQuarter1"></th>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b>Editer</b></td>
                                    @foreach ($calendarNextYearQuarter1 as $quarter)
                                        @foreach ($quarter as $month)
                                            <td><a href="{{ URL::to('back/permanences-attribution/year' . $month->year . '-month' . $month->month . '-week1/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week2/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week3/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week4/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @if ($month->week5)
                                                <td><a href="{{ URL::to('back/permanences-attribution/' . $month->year . '-' . $month->month . '-week5/edit') }}" style=""><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a></td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.panel-body -->

                </div><!-- /.panel -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->

        <div class="row clearfix text-center">
            <br /><br />
            <button class="btn btn-primary" id="showAttributionsTableButton">Générer table des attributions de permanences pour ce trimestre</button><br /><br />
            {{-- <a class="btn btn-primary" href="{{ route('back.permanences-attribution.generateAttributionsTable', ['year' => 2018, 'quarter' => 2]) }}">Générer table d'attribution des permanences</a> --}}
            <div id="showAttributionsTable"></div>
            <br /><br />
            
        </div>

        {{-- <br /><br /><hr><br />
        <table class="table table-bordered table-striped table-hover permanence-table" id="">
            <thead>
                <tr>
                    @foreach ($calendarNextYearQuarter1 as $quarter)
                        @foreach ($quarter as $month)
                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week1 }}">{{ $month->week1 }}</th>
                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week2 }}">{{ $month->week2 }}</th>
                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week3 }}">{{ $month->week3 }}</th>
                            <th data-toggle="tooltip" data-container="body" title="{{ $month->week4 }}">{{ $month->week4 }}</th>
                            @if ($month->week5)
                                <th data-toggle="tooltip" data-container="body" title="{{ $month->week5 }}">{{ $month->week5 }}</th>
                            @endif
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($permanenceQuarter1 as $key => $quarter)
                    <tr>
                        @foreach ($quarter as $month)
                            @if ($month->week1)
                                <td class="green" value="1">{{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<span class="hidden">1</span></td>
                            @else
                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                            @endif
                            @if ($month->week2)
                                <td class="green" value="1">{{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<span class="hidden">1</span></td>
                            @else
                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                            @endif
                            @if ($month->week3)
                                <td class="green" value="1">{{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<span class="hidden">1</span></td>
                            @else
                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                            @endif
                            @if ($month->week4)
                                <td class="green" value="1">{{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<span class="hidden">1</span></td>
                            @else
                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                            @endif
                            @if ($month->week5 === 1)
                                <td class="green" value="1">{{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<span class="hidden">1</span></td>
                            @elseif ($month->week5 === 0)
                                <td class="red" value="0"><i class="fa fa-times"></i><span class="hidden">0</span></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>--}}
        
        <!--<div class="row clearfix">
            @for ($i = 4; $i <= 6; $i++)
                <div class="col-md-12" style="padding-top: 20px;">
                    @for ($j = 1; $j <= 5; $j++)
                        <div class="col-md-3">
                            @foreach ($permanenceQuarter2 as $quarter)
                                @if ($loop->first)
                                    <b>{{ $calendarQuarter2->first()->where('month', '=', $i)->first()['week' . $j] }}</b><br />
                                @endif
                                @foreach ($quarter as $month)
                                    @if ($month->month == $i && $month['week' . $j] == 1)
                                        <span>
                                            {{ $month->lawyer->firstname }} {{ $month->lawyer->lastname }}<br />
                                        </span>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endfor
                </div>
            @endfor
        </div>--><!-- /.row clearfix -->

    </div><!-- /#content -->
@endsection

@section('scripts')
    <!-- To use npm packages -->
    <script src="/js/app.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.16/api/sum().js"></script>

    <script src="{{ asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
        
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $(window).on("load", function() {
            // console.log("window loaded");
            $('#loading').addClass("hidden");
            $('#displayContent').removeClass("hidden");
        });
    </script>

    <script>
        $(document).ready(function(){
            var nextQuarterYear = <?php echo $nextQuarterYear; ?>;
            var nextQuarter = <?php echo $nextQuarter; ?>;
            year = <?php echo $nextQuarterYear; ?>;
            quarter = <?php echo $nextQuarter; ?>;
            // console.log(nextQuarter);
            // console.log(nextQuarterYear);
            // console.log(nextQuarter);
            // <?php $year = 2019; ?>
            // var route = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => $nextQuarter]) }}";
            // var route = "{{ route('home') }}";
            $('#see_quarter' + nextQuarter).removeClass("notActive");
            $('#see_quarter' + nextQuarter).addClass("active");
            $('#quarter' + nextQuarter).removeClass("hidden");
            getLawyerTotalAttribution();
            getLawyerTotalAvailability();
            var table = $('#table_quarter' + nextQuarter).DataTable({
                scrollX: true,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    {
                        text: 'Ajouter avocat à la liste',
                        action: function (e, dt, node, config) {
                            window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => $nextQuarter]) }}";
                        }
                    }
                ],
                // columnDefs: [
                //     {
                //         "targets": [3,4],
                //         "visible": false,
                //     }
                // ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                    buttons: {
                        colvis: 'Afficher colonnes',
                        pageLength: 'Afficher lignes'
                    }
                }
            // }).columns.adjust();
            });
            $('.totalGreenQuarter' + nextQuarter).each(function(index) {
                // console.log(index);
                $(this).html(Math.abs(table.column( index + 5 ).data().sum()));
            });

            $('#see_quarter1').click(function(e) {
                year = <?php echo $nextQuarterYear; ?>;
                quarter = 1;
                // console.log(year);
                // console.log(quarter);
                $('.quarterBtn').removeClass("active");
                $('.quarterBtn').addClass("notActive");
                $('#see_quarter1').removeClass("notActive");
                $('#see_quarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter1').removeClass("hidden");
                $('#showAttributionsTable').addClass("hidden");

                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(1);
                $('#submitButton').val('Générer attribution aléatoire des permanences du trimestre I');
                if ($.fn.dataTable.isDataTable('#table_quarter1')) {
                    var tableQuarter1 = $('#table_quarter1').DataTable();
                }
                else {
                    var tableQuarter1 = $('#table_quarter1').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            {
                                text: 'Ajouter avocat à la liste',
                                action: function (e, dt, node, config) {
                                    window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => 1]) }}";
                                }
                            }
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        }
                    });
                    $('.totalGreenQuarter1').each(function(index) {
                        $(this).html(Math.abs(tableQuarter1.column( index + 5 ).data().sum()));
                    });
                }
                getLawyerTotalAttribution();
                getLawyerTotalAvailability();
            });
            $('#see_quarter2').click(function(e) {
                year = <?php echo $nextQuarterYear; ?>;
                quarter = 2;
                // console.log(year);
                // console.log(quarter);
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter2').removeClass("notActive");
                $('#see_quarter2').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter2').removeClass("hidden");
                $('#showAttributionsTable').addClass("hidden");

                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(2);
                $('#submitButton').val('Générer attribution aléatoire des permanences du trimestre II');
                if ($.fn.dataTable.isDataTable('#table_quarter2')) {
                    var tableQuarter2 = $('#table_quarter2').DataTable();
                }
                else {
                    var tableQuarter2 = $('#table_quarter2').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            {
                                text: 'Ajouter avocat à la liste',
                                action: function (e, dt, node, config) {
                                    window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => 2]) }}";
                                }
                            }
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                    });
                    $('.totalGreenQuarter2').each(function(index) {
                        $(this).html(Math.abs(tableQuarter2.column( index + 5 ).data().sum()));
                    });
                }
                getLawyerTotalAttribution();
                getLawyerTotalAvailability();
            });
            $('#see_quarter3').click(function(e) {
                year = <?php echo $nextQuarterYear; ?>;
                quarter = 3;
                // console.log(year);
                // console.log(quarter);
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter3').removeClass("notActive");
                $('#see_quarter3').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter3').removeClass("hidden");
                $('#showAttributionsTable').addClass("hidden");

                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(3);
                $('#submitButton').val('Générer attribution aléatoire des permanences du trimestre III');
                if ($.fn.dataTable.isDataTable('#table_quarter3')) {
                    var tableQuarter3 = $('#table_quarter3').DataTable();
                }
                else {
                    var tableQuarter3 = $('#table_quarter3').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            {
                                text: 'Ajouter avocat à la liste',
                                action: function (e, dt, node, config) {
                                    window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => 3]) }}";
                                }
                            }
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        },
                    });
                    $('.totalGreenQuarter3').each(function(index) {
                        $(this).html(Math.abs(tableQuarter3.column( index + 5 ).data().sum()));
                    });
                }
                getLawyerTotalAttribution();
                getLawyerTotalAvailability();
            });
            $('#see_quarter4').click(function(e) {
                year = <?php echo $nextQuarterYear; ?>;
                quarter = 4;
                // console.log(year);
                // console.log(quarter);
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_quarter4').removeClass("notActive");
                $('#see_quarter4').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#quarter4').removeClass("hidden");
                $('#showAttributionsTable').addClass("hidden");

                $("#submitYear").val(nextQuarterYear);
                $('#submitQuarter').val(4);
                $('#submitButton').val('Générer attribution aléatoire des permanences du trimestre IV');
                if ($.fn.dataTable.isDataTable('#table_quarter4')) {
                    var tableQuarter4 = $('#table_quarter4').DataTable();
                }
                else {
                    var tableQuarter4 = $('#table_quarter4').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            {
                                text: 'Ajouter avocat à la liste',
                                action: function (e, dt, node, config) {
                                    window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextQuarterYear, 'quarter' => 4]) }}";
                                }
                            }
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        }
                    });
                    $('.totalGreenQuarter4').each(function(index) {
                        $(this).html(Math.abs(tableQuarter4.column( index + 5 ).data().sum()));
                    });
                }
                getLawyerTotalAttribution();
                getLawyerTotalAvailability();
            });
            $('#see_whole_year').click(function(e) {
                $('.quarterBtn').removeClass("active");
                $('.quarterBtn').addClass("notActive");
                $('#see_whole_year').removeClass("notActive");
                $('#see_whole_year').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#wholeYear').removeClass("hidden");
                if ($.fn.dataTable.isDataTable('#table_wholeYear')) {
                    $('#table_wholeYear').DataTable();
                }
                else {
                    $('#table_wholeYear').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        }
                    });
                }
                getLawyerTotalAttribution();
                // $('.totalGreenWholeYear').each(function(index) {
                //     $(this).html(Math.abs(table.column( index + 4 ).data().sum()));
                // });
            });
            $('#see_nextYearQuarter1').click(function(e) {
                year = <?php echo $nextQuarterYear + 1; ?>;
                quarter = 1;
                // console.log(year);
                // console.log(quarter);
                $('.quarterBtn').removeClass('active');
                $('.quarterBtn').addClass('notActive');
                $('#see_nextYearQuarter1').removeClass("notActive");
                $('#see_nextYearQuarter1').addClass("active");
                $('.panel-body').addClass("hidden");
                $('#nextYearQuarter1').removeClass("hidden");

                $("#submitYear").val(nextQuarterYear+1);
                $('#submitQuarter').val(1);
                $('#submitButton').val('Générer attribution aléatoire des permanences du trimestre I de l\'année prochaine');
                if ($.fn.dataTable.isDataTable('#table_nextYearQuarter1')) {
                    $('#table_nextYearQuarter1').DataTable();
                }
                else {
                    $('#table_nextYearQuarter1').DataTable({
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            'pageLength',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            {
                                text: 'Ajouter avocat à la liste',
                                action: function (e, dt, node, config) {
                                    <?php $nextYear = $nextQuarterYear+1; ?>
                                    window.location = "{{ route('back.permanences-attribution.showAddLawyerToPermanencesAttributionForm', ['year' => $nextYear, 'quarter' => 1]) }}";
                                }
                            }
                        ],
                        // columnDefs: [
                        //     {
                        //         "targets": [3,4],
                        //         "visible": false,
                        //     }
                        // ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json",
                            buttons: {
                                colvis: 'Afficher colonnes',
                                pageLength: 'Afficher lignes'
                            }
                        }
                    });
                }
                getLawyerTotalAttribution();
                $('.totalGreenNextYearQuarter1').each(function(index) {
                    $(this).html(Math.abs(table.column( index + 5 ).data().sum()));
                });
            });
        });
    </script>
    
    <script>
    
    </script>

    <!-- Table tooltip -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        // function getLawyerTotal() {
        //     //iterate through each row in the table
        //     console.log('getLawyerTotal');
        //     // $('.total-green').html('abc');
            
        //     var dataRows = $("#table_quarter2 tr:not('.totalColumn, .titlerow')");
        //     console.log(dataRows.length);
        //     var dataCols = $('#table_quarter2 th.col');
        //     console.log(dataCols.length);
        //     // var sum;
        //     dataCols.each(function() {
        //         // $("#table_quarter2 tr.abc").each(function() {
        //         //     var newval = $(this);
        //         //     console.log(newval);
        //         // });
        //         var newval = $(this).find('.green').val();
        //         console.log(newval);
        //         console.log(abc.length);
        //             var newval = $(this).find('.green').val();
        //             console.log(newval);
        //             if (isNaN(newval)) {
        //               $(this).html(sum);
        //             } else {
        //               sum += parseInt(newval);
        //             }
        //         });
        //     });
            // console.log(sum);

            // sum by col
            // for (col = 5; col <= 18; col++) {
            //     console.log("column: " + col);
            //     $("#table_quarter2 tr.abc").each(function() {
            //         $(this).find("td:nth-child(" + col + ")").each(function () {
            //             var def = $(this).attr('class')== "td.green";
            //             // console.log($(this));
            //             console.log(def);
            //         });
            //         // console.log(abc.length);
            //         // var newval = $(this);
            //         // console.log(newval);
            //     });
            // }

            // $(".col14").each(function() {
            //     // var abc = $(this).find('.green').val();
            //     console.log($(this).find());
            // });

            // function () {
            //     //the value of sum needs to be reset for each row, so it has to be set inside the row loop
            //     var sum = 0
            //     //find the combat elements in the current row and sum it 
            //     $(this).find('.green').each(function () {
            //         var value = $(this).text();
            //         console.log(value);
            //         if (!isNaN(value) && value.length !== 0) {
            //             sum += parseFloat(value);
            //             // console.log(sum);
            //         }
            //     });
            //     //set the value of currents rows sum to the total-combat element in the current row
            //     $('.total-green', this).html(sum);
            // });
        // }

        function getLawyerTotalAttribution() {
            var rowCount1 = $('#table_quarter1 tr').length;
            // console.log(rowCount1);
            for (i = 0; i < rowCount1 - 1; i++) {
                var count1 = $("#quarter1AttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter1AttributionCount" + i).html(count1);
            }

            var rowCount2 = $('#table_quarter2 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount2 - 1; i++) {
                var count2 = $("#quarter2AttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter2AttributionCount" + i).html(count2);
            }

            var rowCount3 = $('#table_quarter3 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount3 - 1; i++) {
                var count3 = $("#quarter3AttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter3AttributionCount" + i).html(count3);
            }

            var rowCount4 = $('#table_quarter4 tr').length;
            // console.log(rowCount2);
            for (i = 0; i < rowCount4 - 1; i++) {
                var count4 = $("#quarter4AttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#quarter4AttributionCount" + i).html(count4);
            }

            var rowCountWholeYear = $('#table_wholeYear tr').length;
            // console.log(rowCountWholeYear);
            for (i = 0; i < rowCountWholeYear - 1; i++) {
                var countWholeYear = $("#wholeYearAttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#wholeYearCount" + i).html(countWholeYear);
            }

            var rowCountNextYear1 = $('#table_nextYearQuarter1 tr').length;
            // console.log(rowCount1);
            for (i = 0; i < rowCountNextYear1 - 1; i++) {
                var countNextYearQuarter1 = $("#nextYearQuarter1AttributionCount" + i)
                    .closest("tr")
                    .find(".green")
                    .length;
                // console.log('count: ' + count);
                $("#nextYearQuarter1Count" + i).html(countNextYearQuarter1);
            }
        }

        function getLawyerTotalAvailability() {
            var rowCount1 = $('#table_quarter1 tr').length;
            // console.log(rowCount2);
            var availabilities1 = <?php echo $permanencesAvailabilityQuarter1; ?>;

            for (i = 0; i < rowCount1 - 3; i++) {
                var lawyer_id = parseInt($("#quarter1AvailabilityCount" + i).attr("data"));
                let availability = [];
                availability.push(collect(availabilities1).where('lawyer_id', '=', lawyer_id).where('week1', 1).count());
                availability.push(collect(availabilities1).where('lawyer_id', '=', lawyer_id).where('week2', 1).count());
                availability.push(collect(availabilities1).where('lawyer_id', '=', lawyer_id).where('week3', 1).count());
                availability.push(collect(availabilities1).where('lawyer_id', '=', lawyer_id).where('week4', 1).count());
                availability.push(collect(availabilities1).where('lawyer_id', '=', lawyer_id).where('week5', 1).count());
                // console.log(availability);
                var sum = availability.reduce(function(a, b) { return a + b; }, 0);
                // console.log(sum);
                $("#quarter1AvailabilityCount" + i).html(sum);

                var quarter1Diff = $("#quarter1AvailabilityCount" + i).text() - $("#quarter1AttributionCount" + i).text();
                $("#quarter1Diff" + i).html(quarter1Diff);
            }

            var rowCount2 = $('#table_quarter2 tr').length;
            // console.log(rowCount2);
            var availabilities2 = <?php echo $permanencesAvailabilityQuarter2; ?>;

            for (i = 0; i < rowCount2 - 3; i++) {
                var lawyer_id = parseInt($("#quarter2AvailabilityCount" + i).attr("data"));
                let availability = [];
                availability.push(collect(availabilities2).where('lawyer_id', '=', lawyer_id).where('week1', 1).count());
                availability.push(collect(availabilities2).where('lawyer_id', '=', lawyer_id).where('week2', 1).count());
                availability.push(collect(availabilities2).where('lawyer_id', '=', lawyer_id).where('week3', 1).count());
                availability.push(collect(availabilities2).where('lawyer_id', '=', lawyer_id).where('week4', 1).count());
                availability.push(collect(availabilities2).where('lawyer_id', '=', lawyer_id).where('week5', 1).count());
                // console.log(availability);
                var sum = availability.reduce(function(a, b) { return a + b; }, 0);
                // console.log(sum);
                $("#quarter2AvailabilityCount" + i).html(sum);

                var quarter2Diff = $("#quarter2AvailabilityCount" + i).text() - $("#quarter2AttributionCount" + i).text();
                $("#quarter2Diff" + i).html(quarter2Diff);
            }

            var rowCount3 = $('#table_quarter3 tr').length;
            // console.log(rowCount2);
            var availabilities3 = <?php echo $permanencesAvailabilityQuarter3; ?>;

            for (i = 0; i < rowCount3 - 3; i++) {
                var lawyer_id = parseInt($("#quarter3AvailabilityCount" + i).attr("data"));
                let availability = [];
                availability.push(collect(availabilities3).where('lawyer_id', '=', lawyer_id).where('week1', 1).count());
                availability.push(collect(availabilities3).where('lawyer_id', '=', lawyer_id).where('week2', 1).count());
                availability.push(collect(availabilities3).where('lawyer_id', '=', lawyer_id).where('week3', 1).count());
                availability.push(collect(availabilities3).where('lawyer_id', '=', lawyer_id).where('week4', 1).count());
                availability.push(collect(availabilities3).where('lawyer_id', '=', lawyer_id).where('week5', 1).count());
                // console.log(availability);
                var sum = availability.reduce(function(a, b) { return a + b; }, 0);
                // console.log(sum);
                $("#quarter3AvailabilityCount" + i).html(sum);

                var quarter3Diff = $("#quarter3AvailabilityCount" + i).text() - $("#quarter3AttributionCount" + i).text();
                $("#quarter3Diff" + i).html(quarter3Diff);
            }

            var rowCount4 = $('#table_quarter4 tr').length;
            // console.log(rowCount2);
            var availabilities4 = <?php echo $permanencesAvailabilityQuarter2; ?>;

            for (i = 0; i < rowCount4 - 3; i++) {
                var lawyer_id = parseInt($("#quarter4AvailabilityCount" + i).attr("data"));
                let availability = [];
                availability.push(collect(availabilities4).where('lawyer_id', '=', lawyer_id).where('week1', 1).count());
                availability.push(collect(availabilities4).where('lawyer_id', '=', lawyer_id).where('week2', 1).count());
                availability.push(collect(availabilities4).where('lawyer_id', '=', lawyer_id).where('week3', 1).count());
                availability.push(collect(availabilities4).where('lawyer_id', '=', lawyer_id).where('week4', 1).count());
                availability.push(collect(availabilities4).where('lawyer_id', '=', lawyer_id).where('week5', 1).count());
                // console.log(availability);
                var sum = availability.reduce(function(a, b) { return a + b; }, 0);
                // console.log(sum);
                $("#quarter4AvailabilityCount" + i).html(sum);

                var quarter4Diff = $("#quarter4AvailabilityCount" + i).text() - $("#quarter4AttributionCount" + i).text();
                $("#quarter4Diff" + i).html(quarter4Diff);
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            // nextQuarterYear = <?php echo $nextQuarterYear; ?>;
            // var nextQuarter = <?php echo $nextQuarter; ?>;

            $("#showAttributionsTableButton").click(function(e) {
                $("#showAttributionsTable").removeClass("hidden");

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: "{{ URL::route('back.permanences-attribution.generateAttributionsTable', ['year' => 2018, 'quarter' => 2]) }}",
                    data: {
                        year: year,
                        quarter: quarter
                        // data: data
                    },
                    success: function(data) {
                        console.log('success');
                        toastr.success('Table des attributions de permanences générée avec succès', 'Succès');
                        var calendarQuarter = <?php echo $calendarQuarter2; ?>;
                        // console.log(data);
                        // console.log(data.length);
                        // console.log(data['month1_week1']);
                        // console.log(calendarQuarter);
                        // console.log(calendarQuarter[0][1]);
                        // console.log(calendarQuarter[0][1]['week1_nb']);
                        
                        var myTable= "<table class='table table-bordered table-striped table-bordered' id='table_ajax'><thead><tr>";
                            // myTable += "<td>abc</td>";
                            for (var i = 0; i < calendarQuarter[0].length; i++) {
                                myTable += "<th>" + calendarQuarter[0][i]['week1'] + "</th>";
                                myTable += "<th>" + calendarQuarter[0][i]['week2'] + "</th>";
                                myTable += "<th>" + calendarQuarter[0][i]['week3'] + "</th>";
                                myTable += "<th>" + calendarQuarter[0][i]['week4'] + "</th>";
                                if (calendarQuarter[0][i]['week5_nb']) {
                                    myTable += "<th>" + calendarQuarter[0][i]['week5'] + "</th>";
                                }
                            }
                            myTable += "</tr></thead><tbody>";
                            for (var i = 0; i < 4; i++) {
                                myTable += "<tr>";
                                for (var j = 0; j < data.length; j++) {
                                    myTable += "<td>" + data[j][i]['firstname'] + " " + data[j][i]['lastname'] + "</td>";
                                }
                                myTable += "</tr>";
                            }
                            myTable += "</tbody></table>";
                            // console.log(myTable);
                            $("#showAttributionsTable").html(myTable);

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                        toastr.error('Erreur dans la nouvelle attribution des permanences', 'Erreur');
                    },
                });
            });
        });
    </script>
@endsection