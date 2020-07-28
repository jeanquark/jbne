@if((sizeof($files) > 0) || (sizeof($directories) > 0))

<div class="row">

  @foreach($items as $item)
  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 img-row">
    <?php $item_name = $item->name; ?>
    <?php $thumb_src = $item->thumb; ?>
    <?php $item_path = $item->is_file ? $item->url : $item->path; ?>

    <div class="square clickable {{ $item->is_file ? 'file' : 'folder'}}-item" data-id="{{ $item_path }}">
      @if($thumb_src)
      <img src="{{ $thumb_src }}">
      @else
      <i class="fa {{ $item->icon }} fa-5x"></i>
      @endif
    </div>

    <div class="caption text-center">
      <div class="btn-group">
        @if (Auth::check())
          <button type="button" data-id="{{ $item_path }}" class="item_name btn btn-default btn-xs {{ $item->is_file ? 'file' : 'folder'}}-item">
            {{ $item_name }}
          </button>
          <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false" style="height: 22px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
        @else
          <button type="button" data-id="{{ $item_path }}" class="item_name btn btn-default btn-xs {{ $item->is_file ? 'file' : 'folder'}}-item" style="width: 100%;">
            {{ $item_name }}
          </button>
        @endif
        @if (Auth::check())
          <ul class="dropdown-menu" role="menu" style="padding: 0px 0px;">
            <li>
              <a href="javascript:rename('{{ $item_name }}')"><i class="fa fa-edit fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-rename') }}</a>
            </li>
            @if($item->is_file)
              <li><a href="javascript:download('{{ $item_name }}')" onClick="onClick('{{ basename($item->url) }}')"><i class="fa fa-download fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-download') }}</a></li>
              <li class="divider"></li>
              @if($thumb_src)
                <li><a href="javascript:fileView('{{ $item_path }}', '{{ $item->updated }}')"><i class="fa fa-image fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-view') }}</a></li>
                <li><a href="javascript:resizeImage('{{ $item_name }}')"><i class="fa fa-arrows fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-resize') }}</a></li>
                <li><a href="javascript:cropImage('{{ $item_name }}')"><i class="fa fa-crop fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-crop') }}</a></li>
                <li class="divider"></li>
              @endif
            @endif
            <li><a href="javascript:trash('{{ $item_name }}')"><i class="fa fa-trash fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-delete') }}</a></li>
          </ul>
        @else
          @if($item->is_file)
            <ul class="dropdown-menu" role="menu">
              <li><a href="javascript:download('{{ $item_name }}')" onClick="onClick('{{ basename($item->url) }}')"><i class="fa fa-download fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-download') }}</a></li>
            </ul>
          @endif
        @endif
      </div>
    </div>

  </div>
  @endforeach

</div>

@else
<p>{{ Lang::get('laravel-filemanager::lfm.message-empty') }}</p>
@endif
