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
    @include('Invernadero.aplicacionMantenimiento.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('invernadero/aplicacionMantenimiento') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar aplicación de mantenimiento</h4><br>

                            @if( isset($aplicacionesMantenimiento))


                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('invernadero/aplicacionMantenimiento/modificar/item',$aplicacionesMantenimiento->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['invernaderoAplicacionesMantenimientoController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la aplicación?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$aplicacionesMantenimiento->id}}>
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
                                        <dt>Invernadero</dt><dd>{{ $aplicacionesMantenimiento->invernadero->nombre }}</dd>
                                        <dt>Transplante</dt><dd>{{ $siembra }}</dd>
                                        <dt>Aplicación</dt><dd>{{ $aplicacionesMantenimiento->aplicacion }}</dd>
                                        <dt>Tipo de aplicación</dt><dd>{{ $aplicacionesMantenimiento->tipoAplicacion }}</dd>
                                        <dt>Producto</dt><dd>{{ $aplicacionesMantenimiento->producto }}</dd>
                                        <dt>Cantidad</dt><dd>{{ $aplicacionesMantenimiento->cantidad }}</dd>
                                        <dt>Fecha</dt><dd>{{ $aplicacionesMantenimiento->fecha }}</dd>
                                        <dt>Comentario</dt><dd>{{ $aplicacionesMantenimiento->comentario }}</dd>

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