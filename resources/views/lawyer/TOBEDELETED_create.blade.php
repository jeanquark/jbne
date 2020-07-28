@extends('layouts.layoutPermanences')

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
<div class="container">
    <div class="row">
        <ul class="breadcrumb">
            <li><a href="{{ route('permanences.index') }}">Mes permanences</a></li>
            <li class="active">Indiquer mes permanences</li>
        </ul>
        <div class="col-md-12">
            <h2 class="text-center">Mes disponibilités</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {!! Form::open(array('route' => 'permanences.store', 'method' => 'POST', 'id' => 'form_permanence')) !!}
                <h3 class="text-center">Année 2018</h3>
                <br />
                <h5 class="text-center" id="count"></h5>
                {!! Form::hidden('lawyer_id', 1) !!}
                <div class="row">
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
                                    Semaine 10 - Du 5 au 11 mars
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
                                    Semaine 11 - Du 12 au 18 mars
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
                                    Semaine 12 - Du 19 au 25 mars
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
                                    Semaine 13 - Du 26 mars au 1<sup>er</sup> avril
                                </label>
                            </div>
                        </div>      
                    </div><!-- /.col-md-4-->
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6" style="background-color: #ead5f4;">
                        <h4 class="text-center" style="color: #7a5b89;">Avril</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week14" id="week14" />
                            <div class="btn-group">
                                <label for="week14" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week14" class="btn btn-default active">
                                    Semaine 14 - Du 2 au 8 avril
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week15" id="week15" />
                            <div class="btn-group">
                                <label for="week15" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week15" class="btn btn-default active">
                                    Semaine 15 - Du 9 au 15 avril
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week16" id="week16" />
                            <div class="btn-group">
                                <label for="week16" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week16" class="btn btn-default active">
                                    Semaine 16 - Du 16 au 22 avril
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week17" id="week17" />
                            <div class="btn-group">
                                <label for="week17" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week17" class="btn btn-default active">
                                    Semaine 17 - Du 23 au 29 avril
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week18" id="week18" />
                            <div class="btn-group">
                                <label for="week18" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week18" class="btn btn-default active">
                                    Semaine 18 - Du 30 au 6 mai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #e5cbf2;">
                        <h4 class="text-center" style="color: #7a5b89;">Mai</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week19" id="week19" />
                            <div class="btn-group">
                                <label for="week19" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week19" class="btn btn-default active">
                                    Semaine 19 - Du 7 au 13 mai
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week20" id="week20" />
                            <div class="btn-group">
                                <label for="week20" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week20" class="btn btn-default active">
                                    Semaine 20 - Du 14 au 20 mai
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week21" id="week21" />
                            <div class="btn-group">
                                <label for="week21" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week21" class="btn btn-default active">
                                    Semaine 21 - Du 21 au 27 mai
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week22" id="week22" />
                            <div class="btn-group">
                                <label for="week22" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week22" class="btn btn-default active">
                                    Semaine 22 - Du 28 au 3 juin
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #e0c1ef;">
                        <h4 class="text-center" style="color: #7a5b89;">Juin</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week23" id="week23" />
                            <div class="btn-group">
                                <label for="week23" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week23" class="btn btn-default active">
                                    Semaine 23 - Du 4 au 10 juin
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week24" id="week24" />
                            <div class="btn-group">
                                <label for="week24" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week24" class="btn btn-default active">
                                    Semaine 24 - Du 11 au 17 juin
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week25" id="week25" />
                            <div class="btn-group">
                                <label for="week25" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week25" class="btn btn-default active">
                                    Semaine 25 - Du 18 au 24 juin
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week26" id="week26" />
                            <div class="btn-group">
                                <label for="week26" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week26" class="btn btn-default active">
                                    Semaine 26 - Du 25 au 1 juillet
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6" style="background-color: #dbb6ec;">
                        <h4 class="text-center" style="color: #7a5b89;">Juillet</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week27" id="week27" />
                            <div class="btn-group">
                                <label for="week27" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week27" class="btn btn-default active">
                                    Semaine 27 - Du 2 au 8 juillet
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week28" id="week28" />
                            <div class="btn-group">
                                <label for="week28" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week28" class="btn btn-default active">
                                    Semaine 28 - Du 9 au 15 juillet
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week29" id="week29" />
                            <div class="btn-group">
                                <label for="week29" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week29" class="btn btn-default active">
                                    Semaine 29 - Du 16 au 22 juillet
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week30" id="week30" />
                            <div class="btn-group">
                                <label for="week30" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week30" class="btn btn-default active">
                                    Semaine 30 - Du 23 au 29 juillet
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week31" id="week31" />
                            <div class="btn-group">
                                <label for="week31" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week31" class="btn btn-default active">
                                    Semaine 31 - Du 30 au 5 août
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #d6acea;">
                        <h4 class="text-center" style="color: #7a5b89;">Août</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week32" id="week32" />
                            <div class="btn-group">
                                <label for="week32" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week32" class="btn btn-default active">
                                    Semaine 32 - Du 6 au 12 août
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week33" id="week33" />
                            <div class="btn-group">
                                <label for="week33" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week33" class="btn btn-default active">
                                    Semaine 33 - Du 13 au 19 août
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week34" id="week34" />
                            <div class="btn-group">
                                <label for="week34" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week34" class="btn btn-default active">
                                    Semaine 34 - Du 20 au 26 août
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week35" id="week35" />
                            <div class="btn-group">
                                <label for="week35" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week35" class="btn btn-default active">
                                    Semaine 35 - Du 27 au 2 septembre
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #d1a2e7;">
                        <h4 class="text-center" style="color: #7a5b89;">Septembre</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week36" id="week36" />
                            <div class="btn-group">
                                <label for="week36" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week36" class="btn btn-default active">
                                    Semaine 36 - Du 3 au 9 septembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week37" id="week37" />
                            <div class="btn-group">
                                <label for="week37" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week37" class="btn btn-default active">
                                    Semaine 37 - Du 10 au 16 septembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week38" id="week38" />
                            <div class="btn-group">
                                <label for="week38" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week38" class="btn btn-default active">
                                    Semaine 38 - Du 17 au 23 septembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week39" id="week39" />
                            <div class="btn-group">
                                <label for="week39" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week39" class="btn btn-default active">
                                    Semaine 39 - Du 24 au 30 septembre
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6" style="background-color: #cc98e5;">
                        <h4 class="text-center" style="color: #7a5b89;">Octobre</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week40" id="week40" />
                            <div class="btn-group">
                                <label for="week40" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week40" class="btn btn-default active">
                                    Semaine 40 - Du 1<sup>er</sup> au 7 octobre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week41" id="week41" />
                            <div class="btn-group">
                                <label for="week41" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week41" class="btn btn-default active">
                                    Semaine 41 - Du 8 au 14 octobre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week42" id="week42" />
                            <div class="btn-group">
                                <label for="week42" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week42" class="btn btn-default active">
                                    Semaine 42 - Du 15 au 21 octobre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week43" id="week43" />
                            <div class="btn-group">
                                <label for="week43" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week43" class="btn btn-default active">
                                    Semaine 43 - Du 22 au 28 octobre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week44" id="week44" />
                            <div class="btn-group">
                                <label for="week44" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week44" class="btn btn-default active">
                                    Semaine 44 - Du 29 au 4 novembre
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #b788ce;">
                        <h4 class="text-center" style="color: #7a5b89;">Novembre</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week45" id="week45" />
                            <div class="btn-group">
                                <label for="week45" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week45" class="btn btn-default active">
                                    Semaine 45 - Du 5 au 11 novembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week46" id="week46" />
                            <div class="btn-group">
                                <label for="week46" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week46" class="btn btn-default active">
                                    Semaine 46 - Du 12 au 18 novembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week47" id="week47" />
                            <div class="btn-group">
                                <label for="week47" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week47" class="btn btn-default active">
                                    Semaine 47 - Du 19 au 25 novembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week48" id="week48" />
                            <div class="btn-group">
                                <label for="week48" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week48" class="btn btn-default active">
                                    Semaine 48 - Du 26 au 2 décembre
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" style="background-color: #a379b7;">
                        <h4 class="text-center" style="color: #7a5b89;">Décembre</h4>
                        <br />
                        <div class="form-group">
                            <input type="checkbox" name="week49" id="week49" />
                            <div class="btn-group">
                                <label for="week49" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week49" class="btn btn-default active">
                                    Semaine 49 - Du 3 au 9 décembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week50" id="week50" />
                            <div class="btn-group">
                                <label for="week50" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week50" class="btn btn-default active">
                                    Semaine 50 - Du 10 au 16 décembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week51" id="week51" />
                            <div class="btn-group">
                                <label for="week51" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week51" class="btn btn-default active">
                                    Semaine 51 - Du 17 au 23 décembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week52" id="week52" />
                            <div class="btn-group">
                                <label for="week52" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week52" class="btn btn-default active">
                                    Semaine 52 - Du 24 au 30 décembre
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="week53" id="week53" />
                            <div class="btn-group">
                                <label for="week53" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="week53" class="btn btn-default active">
                                    Semaine 53 - Du 31 au 6 janvier 2019
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group">
                    {!! Form::label('remarks', 'Remarques:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::textarea('remarks', Input::old('remarks'), array('class' => 'form-control')) !!}
                    </div>
                </div> --}}
                <br />
                <div class="text-center">
                    {!! Form::submit('Enregistrer mes disponibilités', array('class'=>'btn btn-primary')) !!}&nbsp;
                    <a href="{{ route('permanences.index') }}" class="btn btn-default">Annuler</a>
                </div>
            {!! Form::close() !!}
        </div><!-- ./col-md-12 -->
    </div><!-- ./row -->
</div><!-- ./container -->
@endsection

@section('scripts')
    <!--  Calculate total availability -->
    <script>
        var countChecked = function() {
            var n = $( "input:checked" ).length;
            $( "#count" ).text( n + (n === 0 | n === 1 ? " semaine" : " semaines") + " de disponibilité au total" );
        };
        countChecked();
         
        $("input[type=checkbox]").on('click', countChecked);
    </script>

    <!-- Define "true" as a boolean value when week availability is checked -->
    <script>
        $("input[type='checkbox']").on('change', function() {
            // console.log('changed')
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
            }
        });
    </script>
@endsection