<!DOCTYPE html>
<html>
<head>
    <title>PaySano</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/animate.css">
    <!-- js -->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
</head>
<body>
    <div id="particles-js"></div>
    <!--header-->
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <h1 class="navbar-brand"><a  href="index.php">Pay-Sano</a></h1>
            </div>
            <!--navbar-header-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php#productos" class="">Productos</a></li>
                    <li><a href="index.php#nosotros" class="">Nosotros</a></li>
                    <li><a href="index.php#contacto" class="">Contacto</a></li>
                </ul>
            </div>
        </nav>
        <div class="header-info">
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!--//header-->
<!--banner-->
<div class="banner">
    <div class="container">
        <h2 class="hdng animated bounceInDown">Aquí están</h2>
        <p class="animated bounceInLeft" >Los más ricos y deliciosos Pays</p>
        <a class="animated bounceInRight" data-rel="external" href="#" target = "_blank">Llamar y Pedir Ahora!</a>
        <div class="banner-text">
            <img src="images/paysanologo.png" alt="" class="animated  bounceIn" />
        </div>
    </div>
</div>
<!--//banner-->
<h2 id="productos" class="titulo-principal">¡PRODUCTOS!</h2>
<!--//parall-->
<!--gallery-->
<div class="gallery">
    <div class="container">
        <div id="contenedor_productos" class="row gallery-grids">
            <!-- AQUI SE INCLUIRAN LOS PRODUCTOS EXITENTES EN LA BASE DE DATOS -->
        </div>
    </div>
</div>
<!--//gallery-->
<!--parall-->
<div id="nosotros" class="subscribe">
    <div class="container">
        <h3>NOSOTROS:</h3>
        <h3> Somos una reposteria especializada en la venta de PAY, comprometidos con nuestros cliente brindandoles la mayor calidad y variedad de nuestros productos. </h3>
    </div>
</div>
<!--//parall-->

<!--footer-->
<div class="footer " id="contacto">
    <div class="container">
        <div class="footer-grids">
            <div class="col-md-12 footer-grid icons" style="text-align:center">
                <h4>¡SIGUENOS EN FACEBOOK!</h4>
                <ul>
                    <li><img src="images/redessociales.png"></li>
                    <li><img src="images/facebook.png" alt=""/><a href="https://www.facebook.com/Pay-Sano-1624064007858076">Facebook</a></li>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--//footer-->
<div class="footer-bottom">
    <div class="container">
        <p>
            © 2015 - Cesar Adrian Cortes Gonzalez
            <a href="https://twitter.com/duilan">
                <img src="images/twitter.png" alt=""/>
            </a>
        </p>
    </div>
</div>

</body>
<script src="js/particles.min.js"></script>
<script src="app/app.js"></script>
<script>
    $(document).ready(function() {
        /* Particulas */
        particlesJS.load('particles-js', 'js/particlesjs-config.json');
        carga_productos();
    });
</script>
</html>
