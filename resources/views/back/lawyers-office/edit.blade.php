@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-building"></i>  <a href="{{ route('back.lawyers-office.index') }}">Études d'avocat</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Editer l'Étude d'avocat</h2>
            {!! Form::model($office, array('route' => array('back.lawyers-office.update', $office->id), 'method' => 'PUT', 'id' => 'form_lawyer_office')) !!}
                <div class="col-md-10 col-md-offset-1">
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
                </div>
                
                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer cette Étude d\'avocat', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.lawyers-office.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
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