@extends('layouts.layoutLawyers')

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
<div class="container">
    <div class="row">
        <ul class="breadcrumb">
            <li><a href="{{ route('lawyer.permanences.index') }}">Mes disponibilités</a></li>
            <li class="active">Indiquer mes disponibilités</li>
        </ul>
        <div class="col-md-12">
            <h2 class="text-center">Mes disponibilités</h2>
            <p class="text-center"><small>Une semaine de disponibilité s'étend du lundi 07h00 au lundi suivant 07h00.</small></p>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {{-- {{ $calendar }}<br /><br /> --}}
            {{-- {{ $nextCalendar }} --}}
            {{-- {{ date('n') }} --}}

            {!! Form::open(array('route' => array('lawyer.permanences.store'), 'method' => 'POST', 'id' => 'lawyer_submit_permanence')) !!}
                {!! Form::hidden('lawyer_id', $lawyer) !!}
                {!! Form::hidden('year', $nextQuarterYear) !!}
                {!! Form::hidden('quarter', $nextQuarter) !!}

                <h3 class="text-center">Année {{ $nextQuarterYear }}</h3>
                <h4 class="text-center">Trimestre {{ $nextQuarter }}</h4>

                <br />
                <h4 class="text-center" class="checkBoxClass" id="count"></h4>

                @foreach ($calendar->chunk(3) as $quarter)
                    {{-- {{ $calendar }} --}}
                    <div class="row">
                        @foreach ($quarter as $key=>$month)
                            {{-- {{ $quarter }} --}}
                            {!! Form::hidden('month' . $key, $month->month) !!}
                            <div class="col-lg-4 col-md-6" style="background-color: #f9f4fc;">
                                {{-- {{ $month }} --}}
                                {{-- <h4 class="text-center" style="color: #7a5b89;">{{ date('F', mktime(0, 0, 0, $month->month, 10)) }}</h4> --}}
                                <h4 class="text-center" style="color: #7a5b89;">{{ getMonthName($month->month) }}</h4>
                                <br />
                                <div class="form-group">
                                    {!! Form::hidden('month' . $key . '_week1_nb', $month->week1_nb) !!}
                                    {!! Form::hidden('month' . $key . '_week1', 0) !!}
                                    <input type="checkbox" name="month{{$key}}_week1" class="checkBoxClass" id="month{{$key}}_week1" />
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
                                    <input type="checkbox" name="month{{$key}}_week2" class="checkBoxClass" id="month{{$key}}_week2"  />
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
                                    <input type="checkbox" name="month{{$key}}_week3" class="checkBoxClass" id="month{{$key}}_week3" />
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
                                    <input type="checkbox" name="month{{$key}}_week4" class="checkBoxClass" id="month{{$key}}_week4" />
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
                                        <input type="checkbox" name="month{{$key}}_week5" class="checkBoxClass" id="month{{$key}}_week5" />
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
                    {{-- {!! Form::submit('Enregistrer mes disponibilités "<i>cbvcy</i>"', array('class'=>'btn btn-primary')) !!}&nbsp; --}}
                    <br />
                        <label>
                            <input type="checkbox" name="check" id="conditions"> <span class="label-text">J'ai lu et j'accepte les <a href="#" data-toggle="modal" data-target="#myModal"> conditions générales</a></span>
                        </label>
                    <br />
                    <br />

                    <button type="submit" class="btn btn-primary" id="submitButton">
                        Enregistrer mes disponibilités&nbsp;
                        <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i>
                    </button>

                    <a href="{{ route('lawyer.permanences.index') }}" class="btn btn-default">Annuler</a>
                    <br /><br />
                </div>
                
            {!! Form::close() !!}
        </div><!-- ./col-md-12 -->
    </div><!-- ./row -->

    <!-- Modal for conditions -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                       data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                    </button>
                    <h5 class="modal-title text-center" id="myModalLabel">
                        Permanence de l’avocat de la première heure<br />
                        <small>Conditions générales d’utilisation</small>
                    </h5>  
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                <br />
                    <ol>
                        <li>La permanence de l’avocat de la première heure (ci-après : la permanence) est organisée par trimestres : du 1er janvier au 31 mars, du 1er avril au 30 juin, du 1er juillet au 30 septembre et du 1er octobre au 31 décembre.</li><br />
                        <li>La semaine de permanence débute le <b>lundi à 7h00</b> et se termine le <b>lundi suivant</b> à la même heure.</li><br />
                        <li>L’avocat inscrit s’engage à être disponible dans les semaines indiquées de manière à pouvoir rejoindre dans l’heure le lieu de son intervention.</li><br />
                        <li>Lorsqu’il est de permanence, l’avocat s’engage à répondre aussitôt à tout appel du Ministère public ou de la police.</li><br />
                        <li>La première audition ne peut pas être déléguée à un avocat-stagiaire.</li><br />
                        <li>L’avocat de permanence s’engage à <b>être atteignable</b> à toute heure au numéro indiqué.</li><br />
                        <li>Le non-respect des conditions ci-dessus peut entraîner l’exclusion de la permanence.</li>
                    </ol>
                </div><!-- /.modal-body -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div><!-- ./container -->
@endsection

@section('scripts')
    <!--  Calculate total availability -->
    <script>
        var countChecked = function() {
            var n = $("input[class=checkBoxClass]:checked").length;
            $( "#count" ).text( n + (n === 0 | n === 1 ? " semaine" : " semaines") + " de disponibilité au total" );
        };
        countChecked();
         
        $("input[type=checkbox][class=checkBoxClass]").on('click', countChecked);
    </script>

    <!-- Define "true" as a boolean value when week availability is checked -->
    <script>
        $("input[type='checkbox']").on('change', function() {
            console.log('changed')
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#submitButton").attr("disabled", true);
            $("#lawyer_submit_permanence").submit(function( event ) {
                console.log('click submit');
                $("#submitButton").attr("disabled", true);
                $("#spinner").removeAttr('style');
            });
        });
    </script>
    
    <!-- Enable submit button on conditions checked -->
    <script>
        $("#conditions").on('change', function() {
          if ($(this).is(':checked')) {
            $("#submitButton").attr('disabled', false);
          } else {
            $("#submitButton").attr('disabled', true);
          }
        });
    </script>
@endsection