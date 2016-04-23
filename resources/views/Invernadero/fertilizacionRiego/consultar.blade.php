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
    @include('Invernadero.fertilizacionRiego.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('invernadero/fertilizacionRiego') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar fertilización/riego</h4><br>

                            @if( isset($fertilizacionesRiego))
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('invernadero/fertilizacionRiego/modificar/item',$fertilizacionesRiego->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['fertilizacionRiegoInvernaderoController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la fertilización?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$fertilizacionesRiego->id}}>
                                            {!! Form::close() !!}
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
                                        <dt>Invernadero</dt><dd>{{ $fertilizacionesRiego->invernadero->nombre }}</dd>
                                        <dt>Transplante</dt><dd>{{ $siembras['nombre'] . ' '. $siembras['variedad']  }}</dd>
                                        <dt>Fecha</dt><dd>{{ $fertilizacionesRiego->fecha }}</dd>
                                        <dt>Tiempo riego</dt><dd>{{ $fertilizacionesRiego->tiempoRiego }}</dd>
                                        <dt>Etapa Fenológica</dt><dd>{{ $fertilizacionesRiego->etapaFenologica }}</dd>
                                        <dt>Frecuencia</dt><dd>{{ $fertilizacionesRiego->frecuencia }}</dd>
                                        <dt>Formulación</dt><dd>{{ $fertilizacionesRiego->formulacion }}</dd>
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