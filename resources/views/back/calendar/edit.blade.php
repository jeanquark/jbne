@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
		<li><i class="fa fa-calendar"></i> <a href="{{ route('back.calendar.index') }}"> Calendrier</a>
        <li class="active"><i class="fa fa-pencil"></i> Editer</li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Calendrier
                </div>

                <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if ($errors->any())        
                        <div class='flash alert alert-danger alert-dismissable'> 
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @foreach ( $errors->all() as $error )               
                                <p>{{ $error }}</p>         
                            @endforeach     
                        </div>  
                    @endif
                    {!! Form::model($month, array('route' => array('back.calendar.update', $month->id), 'method' => 'PUT', 'id' => 'form_calendar', 'class' => 'form-horizontal')) !!}
                        <br />
                        {!! Form::hidden('id', Input::old('id')) !!}

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            {!! Form::label('year', 'Année', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('year', Input::old('year'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('trimestre') ? ' has-error' : '' }}">
                            {!! Form::label('quarter', 'Trimestre', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('quarter', Input::old('quarter'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                            {!! Form::label('month', 'Mois', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('month', Input::old('month'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week1') ? ' has-error' : '' }}">
                            {!! Form::label('week1', 'Semaine 1', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week1', Input::old('week1'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week1_nb') ? ' has-error' : '' }}">
                            {!! Form::label('week1_nb', 'N° semaine 1', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week1_nb', Input::old('week1_nb'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week2') ? ' has-error' : '' }}">
                            {!! Form::label('week2', 'Semaine 2', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week2', Input::old('week2'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week2_nb') ? ' has-error' : '' }}">
                            {!! Form::label('week2_nb', 'N° semaine 2', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week2_nb', Input::old('week2_nb'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week3') ? ' has-error' : '' }}">
                            {!! Form::label('week3', 'Semaine 3', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week3', Input::old('week3'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week3_nb') ? ' has-error' : '' }}">
                            {!! Form::label('week3_nb', 'N° semaine 3', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week3_nb', Input::old('week3_nb'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week4') ? ' has-error' : '' }}">
                            {!! Form::label('week4', 'Semaine 4', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week4', Input::old('week4'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week4_nb') ? ' has-error' : '' }}">
                            {!! Form::label('week4_nb', 'N° semaine 4', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week4_nb', Input::old('week4_nb'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week5') ? ' has-error' : '' }}">
                            {!! Form::label('week5', 'Semaine 5', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week5', Input::old('week5'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('week5_nb') ? ' has-error' : '' }}">
                            {!! Form::label('week5_nb', 'N° semaine 5', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('week5_nb', Input::old('week5_nb'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="text-center">
                            {!! Form::submit('Editer ce mois', array('class'=>'btn btn-primary')) !!}&nbsp;
                            <a href="{{ route('lawyer.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                        <br />
                    {!! Form::close() !!}

                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
            </div><!-- /.panel panel-default -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row clearfix -->
@endsection

@section('scripts')

@endsection