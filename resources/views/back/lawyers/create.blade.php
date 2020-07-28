@extends('layouts.layoutBack')

@section('css')
    <style>
        .form-group input[type="checkbox"] {
            display: none;
        }
        .form-group input[type="checkbox"] + .btn-group > label span {
            width: 20px;
        }
        .form-group input[type="checkbox"] + .btn-group > label span:first-child {
            display: none;
        }
        .form-group input[type="checkbox"] + .btn-group > label span:last-child {
            display: inline-block;   
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
            display: inline-block;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
            display: none;   
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label {
            background-color: #449d44;
            border-color: #449d44;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label.active {
            background-color: #c6e1c6;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-user-tie"></i>  <a href="{{ route('back.lawyers.index') }}">Avocats</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Créer un nouvel avocat</h2>
            {{-- @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif --}}
            {!! Form::open(array('route' => 'back.lawyers.store', 'method' => 'POST', 'files' => true, 'id' => 'form_lawyer')) !!}
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
                    {!! Form::label('username', 'Nom d\'utilisateur', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('username', Input::old('username'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'E-mail:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Mot de passe:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::password('password', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmation mot de passe:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                    </div>
                </div>
                
                <div class="text-center">
                    {!! Form::submit('Ajouter cet avocat', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('back.lawyers.index') }}" class="btn btn-default">Annuler</a>
                </div>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
@endsection

@section('scripts')

@endsection