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
        /*.highlight {
            background-color: red;
        }*/
        .form-group input[type="checkbox"]:checked + .btn-group > label {
            background-color: #449d44;
            border-color: #449d44;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label.active {
            /*background-color: rgba(68, 157, 68, 0.75);*/
            background-color: #c6e1c6;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar"></i>  <a href="{{ route('back.permanences.index') }}">Permanences</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Transmettre mes disponibilités</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {!! Form::open(array('route' => 'back.permanences.store', 'method' => 'POST', 'id' => 'form_permanence')) !!}
                {{-- <div class="form-group">
                    {!! Form::label('name', 'Name:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
                    </div>
                </div> --}}

                {{-- <div class="form-group">
                    {!! Form::label('availability', 'Cochez les cases :', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::checkbox('availability', Input::old('availability'), array('class' => 'field')) !!}
                    </div>
                </div> --}}
                <h3 class="text-center">Année 2018</h3>
                <br />
                <h4 class="text-center" id="count"></h4>

                <div class="col-lg-4 col-md-6" style="background-color: #f9f4fc;">
                    <h4 class="text-center" style="color: #7a5b89;">Janvier</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week1" id="week1" />
                        <div class="btn-group">
                            <label for="week1" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week1" class="btn btn-default active">
                                Semaine 1 - Du 1<sup>er</sup> au 7 janvier
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week2" id="week2" />
                        <div class="btn-group">
                            <label for="week2" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week2" class="btn btn-default active">
                                Semaine 2 - Du 8 au 14 janvier
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week3" id="week3" />
                        <div class="btn-group">
                            <label for="week3" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week3" class="btn btn-default active">
                                Semaine 3 - Du 15 au 21 janvier
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week4" id="week4" />
                        <div class="btn-group">
                            <label for="week4" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week4" class="btn btn-default active">
                                Semaine 4 - Du 22 au 28 janvier
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week5" id="week5" />
                        <div class="btn-group">
                            <label for="week5" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week5" class="btn btn-default active">
                                Semaine 5 - Du 29 janvier au 4 février
                            </label>
                        </div>
                    </div>
                </div><!-- /.col-md-4-->
                <div class="col-lg-4 col-md-6" style="background-color: #f4eaf9;">
                    <h4 class="text-center" style="color: #7a5b89;">Février</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week6" id="week6" />
                        <div class="btn-group">
                            <label for="week6" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week6" class="btn btn-default active">
                                Semaine 6 - Du 5 au 11 février
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week7" id="week7" />
                        <div class="btn-group">
                            <label for="week7" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week7" class="btn btn-default active">
                                Semaine 7 - Du 12 au 18 février
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week8" id="week8" />
                        <div class="btn-group">
                            <label for="week8" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week8" class="btn btn-default active">
                                Semaine 8 - Du 19 au 25 février
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week9" id="week9" />
                        <div class="btn-group">
                            <label for="week9" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week9" class="btn btn-default active">
                                Semaine 9 - Du 26 février au 4 mars
                            </label>
                        </div>
                    </div>
                </div><!-- /.col-md-4-->
                <div class="col-lg-4 col-md-6" style="background-color: #efe0f7;">
                    <h4 class="text-center" style="color: #7a5b89;">Mars</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week10" id="week10" />
                        <div class="btn-group">
                            <label for="week10" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week10" class="btn btn-default active">
                                Semaine 10 - Du 29 janvier au 4 février
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week11" id="week11" />
                        <div class="btn-group">
                            <label for="week11" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week11" class="btn btn-default active">
                                Semaine 11 - Du 5 au 11 mars
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week12" id="week12" />
                        <div class="btn-group">
                            <label for="week12" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week12" class="btn btn-default active">
                                Semaine 12 - Du 12 au 18 mars
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week13" id="week13" />
                        <div class="btn-group">
                            <label for="week13" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week13" class="btn btn-default active">
                                Semaine 13 - Du 19 au 25 mars
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="week14" id="week14" />
                        <div class="btn-group">
                            <label for="week14" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week14" class="btn btn-default active">
                                Semaine 14 - Du 26 mars au 1<sup>er</sup> avril
                            </label>
                        </div>
                    </div>
                    
                </div><!-- /.col-md-4-->
                <div class="col-lg-4 col-md-6" style="background-color: #ead5f4;">
                    <h4 class="text-center" style="color: #7a5b89;">Avril</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week15" id="week15" />
                        <div class="btn-group">
                            <label for="week15" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week15" class="btn btn-default active">
                                Semaine 15 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #e5cbf2;">
                    <h4 class="text-center" style="color: #7a5b89;">Mai</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week16" id="week16" />
                        <div class="btn-group">
                            <label for="week16" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week16" class="btn btn-default active">
                                Semaine 16 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #e0c1ef;">
                    <h4 class="text-center" style="color: #7a5b89;">Juin</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week17" id="week17" />
                        <div class="btn-group">
                            <label for="week17" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week17" class="btn btn-default active">
                                Semaine 17 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #dbb6ec;">
                    <h4 class="text-center" style="color: #7a5b89;">Juillet</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week21" id="week21" />
                        <div class="btn-group">
                            <label for="week21" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week21" class="btn btn-default active">
                                Semaine 21 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #d6acea;">
                    <h4 class="text-center" style="color: #7a5b89;">Août</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week26" id="week26" />
                        <div class="btn-group">
                            <label for="week26" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week26" class="btn btn-default active">
                                Semaine 26 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #d1a2e7;">
                    <h4 class="text-center" style="color: #7a5b89;">Septembre</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week31" id="week31" />
                        <div class="btn-group">
                            <label for="week31" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week31" class="btn btn-default active">
                                Semaine 31 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #cc98e5;">
                    <h4 class="text-center" style="color: #7a5b89;">Octobre</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week36" id="week36" />
                        <div class="btn-group">
                            <label for="week36" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week36" class="btn btn-default active">
                                Semaine 36 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #b788ce;">
                    <h4 class="text-center" style="color: #7a5b89;">Novembre</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week41" id="week41" />
                        <div class="btn-group">
                            <label for="week41" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week41" class="btn btn-default active">
                                Semaine 41 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" style="background-color: #a379b7;">
                    <h4 class="text-center" style="color: #7a5b89;">Décembre</h4>
                    <br />
                    <div class="form-group">
                        <input type="checkbox" name="week46" id="week46" />
                        <div class="btn-group">
                            <label for="week46" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span> </span>
                            </label>
                            <label for="week46" class="btn btn-default active">
                                Semaine 46 - Du 2 au 4 avril 2018
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('remarks', 'Remarques:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::textarea('remarks', Input::old('remarks'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                {!! Form::submit('Transmettre mes disponibilités', array('class'=>'btn btn-primary')) !!}&nbsp;
                <a href="{{ route('back.permanences.index') }}" class="btn btn-default">Annuler</a>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')
    <script>
        // $('.btn-default').click(function() {
        //     // alert('Week 1 is clicked!');
        //     // $(".btn-default").toggle(this.checked);
        //     // $(".btn-default").toggleClass('highlight');
        //     // $(event.target).closest('.btn-default').toggleClass('highlight');
        //     // $(event.target).closest('.active').toggleClass('highlight');
        //     $("input[type=checkbox]:checked").toggleClass('highlight');
        // });
        $('.btn-default').click(function() {
            // alert('Week 1 is clicked!');
            $(".btn-default").toggleClass('highlight');
        });
        var countChecked = function() {
            var n = $( "input:checked" ).length;
            $( "#count" ).text( n + (n === 0 | n === 1 ? " semaine" : " semaines") + " de disponibilité au total" );
        };
        countChecked();
         
        $( "input[type=checkbox]" ).on( "click", countChecked );
    </script>

@endsection