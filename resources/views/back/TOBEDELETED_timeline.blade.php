<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBNE - Login Avocats stagiaires</title>

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	{{-- // <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
	{{-- // <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
	{{-- // <script src="https://unpkg.com/sweet-scroll/sweet-scroll.min.js"></script> --}}
	<script>
		$(document).ready(function(){
			$('#right-button').click(function() {
			  	event.preventDefault();
			  	$('#content').animate({
			    	scrollLeft: "+=500px"
			  	}, "slow");
			});

			$('#left-button').click(function() {
			  	event.preventDefault();
			  	$('#content').animate({
			    	scrollLeft: "-=500px"
			  	}, "slow");
			});
		});
	</script>

	<style>
		/* Timeline */
		.timeline,
		.timeline-horizontal {
		  list-style: none;
		  padding: 20px;
		  position: relative;
		}
		.timeline:before {
		  top: 40px;
		  bottom: 0;
		  position: absolute;
		  content: " ";
		  width: 3px;
		  background-color: #eeeeee;
		  left: 50%;
		  margin-left: -1.5px;
		}
		.timeline .timeline-item {
		  margin-bottom: 20px;
		  position: relative;
		}
		.timeline .timeline-item:before,
		.timeline .timeline-item:after {
		  content: "";
		  display: table;
		}
		.timeline .timeline-item:after {
		  clear: both;
		}
		.timeline .timeline-item .timeline-badge {
		  color: #fff;
		  /*width: 54px;*/
		  /*height: 54px;*/
		  width: 170px;
		  height: 170px;
		  line-height: 52px;
		  font-size: 22px;
		  text-align: center;
		  position: absolute;
		  top: 18px;
		  left: 100px;
		  margin-left: -25px;
		  background-color: #7c7c7c;
		  border: 3px solid #ffffff;
		  z-index: 100;
		  border-top-right-radius: 50%;
		  border-top-left-radius: 50%;
		  border-bottom-right-radius: 50%;
		  border-bottom-left-radius: 50%;
		}
		.timeline .timeline-item .timeline-badge.primary {
		  background-color: #1f9eba;
		  border: 7px solid #f1f1f1;
		}
		.timeline .timeline-item .timeline-panel-top {
		  position: relative;
		  width: 46%;
		  float: left;
		  right: 16px;
		  border: 1px solid #c0c0c0;
		  background: #ffffff;
		  border-radius: 2px;
		  padding: 20px;
		  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		}
		.timeline .timeline-item .timeline-panel-top:before {
		  position: absolute;
		  top: 26px;
		  right: -16px;
		  display: inline-block;
		  border-top: 16px solid transparent;
		  border-left: 16px solid #c0c0c0;
		  border-right: 0 solid #c0c0c0;
		  border-bottom: 16px solid transparent;
		  content: " ";
		}
		.timeline .timeline-item .timeline-panel-top .timeline-title {
		  margin-top: 0;
		  color: inherit;
		}
		.timeline .timeline-item .timeline-panel-top .timeline-body > p,
		.timeline .timeline-item .timeline-panel-top .timeline-body > ul {
		  margin-bottom: 0;
		}
		.timeline .timeline-item .timeline-panel-top .timeline-body > p + p {
		  margin-top: 5px;
		}
		.timeline .timeline-item:last-child:nth-child(even) {
		  float: right;
		}
		.timeline .timeline-item:nth-child(even) .timeline-panel-top {
		  float: right;
		  left: 16px;
		}
		.timeline .timeline-item:nth-child(even) .timeline-panel-top:before {
		  border-left-width: 0;
		  border-right-width: 14px;
		  left: -14px;
		  right: auto;
		}
		.timeline-horizontal {
		  list-style: none;
		  position: relative;
		  padding: 20px 0px 20px 0px;
		  display: inline-block;
		}
		/* Time Line */
		.timeline-horizontal:before {
		  height: 6px;
		  top: auto;
		  bottom: 365px;
		  left: 156px;
		  /*right: 200px;*/
		  /*margin-right: 100px;*/
		  width: 80%;
		  margin-bottom: 20px;
		}
		.timeline-horizontal .timeline-item {
		  display: table-cell;
		  height: 700px;
		  width: 20%;
		  min-width: 320px;
		  float: none !important;
		  padding-left: 0px;
		  /*padding-right: 20px;*/
		  margin: 0 auto;
		  vertical-align: bottom;
		}
		.timeline-horizontal .timeline-item .timeline-panel-top {
		  top: auto;
		  /*bottom: 64px;*/
		  bottom: 460px;
		  display: inline-block;
		  float: none !important;
		  left: 0 !important;
		  right: 0 !important;
		  width: 100%;
		  margin-bottom: 20px;
		}
		.timeline-horizontal .timeline-item .timeline-panel-top:before {
		  top: auto;
		  bottom: -16px;
		  /*left: 28px !important;*/
		  left: 144px !important;
		  right: auto;
		  border-right: 16px solid transparent !important;
		  border-top: 16px solid #c0c0c0 !important;
		  border-bottom: 0 solid #c0c0c0 !important;
		  border-left: 16px solid transparent !important;
		}
		.timeline-horizontal .timeline-item:before,
		.timeline-horizontal .timeline-item:after {
		  display: none;
		}
		.timeline-horizontal .timeline-item .timeline-badge {
		  /*top: auto;*/
		  top: 250px;
		  bottom: 0px;
		  /*left: 43px;*/
		}

		/* Added by J-M */
		.timeline .timeline-item .timeline-panel-bottom {
		  position: relative;
		  width: 46%;
		  float: left;
		  right: 16px;
		  border: 1px solid #c0c0c0;
		  background: #ffffff;
		  border-radius: 2px;
		  padding: 20px;
		  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		}
		.timeline .timeline-item .timeline-panel-bottom:before {
		  position: absolute;
		  top: 26px;
		  right: -16px;
		  display: inline-block;
		  border-top: 16px solid transparent;
		  border-left: 16px solid #c0c0c0;
		  border-right: 0 solid #c0c0c0;
		  border-bottom: 16px solid transparent;
		  content: " ";
		}
		.timeline .timeline-item .timeline-panel-bottom .timeline-title {
		  margin-top: 0;
		  color: inherit;
		}
		.timeline .timeline-item .timeline-panel-bottom .timeline-body > p,
		.timeline .timeline-item .timeline-panel-bottom .timeline-body > ul {
		  margin-bottom: 0;
		}
		.timeline .timeline-item .timeline-panel-bottom .timeline-body > p + p {
		  margin-top: 5px;
		}
		.timeline .timeline-item:nth-child(even) .timeline-panel-bottom {
		  float: right;
		  left: 16px;
		}
		.timeline .timeline-item:nth-child(even) .timeline-panel-bottom:before {
		  border-left-width: 0;
		  border-right-width: 14px;
		  left: -14px;
		  right: auto;
		}
		.timeline-horizontal .timeline-item .timeline-panel-bottom {
		  /*top: auto;*/
		  top: 450px;
		  position: absolute;
		  /*bottom: 64px;*/
		  bottom: auto;
		  display: inline-block;
		  float: none !important;
		  left: 0 !important;
		  right: 0 !important;
		  width: 100%;
		  margin-bottom: 20px;
		}
		.timeline-horizontal .timeline-item .timeline-panel-bottom:before {
		  top: auto;
		  top: -16px;
		  /*position: absolute;*/
		  /*left: 28px !important;*/
		  left: 144px !important;
		  right: auto;
		  border-right: 16px solid transparent !important;
		  border-top: 0 solid #c0c0c0 !important;
		  border-bottom: 16px solid #c0c0c0 !important;
		  border-left: 16px solid transparent !important;
		}
		#content::-webkit-scrollbar { 
		    display: none; 
		}






	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
				  <h1>Nouvelle représentation de l'agenda</h1>
				</div>
				<div class="text-center">
					<button class="btn" id="left-button" type="button" style="color: #fff; background: #9f1853;">&larr;</button>
					<button class="btn" id="right-button" type="button" style="color: #fff; background: #9f1853;">&rarr;</button>
				</div>

				<br />
				<div style="display:inline-block; width:100%; overflow-y:auto;" id="content">
					<ul class="timeline timeline-horizontal">
						<li class="timeline-item" id="first">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/logo.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-bottom">
								<div class="timeline-heading">
									<h4 class="timeline-title">MERCREDI 22 NOVEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Le Jeune Barreau est fier de dévoiler son nouveau logo qui met en avant l'héritage de la profession d'avocat associé à du lettrage moderne et épuré</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/aperitif.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">DIMANCHE 15 OCTOBRE 2017, DÈS 11H</h4>
								</div>
								<div class="timeline-body">
									<p>Apéritif commun avec l'ANAS au Parc de Pierre-à-Bot. En cas de mauvais temps, une fondue au fromage à la Pinte de Pierre-à-Bot sera une alternative gourmande</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/recours.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-bottom">
								<div class="timeline-heading">
									<h4 class="timeline-title">17 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Dépôt du recours abstrait au Tribunal fédéral à l'encontre la loi portant modification de la loi sur les autorités de protection de l'enfant et de l'adulte (LAPEA). Dépôt du recours abstrait au Tribunal fédéral à l'encontre la loi portant modification de la loi sur les autorités de protection de l'enfant et de l'adulte (LAPEA)</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/assemblee.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">11 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Assemblée générale constitutive</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/assemblee.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">11 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Assemblée générale constitutive</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/assemblee.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">11 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Assemblée générale constitutive</p>
								</div>
							</div>
						</li>
						<li class="timeline-item">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/assemblee.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">11 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Assemblée générale constitutive</p>
								</div>
							</div>
						</li>
						<li class="timeline-item" id="last">
							<div class="timeline-badge primary" style="">
		                        <img class="img-circle img-responsive" src="{{ asset('images/agenda/assemblee.jpg') }}" alt="image d'illustration">
		                    </div>
							<div class="timeline-panel-top">
								<div class="timeline-heading">
									<h4 class="timeline-title">11 SEPTEMBRE 2017</h4>
								</div>
								<div class="timeline-body">
									<p>Assemblée générale constitutive</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
		{{-- <div class="row">
			<div class="col-md-12">
				<div class="page-header">
				  <h1>Timeline</h1>
				</div>
				<ul class="timeline">
					<li class="timeline-item">
						<div class="timeline-badge"><i class="glyphicon glyphicon-off"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Mussum ipsum cacilds 1</h4>
								<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
							</div>
							<div class="timeline-body">
								<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
							</div>
						</div>
					</li>
					<li class="timeline-item">
						<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Mussum ipsum cacilds 2</h4>
								<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
							</div>
							<div class="timeline-body">
								<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros gostis.</p>
							</div>
						</div>
					</li>
					<li class="timeline-item">
						<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Mussum ipsum cacilds 3</h4>
								<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
							</div>
							<div class="timeline-body">
								<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
								<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
								
							</div>
						</div>
					</li>
					<li class="timeline-item">
						<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Mussum ipsum cacilds 4</h4>
								<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
							</div>
							<div class="timeline-body">
								<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div> --}}



	</div>
</body>

</html>