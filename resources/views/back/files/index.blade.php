@extends('layouts.layoutBack')

@section('css')
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
    <style>
      /*{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}*/
    </style>
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/mfb.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css">

    <style>
      #fab a:hover, #fab a:focus{
        color: white;
      }

      .item_name {
        width: 120px;
        overflow:hidden;
        white-space:nowrap;
        text-overflow: ellipsis;
      }

      .clickable {
        cursor: pointer;
      }

      .img-preview {
        background-color: #f7f7f7;
        overflow: hidden;
        width: 100%;
        text-align: center;
        height: 200px;
      }

      .hidden {
        display: none;
      }

      .square {
        width: 100%;
        padding-bottom: 100%;
        position: relative;
        border: 1px solid rgb(221, 221, 221);
        border-radius: 3px;
        // max-width: 210px;
        max-height: 210px;
      }
      .visible-xs .square {
        width: 60px;
      }
      .square > img {
        padding: 5px;
        position: absolute;
        max-width: 100%;
        max-height: 100%;
        margin: 0 auto;
        display: inline-block;
        vertical-align: middle;
      }
      .square > i {
        font-size: 80px;
        padding: 5px;
        position: absolute;
        top: calc(50% - 40px);
        left: calc(50% - 40px);
      }
      .visible-xs .square > i {
        font-size: 50px;
        padding: 0px auto;
        padding-top: 5px;
        top: calc(50% - 25px);
        left: calc(50% - 25px);
      }

      .caption {
        margin-top: 10px;
        margin-bottom: 20px;
      }
      .caption > .btn-group {
        width: 100%;
      }
      .caption > .btn-group > .item_name {
        width: calc(100% - 25px);
      }
      .caption > .btn-group > .dropdown-toggle {
        width: 25px;
      }
    </style>
@endsection

