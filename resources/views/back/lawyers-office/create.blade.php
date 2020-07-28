@extends('layouts.layoutBack')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-building"></i>  <a href="{{ route('back.lawyers-office.index') }}">Études d'avocat</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Créer une nouvelle Étude</h2>
            {!! Form::open(array('route' => 'back.lawyers-office.store', 'method' => 'POST', 'id' => 'form_lawyers_office')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nom:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('street', 'Rue et numéro:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('street', Input::old('street'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('city', 'Numéro postal et localité:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('city', Input::old('city'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('phone_office', 'Numéro de téléphone:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('phone_office', Input::old('phone_office'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fax_office', 'Numéro de fax:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('fax_office', Input::old('fax_office'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                {!! Form::submit('Ajouter cette Étude', array('class'=>'btn btn-primary')) !!}
                <a href="{{ route('back.lawyers-office.index') }}" class="btn btn-default">Annuler</a>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')
    <!-- jQuery Mask -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> --}}
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
        // Apply mask to phone numbers
        $('#phone_office').mask('(000)-000-00-00');
        $('#fax_office').mask('(000)-000-00-00');
    </script>
@endsection