@extends('layouts.layoutBack')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-key"></i>  <a href="{{ route('back.permissions.index') }}">Permissions</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Créer une nouvelle permission</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {!! Form::open(array('route' => 'back.permissions.store', 'method' => 'POST', 'id' => 'form_permission')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:', array('class' => 'form-label')) !!}
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

                {!! Form::submit('Ajouter cette permission', array('class'=>'btn btn-primary')) !!}&nbsp;
                <a href="{{ route('back.permissions.index') }}" class="btn btn-default">Annuler</a>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')
    
@endsection