@section('content')
  <ol class="breadcrumb">
    <li class="active">
      <i class="fa fa-file-pdf-o"></i> Gestion des fichiers partagés
    </li>
  </ol>

  @if(Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Remarque: </strong>Pour ajouter de nouveaux fichiers en partage, cliquez sur le bouton + en bas à droite de l'écran.
  </div>

  <div class="alert alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention: </strong>L'ensemble des fichiers ajoutés peuvent être téléchargés par les membres.
  </div>

  <div class="col-md-12" id="">
    {{-- <div class="panel panel-primary hidden-xs">
      <div class="panel-heading">
        <h1 class="panel-title">{{ trans('laravel-filemanager::lfm.title-panel') }}</h1>
      </div>
    </div> --}}
    <div class="row">
      <div class="col-sm-2 hidden-xs">
        <div id="tree"></div>
      </div>

      <div class="col-sm-10 col-xs-12" id="main">
        <nav class="navbar navbar-default" id="nav">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-buttons">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand clickable hide" id="to-previous">
              <i class="fa fa-arrow-left"></i>
              <span class="hidden-xs">{{ trans('laravel-filemanager::lfm.nav-back') }}</span>
            </a>
            <a class="navbar-brand visible-xs" href="#">{{ trans('laravel-filemanager::lfm.title-panel') }}</a>
          </div>
          <div class="collapse navbar-collapse" id="nav-buttons">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a class="clickable" id="thumbnail-display">
                  <i class="fa fa-th-large"></i>
                  <span>{{ trans('laravel-filemanager::lfm.nav-thumbnails') }}</span>
                </a>
              </li>
              <li>
                <a class="clickable" id="list-display">
                  <i class="fa fa-list"></i>
                  <span>{{ trans('laravel-filemanager::lfm.nav-list') }}</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  {{ trans('laravel-filemanager::lfm.nav-sort') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#" id="list-sort-alphabetic">
                      <i class="fa fa-sort-alpha-asc"></i> {{ trans('laravel-filemanager::lfm.nav-sort-alphabetic') }}
                    </a>
                  </li>
                  <li>
                    <a href="#" id="list-sort-time">
                      <i class="fa fa-sort-amount-asc"></i> {{ trans('laravel-filemanager::lfm.nav-sort-time') }}
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <div class="visible-xs" id="current_dir" style="padding: 5px 15px;background-color: #f8f8f8;color: #5e5e5e;"></div>

        <div id="alerts"></div>

        <div id="content"></div>
      </div>
      @if (Auth::guard('member')->check())
        <ul id="fab">
          <li>
            <a href="#"></a>
            <ul class="hide">
              <li>
                <a href="#" id="add-folder" data-mfb-label="{{ trans('laravel-filemanager::lfm.nav-new') }}">
                  <i class="fa fa-folder"></i>
                </a>
              </li>
              <li>
                <a href="#" id="upload" data-mfb-label="{{ trans('laravel-filemanager::lfm.nav-upload') }}">
                  <i class="fa fa-upload"></i>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      @endif
    </div>
  </div>
  
  <div class="col-md-10 col-md-offset-1">
    <h3 class="text-center">Liste complète des fichiers:</h3>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nom du fichier</th>
          <th>Mis en ligne par</th>
          <th>Chemin</th>
          <th>Nb de clicks</th>
          <th>Date de création</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($files as $key => $file)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $file->name }}</td>
            @if ($file->member)
              <td>{{ $file->member->firstname }}&nbsp;{{ $file->member->lastname }}</td>
            @else
              <td><i>Ce membre a été effacé</i></td>
            @endif
            <td>{{ $file->path }}</td>
            <td>{{ $file->clicks }}</td>
            <td>{{ Date::parse($file->created_at)->format('j F Y') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aia-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">{{ trans('laravel-filemanager::lfm.title-upload') }}</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('unisharp.lfm.upload') }}" role='form' id='uploadForm' name='uploadForm' method='post' enctype='multipart/form-data'>
            <div class="form-group" id="attachment">
              <label for='upload' class='control-label'>{{ trans('laravel-filemanager::lfm.message-choose') }}</label>
              <div class="controls">
                <div class="input-group" style="width: 100%">
                  <input type="file" id="upload" name="upload[]" multiple="multiple">
                </div>
              </div>
            </div>
            <input type='hidden' name='working_dir' id='working_dir'>
            <input type='hidden' name='type' id='type' value='{{ request("type") }}'>
            <input type='hidden' name='_token' value='{{csrf_token()}}'>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-close') }}</button>
          <button type="button" class="btn btn-primary" id="upload-btn">{{ trans('laravel-filemanager::lfm.btn-upload') }}</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <!-- // <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
  <!-- // <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/jquery.form.min.js') }}"></script>
  <script>
    var route_prefix = "{{ url('/') }}";
    var lfm_route = "{{ url(config('lfm.prefix')) }}";
    var lang = {!! json_encode(trans('laravel-filemanager::lfm')) !!};
  </script>
  <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>
  {{-- Use the line below instead of the above if you need to cache the script. --}}
  {{-- <script src="{{ asset('vendor/laravel-filemanager/js/script.js') }}"></script> --}}
  <script>
    $.fn.fab = function () {
      var menu = this;
      menu.addClass('mfb-component--br mfb-zoomin').attr('data-mfb-toggle', 'hover');
      var wrapper = menu.children('li');
      wrapper.addClass('mfb-component__wrap');
      var parent_button = wrapper.children('a');
      parent_button.addClass('mfb-component__button--main')
        .append($('<i>').addClass('mfb-component__main-icon--resting fa fa-plus'))
        .append($('<i>').addClass('mfb-component__main-icon--active fa fa-times'));
      var children_list = wrapper.children('ul');
      children_list.find('a').addClass('mfb-component__button--child');
      children_list.find('i').addClass('mfb-component__child-icon');
      children_list.addClass('mfb-component__list').removeClass('hide');
    };
    $('#fab').fab({
      buttons: [
        {
          icon: 'fa fa-folder',
          label: "{{ trans('laravel-filemanager::lfm.nav-new') }}",
          attrs: {id: 'add-folder'}
        },
        {
          icon: 'fa fa-upload',
          label: "{{ trans('laravel-filemanager::lfm.nav-upload') }}",
          attrs: {id: 'upload'}
        }
      ]
    });
  </script>

  <script>
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
  </script>
  <script>
    // $('#abcde').on('click', function (e) {
    function onClick(fileName) {
      // alert('onClick');
      console.log(fileName);
      // $.ajax({
      //   type: "POST",
      //   url: '/addToDownloadCount',
      //   data: {file_name: fileName},
      //   success: function(data) {
      //     console.log('success');
      //     // console.log(data);
      //   },
      //   error: function(jqXHR, textStatus, errorThrown) {
      //     console.log('error');
      //   }
      // });
    }
  </script>
@endsection