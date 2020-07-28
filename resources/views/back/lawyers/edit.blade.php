@extends('layouts.layoutBack')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-user-tie"></i>  <a href="{{ route('back.lawyers.index') }}">Tous les avocats</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Editer Maître {{ $lawyer->firstname }} {{ $lawyer->lastname }}</h2>
            {!! Form::model($lawyer, array('route' => array('back.lawyers.update', $lawyer->id), 'method' => 'PUT', 'id' => 'form_lawyer')) !!}
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        {!! Form::label('lastname', 'Nom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('firstname', 'Prénom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('username', 'Nom d\'utilisateur (Prudence: identifiant de connexion)', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('username', Input::old('username'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('email', Input::old('email'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('street', 'Rue et numéro:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('street', Input::old('street'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('city', 'Ville:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('city', Input::old('city'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone_mobile', 'Téléphone mobile:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('phone_mobile', Input::old('phone_mobile'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone_office', 'Téléphone prof.:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('phone_office', Input::old('phone_office'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fax_office', 'Fax:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('fax_office', Input::old('fax_office'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('languages', 'Langues:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('languages', Input::old('languages'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('is_verified', 'Compte vérifié?', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::checkbox('is_verified', null, null, array('id' => $lawyer->id, 'class' => "filled-in")) !!}
                            {{-- <input type="checkbox" class="filled-in" id="{{$lawyer->id}}" @if ($lawyer->is_confirmed) checked @endif> --}}
                        </div>
                    </div>







                </div>
                
                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer cet avocat', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.lawyers.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
             {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row clearfix -->
@endsection

@section('scripts')
    <!-- jQuery Mask -->
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#phone_mobile').mask('(000)-000-00-00');
            $('#phone_office').mask('(000)-000-00-00');
            $('#fax_office').mask('(000)-000-00-00');
        });
    </script>
@endsection