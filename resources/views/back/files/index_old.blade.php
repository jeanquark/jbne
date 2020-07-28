@extends('layouts.layoutBack')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" rel="stylesheet" type="text/css">

    <style>
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-file-text"></i> Documents partagés
        </li>
    </ol>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('back.files.index') }}">Voir toutes les documents partagés</a></li>
        <li><a href="{{ route('back.files.create') }}">Ajouter un document</a></li>
    </ul>

    {{-- <div class="col-md-6 col-md-offset-3">
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-file-pdf-o"></i> Choisir
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="filepath">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div> --}}
    
    <!-- Display content of files folder -->
    {{-- {!! Storage::disk('public')->files() !!} --}}
    <div class="col-md-6 col-md-offset-3">
      <div id="tree"></div>
    </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script>
        var data = [
          {
            text: "Annee 2014",
            nodes: [
              {
                text: "Examens 2014",
                nodes: [
                  {
                    text: "Ecrit <a href='#'>download</a>"
                  },
                  {
                    text: "Oral"
                  }
                ]
              },
              {
                text: "Annexes 2014",
                nodes: [
                  {
                    text: "Annexes A <a href='#'>download</a>"
                  },
                  {
                    text: "Annexes B"
                  }
                ]
              }
            ]
          },
          {
            text: "Annee 2015",
            nodes: [
              {
                text: "Examens 2015",
                nodes: [
                  {
                    text: "Ecrit <a href='#'>download</a>"
                  },
                  {
                    text: "Oral"
                  }
                ]
              },
              {
                text: "Annexes 2015"
              }
            ]
          },
          {
            text: "Annee 2016"
          },
          {
            text: "Barreau 2016"
          },
          {
            text: "Divers"
          }
        ];
    </script>

    <script>
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>
    <script>
      $(document).ready(function(){
        $.ajax({ 
          url: "getAllFiles",
          type: "POST",
          // dataType: "json",       
          success: function(data) {
            console.log('success');
            console.log(data);
            // $('#treeview').treeview({data: data});
          }   
        }); 
      });
    </script>
    <script>
        function getTree() {
          // Some logic to retrieve, or generate tree structure
          return data;
        }

        $('#tree').treeview({data: getTree()});
    </script>

    
@endsection