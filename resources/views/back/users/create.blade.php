@extends('layouts.layoutBack')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('back.users.index') }}">Utilisateurs</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Créer un nouvel utilisateur</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
            {!! Form::open(array('route' => 'back.users.store', 'method' => 'POST', 'files' => true, 'id' => 'form_user')) !!}
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

                {!! Form::submit('Ajouter cet utilisateur', array('class'=>'btn btn-primary')) !!}
                <a href="{{ route('back.users.index') }}" class="btn btn-default">Annuler</a>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')
    <script>
        
    </script>

@endsection