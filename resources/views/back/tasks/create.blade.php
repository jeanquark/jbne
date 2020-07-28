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
            <i class="fa fa-plus-square"></i> Ajouter
        </li>
    </ol>

	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="">Ajouter une nouvelle tâche</h2>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif

            {!! Form::open(array('route' => 'back.tasks.store', 'method' => 'POST', 'id' => 'form_task')) !!}
                <div class="form-group"> 
                	{!! Form::label('description', 'Description de la tâche:') !!}
                	<div class="form-line">	
                		{!! Form::text('description', Input::old('description'), array('class' => 'form-control')) !!}
                	</div>
                </div>

                <div class="form-group">
					{!! Form::label('members', 'Responsable(s)') !!}
                    {!! Form::select('members[]', $responsables, null, ['class' => 'form-control show-tick', 'multiple' => 'multiple']) !!}

                </div>

                <div class="form-group">
                	{!! Form::label('statut', 'Statut') !!}
                    {!! Form::select('statut', $status, null, ['class' => 'form-control show-tick']) !!}
                </div>

				<div class="form-group">
                    {!! Form::label('progress', 'Progrès') !!}
                    <div id="nouislider"></div>
                    <input type="text" class="js-nouislider-value hidden" name="progress" readonly />
                    <h4 class="js-nouislider-value text-center" name="progress"></h4>
                </div>


				
				<div class="text-center">
					{!! Form::submit('Ajouter cette tâche', array('class'=>'btn btn-primary')) !!}&nbsp;
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
		    var sliderBasic = document.getElementById('nouislider');
		    noUiSlider.create(sliderBasic, {
		        start: [0],
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