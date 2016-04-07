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
    @include('Plantula.Siembra.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3>
                    <a href="{{ route('plantula/siembra') }}">
                        <button type="button" class="btn btn-primary">
                            <i class="glyphicon glyphicon-arrow-left"></i>
                            Búsqueda
                        </button>
                    </a>
                </h3>
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Consultar siembra</h4><br>

                            @if( isset($siembra))

                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('plantula/siembra/modificar/item',$siembra->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                            &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['siembraPlantulaController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la siembra?")'>
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            <input type="hidden" name="id" value={{$siembra->id}}>
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
                                        <dt>Invernadero de Plántula</dt><dd>{{ $siembra->invernadero->nombre }}</dd>
                                        <dt>Contenedor</dt><dd>{{ $siembra->contenedor  }}</dd>
                                        <dt>Cultivo</dt><dd>{{ $siembra->cultivo->nombre }}</dd>
                                        <dt>Variedad</dt><dd>{{ $siembra->variedad }}</dd>
                                        <dt>Número de plantas</dt><dd>{{ $siembra->numPlantas }}</dd>
                                        <dt>Sustrato</dt><dd>{{ $siembra->sustrato }}</dd>
                                        <dt>Destino</dt><dd>{{ $siembra->destino }}</dd>
                                        <dt>Comentario</dt><dd>{{ $siembra->comentario}}</dd>
                                        <dt>Fecha</dt><dd>{{ $siembra->fecha }}</dd>
                                        <dt>Status</dt><dd>{{ $siembra->status}}</dd>
                                        <dt>Fecha de Terminación</dt><dd>{{ $siembra->fechaTerminacion}}</dd>
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