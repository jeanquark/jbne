@extends('layouts.layoutBack')

@section('css')
	<!-- Bootstrap-select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

	<!-- noUiSlider -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.css" rel="stylesheet">
	<style>
        .noUi-connect {
        	background: #337ab7;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-tasks"></i>  <a href="{{ route('back.index') }}">Tâches</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Editer {{ $task->name }}</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

        	{!! Form::model($task, array('route' => array('back.tasks.update', $task->id), 'method' => 'PUT', 'id' => 'form_task')) !!}

                <div class="form-group"> 
                	{!! Form::label('description', 'Description de la tâche:') !!}
                	<div class="form-line">	
                		{!! Form::text('description', Input::old('description'), array('class' => 'form-control')) !!}
                	</div>
                </div>

                <div class="form-group">
				    {!! Form::label('members', 'Responsable(s)') !!}
				    {!! Form::select('responsables[]', $responsables, 
				        $task->members->pluck('id')->toArray(), ['class' => 'form-control show-tick', 'multiple' => 'multiple']) !!}
				</div>

                <div class="form-group">
                    <label>Statut:</label><br />
                    <select name="status_id" class="form-control">
                        <option value="" selected>Veuillez choisir</option>
                        @foreach ($status as $s)
                            @if ($s->id == $task->status_id)
                                <option value="{{ $s->id }}" selected>{{ $task->status->name }}</option>
                            @else
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- <div class="form-group">
                	{!! Form::label('statut', 'Statut') !!}
                    {!! Form::select('statut', $status, Null, ['class' => 'form-control show-tick']) !!}
                </div> --}}

				<div class="form-group">
                    {!! Form::label('progress', 'Progrès') !!}
                    <div id="nouislider"></div>
                    <input type="text" class="js-nouislider-value hidden" name="progress" readonly />
                    <h4 class="js-nouislider-value text-center" name="progress"></h4>
                </div>
				
				<div class="text-center">
                	{!! Form::submit('Editer la tâche', array('class'=>'btn btn-primary')) !!}
                	<a href="{{ route('back.index') }}" class="btn btn-default">Annuler</a>
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

	<!-- noUiSlider -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.js"></script>
	<script>
		$(function () {
			var init = "<?php echo $task->progress; ?>";
		    var sliderBasic = document.getElementById('nouislider');
		    noUiSlider.create(sliderBasic, {
		        start: init,
		        connect: 'lower',
		        step: 10,
		        range: {
		            'min': [0],
		            'max': [100]
		        }
		    });
		    getNoUISliderValue(sliderBasic, true);
		});

		//Get noUISlider Value and write on
		function getNoUISliderValue(slider, percentage) {
		    slider.noUiSlider.on('update', function () {
		        var val = slider.noUiSlider.get();
		        if (percentage) {
		            val = parseInt(val);
		        }
		        $(slider).parent().find('h4.js-nouislider-value').text(val + '%');
		        $(slider).parent().find('input.js-nouislider-value').val(val);
		    });
		}
    </script>
@endsection