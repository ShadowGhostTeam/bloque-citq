@include('Partials.ScriptsGenerales.scriptsPartials')
<body>
<script type="text/javascript">

    $(function () {

        //previene lo del input
        $('#fechaFinDP').keypress(function(event) {event.preventDefault();});
        //previene lo del input
        $('#fechaInicioDP').keypress(function(event) {event.preventDefault();});


        //VALIDAR FECHAS EN BUSQUEDA

        $('#fechaFinDP').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#fechaInicioDP').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#fechaInicioDP').datetimepicker();
        $('#fechaFinDP').datetimepicker({
            useCurrent: false //Important! See issue  #1075
        });
        $("#fechaInicioDP").on("dp.change", function (e) {
            $('#fechaFinDP').data("DateTimePicker").minDate(e.date);
        });
        $("#fechaFinDP").on("dp.change", function (e) {
            $('#fechaInicioDP').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>

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
    @include('Reportes.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3 style="color:#078006"><i class="fa fa-angle-right"></i>Reportes</h3>
                <div class="row mt">


                    <!-- INICIO CONTENIDO -->
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4><i class="fa fa-angle-right"></i>Sector</h4>
                            @include('Partials.Mensajes.mensajes')


                            <div class="row">
                                <div class="col-xs-12">



                                    {!! Form::open(['route' => 'reportes/sector/generar' ,'method'=>'GET','id'=>'formulario']) !!}

                                        <div class="form-group">

                                            <div class="col-lg-3">
                                                <select  class="form-control" id="sector" name="sector">
                                                    <option value="">Todos los sectores</option>

                                                    @if( isset($sectores))
                                                        @foreach($sectores as $sector)
                                                            <option value="{{  $sector->id  }}" > {{ $sector->nombre}}  </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-lg-3">
                                                <select  class="form-control" id="cultivo" name="cultivo">
                                                    <option value="">Todos los cultivos</option>

                                                    @if( isset($cultivos))
                                                        @foreach($cultivos as $cultivo)
                                                            <option value="{{  $cultivo->id  }}" > {{ $cultivo->nombre}}  </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                                                        {!!Form::text('fechaInicio' ,null,['class'=>'form-control','id'=>'fechaInicioDP','placeholder'=>'Fecha inicial'])!!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                                                    {!!Form::text('fechaFin' ,null,['class'=>'form-control','id'=>'fechaFinDP','placeholder'=>'Fecha final'])!!}
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">

                                        <div class="col-lg-12" align="center" >
                                            <label>
                                            {!!Form::checkbox('opciones[]' ,'preparaciones',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                             Preparaciones
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('opciones[]' ,'siembras',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Siembras
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('opciones[]' ,'fertilizaciones',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Fertilizaciones
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('opciones[]' ,'riegos',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Riegos
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('opciones[]' ,'mantenimientos',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Mantenimientos
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('opciones[]' ,'cosechas',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Cosechas
                                            </label>
                                        </div>
                                    </div>



                                        <div class="form-group" align="center">
                                            &nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-default"  >
                                                <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                                                Generar reporte
                                            </button>
                                        </div>

                                        {!! Form::close() !!}



                        </div>
                    </div>
                    <!-- FIN CONTENIDO -->

                </div>
            </section>
        </section>
    </section>


    <script type="text/javascript">

        $(document).ready(function() {

            $('#formulario').bootstrapValidator({
                message: 'Los valores no son válidos',
                feedbackIcons: {
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    'opciones[]': {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Seleccione al menos un filtro'
                            }
                        }
                    },
                    fechaInicio: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese fecha'
                            },
                            date: {
                                format: 'DD/MM/YYYY',
                                message: 'Ingrese en formato dd/mm/aaaa'
                            }
                        }
                    },
                    fechaFin: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese fecha'
                            },
                            date: {
                                format: 'DD/MM/YYYY',
                                message: 'Ingrese en formato dd/mm/aaaa'
                            }
                        }
                    }
                }
            });

            $('#fechaInicioDP').on('dp.change dp.show', function(e) {
                if ( $('#formulario').data('bootstrapValidator').revalidateField('fechaInicio') && ! $('#formulario').data('bootstrapValidator').revalidateField('fechaFin')) {
                    $('#formulario').data('bootstrapValidator').revalidateField('fechaFin');
                }


            });

            $('#fechaFinDP').on('dp.change dp.show', function(e) {
                if ( $('#formulario').data('bootstrapValidator').revalidateField('fechaFin') && ! $('#formulario').data('bootstrapValidator').revalidateField('fechaInicio')) {
                    $('#formulario').data('bootstrapValidator').revalidateField('fechaInicio');
                }

            });
        });
    </script>



@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')