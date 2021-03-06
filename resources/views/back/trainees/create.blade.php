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
            <i class="fa fa-users"></i>  <a href="{{ route('back.trainees.index') }}">Avocats-stagiaires</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <br />
                <h3 class="text-center">Créer une nouvelle page</h3>
                <h5 class="text-center">Les champs suivis d'un astérisque (*) sont obligatoires</h5>
                <br />
                <div class="body">
                    <div class="row clearfix">
                        <div class="">
                            {!! Form::open(array('route' => 'back.trainees.store', 'method' => 'POST', 'files' => true, 'id' => 'create_activity')) !!}
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Titre*:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('title', Input::old('title'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::label('image', 'Image d\'illustration*:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Largeur min: 300px, Hauteur min: 200px, Format 3/2 (ex: 600px/400px)</i>
                                    {!! Form::file('image', ['class' => 'field', 'id' => 'image']) !!}
                                    <br />
                                    <img id="preview" src="#" alt="image du contenu" width="100" style="visibility: hidden;" />
                                    <br /><br />
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('content', 'Contenu (texte uniquement):', array('class' => 'form-label')) !!} 
                                        {!! Form::textarea('content', Input::old('content'), array('size' => '5x8', 'class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::label('order_of_appearance', 'Ordre d\'affichage*:', array('class' => 'form-label')) !!}
                                    <div class="form-line">
                                        {!! Form::input('number', 'order_of_appearance', Input::old('order_of_appearance'), ['class' => 'form-control']) !!}
                                    </div>
                                    <small>Doit être un nombre. Par exemple, l'élément "1" apparaît avant (= sur la gauche de) l'élément "2".</small>
                                </div>

                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <br /><br />
                                    {!! Form::submit('Créer ce contenu', array('class'=>'btn btn-primary')) !!}&nbsp;
                                    <a href="{{ route('back.trainees.index') }}" class="btn btn-default">Annuler</a>
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

    <!-- image preview -->
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

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endsection