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
<<<<<<< HEAD
    @include('Invernadero.LaboresCulturales.aside')
=======
    @include('Invernadero.laboresCulturales.aside')
>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
<<<<<<< HEAD
                <h3><a href="{{ route('invernadero/laboresCulturales') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
=======
                <h3><a href="{{ route('laboresCulturales') }}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Búsqueda</button></a></h3>
>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57
                <div class="row mt">

                    <!-- INICIO CONSULTAR FUNCIONES -->
                    <div class="col-lg-12">
                        <div class="form-panel">
                            @include('Partials.Mensajes.mensajes')
                            <h4 style="color:#078006"><i class="fa fa-angle-right"></i>Modificar labor cultural</h4><br>
                            @if( isset($laboresCulturales))


                                <table align="right">
                                    <tr>
                                        <td>
<<<<<<< HEAD
                                            <a href="{{ route('invernadero/laboresCulturales/consultar/item',$laboresCulturales->id) }}">
=======
                                            <a href="{{ route('laboresCulturales',$laboresCulturales->id) }}">
>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57
                                                <button  class="btn btn-success btn-xs tooltips" data-placement="top" data-original-title="Consultar">
                                                    <i class="fa fa-eye"></i></button>
                                            </a> &nbsp
                                        </td>

                                        <td>
                                            {!! Form::open(['action'=>['invernaderoLaboresCulturalesController@eliminar'],'role'=>'form'] )  !!}
                                            <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar la labor cultural?")'><i class="fa fa-trash-o "></i></button>
                                            <input type="hidden" name="id" value={{$laboresCulturales->id}}>
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                </table>
                                <br><br>

                            @endif

                            {!! Form::open(['action'=>['invernaderoLaboresCulturalesController@modificar'],'class'=>'form-horizontal','role'=>'form', 'id' =>'formulario'] )  !!}



<<<<<<< HEAD
                            @include('Invernadero.LaboresCulturales.Partials.form')
=======
                            @include('Invernadero.laboresCulturales.Partials.form')
>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57
                            <input type="hidden" name="id" value="{{$laboresCulturales->id}}">
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- FIN CONSULTAR FUNCIONES -->
                </div>
            </section>
        </section>
    </section>
</section>

<<<<<<< HEAD
@include('Invernadero.LaboresCulturales.Partials.validator')

@include('Invernadero.LaboresCulturales.Partials.ajaxScript')
=======
@include('Invernadero.laboresCulturales.Partials.validator')

@include('Invernadero.laboresCulturales.Partials.ajaxScript')
>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57

@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')
