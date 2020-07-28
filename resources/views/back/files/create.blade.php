@extends('layouts.layoutBack')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-file-text"></i> Ajouter un document partagé
            </li>
        </ol>
        <ul class="nav navbar-nav">
            <li><a href="{{ route('back.files.index') }}">Voir toutes les documents partagés</a></li>
        </ul>
    </div>

    <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3">
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-file-pdf-o"></i> Choisir
                    </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>
    </div>
    
    <!-- Display content of files folder -->
    {{-- {!! Storage::disk('public')->files() !!} --}}

@endsection

@section('scripts')
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script> --}}

    <script>
        var route_prefix = "{{ url(config('lfm.prefix')) }}";
    </script>
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
    </script>
    <script>
        $('#lfm').filemanager('files', {prefix: route_prefix});
    </script>
   
@endsection