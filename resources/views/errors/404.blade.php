<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>JBNE - Page non trouvée</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
        <style>
            .text {
                font-family: "Times New Roman", Georgia, Serif;
                font-size: 250%;
                padding-top: 20px;
            }
            #parent {
                position:fixed;
                bottom:0px;
                width:100%;  
            } 
            #child {
                width:300px;
                margin:0px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="text">Oups, la page requise n'a pas été trouvée.</p>

                    <br />
                    <br />

                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo_old.png') }}" width="400px" alt="logo" /></a>
                    
                    <a href="{{ route('home') }}"><h3>&larr; Retour à l'accueil</h3></a>

                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <br/>            
        </div><!-- /.container -->
        
        <div id='parent'>
            <div id='child'>
                <p class="text-center">Tous droits réservés &copy; jbne.ch <?php echo date("Y"); ?></p>
            </div>
        </div>
    </body>
</html>
