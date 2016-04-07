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
                            @include('Partials.Mensajes.mensajes')
                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Modificar salida de planta</h4><br>
                            @if( isset($salidaPlanta))
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('plantula/salidaplanta/consultar/item',$salidaPlanta->id) }}">
                                                <button  class="btn btn-success btn-xs tooltips" data-placement="top" data-original-title="Consultar">
                                                    <i class="fa fa-eye"></i></button>
                                            </a> &nbsp
                                        </td>
                                        <td>
                                            {!! Form::open(['action'=>['salidaDePlantaController@eliminar'],'role'=>'form'] )!!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar esta salida de planta?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$salidaPlanta->id}}>
                                            {!! Form::close() !!}
                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                </table>
                                <br><br>

                            @endif

                            {!! Form::open(['action'=>['salidaDePlantaController@modificar'],'class'=>'form-horizontal','role'=>'form', 'id' =>'formulario'] )  !!}



                            @include('Plantula.SalidaPlanta.Partials.form')
                            <input type="hidden" name="id" value="{{$salidaPlanta->id}}">
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- FIN CONSULTAR FUNCIONES -->
                </div>
            </section>
        </section>
    </section>
</section>

@include('Plantula.SalidaPlanta.Partials.validator')

@include('Plantula.SalidaPlanta.Partials.ajaxScript')

@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')
