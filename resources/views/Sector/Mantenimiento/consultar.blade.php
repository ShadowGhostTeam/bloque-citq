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
    @include('Sector.Mantenimiento.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('sector/mantenimiento') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar mantenimiento</h4><br>

                            @if( isset($mantenimiento))


                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('sector/mantenimiento/modificar/item',$mantenimiento->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['mantenimientoSectorController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la fertilización?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$mantenimiento->id}}>
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
                                        <dt>Actividad</dt><dd>{{ $fertilizacion->fuente->nombre }}</dd>
                                        @if($mantenimiento->actividad!="Deshierbe manual"&&$mantenimiento->actividad!="Deshierbe máquina")
                                            <dt>Tipo aplicación</dt><dd>{{ $mantenimiento->tipoAplicación }}</dd>
                                            <dt>Producto</dt><dd>{{ $mantenimiento->producto }}</dd>
                                            <dt>Cantidad kg ó l/ha</dt><dd>{{ $mantenimiento->cantidad }}</dd>
                                        @endif
                                        <dt>Fecha</dt><dd>{{ $mantenimiento->fecha }}</dd>
                                        <dt>Comentario</dt><dd>{{ $mantenimiento->comentario}}</dd>
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