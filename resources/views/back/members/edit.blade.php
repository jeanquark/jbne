@extends('layouts.layoutBack')

@section('css')
    <!-- Bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('back.members.index') }}">Membres</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Editer le membre {{ $member->firstname }} {{ $member->lastname }}</h2>
            {!! Form::model($member, array('route' => array('back.members.update', $member->id), 'method' => 'PUT', 'id' => 'form_page')) !!}
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
                        {!! Form::label('roles', 'Role') !!} <br />
                        {!! Form::select('roles', $roles, $member->roles->pluck('id'), array('class' => 'form-control show-tick')) !!}
                    </div>

                </div>
                
                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer ce membre', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.members.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
             {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
@endsection

@section('scripts')
    <!-- Bootstrap-select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script>
        $('.show-tick').selectpicker({
            noneSelectedText: 'Veuillez choisir'
        });
    </script>
@endsection