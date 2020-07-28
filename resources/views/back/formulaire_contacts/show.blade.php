@extends('layouts.layoutBack')

@section('css')

@endsection

@section('content')    
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-comments"></i><a href="{{ route('back.formulaire-contacts.index') }}"> Messages</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Détails du rôle
                </div>

                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Champ:</th>
                                    <th>Valeur:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td>{{ $contact->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $contact->nom }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Prénom</th>
                                    <td>{{ $contact->prenom }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Message</th>
                                    <td>{{ $contact->message }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lu?</th>
                                    <td>
                                    	@if ($contact->is_read)
                                            Oui
                                        @else 
                                            Non
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de création</th>
                                    <td>{{ $contact->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière modification</th>
                                    <td>{{ $contact->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.dataTable_wrapper -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row <-->
@endsection

@section('scripts')

@endsection