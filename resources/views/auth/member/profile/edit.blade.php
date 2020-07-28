@extends('layouts.layoutMembers')

@section('css')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2" style="">
        <div class="row clearfix">
            <ol class="breadcrumb">
            <li>
                <i class="fa fa-black-tie"></i>  <a href="{{ route('member.profile.show', ['id' => Auth::id() ]) }}">Profil</a>
            </li>
            <li class="active">
                <i class="fa fa-pencil"></i> Editer
            </li>
        </ol>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="text-center">Editer</h3>
                @if ($errors->any())        
                    <div class='flash alert alert-danger alert-dismissable'> 
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                        @foreach ( $errors->all() as $error )               
                            <p>{{ $error }}</p>         
                        @endforeach     
                    </div>  
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Erreur:</strong> {!! $message !!}
                    </div>
                    {{ Session::forget('error') }}
                @endif
                {!! Form::model($profile, array('route' => array('member.profile.update', $profile->id), 'method' => 'PUT', 'id' => 'form_profile', 'files' => true)) !!}
                    <div class="form-group">
                        {!! Form::label('firstname', 'Prénom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname', 'Nom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('rue', 'Rue et numéro:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('rue', Input::old('rue'), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('localite', 'Code postal et localité:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('localite', Input::old('localite'), array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Statut:</label>
                        <div class="form-line">
                            <label for="barreau" class="">
                            <input type="radio" name="statut" id="barreau" value="Avocat au Barreau" class="" @if($profile->statut == 'Avocat au Barreau') checked @endif> Avocat au Barreau</label>&nbsp;&nbsp;

                            <label for="brevet" class="">
                            <input type="radio" name="statut" id="brevet" value="Avocat breveté" class="" @if($profile->statut == 'Avocat breveté') checked @endif> Titulaire du brevet</label>&nbsp;&nbsp;

                            <label for="stagiaire" class="">
                            <input type="radio" name="statut" id="stagiaire" value="Avocat stagiaire" class="" @if($profile->statut == 'Avocat stagiaire') checked @endif> Avocat stagiaire</label>
                        </div>
                    </div>

                    <div class="form-group" id="barreau_inscription">
                        <label class="col-md-4 form-label">Date de l'inscription au Barreau:</label>
                        <div class="form-line">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" class="form-control" name="date_inscription_barreau" value="{{ $profile->date_inscription_barreau }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stage_debut">
                        <label class="col-md-4 form-label">Date du début du stage:</label>
                        <div class="form-line">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" class="form-control" name="date_debut_stage" value="{{ $profile->date_debut_stage }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stage_fin">
                        <label class="col-md-4 form-label">Date de fin de stage:</label>
                        <div class="form-line">
                            <div class="input-group date" id="datetimepicker3">
                                <input type="text" class="form-control" name="date_fin_stage" value="{{ $profile->date_fin_stage }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        {!! Form::submit('Editer le profil', array('class'=>'btn btn-primary')) !!}
                    </div>
                {!! Form::close() !!}
            </div><!-- ./col-md-6 -->
        </div><!-- ./row -->

        <div id="password"></div><br />

        <div class="row clearfix">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="text-center">Modifier le mot de passe</h3><br />
                    {!! Form::open(array('route' => ['member.profile.changePassword', $profile->id], 'method' => 'POST', 'id' => 'form_password')) !!}

                        <div class="form-group">
                            {!! Form::label('old_password', 'Mot de passe actuel:', array('class' => 'form-label')) !!}
                            <div class="form-line">
                                {!! Form::password('old_password', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('new_password', 'Nouveau mot de passe:', array('class' => 'form-label')) !!}
                            <div class="form-line">
                                {!! Form::password('new_password', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('new_password_confirmation', 'Confirmation nouveau mot de passe:', array('class' => 'form-label')) !!}
                            <div class="form-line">
                                {!! Form::password('new_password_confirmation', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="text-center">
                            {!! Form::submit('Changer mot de passe', array('class'=>'btn btn-primary')) !!}
                        </div>
                        <br />
                {!! Form::close() !!}
            </div><!-- ./col-md-6 -->
        </div><!-- ./row -->
    </div><!-- /.col-md-8 -->
@endsection

@section('scripts')
    <!-- jQuery Validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#form_profile').validate({
                rules: {
                    'description': {
                        required: true,
                        //minlength: 8,
                        //maxlength: 10
                    }
                },
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append(error);
                }
            });
        });
    </script>

    <!-- Image preview -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    spanId = '#new-preview-'+$(input).attr('id');
                    imgId = '#preview-'+$(input).attr('id');
                    $(spanId).removeAttr('style');
                    $(imgId).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("form#form_profile input[type='file']").change(function(){
            readURL(this);
        });
    </script>

    <!-- Bootstrap 3 Datepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/fr.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                locale: 'fr',
                format: 'DD/MM/YYYY'
            });
            $('#datetimepicker2').datetimepicker({
                locale: 'fr',
                format: 'DD/MM/YYYY'
            });
            $('#datetimepicker3').datetimepicker({
                locale: 'fr',
                format: 'DD/MM/YYYY'
            });
        });
    </script>

    <!-- Show Bootstrap 3 Datepicker -->
    <script>
        $(document).ready(function() {
            $('.panel-body').removeAttr('style');

            if ($('#barreau').is(':checked')) {
                console.log('barreau checked');
                $('#barreau_inscription').show();
            } else {
                $('#barreau_inscription').hide();
            }
            if ($('#stagiaire').is(':checked')) {
                console.log('stagiaire checked');
                $('#stage_debut').show();
                $('#stage_fin').show();
            } else {
                $('#stage_debut').hide();
                $('#stage_fin').hide();
            }

            $("input[name='statut']").click(function() {
                if($(this).attr('id') == 'barreau') {
                    $("#barreau_inscription").slideDown("slow");
                }
                else {
                    $('#barreau_inscription').hide();
                }
                if($(this).attr('id') == 'stagiaire') {
                    $('#stage_debut').slideDown("slow");
                    $('#stage_fin').show("slow");
                }
                else {
                    $('#stage_debut').hide();
                    $('#stage_fin').hide();
                }
            });
        });
    </script>

@endsection