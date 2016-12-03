<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Niraj Byanjankar">
    <link rel="icon" href="favicon.ico">

    <meta name="description" content="Project Flyer is the Laravel based web application to keep track of Flyers."/>
    <link rel="canonical" href="http://www.projectflyer.com" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Project Flyer" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="http://www.projectflyer.com" />
    <meta property="og:site_name" content="Project Flyer" />
    <meta property="og:image" content="http://www.projectflyer.com" />

    <title>@yield('page-title') - Articles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <link href="/css/styles.min.css" rel="stylesheet">

    @yield("styles")
</head>
<body>
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
<script src="/js/scripts.min.js"></script>

@yield("scripts")
@include("flashes._sweetflash")
</body>
</html>