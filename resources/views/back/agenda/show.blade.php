@extends('layouts.layoutBack')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <style>
        p {
            font-family: "Roboto Slab", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.75;
        }
        h4 {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-transform: uppercase;
            font-weight: 700;
        }
        .text-muted {
          color: #777777;
        }
        .timeline {
          list-style: none;
          padding: 0;
          position: relative;
        }
        .timeline:before {
          top: 0;
          bottom: 0;
          position: absolute;
          content: "";
          width: 2px;
          background-color: #f1f1f1;
          left: 40px;
          margin-left: -1.5px;
        }
        .timeline > li {
          margin-bottom: 50px;
          position: relative;
          min-height: 50px;
        }
        .timeline > li:before,
        .timeline > li:after {
          content: " ";
          display: table;
        }
        .timeline > li:after {
          clear: both;
        }
        .timeline > li .timeline-panel {
          width: 100%;
          float: right;
          padding: 0 20px 0 100px;
          position: relative;
          text-align: left;
        }
        .timeline > li .timeline-panel:before {
          border-left-width: 0;
          border-right-width: 15px;
          left: -15px;
          right: auto;
        }
        .timeline > li .timeline-panel:after {
          border-left-width: 0;
          border-right-width: 14px;
          left: -14px;
          right: auto;
        }
        .timeline > li .timeline-image {
          left: 0;
          margin-left: 0;
          width: 80px;
          height: 80px;
          position: absolute;
          z-index: 100;
          background-color: #9f1853;
          color: white;
          border-radius: 100%;
          border: 7px solid #f1f1f1;
          text-align: center;
        }
        .timeline > li .timeline-image h4 {
          font-size: 10px;
          margin-top: 12px;
          line-height: 14px;
        }
        .timeline > li.timeline-inverted > .timeline-panel {
          float: right;
          text-align: left;
          padding: 0 20px 0 100px;
        }
        .timeline > li.timeline-inverted > .timeline-panel:before {
          border-left-width: 0;
          border-right-width: 15px;
          left: -15px;
          right: auto;
        }
        .timeline > li.timeline-inverted > .timeline-panel:after {
          border-left-width: 0;
          border-right-width: 14px;
          left: -14px;
          right: auto;
        }
        .timeline > li:last-child {
          margin-bottom: 0;
        }
        .timeline .timeline-heading h4 {
          margin-top: 0;
          color: inherit;
        }
        .timeline .timeline-heading h4.subheading {
          text-transform: none;
        }
        .timeline .timeline-body > p,
        .timeline .timeline-body > ul {
          margin-bottom: 0;
        }
        @media (min-width: 768px) {
          .timeline:before {
            left: 50%;
          }
          .timeline > li {
            margin-bottom: 100px;
            min-height: 100px;
          }
          .timeline > li .timeline-panel {
            width: 41%;
            float: left;
            padding: 0 20px 20px 30px;
            text-align: right;
          }
          .timeline > li .timeline-image {
            width: 100px;
            height: 100px;
            left: 50%;
            margin-left: -50px;
          }
          .timeline > li .timeline-image h4 {
            font-size: 13px;
            margin-top: 16px;
            line-height: 18px;
          }
          .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
            text-align: left;
            padding: 0 30px 20px 20px;
          }
        }
        @media (min-width: 992px) {
          .timeline > li {
            min-height: 150px;
          }
          .timeline > li .timeline-panel {
            padding: 0 20px 20px;
          }
          .timeline > li .timeline-image {
            width: 150px;
            height: 150px;
            margin-left: -75px;
          }
          .timeline > li .timeline-image h4 {
            font-size: 18px;
            margin-top: 30px;
            line-height: 26px;
          }
          .timeline > li.timeline-inverted > .timeline-panel {
            padding: 0 20px 20px;
          }
        }
        @media (min-width: 1200px) {
          .timeline > li {
            min-height: 170px;
          }
          .timeline > li .timeline-panel {
            padding: 0 20px 20px 100px;
          }
          .timeline > li .timeline-image {
            width: 170px;
            height: 170px;
            margin-left: -85px;
          }
          .timeline > li .timeline-image h4 {
            margin-top: 40px;
          }
          .timeline > li.timeline-inverted > .timeline-panel {
            padding: 0 100px 20px 20px;
          }
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar"></i>  <a href="{{ route('back.agenda.index') }}">Agenda</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Montrer
        </li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{ asset($agenda->image_path) }}" alt="image d'illustration">
                        </div>
                        <div class="timeline-panel">
                            <br /><br /><br />
                            <div class="timeline-heading">
                                <h4>{{ $agenda->title }}</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">{{ $agenda->content }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection

@section('scripts')

@endsection