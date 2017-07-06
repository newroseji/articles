<!DOCTYPE html>
<html lang="en" ng-App="myApp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Niraj Byanjankar">
    <link rel="icon" href="favicon.ico">

    <meta name="description" content="{{title_case($appTitle)}} is the Laravel based web application."/>
    <link rel="canonical" href="http://www.{{str_slug($appTitle)}}.com" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{title_case($appTitle)}}" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="http://www.{{str_slug($appTitle)}}.com" />
    <meta property="og:site_name" content="{{title_case($appTitle)}}" />
    <meta property="og:image" content="http://www.{{str_slug($appTitle)}}.com" />

    <title>@yield('page-title') - {{title_case($appTitle)}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <link href="/assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="/assets/lity.2.2.0/lity.min.css" rel="stylesheet">

    <script src="/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.3.7.3.min.js"></script>
    <script src="/assets/js/respond.1.4.2.min.js"></script>
    <![endif]-->

    <link href="/assets/css/carousel.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">

    @yield("styles")


    <script src="/assets/js/ckeditor/ckeditor.js"></script>

</head>
<body ng-controller="AppMainController">

<div class="navbar-wrapper">
    <div class="container">

        @include("headers._dynav")

    </div>
</div>

@yield('carousel')
<div class="container">
    @yield('content')

</div>

@yield('footer')
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="/assets/js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>

<script src="/assets/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/sweetalert2/dist/ng-sweet-alert.js"></script>
<script src="/assets/lity.2.2.0/lity.min.js"></script>

<script src="/assets/js/app.js"></script>
@yield("scripts")
@include("flashes._sweetflash")
</body>
</html>