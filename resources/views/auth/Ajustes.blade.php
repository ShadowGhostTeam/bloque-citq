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
    @include('auth.ConfiguracionAside')


    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3 style="color:#078006"><i class="fa fa-angle-right"></i>{{ trans('validation.attributes.Configuracion')  }}</h3>

                <div class="row">
                    <!-- INICIO CONTENIDO -->

                    <div class="col-lg-12">

                        @include('Partials.Mensajes.mensajes')

                        <div class="form-panel">

                            <h4 class="mb"><i class="fa fa-angle-right"></i>{{trans('validation.attributes.contrasena')}}</h4>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">

                                    <p align="left" class="help-block"> (*) Obligatorio </p><br>

                            <div style="text-align: center">
                                {!! Form::open(['action'=>['contrasenaController@cambiarContrasena'],'class'=>'form-horizontal style-form','id'=>'formulario'])!!}

                                <div class="form-group">
                                    <label for="contrasena actual" class="col-sm-2 control-label"><strong>*</strong>{{trans('validation.attributes.contrasenaActual')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasenaActual' ,['class'=>'form-control','id'=>'contrasenaActual'])!!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Contrasena actual" class="col-sm-2 control-label"><strong>*</strong>{{trans('validation.attributes.contrasenaNueva')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasena' ,['class'=>'form-control','id'=>'contrasena'])!!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Confirmacion de contrasena" class="col-sm-2 control-label"><strong>*</strong>{{trans('validation.attributes.contrasenaConfirmar')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasena_confirmation' ,['class'=>'form-control','id'=>'contrasena_confirmation'])!!}
                                    </div>
                                </div>

                                {!! Form::submit('Guardar',['class'=>'btn btn-success','onclick'=>trans('validation.attributes.mensajeModificarContrasena')])!!}

                                {!! Form::close() !!}
                            </div>

                        </div></div></div>


                    </div>
                    <!-- FIN CONTENIDO -->

                </div>
            </section>
        </section>
    </section>
</section>

@include('auth.validator')
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')

