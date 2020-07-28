@extends('layouts.layoutBack')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row clearfix">
        <ol class="breadcrumb">
        <li>
            <i class="fa fa-id-badge"></i>  <a href="{{ route('back.roles.index') }}">Roles</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Editer {{ $role->name }}</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
            {!! Form::model($role, array('route' => array('back.roles.update', $role->id), 'method' => 'PUT', 'id' => 'form_role')) !!}
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        {!! Form::label('name', 'Nom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('name', $role->name, array('class' => 'form-control')) !!}
                        </div>
                    </div>
            
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('slug', $role->slug, array('class' => 'form-control')) !!}
                        </div>
                    </div>
            
                    <div class="form-group">
                        {!! Form::label('description', 'Description:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('description', $role->description, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('permissions', 'Permissions:') !!} <br />
                        {!! Form::select('permissions[]', $permissions, $role->permissions->pluck('id'), array('class' => 'form-control selectpicker', 'multiple' => true)) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer ce rôle', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.roles.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@endsection