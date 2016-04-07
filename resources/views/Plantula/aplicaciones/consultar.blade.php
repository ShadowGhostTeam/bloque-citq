@include('Partials.ScriptsGenerales.scriptsPartials')



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

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar fertilización/riego</h4><br>

                            @if( isset($fertilizacionesRiego))
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="#"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            <!--eliminar-->
                                        </td>
                                    </tr>
                                </table>
                                <br><br>
                            @endif
                            <div class="row">
                                <br>
                                <div class="col-md-4">

                                </div>


                                <div class="col-md-7">

                                    <dl class="dl-horizontal">
                                        <dt>Invernadero</dt><dd>{{ $aplicaciones->invernadero->nombre }}</dd>
                                        <dt>Siembra plántula</dt><dd>{{ $siembras['nombre'] . ' '. $siembras['variedad']  }}</dd>
                                        <dt>Fecha</dt><dd>{{ $aplicaciones->fecha }}</dd>
                                        @if( $aplicaciones->aplicacion != "")
                                            <dt>Aplicación</dt><dd>{{ $aplicaciones->aplicacion }}</dd>
                                        @endif
                                        @if( $aplicaciones->tipoAplicacion != "")
                                            <dt>Tipo de aplicación</dt><dd>{{ $aplicaciones->tipoAplicacion }}</dd>
                                        @endif
                                        @if( $aplicaciones->producto != "")
                                            <dt>Producto</dt><dd>{{ $aplicaciones->producto }}</dd>
                                        @endif
                                        @if( $aplicaciones->cantidad != "")
                                            <dt>Cantidad</dt><dd>{{ $aplicaciones->cantidad }}</dd>
                                        @endif
                                        @if( $aplicaciones->comentario != "")
                                            <dt>Comentarios</dt><dd>{{ $aplicaciones->comentario }}</dd>
                                        @endif

                                    </dl>
                                </div>

                            </div>


                            <br>

                        </div>
                    </div>
                    <!-- FIN CONSULTAR FUNCIONES -->
                </div>
            </section>
        </section>
    </section>
</section>




@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')