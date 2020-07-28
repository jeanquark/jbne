@extends('layouts.layoutBack')

@section('css')
    <!-- JQuery DataTable -->
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .form-group input[type="checkbox"] {
            display: none;
        }

        .form-group input[type="checkbox"] + .btn-group > label span {
            width: 20px;
        }

        .form-group input[type="checkbox"] + .btn-group > label span:first-child {
            display: none;
        }
        .form-group input[type="checkbox"] + .btn-group > label span:last-child {
            display: inline-block;   
        }

        .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
            display: inline-block;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
            display: none;   
        }
        /*.highlight {
            background-color: red;
        }*/
        .form-group input[type="checkbox"]:checked + .btn-group > label {
            background-color: #449d44;
            border-color: #449d44;
        }
        .form-group input[type="checkbox"]:checked + .btn-group > label.active {
            /*background-color: rgba(68, 157, 68, 0.75);*/
            background-color: #c6e1c6;
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar"></i>  <a href="{{ route('back.permanences-attribution.index') }}">Attribution des permanences</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Ajouter un avocat à la liste des attributions
        </li>
    </ol>

    <div class="col-md-12">
        {{-- {{ $lawyersWithoutAttribution[0] }} --}}
        <h5 class="">Ce tableau liste uniquement les avocats qui ne sont <b>pas encore inscrits</b> au tableau d'attribution des permanences pour le trimestre {{ $quarter }} de l'année {{ $year }}. Ils n'ont de fait encore <b>aucune attribution</b>. En cliquant sur "ajouter", vous pouvez ajouter l'avocat concerné à la liste des attributions de permanences, mais il n'aura aucune attribution pour le moment. Pour effectivement lui attribuer une permanence, il conviendra de modifier les attributions hebdomadaires et faire glisser son nom de la colonne de droite vers la colonne de gauche après avoir cliqué sur le bouton bleu "Editer" de la semaine en question.</h5>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover" id="table_lawyers">
                <thead>
                    <tr class="titlerow">
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Nom d'utilisateur</th>
                        <th>E-mail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lawyersWithoutAttribution as $lawyer)
                        <tr>
                            <td>{{ $lawyer->id }}</td>
                            <td>{{ $lawyer->lastname }}</td>
                            <td>{{ $lawyer->firstname }}</td>
                            <td>{{ $lawyer->username }}</td>
                            <td>{{ $lawyer->email }}</td>
                            <td>
                                {!! Form::open(array('route' => array('back.permanences-attribution.addLawyerToPermanencesAttribution', $year, $quarter, $lawyer->id), 'method' => 'POST', 'id' => 'update_permanence')) !!}
                                    <button class="btn btn-small btn-success" style="margin: 5px;">Ajouter</button>
                                {!! Form::close() !!}
                                {{-- <a class="btn btn-small btn-success" href="{{ route('back.permanences-attribution.addLawyerToPermanencesAttribution', ['quarter' => 2, 'lawyer' => $lawyer->id]) }}" style="margin: 5px;">Ajouter</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.panel-body -->
    </div><!-- ./col-md-12 -->
    
@endsection

@section('scripts')
    <!-- Jquery DataTable Plugin Js -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>    
    <script>
        $('#table_lawyers').DataTable({
            order: [[ 1, "desc" ]],
            columnDefs: [
                { 
                    "targets": [5], 
                    "orderable": false 
                }
            ]
        });
    </script>
@endsection