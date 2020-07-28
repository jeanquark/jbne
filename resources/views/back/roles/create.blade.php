@extends('layouts.layoutBack')

@section('css')
    <style>
        #page-wrapper {
            /*height:100vh;*/
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-id-badge"></i>  <a href="{{ route('back.roles.index') }}">Rôles</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            <h2 class="">Créer un nouveau rôle</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
            {!! Form::open(array('route' => 'back.roles.store', 'method' => 'POST', 'id' => 'form_role')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nom:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('slug', Input::old('slug'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description:', array('class' => 'form-label')) !!}
                    <div class="form-line">
                        {!! Form::text('description', Input::old('description'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                {!! Form::submit('Ajouter ce role', array('class'=>'btn btn-primary')) !!}&nbsp;
                <a href="{{ route('back.roles.index') }}" class="btn btn-default">Annuler</a>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
@endsection

@section('scripts')
    
@endsection