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
        a:hover {
            text-decoration: none;
        }
        
        /* Confirm checkbox */
        label {
            position: relative;
            cursor: pointer;
            color: #666;
            font-weight: normal;
        }
        span.label-text {
            font-size: 1.2em;
        }
        input[type="checkbox"], input[type="radio"]{
            position: absolute;
            right: 9000px;
        }
        input[type="checkbox"] + .label-text:before{
            content: "\f096";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing:antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 5px;
        }
        input[type="checkbox"]:checked + .label-text:before{
            content: "\f14a";
            color: #9f1853;
            animation: effect 250ms ease-in;
        }
        input[type="checkbox"]:disabled + .label-text{
            color: #aaa;
        }
        input[type="checkbox"]:disabled + .label-text:before{
            content: "\f0c8";
            color: #ccc;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <ul class="breadcrumb">
            <li><i class="fa fa-calendar"></i> <a href="{{ route('lawyer.permanences.index') }}">Mes permanences</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Modifier les permanences</li>
        </ul>
        <h3 class="text-center">Modifier les disponibilités de Maître {{ $lawyer->firstname }} {{ $lawyer->lastname }}</h3>
        @if ($errors->any())        
            <div class='flash alert alert-danger alert-dismissable'> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ( $errors->all() as $error )               
                    <p>{{ $error }}</p>         
                @endforeach     
            </div>  
        @endif
        
        {!! Form::open(array('route' => array('back.permanences.update', $permanence[0]->lawyer_id), 'method' => 'PUT', 'id' => 'update_permanence')) !!}
            <h4 class="text-center">Année {{ $nextQuarterYear }}</h4>
            <br />
            <h4 class="text-center" class="checkBoxClass" id="count"></h4>
            {!! Form::hidden('lawyer_id', $permanence[0]->lawyer_id) !!}
            {!! Form::hidden('year', $nextQuarterYear) !!}
            {!! Form::hidden('quarter', $nextQuarter) !!}

            @foreach ($calendar->chunk(3) as $quarter)
                <div class="row">
                    @foreach ($quarter as $key=>$month)
                        {!! Form::hidden('month' . $key, $month->month) !!}
                        <div class="col-lg-4 col-md-6" style="background-color: #f9f4fc;">
                            <h4 class="text-center" style="color: #7a5b89;">
                                {{ getMonthName($month->month) }}
                            </h4>
                            <br />
                            <div class="form-group">
                                {!! Form::hidden('month' . $key . '_week1_nb', $month->week1_nb) !!}
                                {!! Form::hidden('month' . $key . '_week1', 0) !!}
                                <input type="checkbox" name="month{{$key}}_week1" class="checkBoxClass" id="month{{$key}}_week1" @if ($permanence[$key]->week1) checked @endif />
                                <div class="btn-group">
                                    <label for="month{{$key}}_week1" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <span> </span>
                                    </label>
                                    <label for="month{{$key}}_week1" class="btn btn-default active">
                                        {{ $month->week1 }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('month' . $key . '_week2_nb', $month->week2_nb) !!}
                                {!! Form::hidden('month' . $key . '_week2', 0) !!}
                                <input type="checkbox" name="month{{$key}}_week2" class="checkBoxClass" id="month{{$key}}_week2" @if ($permanence[$key]->week2) checked @endif />
                                <div class="btn-group">
                                    <label for="month{{$key}}_week2" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <span> </span>
                                    </label>
                                    <label for="month{{$key}}_week2" class="btn btn-default active">
                                        {{ $month->week2 }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('month' . $key . '_week3_nb', $month->week3_nb) !!}
                                {!! Form::hidden('month' . $key . '_week3', 0) !!}
                                <input type="checkbox" name="month{{$key}}_week3" class="checkBoxClass" id="month{{$key}}_week3" @if ($permanence[$key]->week3) checked @endif/>
                                <div class="btn-group">
                                    <label for="month{{$key}}_week3" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <span> </span>
                                    </label>
                                    <label for="month{{$key}}_week3" class="btn btn-default active">
                                        {{ $month->week3 }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('month' . $key . '_week4_nb', $month->week4_nb) !!}
                                {!! Form::hidden('month' . $key . '_week4', 0) !!}
                                <input type="checkbox" name="month{{$key}}_week4" class="checkBoxClass" id="month{{$key}}_week4" @if ($permanence[$key]->week4) checked @endif />
                                <div class="btn-group">
                                    <label for="month{{$key}}_week4" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <span> </span>
                                    </label>
                                    <label for="month{{$key}}_week4" class="btn btn-default active">
                                        {{ $month->week4 }}
                                    </label>
                                </div>
                            </div>
                            @if ($month->week5)
                                <div class="form-group">
                                    {!! Form::hidden('month' . $key . '_week5_nb', $month->week5_nb) !!}
                                    {!! Form::hidden('month' . $key . '_week5', 0) !!}
                                    <input type="checkbox" name="month{{$key}}_week5" class="checkBoxClass" id="month{{$key}}_week5" @if ($permanence[$key]->week5) checked @endif />
                                    <div class="btn-group">
                                        <label for="month{{$key}}_week5" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            <span> </span>
                                        </label>
                                        <label for="month{{$key}}_week5" class="btn btn-default active">
                                            {{ $month->week5 }}
                                        </label>
                                    </div>
                                </div>
                            @else
                                {!! Form::hidden('month' . $key . '_week5_nb', null) !!}
                                {!! Form::hidden('month' . $key . '_week5', null) !!}
                            @endif
                        </div>
                    @endforeach
                </div><!-- /.row -->
                <br /><br />
            @endforeach

            <div class="text-center">
                {!! Form::submit('Enregistrer les disponibilités', array('class' => 'btn btn-primary', 'id' => 'submitButton')) !!}&nbsp;
                <a href="{{ route('back.permanences.index') }}" class="btn btn-default">Annuler</a>
            </div>
        {!! Form::close() !!}

    </div><!-- ./col-md-12 -->
@endsection

@section('scripts')
    <!-- Define values for checkboxes -->
    <script>
        $(document).ready(function() {
            if ($("input[type='checkbox']").is(':checked')) {
                $("input[type='checkbox']").attr('value', 1);
            } else {
                $(".checkBoxClass").attr('value', 0);
            }
        });
    </script>
    
    <!-- Define "true" as a boolean value when week availability is checked -->
    <script>
        $("input[type='checkbox']").on('change', function() {
          if ($(this).is(':checked')) {
            $(this).attr('value', 1);
          }
        });
    </script>
@endsection