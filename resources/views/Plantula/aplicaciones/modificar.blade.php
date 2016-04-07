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
                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Modificar aplicación</h4><br>
                            @if( isset($aplicaciones))
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="{{ route('plantula/aplicaciones/consultar/item',$aplicaciones->id) }}">
                                                <button  class="btn btn-success btn-xs tooltips" data-placement="top" data-original-title="Consultar">
                                                    <i class="fa fa-eye"></i></button>
                                            </a> &nbsp
                                        </td>
                                        <td>
                                            {!! Form::open(['action'=>['aplicacionesPlantulaController@eliminar'],'role'=>'form'] )!!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar esta aplicación?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$aplicaciones->id}}>
                                            {!! Form::close() !!}
                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                </table>
                                <br><br>

                            @endif

                            {!! Form::open(['action'=>['aplicacionesPlantulaController@modificar'],'class'=>'form-horizontal','role'=>'form', 'id' =>'formulario'] )  !!}



                            @include('Plantula.aplicaciones.Partials.form')
                            <input type="hidden" name="id" value="{{$aplicaciones->id}}">
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
