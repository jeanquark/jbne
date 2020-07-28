@extends('layouts.layoutBack')

@section('css')
    <style>
        ul:not(.browser-default) li {
            list-style-type: circle;
        }
    </style>
@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-wine-glass"></i>  <a href="{{ route('back.activities.index') }}">Activités</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Modifier
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <br />
                <h3 class="text-center">Editer cette activité</h3>
                <br />
                <div class="body">
                    <div class="row clearfix">
                        <div class="">
                            {!! Form::model($activity, array('route' => array('back.activities.update', $activity->id), 'method' => 'PUT', 'files' => true, 'id' => 'edit_activity')) !!}
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
                                	<div class="col-md-6">
	                                    {!! Form::label('image', 'Image actuelle:', array('class' => 'form-label')) !!}<br />
	                                    {!! Form::image($activity->image_path, 'image', ['class' => 'field', 'id' => 'image', 'width' => '100']) !!}
	                                </div>
	                                <div class="col-md-6 text-left">
	                                    {!! Form::label('new_image', 'Nouvelle image:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Largeur min: 300px, Hauteur min: 200px, Format: 3/2</i><br />
                                    	{!! Form::file('new_image', ['class' => 'field', 'id' => 'new_image']) !!}<br />
                                    	<img id="preview" src="#" alt="image actualité" width="100" style="visibility: hidden;" />
                                    	<br /><br /><br />
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                        {!! Form::label('file', 'Fichier actuel:', array('class' => 'form-label')) !!}<br />
                                        <a href="{{ asset($activity->file_path) }}" download>
                                            {{ substr($activity->file_path, strrpos($activity->file_path, '/') + 1, strlen($activity->file_path)) }}
                                        </a>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        {!! Form::label('new_file', 'Nouveau fichier:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Taille max: 5MB, Type: PDF</i><br />
                                        {!! Form::file('new_file', ['class' => 'field', 'id' => 'new_file']) !!}<br />
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3 text-center">
                                    {!! Form::submit('Editer cette actualité', array('class'=>'btn btn-primary')) !!}&nbsp;
                                    <a href="{{ route('back.activities.index') }}" class="btn btn-default">Annuler</a>
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
    <script>
        var route_prefix = "{{ url(config('lfm.prefix')) }}";
    </script>
    <!-- CKEditor -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
    <script>
        $('textarea[name=content]').ckeditor({
            height: 300,
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
        });
        // CKEDITOR.config.contentsCss = 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css';
        CKEDITOR.config.coreStyles_bold = { element : 'b', overrides : 'strong' };
        CKEDITOR.config.coreStyles_italic = { element : 'i', overrides : 'em' };
        CKEDITOR.config.extraPlugins = 'justify';
    </script>

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