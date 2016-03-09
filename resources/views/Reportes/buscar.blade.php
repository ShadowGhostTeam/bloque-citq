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
                                            <div class="col-lg-3">
                                                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                                                        {!!Form::text('fechaInicio' ,null,['class'=>'form-control','id'=>'fechaInicioDP','placeholder'=>'Fecha inicial'])!!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">


                                            <div class="col-lg-3">
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
                                            {!!Form::checkbox('filtros[]' ,'preparaciones',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                             Preparaciones
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('filtros[]' ,'siembras',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Siembras
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('filtros[]' ,'fertilizaciones',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Fertilizaciones
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('filtros[]' ,'riegos',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Riegos
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('filtros[]' ,'mantenimientos',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Mantenimientos
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                {!!Form::checkbox('filtros[]' ,'cosechas',['class'=>'form-control','value'=>'Preparaciones','id'=>'chkPreparaciones'])!!}
                                                Cosechas
                                            </label>
                                        </div>
                                    </div>



                                        <div class="form-group" align="center">
                                            <div class="col-lg-12">
                                            &nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-default"  >
                                                <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                                                Generar reporte
                                            </button>
                                                </div>
                                        </div>

                                        {!! Form::close() !!}



                        </div>
                    </div>

                            <hr>
                    @if (isset($arrays))

                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php $active=true;?>
                                    @if($filtros['preparaciones'])

                                    <li role="presentation"  @if($active)class="active" <?php $active=false;?>@endif><a href="#preparaciones" aria-controls="preparaciones" role="tab" data-toggle="tab">Preparaciones</a></li>
                                    @endif
                                    @if($filtros['siembras'])
                                    <li role="presentation"@if($active)class="active" <?php $active=false;?>@endif><a href="#siembras" aria-controls="siembras" role="tab" data-toggle="tab">Siembras</a></li>
                                    @endif
                                    @if($filtros['fertilizaciones'])
                                    <li role="presentation"@if($active)class="active" <?php $active=false;?>@endif><a href="#fertilizaciones" aria-controls="fertilizaciones" role="tab" data-toggle="tab">Fertilizaciones</a></li>
                                    @endif
                                    @if($filtros['riegos'])
                                    <li role="presentation"@if($active)class="active" <?php $active=false;?>@endif><a href="#riegos" aria-controls="riegos" role="tab" data-toggle="tab">Riegos</a></li>
                                    @endif
                                     @if($filtros['mantenimientos'])
                                    <li role="presentation"@if($active)class="active" <?php $active=false;?>@endif><a href="#mantenimientos" aria-controls="mantenimientos" role="tab" data-toggle="tab">Mantenimientos</a></li>
                                    @endif
                                    @if($filtros['cosechas'])
                                    <li role="presentation"@if($active)class="active" <?php $active=false;?>@endif><a href="#cosechas" aria-controls="cosechas" role="tab" data-toggle="tab">Cosechas</a></li>
                                     @endif
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php $active=true;?>
                                    @if($filtros['preparaciones'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="preparaciones">

                                        <div class="table-responsive">
                                            <table  class="table table-striped table-advance table-hover table_sort"  >
                                                <thead >
                                                <tr>
                                                    <th><i ></i>#</th>
                                                    <th><i ></i> Sector</th>
                                                    <th><i ></i> Maquinaria </th>
                                                    <th><i ></i> Pasadas</th>
                                                    <th><i></i> Fecha</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0;?>
                                                @foreach ($arrays[0][0] as $resultado)
                                                    @if($resultado['Sector']!="")
                                                    <?php $i++;?>
                                                    <tr>
                                                        <td style="width: 5%"><?php echo $i;?></td>
                                                        <td style="width: 25%">{{$resultado['Sector']}}</td>
                                                            <td style="width: 25%">{{$resultado['Maquinaria']}}</td>
                                                        <td style="width: 10%">{{$resultado['Número de pasadas']}}</td>
                                                        <td style="width: 25%">{{$resultado['Fecha']}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif


                                    @if($filtros['siembras'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="siembras">
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-advance table-hover table_sort"  >
                                                <thead >
                                                <tr>
                                                    <th><i ></i>#</th>
                                                    <th><i ></i> Sector</th>
                                                    <th><i ></i> Cultivo </th>
                                                    <th><i ></i> Variedad</th>
                                                    <th><i></i> Tipo de siembra</th>
                                                    <th><i></i> Temporada</th>
                                                    <th><i></i> Fecha de siembra</th>
                                                    <th><i></i>Status</th>
                                                    <th><i></i>Fecha terminación</th>
                                                    <th><i></i>Comentario</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0;?>
                                                @foreach ($arrays[1][0] as $resultado)
                                                    @if($resultado['Sector']!="")
                                                        <?php $i++;?>
                                                        <tr>
                                                            <td style="width: 5%"><?php echo $i;?></td>
                                                            <td >{{$resultado['Sector']}}</td>
                                                            <td>{{$resultado['Cultivo']}}</td>
                                                            <td >{{$resultado['Variedad']}}</td>
                                                            <td >{{$resultado['Tipo de siembra']}}</td>
                                                            <td >{{$resultado['Temporada']}}</td>
                                                            <td >{{$resultado['Fecha de siembra']}}</td>
                                                            <td >{{$resultado['Status']}}</td>
                                                            <td >{{$resultado['Fecha de terminación']}}</td>
                                                            <td >{{$resultado['Comentario']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif

                                    @if($filtros['fertilizaciones'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="fertilizaciones">
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-advance table-hover table_sort"  >
                                                <thead >
                                                <tr>
                                                    <th><i ></i>#</th>
                                                    <th><i ></i> Sector</th>
                                                    <th><i ></i> Siembra</th>
                                                    <th><i ></i> Tipo</th>
                                                    <th><i></i> Fuente</th>
                                                    <th><i></i> Cantidad</th>
                                                    <th><i></i> Programa NPK</th>
                                                    <th><i></i> Fecha</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0;?>
                                                @foreach ($arrays[2][0] as $resultado)
                                                    @if($resultado['Sector']!="")
                                                        <?php $i++;?>
                                                        <tr>
                                                            <td style="width: 5%"><?php echo $i;?></td>
                                                            <td >{{$resultado['Sector']}}</td>
                                                            <td >{{$resultado['Siembra']}}</td>
                                                            <td >{{$resultado['Tipo']}}</td>
                                                            <td >{{$resultado['Fuente']}}</td>
                                                            <td >{{$resultado['Cantidad']}}</td>
                                                            <td >{{$resultado['Programa NPK']}}</td>
                                                            <td >{{$resultado['Fecha']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif

                                    @if($filtros['riegos'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="riegos">
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-advance table-hover table_sort"  >
                                                <thead >
                                                <tr>
                                                    <th><i ></i>#</th>
                                                    <th><i ></i> Sector</th>
                                                    <th><i ></i> Siembra</th>
                                                    <th><i ></i> Tiempo</th>
                                                    <th><i></i> Dist. líneas</th>
                                                    <th><i></i> Litros/ha</th>
                                                    <th><i></i> Lámina</th>
                                                    <th><i></i> Fecha</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0;?>
                                                @foreach ($arrays[3][0] as $resultado)
                                                    @if($resultado['Sector']!="")
                                                        <?php $i++;?>
                                                        <tr>
                                                            <td style="width: 5%"><?php echo $i;?></td>
                                                            <td >{{$resultado['Sector']}}</td>
                                                            <td >{{$resultado['Siembra']}}</td>
                                                            <td >{{$resultado['Tiempo']}}</td>
                                                            <td >{{$resultado['Distancia entre líneas']}}</td>
                                                            <td >{{$resultado['Litros/Hectárea']}}</td>
                                                            <td >{{$resultado['Lámina']}}</td>
                                                            <td >{{$resultado['Fecha']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif

                                    @if($filtros['mantenimientos'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="mantenimientos">
                                        <div role="tabpanel" class="tab-pane" id="riegos">
                                            <div class="table-responsive">
                                                <table  class="table table-striped table-advance table-hover table_sort"  >
                                                    <thead >
                                                    <tr>
                                                        <th><i ></i>#</th>
                                                        <th><i ></i> Sector</th>
                                                        <th><i ></i> Siembra</th>
                                                        <th><i ></i> Actividad</th>
                                                        <th><i></i> Tipo aplicación</th>
                                                        <th><i></i> Producto</th>
                                                        <th><i></i> Cantidad</th>
                                                        <th><i></i> Fecha</th>
                                                        <th><i></i> Comentario</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i=0;?>
                                                    @foreach ($arrays[4][0] as $resultado)
                                                        @if($resultado['Sector']!="")
                                                            <?php $i++;?>
                                                            <tr>
                                                                <td style="width: 5%"><?php echo $i;?></td>
                                                                <td >{{$resultado['Sector']}}</td>
                                                                <td >{{$resultado['Siembra']}}</td>
                                                                <td >{{$resultado['Actividad']}}</td>
                                                                <td >{{$resultado['Tipo de aplicación']}}</td>
                                                                <td >{{$resultado['Producto']}}</td>
                                                                <td >{{$resultado['Cantidad']}}</td>
                                                                <td >{{$resultado['Fecha']}}</td>
                                                                <td >{{$resultado['Comentario']}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($filtros['cosechas'])
                                    <div role="tabpanel" @if($active)class="tab-pane active" <?php $active=false;?>@else class="tab-pane"@endif  id="cosechas">
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-advance table-hover table_sort"  >
                                                <thead >
                                                <tr>
                                                    <th><i ></i>#</th>
                                                    <th><i ></i> Sector</th>
                                                    <th><i ></i> Siembra</th>
                                                    <th><i ></i> Fecha</th>
                                                    <th><i></i> Descripción</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0;?>
                                                @foreach ($arrays[5][0] as $resultado)
                                                    @if($resultado['Sector']!="")
                                                        <?php $i++;?>
                                                        <tr>
                                                            <td style="width: 5%"><?php echo $i;?></td>
                                                            <td >{{$resultado['Sector']}}</td>
                                                            <td >{{$resultado['Siembra']}}</td>
                                                            <td >{{$resultado['Fecha']}}</td>
                                                            <td >{{$resultado['Descripción']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>

                                <div class="col-xs-12" align="center">
                                    <a href="{{route('reportes/sector/excel',$string,$filtros)}}">
                                        <button class="btn btn-success">Exportar a excel</button>
                                    </a>
                                </div>

                @endif
                    <!-- FIN CONTENIDO -->

                </div>
                    </div>
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
                    sector: {
                        validators: {
                        }
                    },
                    cultivo: {
                        validators: {
                        }
                    },
                    'filtros[]': {
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