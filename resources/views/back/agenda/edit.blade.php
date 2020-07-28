@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar"></i>  <a href="{{ route('back.agenda.index') }}">Agenda</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Modifier
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <br />
                <h3 class="text-center">Editer cette actualité</h3>
                <br />
                <div class="body">
                    <div class="row clearfix">
                        <div class="">
                            {!! Form::model($agenda, array('route' => array('back.agenda.update', $agenda->id), 'method' => 'PUT', 'files' => true, 'id' => 'edit_agenda')) !!}
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
                                        {!! Form::label('content', 'Contenu:', array('class' => 'form-label')) !!} 
                                        {!! Form::textarea('content', Input::old('content'), array('size' => '5x8', 'class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                	<div class="col-md-4">
	                                    {!! Form::label('image', 'Image actuelle:', array('class' => 'form-label')) !!}<br />
	                                    {{-- <img src="{{ asset($agenda->image_path) }}" width='100' id="image" name="image" /> --}}
	                                    {!! Form::image($agenda->image_path, 'image', ['class' => 'field', 'id' => 'image', 'width' => '100']) !!}
                                    	{{-- {!! Form::file('image', ['class' => 'field', 'id' => 'image']) !!} --}}
	                                </div>
	                                <div class="col-md-8 text-left">
	                                    {!! Form::label('new_image', 'Nouvelle image:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Largeur min: 200px, Hauteur min: 200px, Format: 1/1</i><br />
                                    	{!! Form::file('new_image', ['class' => 'field', 'id' => 'new_image']) !!}<br />
                                    	<img id="preview" src="#" alt="image actualité" width="100" style="visibility: hidden;" />
                                    	<br /><br /><br />
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3 text-center">
                                    {!! Form::submit('Editer cette actualité', array('class'=>'btn btn-primary')) !!}&nbsp;
                                    <a href="{{ route('back.agenda.index') }}" class="btn btn-default">Annuler</a>
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