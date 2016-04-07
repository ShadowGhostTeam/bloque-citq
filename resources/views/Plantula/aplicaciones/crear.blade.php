@include('Partials.ScriptsGenerales.scriptsPartials')
<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    @include('Partials.ScriptsGenerales.headerPartials')
            <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    @include('Plantula.aplicaciones.aside')
            <!--sidebar end-->

    <section id="container">

        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('plantula/aplicaciones') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            @include('Partials.Mensajes.mensajes')

                            {!! Form::open(['action'=>['aplicacionesPlantulaController@crear'],'class'=>'form-horizontal','role'=>'form','id'=>'formulario'])!!}

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Crear aplicación</h4><br>

                            @include('Plantula.aplicaciones.Partials.form')

                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- FIN CONSULTAR FUNCIONES -->
                </div>
            </section>
        </section>
    </section>
</section>

@include('Plantula.aplicaciones.Partials.validator')

@include('Plantula.aplicaciones.Partials.ajaxScript')

@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')
