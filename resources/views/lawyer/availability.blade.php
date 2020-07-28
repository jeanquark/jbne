@extends('layouts.layoutLawyers')

@section('css')

@endsection

@section('content')
	<div class="container">
        <ul class="breadcrumb">
            <li class="active"><i class="fa fa-briefcase"></i> Avocats de la 1<sup>ère</sup> heure</li>
        </ul>
        
        <h5 class="text-center">Liste des avocats disponibles:</h5>
        @if (!$permanences->isEmpty())
            <h3 class="text-center">{{ $week }}</h3>
            
            <p class="text-center"><b>Avocat retenu:</b></p>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Télépone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- {{ $permanences->first() }} --}}
                            <td>{{ $permanences->first()->lawyer->firstname }}</td>
                            <td>{{ $permanences->first()->lawyer->lastname }}</td>
                            <td>{{ $permanences->first()->lawyer->email }}</td>
                            <td>{{ $permanences->first()->lawyer->phone_mobile }}</td>
                            <td>{{ $permanences->first()->lawyer->phone_office }}</td>
                            <td>{{ $permanences->first()->lawyer->city }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.panel-body -->
            
            <p class="text-center"><b>Liste de tous les avocats de permanence cette semaine là:</b></p>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Téléphone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permanences as $key=>$permanence)
                            <tr>
                                <td>{{ $permanence->lawyer->firstname }}</td>
                                <td>{{ $permanence->lawyer->lastname }}</td>
                                <td>{{ $permanence->lawyer->email }}</td>
                                <td>{{ $permanence->lawyer->phone_mobile }}</td>
                                <td>{{ $permanence->lawyer->phone_office }}</td>
                                <td>{{ $permanence->lawyer->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.table-body -->
            <br /><hr><br />
        @else
            <p class="text-center">Aucun avocat de permanence trouvé pour la <b>{{ $week }}</b>. Veuillez nous <a href="{{ url('/#contact') }}">contacter</a> si vous cherchez à entrer en contact avec un avocat de permanence et que ce message apparaît.</p>
        @endif


        {{--@if (!$pastWeekPermanences->isEmpty())
            <h3>{{ $pastWeekCalendar }}</h3>
            
            <p class="text-center"><b>Avocat retenu:</b></p>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Télépone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pastWeekPermanences[0]->lawyer->firstname }}</td>
                            <td>{{ $pastWeekPermanences[0]->lawyer->lastname }}</td>
                            <td>{{ $pastWeekPermanences[0]->lawyer->email }}</td>
                            <td>{{ $pastWeekPermanences[0]->lawyer->phone_mobile }}</td>
                            <td>{{ $pastWeekPermanences[0]->lawyer->phone_office }}</td>
                            <td>{{ $pastWeekPermanences[0]->lawyer->city }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.panel-body -->
            
            <p class="text-center"><b>Liste de tous les avocats de permanence cette semaine là:</b></p>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Téléphone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pastWeekPermanences as $key=>$permanence)
                            <tr>
                                <td>{{ $permanence->lawyer->firstname }}</td>
                                <td>{{ $permanence->lawyer->lastname }}</td>
                                <td>{{ $permanence->lawyer->email }}</td>
                                <td>{{ $permanence->lawyer->phone_mobile }}</td>
                                <td>{{ $permanence->lawyer->phone_office }}</td>
                                <td>{{ $permanence->lawyer->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.table-body -->
            <br /><hr><br />
        @endif


        @if (!$currentWeekPermanences->isEmpty())
            <h3 class="text-center">{{ $currentWeekCalendar }}</h3>
            
            <p class="text-center"><b>Avocat retenu:</b></p>
            <div class="panel-body">
            	<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>Nom</th>
            				<th>Prénom</th>
            				<th>E-mail</th>
            				<th>Téléphone mobile</th>
            				<th>Télépone prof.</th>
            				<th>Ville</th>
            			</tr>
            		</thead>
            		<tbody>
            			<tr>
            				<td>{{ $currentWeekPermanences[0]->lawyer->firstname }}</td>
            				<td>{{ $currentWeekPermanences[0]->lawyer->lastname }}</td>
            				<td>{{ $currentWeekPermanences[0]->lawyer->email }}</td>
            				<td>{{ $currentWeekPermanences[0]->lawyer->phone_mobile }}</td>
            				<td>{{ $currentWeekPermanences[0]->lawyer->phone_office }}</td>
            				<td>{{ $currentWeekPermanences[0]->lawyer->city }}</td>
            			</tr>
            		</tbody>
            	</table>
            </div><!-- /.panel-body -->
    		
            <p class="text-center"><b>Liste de tous les avocats de permanence cette semaine là:</b></p>
    		<div class="panel-body">
    			<table class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>Nom</th>
    						<th>Prénom</th>
    						<th>E-mail</th>
    						<th>Téléphone mobile</th>
    						<th>Téléphone prof.</th>
    						<th>Ville</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($currentWeekPermanences as $key=>$permanence)
    						<tr>
    							<td>{{ $permanence->lawyer->firstname }}</td>
    							<td>{{ $permanence->lawyer->lastname }}</td>
    							<td>{{ $permanence->lawyer->email }}</td>
    							<td>{{ $permanence->lawyer->phone_mobile }}</td>
    							<td>{{ $permanence->lawyer->phone_office }}</td>
    							<td>{{ $permanence->lawyer->city }}</td>
    						</tr>
    					@endforeach
    				</tbody>
    			</table>
            </div><!-- /.table-body -->
            <br /><hr><br />
        @endif


        @if (!$nextWeekPermanences->isEmpty())
            <h3 class="text-center">{{ $nextWeekCalendar }}</h3>
            
            <p class="text-center"><b>Avocat retenu:</b></p>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Télépone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $nextWeekPermanences[0]->lawyer->firstname }}</td>
                            <td>{{ $nextWeekPermanences[0]->lawyer->lastname }}</td>
                            <td>{{ $nextWeekPermanences[0]->lawyer->email }}</td>
                            <td>{{ $nextWeekPermanences[0]->lawyer->phone_mobile }}</td>
                            <td>{{ $nextWeekPermanences[0]->lawyer->phone_office }}</td>
                            <td>{{ $nextWeekPermanences[0]->lawyer->city }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.panel-body -->
            
            <p class="text-center"><b>Liste de tous les avocats de permanence cette semaine là:</b></p>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone mobile</th>
                            <th>Téléphone prof.</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nextWeekPermanences as $key=>$permanence)
                            <tr>
                                <td>{{ $permanence->lawyer->firstname }}</td>
                                <td>{{ $permanence->lawyer->lastname }}</td>
                                <td>{{ $permanence->lawyer->email }}</td>
                                <td>{{ $permanence->lawyer->phone_mobile }}</td>
                                <td>{{ $permanence->lawyer->phone_office }}</td>
                                <td>{{ $permanence->lawyer->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.table-body -->
            <br /><hr><br />
        @endif --}}
    </div><!-- /.container -->
@endsection

@section('scripts')

@endsection