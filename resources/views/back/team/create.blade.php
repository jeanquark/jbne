@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('back.team.index') }}">Membres du Comité</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <br />
                <h3 class="text-center">Ajouter un nouveau membre au Comité</h3>
                <br />
                <div class="body">
                    <div class="row clearfix">
                        <div class="">
                            {!! Form::open(array('route' => 'back.team.store', 'method' => 'POST', 'files' => true, 'id' => 'create_team_member')) !!}
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
                                        {!! Form::label('firstname', 'Prénom*:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('lastname', 'Nom de famille*:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Statut*:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {!! Form::text('status', Input::old('status'), array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::label('image', 'Photo*:', array('class' => 'form-label')) !!} <i class="fa fa-exclamation-circle"> Largeur min: 300px, Hauteur min: 300px, Format 1/1 (ex: 300px/300px, 512px/512px, etc.)</i>
                                    {!! Form::file('image', ['class' => 'field', 'id' => 'image']) !!}

                                    <br />
                                    <img id="preview" src="#" alt="image membre du comité" width="100" style="visibility: hidden;" />
                                    <br /><br />
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        {!! Form::label('order_of_appearance', 'Ordre d\'apparition*:', array('class' => 'form-label')) !!}
                                        <div class="form-line">
                                            {{-- {!! Form::number('order_of_appearance', Input::old('order_of_appearance'), array('class' => 'form-control')) !!} --}}
                                            {!! Form::input('number', 'order_of_appearance', Input::old('order_of_appearance'), ['class' => 'form-control']) !!}

                                        </div>
                                        <small>Doit être un nombre</small>
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
                                        {!! Form::label('website', 'Site internet:', array('class' => 'form-label')) !!}
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

                                <div class="col-md-6 col-md-offset-3 text-center">
                                    {!! Form::submit('Créer ce membre', array('class'=>'btn btn-primary')) !!}&nbsp;
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
	{{-- <script>
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
        CKEDITOR.config.contentsCss = 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css';
        CKEDITOR.config.coreStyles_bold = { element : 'b', overrides : 'strong' };
        CKEDITOR.config.coreStyles_italic = { element : 'i', overrides : 'em' };
        CKEDITOR.config.extraPlugins = 'justify';
    </script> --}}
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