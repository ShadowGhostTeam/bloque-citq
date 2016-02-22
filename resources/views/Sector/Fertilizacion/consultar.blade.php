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
    @include('Sector.Fertilizacion.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('sector/fertilizacion') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar fertilización</h4><br>

                            @if( isset($fertilizacion))


                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('sector/fertilizacion/modificar/item',$fertilizacion->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['fertilizacionSectorController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la fertilización?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$fertilizacion->id}}>
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
                                        <dt>Sector</dt><dd>{{ $fertilizacion->sector->nombre }}</dd>
                                        <dt>Siembra</dt><dd>{{ $siembras['nombre'] . ' '. $siembras['variedad']  }}</dd>
                                        <dt>Fuente</dt><dd>{{ $fertilizacion->fuente->nombre }}</dd>
                                        <dt>Fecha</dt><dd>{{ $fertilizacion->fecha }}</dd>
                                        <dt>Tipo de fertilización</dt><dd>{{ $fertilizacion->tipo}}</dd>
                                        <dt>Cantidad(kg)</dt><dd>{{ $fertilizacion->cantidad }}</dd>
                                        <dt>Programa NPK</dt><dd>{{ $fertilizacion->programaNPK }}</dd>
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




@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')