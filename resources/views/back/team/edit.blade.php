@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i><a href="{{ route('back.team.index') }}"> Membres du Comité</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Modifier
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <br />
                <h3 class="text-center">Editer ce membre du Comité</h3>
                <br />
                <div class="body">
                    <div class="row clearfix">
                        <div class="">
                            {!! Form::model($team_member, array('route' => array('back.team.update', $team_member->id), 'method' => 'PUT', 'files' => true, 'id' => 'edit_team_member')) !!}
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Titre:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('title', Input::old('title'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('firstname', 'Prénom:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('lastname', 'Nom:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Statut:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('status', Input::old('status'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('website', 'Site web:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('website', Input::old('website'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('linkedIn', 'LinkedIn:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('linkedIn', Input::old('linkedIn'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('order_of_appearance', 'Ordre d\'apparition:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::number('order_of_appearance', Input::old('order_of_appearance'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                	<div class="col-md-4">
	                                    {!! Form::label('image', 'Image actuelle:', array('class' => 'form-label')) !!}<br />
	                                    {!! Form::image($team_member->image_path, 'image', ['class' => 'field', 'id' => 'image', 'width' => '100']) !!}
	                                </div>
	                                <div class="col-md-8 text-left">
	                                    {!! Form::label('new_image', 'Nouvelle image:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Largeur min: 300px, Hauteur min: 300px, Format: 1/1</i><br />
                                    	{!! Form::file('new_image', ['class' => 'field', 'id' => 'new_image']) !!}<br />
                                    	<img id="preview" src="#" alt="image membre du comité" width="100" style="visibility: hidden;" />
                                    	<br /><br /><br />
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3 text-center">
                                    {!! Form::submit('Editer ce membre du comité', array('class'=>'btn btn-primary')) !!}&nbsp;
                                    <a href="{{ route('back.team.index') }}" class="btn btn-default">Annuler</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- ./body -->
            </div><!-- ./card -->
        </div><!-- ./col-md-12 -->
    </div><!-- ./row -->
@endsection

@section('scripts')
	<!-- Image preview -->
	<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').removeAttr('style');
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#new_image").change(function() {
            readURL(this);
        });
    </script>
@endsection