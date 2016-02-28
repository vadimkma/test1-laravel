<!doctype html>
<html>
<head>
    <title><?php // if($title){ echo $title;}?></title>
    <link href="{{ URL::asset('../resources/assets/sass/app.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="{{ URL::asset('../resources/assets/monthly/monthly.js')}}"></script>

</head>
<body>
<header>
    <nav class="navbar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    @if (!Auth::check())
                        {!! Menu::get('mainNav')->asUL(array('class' => 'nav navbar-nav navbar-right') ); !!}
                    @else
                        {!! Menu::get('userNav')->asUL(array('class' => 'nav navbar-nav navbar-right') ); !!}
                    @endif
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">