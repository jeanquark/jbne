@extends('layouts.layoutPermanences')

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
        	<li><a href="{{ route('permanences.index') }}">Mes permanences</a></li>
            <li class="active">Mes informations</li>
        </ul>

        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
		        <table class="table table-striped table-hover">
		        	<thead>
		        		<tr>
		        			<th>Champ</th>
		        			<th>Valeur</th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<tr>
		        			<td>Email</td>
		        			<td>{{ $lawyer->email }}</td>
		        		</tr>
		        		<tr>
		        			<td>Nom</td>
		        			<td>{{ $lawyer->lastname }}</td>
		        		</tr>
		        		<tr>
		        			<td>Prénom</td>
		        			<td>{{ $lawyer->firstname }}</td>
		        		</tr>
		        		<tr>
		        			<td>Téléphone mobile</td>
		        			<td>{{ $lawyer->phone_mobile }}</td>
		        		</tr>
		        		<tr>
		        			<td>Adresse de l'Étude: rue et numéro</td>
		        			<td>{{ $lawyer->street }}</td>
		        		</tr>
		        		<tr>
		        			<td>Adresse de l'Étude: code postal et ville</td>
		        			<td>{{ $lawyer->city }}</td>
		        		</tr>
		        		<tr>
		        			<td>Téléphone professionel</td>
		        			<td>{{ $lawyer->phone_office }}</td>
		        		</tr>
		        		<tr>
		        			<td>Fax professionel</td>
		        			<td>{{ $lawyer->fax_office }}</td>
		        		</tr>
		        	</tbody>
		        </table>

		        <div class="text-center">
		        	<a href="{{ URL::to('avocat/' . $lawyer->id . '/edit') }}" class="btn btn-primary">Editer</a>
		        </div>
		    </div><!-- /.col-md-6 -->
		</div><!-- /.row -->
    </div><!-- ./container -->
@endsection

@section('scripts')
    
@endsection