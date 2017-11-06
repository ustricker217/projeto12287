<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <title>Jogo da Memória</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/plugins/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('css/plugins/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<nav >
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse" align="center">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#"> Dashboard</a>
                </li>
                @if (Auth::guest())
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                @else
                    @can('update', Auth::user())
                        <li><a href="#">Editar Perfil</a></li>
                    @endcan
                    @if(Auth::user()->isAdmin())
                        <li class="active">
                            <a href="#demo" data-toggle="collapse">Gestão Administrativa
                                <span class="fa arrow">
                        </span>
                            </a>
                            <div id="demo" class="collapse">
                                <ul class="nav nav-second-level collapse in" aria-expanded="true">
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
                @if(Auth::user())
                    @include('partials.logout')
                @endif
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">@yield('title')</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if(session('success'))
        @include('partials.success-session')
    @endif
    @if(session('error'))
        @include('partials.error-session')
    @endif

    @if(count($errors) > 0)
        @include('partials.errors')
    @endif
    @yield('content')
</div>

<!-- jQuery -->
<script src="{{asset('js/jquery.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{asset('js/plugins/morris/raphael.min.js')}}"></script>
<script src="{{asset('js/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('js/plugins/morris/morris-data.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('js/plugins/flot/flot-data.js')}}"></script>

</body>

</html>