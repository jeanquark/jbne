@extends('layouts.layoutLawyers')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><i class="fa fa-calendar"></i> <a href="{{ route('lawyer.permanences.index') }}">Mes disponibilités</a></li>
            <li class="active"><i class="fa fa-black-tie"></i> Mes informations</li>
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
                            <td>Nom d'utilisateur</td>
                            <td>{{ $lawyer->username }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
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
                            <td id="phone_mobile">{{ $lawyer->phone_mobile }}</td>
                        </tr>
                        <tr>
                            <td>Langues</td>
                            <td>{{ $lawyer->languages }}</td>
                        </tr>
                        <tr>
                            <td>Nom de l'Étude</td>
                            <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->name }} @endif</td>
                        </tr>
                        <tr>
                            <td>Adresse de l'Étude</td>
                            <td>@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->street }}, {{ $lawyer->lawyerOffice->city }} @endif</td>
                        </tr>
                        <tr>
                            <td>Téléphone de l'Étude</td>
                            <td id="phone_office">@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->phone_office }} @endif</td>
                        </tr>
                        <tr>
                            <td>Fax de l'Étude</td>
                            <td id="fax_office">@if ($lawyer->lawyerOffice) {{ $lawyer->lawyerOffice->fax_office }} @endif</td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center">
                    <a href="{{ route('lawyer.edit', ['id'=>$lawyer->id, 'showForm'=>false]) }}" class="btn btn-primary">Editer</a>
                </div>
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- ./container -->
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#phone_mobile').mask('(000)-000-00-00');
            $('#phone_office').mask('(000)-000-00-00');
            $('#fax_office').mask('(000)-000-00-00');
        });
    </script>
@endsection