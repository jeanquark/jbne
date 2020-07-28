@extends('layouts.layoutFront')

@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<style>
		body {
            background-color: #9f1853;
        }        
        .btn-link {
            color: #918f90;
        }
        .btn-link:hover {
        	color: #9f1853;
        }
    </style>
@endsection

@section('content')
	<div id="content">
		@include('_forms.inscription-membres')
	</div>
@endsection

@section('scripts')
	<script>
		/*$('.btn-primary').click(function() {
			console.log('click!');
			$(this).prop('disabled', true);
		});*/
	</script>
@endsection