<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> --}}
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    body{
    margin-top: 30px;
    background-color: #FAEBD7;
    }
    .timeline{
        background-color: #fff;
        padding: 30px;
    }
    .timeline-section1 .timeline-icon-section,
    .timeline-section2 .timeline-content-top{
        position: relative;
        border-bottom:20px solid #DC3545;
        height:210px;
    }
    .timeline-section2 .timeline-content-top{
        border-bottom:20px solid #17A2B8;
        padding-top: 30px;
    }
    .timeline-section1 .timeline-icon-section:after{
        content: " ";
        position:absolute; 
        top:190px;
        right: 0px;
        border:10px solid #fff;
        border-left-color:#DC3545;
    }
    .timeline-section1 .timeline-icon-section:before{
        content: " ";
        position:absolute; 
        top:190px;
        left:0px;
        border:10px solid transparent;
        border-left-color:#fff;
    }
    .timeline-section2 .timeline-icon-section:after{
        content: " ";
        position:absolute; 
        top:-20px;
        right: 0px;
        border:10px solid #fff;
        border-left-color:#17A2B8;
    }
    .timeline-section2 .timeline-icon-section:before{
        content: " ";
        position:absolute; 
        top:-20px;
        left:0px;
        border:10px solid transparent;
        border-left-color:#fff;
    }
    .timeline-icon-section img{
        border: 1px solid #DC3545;
        width: 100px;
        height: 100px;
    }
    .borders{
        border-right:1px solid #c2c2c2;
        height:50px;
        width: 1px;
        margin: 20px auto;
    }
    .timeline-section2 .timeline-icon-section img{
        border: 1px solid #17A2B8;
    } 
    .timeline-content-bottom{
        margin-top:70px;
    }
    .timeline-content-bottom h1,.timeline-content-top h1{
        font-size: 25px;
        font-weight: bold;
    }
    .timeline-section2 .timeline-content-top{
        height:210px;
    }
    @media (min-width:320px) and (max-width:640px){
        .timeline-section1 .timeline-icon-section::after,
        .timeline-section1 .timeline-icon-section::before,
        .timeline-section2 .timeline-icon-section::before,
        .timeline-section2 .timeline-icon-section::after,
        .timeline-section2 .timeline-icon-section,
        .timeline-section2 .timeline-content-top,
        .timeline-section1 .timeline-icon-section{
            border:none;
            
        }
        .timeline-section2{
            border-bottom: 3px solid #2CA2B8;
            margin-bottom: 15px;
        }
        .timeline-section1{
            border-bottom: 3px solid #DC3545;
            margin-bottom: 15px;
        }
    }

    /*@media (min-width: 992px) {
      .container-scroll > .row {
        overflow-x: auto;
        white-space: nowrap;
      }
      .container-scroll > .row > .col-md-2 {
        display: inline-block;
        float: none;
      }
    }*/

    @media (min-width: 992px) {
      .container > .row {
        overflow-x: auto;
        white-space: nowrap;
      }
      .container > .row > .col-lg-2 {
        display: inline-block;
        float: none;
      }
    }
  </style>
</head>
<body>

{{-- <div class="container">
  <div class="row timeline text-center">
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
              <h1>2001</h1>
              <p>Lorem ipsum dolor sitriatur. a deserunt.</p>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
              <p style="height: 100px; overflow-y: auto">Lorem ipsum dolor sitriatur. a deserunt. Lorem ipsum dolor sitriatur. a deserunt. Lorem ipsum dolor sitriatur. a deserunt. Lorem ipsum dolor sitriatur. a deserunt. Lorem ipsum dolor sitriatur. a deserunt. Lorem ipsum dolor sitriatur. a deserunt.</p>
              <h1>2001</h1>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
              <h1>2001</h1>
              <p>Lorem ipsum dolor sitriatur. a deserunt.</p>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
              <p>Lorem ipsum dolor sitriatur. a deserunt.</p>
              <h1>2001</h1>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
              <h1>2001</h1>
              <p>Lorem ipsum dolor sitriatur. a deserunt.</p>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
              <p>Lorem ipsum dolor sitriatur. a deserunt.</p>
              <h1>2001</h1>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
          </div>
      </div>
    </div>
  </div>
</div> --}}

