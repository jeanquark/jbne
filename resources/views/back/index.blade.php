@extends('layouts.layoutBack')

@section('css')
    <style>
        .table>thead>tr>th {
            vertical-align: middle;
            white-space: nowrap;
        }
        .table>tbody>tr>td {
            vertical-align: middle;
        }
        .progress {
            vertical-align: middle;
            margin-bottom: 0px;
        }
    </style>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <img src="{{ asset('images/logo2.png') }}" width="40px" style="vertical-align: top;" /> Jeune Barreau neuchâtelois <small>Administration</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Administration
                </li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <br />
    {{-- <div class=""> --}}
        {{-- <a href="{{ route('back.timeline') }}" class="pull-right">Voir la nouvelle représentation de l'agenda</a> --}}
    {{-- </div> --}}
    <br />
    
    <h3 class="text-center">Liste des tâches:</h3><br />

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-hover dashboard-task-infos">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Tâche</th>
                        <th>Status</th>
                        <th>Responsable(s)</th>
                        <th>Progrès</th>
                        <th>Date de création</th>
                        <th>Dernière modification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $task->description }}</td>
                            <td style="vertical-align: middle;"><span class="label label-{{ $task->status->color }}">{{ $task->status->name }}</span></td>
                            <td>
                                @foreach ($task->members as $member)
                                    {{ $loop->first ? '' : ', ' }}
                                    {{ $member->firstname }}
                                @endforeach
                            </td>
                            <td>
                                <div class="progress" style="top: 4px;">
                                    <div class="progress-bar progress-bar-{{ $task->status->color }}" role="progressbar" aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $task->progress }}%">{{ $task->progress }}%</div>
                                </div>
                            </td>
                            <td>{{ Date::parse($task->created_at)->format('j F Y') }}</td>
                            <td>{{ Date::parse($task->updated_at)->diffForHumans() }}</td>
                            <td>
                                {!! Form::open(array('url' => 'back/tasks/' . $task->id, 'method' => 'DELETE', 'class' => 'form-inline')) !!}
                                    <a class="btn btn-small btn-info" href="{{ URL::to('back/tasks/' . $task->id . '/edit') }}" style="margin: 5px;">Editer</a>
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a class="btn btn-small btn-primary" href="{{ route('back.tasks.create') }}">Créer une tâche</a>
            </div>
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->

    <br />
    <br />
    <h3 class="text-center">Liste des erreurs apparues sur le serveur à l'attention du webmaster:</h3><br />

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            {{-- <th>Instance</th> --}}
                            <th>Channel</th>
                            <th>Level</th>
                            <th>Level name</th>
                            <th>Message</th>
                            <th>Created at</th>
                            @if (Auth::guard('member')->user()->email == 'jm.kleger@gmail.com')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $key => $log)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                {{-- <td>{{ $log->instance }}</td> --}}
                                <td>{{ $log->channel }}</td>
                                <td>{{ $log->level }}</td>
                                <td>{{ $log->level_name }}</td>
                                <td>{{ $log->message }}</td>
                                <td>{{ Date::parse($log->created_at)->format('j F Y') }}</td>
                                @if (Auth::guard('member')->user()->email == 'jm.kleger@gmail.com')
                                    <td>
                                        {!! Form::open(array('url' => 'back/logs/' . $log->id, 'method' => 'DELETE', 'class' => 'form-inline')) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('back/logs/' . $log->id) }}" style="margin: 5px;">Montrer</a>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Supprimer', array('class' => 'btn btn-small btn-warning', 'style' => 'margin: 5px;')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- ./table-responsive -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection