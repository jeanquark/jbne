@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')
    <div class="row clearfix">
        <ol class="breadcrumb">
        <li>
            <i class="fa fa-file-text"></i>  <a href="{{ route('back.content.index') }}">Contenus</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Editer {{ $page->name }}</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {!! Form::model($page, array('route' => array('back.pages.update', $page->id), 'method' => 'PUT', 'id' => 'form_page')) !!}
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        {!! Form::label('nom', 'Nom:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('nom', Input::old('nom'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::text('slug', Input::old('slug'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('content', 'Contenu:', array('class' => 'form-label')) !!}
                        <div class="form-line">
                            {!! Form::textarea('content', Input::old('content'), array('class' => 'form-control donnees')) !!}
                        </div>
                    </div>

                    

                </div>
                
                <div class="col-md-12">
                    <div class="text-center">
                        {!! Form::submit('Editer ce contenu', array('class'=>'btn btn-primary')) !!}
                        <a href="{{ route('back.pages.index') }}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
             {!! Form::close() !!}
        </div><!-- ./col-md-6 -->
    </div><!-- ./row -->
@endsection

@section('scripts')

@endsection