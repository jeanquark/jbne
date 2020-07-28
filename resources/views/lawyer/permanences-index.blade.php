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

        /* PDF Object */
        .pdfobject-container {
            height: 500px;
        }
        .pdfobject {
            border: 1px solid #666; 
        }
        .hidden {
            display: none;
        }

        /* Print properties */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="active"><i class="fa fa-calendar"></i> Mes disponibilités</li>
        </ul>
        Bienvenue, Maître {{ Auth::guard('lawyer')->user()->firstname }} {{ Auth::guard('lawyer')->user()->lastname }}
        <a href="#" class="pull-right hidden-xs" id="letterModal">Plus d'infos (voir courrier)</a><br />

        <a href="#" class="pull-right" data-toggle="modal" data-target="#messageModal">Au secours, j'ai besoin d'aide!</a><br />
        @if ($permanence->isEmpty())
            <h4 class="text-center">Vous n'avez pas d'entrées dans la table des disponibilités pour le prochain trimestre ({{ $nextQuarter }})</h4><br />
            <div class="text-center">
                <a href="{{ route('lawyer.permanences.create') }}" class="btn btn-primary">Entrer mes disponibilités</a>
            </div>
        @else
            <div class="text-center">
                <h3>Disponibilités trimestre {{ integerToRoman($nextQuarter) }}, année {{ $nextQuarterYear }} :</h3> <br /><br />
                <h5>Toutes vos semaines de disponbilité sont indiquées en <span style="background-color: #dff0d8 !important;">vert</span></h5>
                <h5 class="text-center" id="countAvailabilities"></h5>
                <br />
                <!--<button onclick="location.href='{{ route('lawyer.permanences.edit', [$permanence[0]->lawyer_id]) }}'" type="button" class="btn btn-primary" <?php //if (date('j') > env('PERMANENCES_AVAILABILITIES_CLOSING_DAY')) echo 'disabled'; ?> }}>Modifier mes disponibilités</button><br /><br /> -->
                <button onclick="location.href='{{ route('lawyer.permanences.edit', [$permanence[0]->lawyer_id]) }}'" type="button" class="btn btn-primary">Modifier mes disponibilités</button><br /><br />

                
                <div class="text-center visible-print-block">
                    <button class="btn btn-default" style="background: #dff0d8 !important;">Les cases de cette couleur correspondent aux semaines de disponibilité</button>
                    <br /><br />
                </div>
            </div>
            
            @foreach ($calendar->chunk(3) as $quarter)
                <div class="row">
                    @foreach ($quarter as $key=>$month)
                        <div class="col-md-4">
                            <table class="table table-bordered" id="availabilities">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ getMonthName($month->month) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $week1 = 'week' . $month->week1_nb; ?>
                                        <td id="week{{ $month->week1_nb }}" @if ($permanence[$key]->week1_dispo) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week1 }}</td>
                                    </tr>
                                    <tr>   
                                        <?php $week2 = 'week' . $month->week2_nb; ?>
                                        <td id="week{{ $month->week2_nb }}" @if ($permanence[$key]->week2_dispo) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week2 }}</td>
                                    </tr>
                                    <tr>
                                        <?php $week3 = 'week' . $month->week3_nb; ?>
                                        <td id="week{{ $month->week3_nb }}" @if ($permanence[$key]->week3_dispo) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week3 }}</td>
                                    </tr>
                                    <tr>
                                        <?php $week4 = 'week' . $month->week4_nb; ?>
                                        <td id="week{{ $month->week4_nb }}" @if ($permanence[$key]->week4_dispo) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week4 }}</td>
                                    </tr>
                                    @if ($month->week5)
                                        <tr>
                                            <?php $week5 = 'week' . $month->week5_nb; ?>
                                            <td id="week{{ $month->week5_nb }}" @if ($permanence[$key]->week5_dispo) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week5 }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- /.col-md-4 -->
                    @endforeach
                </div><!-- /.row -->
            @endforeach
        @endif
        
        <!-- Attributions des permanences pour le trimestre en cours -->
        @if (!$permanenceCurrentQuarter->isEmpty())
            <div class="row">
                <br />
                <br />
                <h4 class="text-center">Mes attributions pour le trimestre en cours :</h4>
                <h5 class="text-center">Toutes vos semaines de permanences sont indiquées en <span style="background-color: #dff0d8 !important;">vert</span></h5>
                <h6 class="text-center"><span style="border: 1px solid red; padding: 3px;">semaine en cours</span></h6>
                <h5 class="text-center" id="countAttributions"></h5>

                @foreach ($calendarCurrentQuarter as $key=>$month)
                    <div class="col-md-4">
                        <table class="table table-bordered" id="attributions">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ getMonthName($month->month) }}</th>
                                </tr>
                            </thead>
                            <tbody id="def">
                                <tr style="">
                                    <?php $week1 = 'week' . $month->week1_nb; ?>
                                    <td id="week{{ $month->week1_nb }}" @if ($permanenceCurrentQuarter[$key]->week1_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week1 }}</td>
                                </tr>
                                <tr>   
                                    <?php $week2 = 'week' . $month->week2_nb; ?>
                                    <td id="week{{ $month->week2_nb }}" @if ($permanenceCurrentQuarter[$key]->week2_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week2 }}</td>
                                </tr>
                                <tr>
                                    <?php $week3 = 'week' . $month->week3_nb; ?>
                                    <td id="week{{ $month->week3_nb }}" @if ($permanenceCurrentQuarter[$key]->week3_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week3 }}</td>
                                </tr>
                                <tr>
                                    <?php $week4 = 'week' . $month->week4_nb; ?>
                                    <td id="week{{ $month->week4_nb }}" @if ($permanenceCurrentQuarter[$key]->week4_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week4 }}</td>
                                </tr>
                                @if ($month->week5)
                                    <tr>
                                        <?php $week5 = 'week' . $month->week5_nb; ?>
                                        <td id="week{{ $month->week5_nb }}" @if ($permanenceCurrentQuarter[$key]->week5_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week5 }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
        
        
        <!-- Attributions des permanences pour le prochain trimestre -->
        {{-- @if (!$permanence->isEmpty() && config('app.DISPLAY_NEXT_QUARTER_ATTRIBUTIONS') === true) --}}
        @if ($siteParameters->boolean_value)
            <div class="row">
                <br />
                <br />
                <h4 class="text-center">Mes attributions pour le prochain trimestre :</h4>
                <h5 class="text-center">Toutes vos semaines de permanences sont indiquées en <span style="background-color: #dff0d8 !important;">vert</span></h5>
                @foreach ($calendar as $key=>$month)
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ getMonthName($month->month) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="">
                                    <?php $week1 = 'week' . $month->week1_nb; ?>
                                    <td id="week{{ $month->week1_nb }}" @if (!$permanence->isEmpty() && $permanence[$key]->week1_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week1 }}</td>
                                </tr>
                                <tr>   
                                    <?php $week2 = 'week' . $month->week2_nb; ?>
                                    <td id="week{{ $month->week2_nb }}" @if (!$permanence->isEmpty() && $permanence[$key]->week2_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week2 }}</td>
                                </tr>
                                <tr>
                                    <?php $week3 = 'week' . $month->week3_nb; ?>
                                    <td id="week{{ $month->week3_nb }}" @if (!$permanence->isEmpty() && $permanence[$key]->week3_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week3 }}</td>
                                </tr>
                                <tr>
                                    <?php $week4 = 'week' . $month->week4_nb; ?>
                                    <td id="week{{ $month->week4_nb }}" @if (!$permanence->isEmpty() && $permanence[$key]->week4_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week4 }}</td>
                                </tr>
                                @if ($month->week5)
                                    <tr>
                                        <?php $week5 = 'week' . $month->week5_nb; ?>
                                        <td id="week{{ $month->week5_nb }}" @if (!$permanence->isEmpty() && $permanence[$key]->week5_attr) class="success" style="background-color: #dff0d8 !important;" @endif>{{ $month->week5 }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
        

        <!-- Message Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            Avez-vous une question au sujet des permanences?<br />
                            <small>Veuillez décrire le problème que vous rencontrez</small>
                        </h5>  
                    </div>
                    
                    <!-- Modal Body -->
                    {!! Form::open(array('route' => 'lawyer.formulaire.question', 'method' => 'POST', 'id' => 'contactForm', 'class' => '', 'style' => '', 'name' => 'sentMessage')) !!}
                        <div class="modal-body">
                            <div class="form-group {{ ($errors->has('message')) ? 'has-error' : '' }}">
                                {!! Form::textarea('message', Input::old('message'), array('class' => 'form-control', 'placeholder' => 'Votre question *')) !!}
                                @if ($errors->has('message') )
                                    <span class="help-block" style="background-color: #fff; border-radius: 4px; padding: 5px;">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                        </div><!-- /.modal-body -->
                            
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                        Annuler
                            </button>
                            {!! Form::submit('Envoyer Message', array('class'=>'btn btn-primary')) !!}
                        </div><!-- /.modal-footer -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- ./modal -->

        
        <div id="showPDF" class="hidden"></div>

        <!-- Message Modal -->
        {{-- <div class="modal fade" id="letterModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Lettre aux avocats</h4> 
                    </div>

                    <div class="modal-body">
                        <div style="text-align: center;">
                            <iframe src="{{ asset('documents/lettre_aux_avocats_inscription.pdf') }}" style="width:800px; height:500px;" frameborder="0" download></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div><!-- ./container -->
@endsection

@section('scripts')
    <!-- Compute number of weeks with availability -->
    <script>
        var countAvailabilities = function() {
            var n = $('table#availabilities>tbody>tr>td.success').length;
            $( "#countAvailabilities" ).text(n + (n === 0 | n === 1 ? " semaine" : " semaines") + " de disponibilité au total" );
        };
        countAvailabilities();
        var countAttributions = function() {
            var n = $('table#attributions>tbody>tr>td.success').length;
            $( "#countAttributions" ).text(n + (n === 0 | n === 1 ? " semaine" : " semaines") + " de permanence au total" );
        };
        countAttributions();
    </script>

    <!-- Highlight current week -->
    <script>
        var year = '<?php echo $year; ?>';
        var week = '<?php echo $week; ?>';
        // if (year == '2018') {
            $("#week" + week).css("border", "3px solid red");
        // }
    </script>
    
    <!-- Open modal in case of validation error -->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 'modal')
        <script>
            $('#myModal').modal('show');
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#trigger').click(function(){
                $("#dialog").dialog();
            });
        });
    </script>

    <!-- Open PDF in div -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js"></script>
    <script>PDFObject.embed("{{ asset('documents/lettre_aux_avocats_inscription.pdf') }}", "#showPDF");</script>
    <script>
        $('#letterModal').click(function(){
            $("#showPDF").removeClass('hidden');
        });
    </script>
@endsection