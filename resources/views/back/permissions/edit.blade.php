@extends('layouts.layoutBack')

@section('css')
    <style>
        /*.btn:not(.btn-link):not(.btn-circle) {
            box-shadow: 0 0px 0px rgba(0,0,0,.16), 0 0px 0px rgba(0,0,0,.12);
        }
        [type="checkbox"].filled-in:checked + label:after {
            border: 2px solid #8BC34A;
            background-color: #8BC34A;
        }
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 500px;
        }*/
    </style>
@endsection

@section('content')
    <div class="row clearfix">
        <ol class="breadcrumb">
        <li>
            <i class="fa fa-key"></i>  <a href="{{ route('back.permissions.index') }}">Permissions</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Editer {{ $permission->name }}</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
            {!! Form::model($permission, array('route' => array('back.permissions.update', $permission->id), 'method' => 'PUT', 'id' => 'form_permission')) !!}
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        {!! Form::label('name', 'Nom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('name', $permission->name, array('class' => 'form-control')) !!}
                        </div>
                    </div>
            
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('slug', $permission->slug, array('class' => 'form-control')) !!}
                        </div>
                    </div>
            
                    <div class="form-group">
                        {!! Form::label('description', 'Description:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('description', $permission->description, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer cette permission', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.permissions.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
    
@endsection

@section('scripts')

@endsection