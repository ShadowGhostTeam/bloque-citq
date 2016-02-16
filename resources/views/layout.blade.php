<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
 
	{!! Html::style('assets/css/bootstrap.css') !!}
	{!! Html::style('assets/css/custom.css') !!}
 
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.3.min.js') }}"></script>

    <!-- DATEPICKER -->
    <link rel="stylesheet" href="{{asset('assets/css/datepicker.css')}}" />

    <!-- VALIDATOR -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrapValidator.css')}}"/>
    <script type="text/javascript" src="{{asset('assets/js/bootstrapValidator.js')}}"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top green">
		<div class="container-fluid">
			<div class="navbar-header">
				</button>
				<img class="navbar-img" src="/assets/LOGOB.png">
				<a class="navbar-brand" href="#">AgroBay</a>
				
			</div>
		</div>
	</nav>
 
	<!--Sidebar-->
	<nav class="navbar navbar-default sidebar" role="navigation">
	    <div class="container-fluid">
	    	<div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>      
		    </div>
		    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="#">Home<span class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
		        <li class="active" class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sectores<span class="caret"></span><span class="pull-right hidden-xs showopacity glyphicon glyphicon-leaf"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">Preparación de suelo</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Siembra</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Fertilización</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Riegos</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Mantenimiento</a></li>
		          </ul>
		        </li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<span class="caret"></span><span class="pull-right hidden-xs showopacity glyphicon glyphicon-piggy-bank"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">Mantenimiento</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Empleados</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Gastos</a></li>
		          </ul>
		        </li>     
		        <li ><a href="#">Reportes<span class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a></li>
		        <li ><a href="#">Configuración<span class="pull-right hidden-xs showopacity glyphicon glyphicon-cog	"></span></a></li>
		        <li ><a href="#">Cerrar Sesión<span class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
		      </ul>
		    </div>
	  	</div>
	</nav>
	<!--end sidebar-->
		
 
	@yield('content')
 
	<!-- Scripts -->

	{!! Html::script('assets/js/bootstrap.min.js') !!}

    <script type="text/javascript" src="{{ asset ('assets/js/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>


</body>
</html>