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
    @include('Plantula.SalidaPlanta.aside')
            <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><a href="{{ route('plantula/salidaplanta') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar salida de planta</h4><br>
                            @if( isset($salidaPlanta))
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('plantula/salidaplanta/modificar/item',$salidaPlanta->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>

                                            {!! Form::open(['action'=>['salidaDePlantaController@eliminar'],'role'=>'form'] ) !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar esta salida de planta?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$salidaPlanta->id}}>
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
                                        <dt>Invernadero</dt><dd>{{ $salidaPlanta->invernadero->nombre }}</dd>

                                        <dt>Fecha</dt><dd>{{ $salidaPlanta->fecha }}</dd>
                                        @if( $salidaPlanta->comentario != "")
                                            <dt>Comentarios</dt><dd>{{ $salidaPlanta->comentario }}</dd>
                                        @endif

                                    </dl>
                                </div>
                    </div>
                    <!-- FIN CONSULTAR FUNCIONES -->
                </div>
            </section>
        </section>
    </section>
</section>




@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')