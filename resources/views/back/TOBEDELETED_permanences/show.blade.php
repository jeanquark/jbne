@extends('layouts.layoutBack')

@section('css')
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
    </style> 
@endsection

@section('content')    
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar-plus-o"></i><a href="{{ route('back.permanences.index') }}"> Permanences</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="col-md-12">
        @if ($permanence->isEmpty())
            <h4 class="text-center">Il n'y a pas d'entrées dans la table des permanences pour cet avocat</h4><br />
        @else
            <div class="text-center">
                <h3>Disponibilités de Maître {{ $lawyer->firstname }} {{ $lawyer->lastname }}</h3>
                <h3>Trimestre {{ integerToRoman($nextQuarter) }}, année {{ $nextQuarterYear }}</h3><br />
                <h5>Toutes les semaines de disponbilité sont indiquées en <span style="background-color: #dff0d8;">vert</span></h5><br />
                <a href="{{ route('back.permanences.edit', $lawyer->id . '-' . $nextQuarterYear . '-' . $nextQuarter) }}" class="btn btn-primary">Modifier les disponibilités</a><br /><br />
                <br />
            </div>
            
            @foreach ($calendar->chunk(3) as $quarter)
                <div class="row">
                    @foreach ($quarter as $key=>$month)
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ getMonthName($month->month) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $week1 = 'week' . $month->week1_nb; ?>
                                        <td id="week{{ $month->week1_nb }}" @if ($permanence[$key]->week1) class="success text-success" @endif>{{ $month->week1 }}</td>
                                    </tr>
                                    <tr>   
                                        <?php $week2 = 'week' . $month->week2_nb; ?>
                                        <td id="week{{ $month->week2_nb }}" @if ($permanence[$key]->week2) class="success text-success" @endif>{{ $month->week2 }}</td>
                                    </tr>
                                    <tr>
                                        <?php $week3 = 'week' . $month->week3_nb; ?>
                                        <td id="week{{ $month->week3_nb }}" @if ($permanence[$key]->week3) class="success text-success" @endif>{{ $month->week3 }}</td>
                                    </tr>
                                    <tr>
                                        <?php $week4 = 'week' . $month->week4_nb; ?>
                                        <td id="week{{ $month->week4_nb }}" @if ($permanence[$key]->week4) class="success text-success" @endif>{{ $month->week4 }}</td>
                                    </tr>
                                    @if ($month->week5)
                                        <tr>
                                            <?php $week5 = 'week' . $month->week5_nb; ?>
                                            <td id="week{{ $month->week5_nb }}" @if ($permanence[$key]->week5) class="success text-success" @endif>{{ $month->week5 }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- /.col-md-4 -->
                    @endforeach
                </div><!-- /.row -->
            @endforeach
        @endif
    </div><!-- /.col-md-12 -->

@endsection

@section('scripts')
    
@endsection