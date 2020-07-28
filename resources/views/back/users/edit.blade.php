@extends('layouts.layoutBack')

@section('css')
    <!-- Bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row clearfix">
        <ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('back.users.index') }}">Utilisateurs</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Editer l'utilisateur {{ $user->firstname }} {{ $user->lastname }}</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
            {!! Form::model($user, array('route' => array('back.users.update', $user->id), 'method' => 'PUT', 'id' => 'form_page')) !!}
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
                        {!! Form::select('roles', $roles, $user->roles->pluck('id'), array('class' => 'form-control show-tick')) !!}
                    </div>

                </div>
                
                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer cet utilisateur', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.users.index') }}" class="btn btn-default">Annuler</a>
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