<br /><br /><br /><br />

<div class="container">
  <div class="row timeline text-center">
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto; white-space: normal;">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
            <div style="height: 100px; overflow-y: auto; white-space: normal;">
              <h1>11 SEPTEMBRE 2017</h1>
              <p>Assemblée générale constitutive</p>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
            <div style="height: 100px; overflow-y: auto; white-space: normal;">
              <p>Dépôt du recours abstrait au Tribunal fédéral à l'encontre la loi portant modification de la loi sur les autorités de protection de l'enfant et de l'adulte (LAPEA)</p>
              <h1>17 SEPTEMBRE 2017</h1>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto; white-space: normal;">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
            <div style="height: 100px; overflow-y: auto;">
              <h1>DIMANCHE 15 OCTOBRE 2017, DÈS 11H</h1>
              <p>Apéritif commun avec l'ANAS au Parc de Pierre-à-Bot. En cas de mauvais temps, une fondue au fromage à la Pinte de Pierre-à-Bot sera une alternative gourmande</p>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
            <div style="height: 100px; overflow-y: auto;">
              <p>Le Jeune Barreau est fier de dévoiler son nouveau logo qui met en avant l'héritage de la profession d'avocat associé à du lettrage moderne et épuré</p>
              <h1>MERCREDI 22 NOVEMBRE 2017</h1>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
            <div style="height: 100px; overflow-y: auto;">
              <h1>11 SEPTEMBRE 2017</h1>
              <p>Assemblée générale constitutive</p>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
            <div style="height: 100px; overflow-y: auto;">
              <p>Dépôt du recours abstrait au Tribunal fédéral à l'encontre la loi portant modification de la loi sur les autorités de protection de l'enfant et de l'adulte (LAPEA)</p>
              <h1>17 SEPTEMBRE 2017</h1>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section1 text-danger">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
              <div class="borders"></div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-content-bottom">
            <div style="height: 100px; overflow-y: auto;">
              <h1>DIMANCHE 15 OCTOBRE 2017, DÈS 11H</h1>
              <p>Apéritif commun avec l'ANAS au Parc de Pierre-à-Bot. En cas de mauvais temps, une fondue au fromage à la Pinte de Pierre-à-Bot sera une alternative gourmande</p>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-12 timeline-section2 text-info">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-6 timeline-content-top">
            <div style="height: 100px; overflow-y: auto;">
              <p>Le Jeune Barreau est fier de dévoiler son nouveau logo qui met en avant l'héritage de la profession d'avocat associé à du lettrage moderne et épuré</p>
              <h1>MERCREDI 22 NOVEMBRE 2017</h1>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-6 timeline-icon-section">
            <div style="height: 100px; overflow-y: auto;">
              <div class="borders"></div>
              <img src="{{ asset('images/agenda/logo.jpg') }}" class="rounded-circle img-thumbnail">
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

{{-- <div class="container-fluid container-scroll">
  <div class="row">
    <div class="col-md-2">
      Field 1
    </div>
    <div class="col-md-2">
      Field 2
    </div>
    <div class="col-md-2">
      Field 3
    </div>
    <div class="col-md-2">
      Field 4
    </div>
    <div class="col-md-2">
      Field 5
    </div>
    <div class="col-md-2">
      Field 6
    </div>
    <div class="col-md-2">
      Field 7
    </div>
    <div class="col-md-2">
      Field 8
    </div>
    <div class="col-md-2">
      Field 9
    </div>
    <div class="col-md-2">
      Field 10
    </div>
  </div>
</div> --}}

</body>
</html>