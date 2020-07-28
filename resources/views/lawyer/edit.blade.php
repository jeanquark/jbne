@extends('layouts.layoutLawyers')

@section('css')
    <style>
        .form-border {
            border: 1px solid var(--primary-color);
            border-radius: 20px;
        }
        #addNewLawyerOffice, #updateLawyerOffice span {
            color: var(--primary-color);
            cursor: pointer;
        }
        #addNewLawyerOffice:hover, #updateLawyerOffice span:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        .hidden {
            display: none;
        }
        #lawyerOffice_form {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><i class="fa fa-calendar"></i> <a href="{{ route('lawyer.permanences.index') }}">Mes permanences</a></li>
                <li><i class="fa fa-black-tie"></i> <a href="{{ route('lawyer.index') }}">Mes informations</a></li>
                <li class="active"><i class="fa fa-pencil"></i> Modifier mes informations</li>
            </ul>
            <h4 class="text-center">Editer mes informations</h4>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <br />
                    <div class="form-border" id="lawer_form"><br />
                        {!! Form::model($lawyer, array('route' => array('lawyer.update', $lawyer->id), 'method' => 'PUT', 'id' => 'form_lawyer', 'class' => 'form-horizontal')) !!}

                            <h5 class="text-center">Données personnelles:</h5><br />
                            {!! Form::hidden('id', Input::old('id')) !!}
                            
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                {!! Form::label('username', 'Nom d\'utilisateur', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('username', Input::old('username'), array('class' => 'form-control')) !!}
                                    <p style="margin-top: 5px;"><b><i class="fa fa-exclamation-triangle"></i> Prudence: identifiant de connexion</b></p>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'Adresse e-mail', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email', Input::old('email'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                {!! Form::label('lastname', 'Nom', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                {!! Form::label('firstname', 'Prénom', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_mobile') ? ' has-error' : '' }}">
                                {!! Form::label('phone_mobile', 'Numéro de téléphone portable', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('phone_mobile', Input::old('phone_mobile'), array('class' => 'form-control', 'id' => 'phone_mobile')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                                {!! Form::label('languages', 'Langues maîtrisées (niveau juridique)', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('languages', Input::old('languages'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('lawyer_office_id', 'Nom de l\'Étude', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {{-- {!! Form::select('lawyer_office', $lawyer_offices, null, ['class' => 'form-control']) !!} --}}
                                    <select class="form-control" name="lawyer_office_id" id="lawyer_office_select">
                                        <option value=''>Aucune sélection</option>
                                        @foreach($lawyer_offices as $office)
                                            <option value="{{ $office->id }}"
                                            @if ($lawyer->lawyerOffice && $office->id === $lawyer->lawyerOffice->id)
                                                selected="selected"
                                            @endif
                                            >
                                                {{ $office->name }}, {{ $office->street }}, {{ $office->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p style="margin-top: 5px;"><b><i class="fa fa-question-circle"></i> Votre étude ne figure pas dans la liste ci-dessus? Veuillez cliquer <span id="addNewLawyerOffice">ici</span> pour ajouter une nouvelle entrée.</b></p>
                                    <p id="updateLawyerOffice"><b><i class="fa fa-edit"></i> Vous souhaitez modifier les informations relatives à cette Étude? Cliquez <span>ici</span>.</b></p>
                                </div>
                            </div>

                            <div class="text-center">
                                {!! Form::submit('Editer mes infos', array('class'=>'btn btn-primary')) !!}&nbsp;
                                <a href="{{ route('lawyer.index') }}" class="btn btn-default">Annuler</a>
                            </div>
                        {!! Form::close() !!}

                    <br />
                    </div><!-- /#lawyer_form -->
                    

                    <br />
                    <!-- Add a new office -->
                    <div class="form-border hidden" id="addNewLawyerOfficeForm"><br />
                        <br />
                        {!! Form::open(array('route' => ['lawyer.addNewLawyerOffice', $lawyer->id], 'method' => 'POST', 'id' => 'form_addNewLawyerOffice', 'class' => 'form-horizontal')) !!}

                            <h5 class="text-center"><b>Ajouter une nouvelle Étude:</b></h5><br />
                            <!-- To retrieve first form values in case of validation errors with lawyer office form -->
                            {!! Form::hidden('username', $lawyer->username) !!}
                            {!! Form::hidden('email', $lawyer->email) !!}
                            {!! Form::hidden('lastname', $lawyer->lastname) !!}
                            {!! Form::hidden('firstname', $lawyer->firstname) !!}
                            {!! Form::hidden('phone_mobile', $lawyer->phone_mobile) !!}
                            {!! Form::hidden('languages', $lawyer->languages) !!}
                            
                            <div class="form-group{{ $errors->has('lawyer_office_name') ? ' has-error' : '' }}">
                                {!! Form::label('lawyer_office_name', 'Nom de l\'Étude', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('lawyer_office_name', Input::old('lawyer_office_name'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lawyer_office_street') ? ' has-error' : '' }}">
                                {!! Form::label('lawyer_office_street', 'Rue et numéro', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('lawyer_office_street', Input::old('lawyer_office_street'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lawyer_office_city') ? ' has-error' : '' }}">
                                {!! Form::label('lawyer_office_city', 'Numéro postal et localité', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('lawyer_office_city', Input::old('lawyer_office_city'), array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_office') ? ' has-error' : '' }}">
                                {!! Form::label('phone_office', 'Numéro de téléphone prof.', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('phone_office', Input::old('phone_office'), array('class' => 'form-control', 'id' => 'phone_office')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fax_office') ? ' has-error' : '' }}">
                                {!! Form::label('fax_office', 'Numéro de fax prof.', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('fax_office', Input::old('fax_office'), array('class' => 'form-control', 'id' => 'fax_office')) !!}
                                </div>
                            </div>
                            <br />
                            <div class="text-center">
                                {!! Form::submit('Ajouter Étude', array('class'=>'btn btn-primary')) !!}&nbsp;
                                {{-- <a href="{{ route('lawyer.addLawyerOffice', $lawyer->id) }}" class="btn btn-default">Annuler</a> --}}
                            </div>
                        {!! Form::close() !!}
                        <br />
                    </div><!-- /#addNewLawyerOfficeForm -->


                    <!-- Update an existing office -->
                    <div class="form-border hidden" id="updateLawyerOfficeForm"><br />
                        <br />
                        {!! Form::open(array('route' => ['lawyer.updateLawyerOffice', $lawyer->id], 'method' => 'POST', 'id' => 'form_updateLawyerOffice', 'class' => 'form-horizontal')) !!}

                            <h5 class="text-center"><b>Modifier une Étude existante:</b></h5><br />

                            <!-- To retrieve first form values in case of validation errors with lawyer office form -->
                            {!! Form::hidden('username', $lawyer->username) !!}
                            {!! Form::hidden('email', $lawyer->email) !!}
                            {!! Form::hidden('lastname', $lawyer->lastname) !!}
                            {!! Form::hidden('firstname', $lawyer->firstname) !!}
                            {!! Form::hidden('phone_mobile', $lawyer->phone_mobile) !!}
                            {!! Form::hidden('languages', $lawyer->languages) !!}
                            {!! Form::hidden('new_lawyer_office_id', '', array('id' => 'new_lawyer_office_id')) !!}

                            <div class="form-group{{ $errors->has('new_lawyer_office_name') ? ' has-error' : '' }}">
                                {!! Form::label('new_lawyer_office_name', 'Nom de l\'Étude', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('new_lawyer_office_name', null, array('class' => 'form-control', 'id' => 'new_lawyer_office_name')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_lawyer_office_street') ? ' has-error' : '' }}">
                                {!! Form::label('new_lawyer_office_street', 'Rue et numéro', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('new_lawyer_office_street', Input::old('new_lawyer_office_street'), array('class' => 'form-control', 'id' => 'new_lawyer_office_street')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_lawyer_office_city') ? ' has-error' : '' }}">
                                {!! Form::label('new_lawyer_office_city', 'Numéro postal et localité', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('new_lawyer_office_city', Input::old('new_lawyer_office_city'), array('class' => 'form-control', 'id' => 'new_lawyer_office_city')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_phone_office') ? ' has-error' : '' }}">
                                {!! Form::label('new_phone_office', 'Numéro de téléphone prof.', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('new_phone_office', Input::old('new_phone_office'), array('class' => 'form-control', 'id' => 'new_lawyer_office_phone')) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_fax_office') ? ' has-error' : '' }}">
                                {!! Form::label('new_fax_office', 'Numéro de fax prof.', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('new_fax_office', Input::old('new_fax_office'), array('class' => 'form-control', 'id' => 'new_lawyer_office_fax')) !!}
                                </div>
                            </div>
                            <br />
                            <div class="text-center">
                                {!! Form::submit('Modifier les informations de l\'Étude', array('class'=>'btn btn-primary')) !!}&nbsp;
                            </div>
                        {!! Form::close() !!}
                        <br />
                    </div><!-- /#updateLawyerOfficeForm -->
                    <br />
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
            
            <br />
            <hr>
            <div id="password"></div>
            <br /><br />

            <div class="row">
                <div class="col-md-8 col-md-offset-2 form-border">
                    <br />
                    <h4 class="text-center">Modifier mon mot de passe</h4>
                        <br />
                        {!! Form::open(array('route' => ['lawyer.changePassword', $lawyer->id], 'method' => 'POST', 'id' => 'form_password', 'class' => 'form-horizontal')) !!}

                        <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                            {!! Form::label('old_password', 'Mot de passe actuel', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('old_password', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                            {!! Form::label('new_password', 'Nouveau mot de passe', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('new_password', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('new_password_confirmation', 'Confirmation nouveau mot de passe', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('new_password_confirmation', array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        <div class="text-center">
                            {!! Form::submit('Changer mot de passe', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!}
                    <br />
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection

@section('scripts')
    <!-- jQuery Mask -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> --}}
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // Apply mask to phone numbers
            $('#phone_mobile').mask('(000)-000-00-00');
            $('#phone_office').mask('(000)-000-00-00');
            $('#fax_office').mask('(000)-000-00-00');
            $('#new_lawyer_office_phone').mask('(000)-000-00-00');
            $('#new_lawyer_office_fax').mask('(000)-000-00-00');

            // Reopen form in case of validation errors
            function getUrlParams()
            {
                let vars = [], hash;
                let hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++)
                {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }
            let showAddForm = getUrlParams()["showAddForm"];
            let showUpdateForm = getUrlParams()["showUpdateForm"];

            if (showAddForm == 1) {
                $('#addNewLawyerOfficeForm').removeClass('hidden');
            }
            if (showUpdateForm ==1) {
                $('#updateLawyerOfficeForm').removeClass('hidden');
            }

            // Toggle addNewLawyerOffice form
            $('#addNewLawyerOffice').click(function() {
                $('#addNewLawyerOfficeForm').stop(true, true).effect("highlight", {color: '#fff'}, 0);
                setTimeout(function() {
                    $('#addNewLawyerOfficeForm').effect("highlight", {color: 'var(--primary-color)'}, 3000);
                    $('#updateLawyerOfficeForm').addClass('hidden');
                    $('#addNewLawyerOfficeForm').toggleClass('hidden');
                }, 300);
            });

            // Toggle updateLawyerOffice form
            $('#updateLawyerOffice').click(function() {
                $('#updateLawyerOfficeForm').stop(true, true).effect("highlight", {color: '#fff'}, 0);
                setTimeout(function() {
                    $('#updateLawyerOfficeForm').effect("highlight", {color: 'var(--primary-color)'}, 3000);
                    $('#addNewLawyerOfficeForm').addClass('hidden');
                    $('#updateLawyerOfficeForm').toggleClass('hidden');
                }, 300);
                fetchLawyerOfficeData();
            });

            // Fetch asynchronously office data from DB
            function fetchLawyerOfficeData () {
                var lawyer_office_id = $("#lawyer_office_select").val();
                var lawyer_id = $("input[name = id]").val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: "{{ URL::route('lawyer.getLawyerOfficeData', ['id' => 1]) }}",
                    data: {
                        lawyer_office_id: lawyer_office_id,
                    },
                    success: function(data) {
                        console.log('success');
                        $('#new_lawyer_office_id').val(data['id']);
                        $('#new_lawyer_office_name').val(data['name']);
                        $('#new_lawyer_office_street').val(data['street']);
                        $('#new_lawyer_office_city').val(data['city']);
                        $('#new_lawyer_office_phone').val(data['phone_office']);
                        $('#new_lawyer_office_fax').val(data['fax_office']);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                        toastr.error('Erreur dans la récupération des données sur l\'Étude', 'Erreur');
                    }
                });
            }

            $('#lawyer_office_select').on('change', function() {
                // Hide change office information in case there is no office selected
                console.log($("#lawyer_office_select").val());
                if ($("#lawyer_office_select").val() == '') {
                    $("#updateLawyerOffice").addClass('hidden')
                } else {
                    $("#updateLawyerOffice").removeClass('hidden')
                    fetchLawyerOfficeData();
                }
            });

            $('#lawyer_offices_select').on('change', function() {
                let lawyer_office_id = this.value;
            });
        });
    </script>
@endsection