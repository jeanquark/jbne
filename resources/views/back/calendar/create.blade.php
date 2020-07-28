@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
    <style>
        /*.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
        }*/
        table.dataTable th {
            padding: 3px 10px;
            width: 1px;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <ul class="breadcrumb">
        <li><i class="fa fa-calendar"></i> <a href="{{ route('back.calendar.index') }}">Mon calendrier</a></li>
        <li class="active">Ajouter un mois</li>
    </ul>

    <div class="col-md-12">
        <h2 class="text-center">Calendrier</h2>
        @if ($errors->any())        
            <div class='flash alert alert-danger alert-dismissable'> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ( $errors->all() as $error )               
                    <p>{{ $error }}</p>         
                @endforeach     
            </div>  
        @endif
                    
        {!! Form::open(array('route' => 'back.calendar.store', 'method' => 'POST', 'id' => 'form_calendar')) !!}
    
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                    {!! Form::label('year', 'Année', array('class' => 'control-label')) !!}
                    {!! Form::text('year', Input::old('year'), array('class' => 'form-control', 'placeholder' => 2018)) !!}
                </div>
            
                <div class="form-group{{ $errors->has('trimestre') ? ' has-error' : '' }}">
                    {!! Form::label('quarter', 'Trimestre', array('class' => 'control-label')) !!}
                    {!! Form::text('quarter', Input::old('quarter'), array('class' => 'form-control', 'placeholder' => 1)) !!}
                </div>

                <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                    {!! Form::label('month', 'Mois', array('class' => 'control-label')) !!}
                    {!! Form::text('month', Input::old('month'), array('class' => 'form-control', 'placeholder' => 1)) !!}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('week1') ? ' has-error' : '' }}">
                    {!! Form::label('week1', 'Semaine 1', array('class' => 'control-label')) !!}
                    {!! Form::text('week1', Input::old('week1'), array('class' => 'form-control', 'placeholder' => 'Semaine 1 - Du 1er au 7 janvier')) !!}
                </div>

                <div class="form-group{{ $errors->has('week1_nb') ? ' has-error' : '' }}">
                    {!! Form::label('week1_nb', 'N° semaine 1', array('class' => 'control-label')) !!}
                    {!! Form::text('week1_nb', Input::old('week1_nb'), array('class' => 'form-control', 'placeholder' => 1)) !!}
                </div>

                <div class="form-group{{ $errors->has('week2') ? ' has-error' : '' }}">
                    {!! Form::label('week2', 'Semaine 2', array('class' => 'control-label')) !!}
                    {!! Form::text('week2', Input::old('week2'), array('class' => 'form-control', 'placeholder' => 'Semaine 2 - Du 8 au 14 janvier')) !!}
                </div>

                <div class="form-group{{ $errors->has('week2_nb') ? ' has-error' : '' }}">
                    {!! Form::label('week2_nb', 'N° semaine 2', array('class' => 'control-label')) !!}
                    {!! Form::text('week2_nb', Input::old('week2_nb'), array('class' => 'form-control', 'placeholder' => 2)) !!}
                </div>

                <div class="form-group{{ $errors->has('week3') ? ' has-error' : '' }}">
                    {!! Form::label('week3', 'Semaine 3', array('class' => 'control-label')) !!}
                    {!! Form::text('week3', Input::old('week3'), array('class' => 'form-control', 'placeholder' => 'Semaine 3 - Du 15 au 21 janvier')) !!}
                </div>

                <div class="form-group{{ $errors->has('week3_nb') ? ' has-error' : '' }}">
                    {!! Form::label('week3_nb', 'N° semaine 3', array('class' => 'control-label')) !!}
                    {!! Form::text('week3_nb', Input::old('week3_nb'), array('class' => 'form-control', 'placeholder' => 3)) !!}
                </div>

            </div><!-- /.col-md-4 -->

            <div class="col-md-4">

                <div class="form-group{{ $errors->has('week4') ? ' has-error' : '' }}">
                    {!! Form::label('week4', 'Semaine 4', array('class' => 'control-label')) !!}
                    {!! Form::text('week4', Input::old('week4'), array('class' => 'form-control', 'placeholder' => 'Semaine 4 - Du 22 au 28 janvier')) !!}
                </div>

                <div class="form-group{{ $errors->has('week4_nb') ? ' has-error' : '' }}">
                    {!! Form::label('week4_nb', 'N° semaine 4', array('class' => 'control-label')) !!}
                    {!! Form::text('week4_nb', Input::old('week4_nb'), array('class' => 'form-control', 'placeholder' => 4)) !!}
                </div>

                <div class="form-group{{ $errors->has('week5') ? ' has-error' : '' }}">
                    {!! Form::label('week5', 'Semaine 5', array('class' => 'control-label')) !!}
                    {!! Form::text('week5', Input::old('week5'), array('class' => 'form-control', 'placeholder' => 'Semaine 5 - Du 29 janvier au 4 février')) !!}
                </div>

                <div class="form-group{{ $errors->has('week5_nb') ? ' has-error' : '' }}">
                    {!! Form::label('week5_nb', 'N° semaine 5', array('class' => 'control-label')) !!}
                    {!! Form::text('week5_nb', Input::old('week5_nb'), array('class' => 'form-control', 'placeholder' => 5)) !!}
                </div>
            </div><!-- /.col-md-4 -->
            
            <div class="col-md-12">
                <hr>
                <div class="text-center">
                    {!! Form::submit('Créer ce mois', array('class'=>'btn btn-primary')) !!}&nbsp;
                    <a href="{{ route('back.calendar.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
            <br />
        {!! Form::close() !!}
    </div>
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