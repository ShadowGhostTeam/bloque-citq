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
                <h3 style="color:#F10687"><i class="fa fa-angle-right"></i>{{ trans('validation.attributes.Configuracion')  }}</h3>

                <div class="row">
                    <!-- INICIO CONTENIDO -->

                    <div class="col-lg-12">

                        @include('Partials.Mensajes.mensajes')

                        <div class="form-panel">

                            <h4 class="mb"><i class="fa fa-angle-right"></i>{{trans('validation.attributes.contrasena')}}</h4>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">



                            <div style="text-align: center">
                                {!! Form::open(['action'=>['ContrasenaController@cambiarContrasena'],'class'=>'form-horizontal style-form'])!!}

                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">{{trans('validation.attributes.contrasenaActual')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasenaActual' ,['class'=>'form-control'])!!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">{{trans('validation.attributes.contrasenaNueva')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasena' ,['class'=>'form-control'])!!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">{{trans('validation.attributes.contrasenaConfirmar')}}</label>
                                    <div class="col-sm-8">
                                        {!!Form::password('contrasena_confirmation' ,['class'=>'form-control'])!!}
                                    </div>
                                </div>

                                {!! Form::submit('Guardar',['class'=>'btn btn-success btn-xs tooltips','onclick'=>trans('validation.attributes.mensajeModificarContrasena')])!!}

                                {!! Form::close() !!}
                            </div>

                        </div></div></div>


                    </div>
                    <!-- FIN CONTENIDO -->

                </div>
            </section>
        </section>
    </section>>

@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')

