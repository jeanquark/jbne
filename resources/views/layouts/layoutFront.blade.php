<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Le site du Jeune Barreau neuchâtelois, avec sa composition, ses membres et son actualité">
    <meta name="author" content="">

    <title>JBNE - Jeune Barreau Neuchâtelois</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    
    <!-- Google indexing -->
    <meta name="google-site-verification" content="G39Uml7mXCH_53xNipqlliuSAk17kHpxul5eYuExM1I" />

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap_modified.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}


    <!-- Custom Fonts -->
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Toastr notifications -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <link rel="manifest" href="/manifest.json"></link>


    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-71694605-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-71694605-6');
    </script>
</head>

<body id="page-top" class="index">

    @yield('content')

    <footer>
        <div class="container" style="postion: absolute; bottom: 0;">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-xs-center">Tous droits réservés &copy; <?php echo date("Y"); ?> jbne.ch</h4><small>v1.0</small>
                </div>
                
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <!-- Plugin JavaScript -->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script> --}}

    <!-- Toastr notifications -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="{{ asset('front/toastr.min.js') }}"></script> --}}
    {!! Toastr::render() !!}

    <!-- Contact Form JavaScript -->
    {{-- <script src="js/jqBootstrapValidation.js"></script> --}}
    {{-- <script src="js/contact_me.js"></script> --}}

    <!-- Theme JavaScript -->
    {{-- // <script src="js/agency.min.js"></script> --}}
    <script src="js/agency.js"></script>

    <script>
        
    </script>

    @yield('scripts')

</body>

</html>
