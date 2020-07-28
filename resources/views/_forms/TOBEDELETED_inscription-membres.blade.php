<div class="container">
    <div class="row">
        <br /><br /><br />
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><img src="{{ asset('images/logo2.png') }}" width="30px" /> - Enregistrement des nouveaux membres</div>
                
                <div class="alert alert-info alert-dismissable" style="margin: 30px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong style="text-align: center;">Important </strong><br /><u>Avocats stagiaires:</u> Remplissez le formulaire ci-dessous pour vous enregistrer. Dans un premier temps, votre compte ne sera pas actif, si bien que vous ne pourrez pas vous connecter. Nous allons examiner votre demande et vérifier que vous être bien inscrit comme avocat stagiaire dans le Canton de Neuchâtel. Nous activerons ensuite votre compte et vous recevrez une confirmation par e-mail. Vous pourrez dès lors vous connecter et accèder à du contenu strictement réservé à nos membres. Il s'agit d'une série de documents (exemples de recours/jurisprudence, anciens examens) qui vous aideront dans votre préparation de l'examen du Barreau. <br /><u>Une dernière chose:</u> Si vous rencontrez un quelconque soucis au cours de l'enregistrement, ou si vous vous inquiétez de ne pas voir votre compte activé (généralement le prochain jour ouvrable), veuillez nous contacter via le <a href="{{ URL::route('home', ['#contact']) }}">formulaire de contact</a> ou par e-mail à l'adresse suivante: info@jbne.ch.
                </div>

                {{--@if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ( $errors->all() as $error )               
                            <p>{{ $error }}</p>         
                        @endforeach
                    </div>
                @endif--}}

                <div class="panel-body" style="display: none;">
                    {!! Form::open(array('route' => 'member.register', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'inscription_membres')) !!}

                        {{-- {{ csrf_field() }} --}}

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">Prénom</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rue') ? ' has-error' : '' }}">
                            <label for="rue" class="col-md-4 control-label">Rue et numéro</label>

                            <div class="col-md-6">
                                <input id="rue" type="text" class="form-control" name="rue" value="{{ old('rue') }}" required>

                                @if ($errors->has('rue'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('localite') ? ' has-error' : '' }}">
                            <label for="localite" class="col-md-4 control-label">Code postal et localité</label>

                            <div class="col-md-6">
                                <input id="localite" type="text" class="form-control" name="localite" value="{{ old('localite') }}" required>

                                @if ($errors->has('localite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('localite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Membre</label>
                            <div class="col-md-6 radio">
                                <label for="actif" class="">
                                <input type="radio" name="type" id="actif" value="Membre actif" checked>actif</label>

                                <label for="honoraire" class="">
                                <input type="radio" name="type" id="honoraire" value="Membre honoraire" @if(old('type')) checked @endif>honoraire (inscrit au Barreau depuis au moins 10 ans)</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Statut</label>
                            <div class="col-md-6 radio">
                                <label for="barreau" class="">
                                <input type="radio" name="statut" id="barreau" value="Avocat au Barreau" @if(old('statut') == 'Avocat au Barreau') checked @endif>Avocat au Barreau</label>

                                <label for="brevet" class="">
                                <input type="radio" name="statut" id="brevet" value="Avocat breveté" @if(old('statut') == 'Avocat breveté') checked @endif>Titulaire du brevet</label>

                                <label for="stagiaire" class="">
                                <input type="radio" name="statut" id="stagiaire" value="Avocat stagiaire" @if(old('statut') == 'Avocat stagiaire') checked @endif>Avocat stagiaire</label>
                            </div>
                        </div>

                        <div class="form-group" id="barreau_inscription">
                            <label class="col-md-4 control-label">Date de l'inscription au Barreau</label>
                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" class="form-control" name="date_inscription_barreau" value="{{ old('date_inscription_barreau') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="stage_debut">
                            <label class="col-md-4 control-label">Date du début du stage</label>
                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" class="form-control" name="date_debut_stage" value="{{ old('date_debut_stage') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="stage_fin">
                            <label class="col-md-4 control-label">Date de fin de stage</label>
                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker3">
                                    <input type="text" class="form-control" name="date_fin_stage" value="{{ old('date_fin_stage') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmation Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="submitButton">
                                    S'enregistrer&nbsp;
                                    <i class="fa fa-spinner fa-spin fa-fw" id="spinner" style="display: none;"></i>
                                </button>
                            </div>
                        </div>

                        <a class="btn btn-link pull-left" href="{{ route('home') }}">
                            &larr; Retour au site
                        </a>
                        <a class="btn btn-link pull-right" href="{{ route('member.login') }}">
                            Aller au login &rarr;
                        </a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
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

    <!-- Disable submit button when clicked -->
    <script>
        $("#inscription_membres").submit(function( event ) {
            console.log('click submit');
            $("#submitButton").attr("disabled", true);
            $("#spinner").removeAttr('style');
        });
    </script>
@endsection