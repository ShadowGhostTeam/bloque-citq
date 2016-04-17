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
    @include('Administracion.Maquinaria.aside')
    <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3 style="color:#078006"><i class="fa fa-angle-right"></i>Maquinaria</h3>
                <div class="row mt">
                    <!-- INICIO CONTENIDO -->
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4><i class="fa fa-angle-right"></i>Búsqueda</h4>
                            @include('Partials.Mensajes.mensajes')
                            <div class="form-group" align="right">
                                <a href="{{route('administracion/maquinaria/crear')}}"> <button class="btn agregar tooltips" data-placement="left" data-original-title="Agregar"><i class="fa fa-plus"></i></i></button></a>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!! Form::open(['route' => 'administracion/maquinaria/lista' ,'method'=>'GET']) !!}
                                    <div class="form-group">

                                        <div class="col-lg-3">
                                            <select  class="form-control" id="nombre" name="nombre">
                                                <option value="">Todas las máquinas</option>
                                                @if( isset($combo))
                                                    @foreach($combo as $maquina)
                                                        <option value="{{  $maquina->id  }}" > {{ $maquina->nombre}}  </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <button type="submit" class="btn btn-default" >
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                Buscar
                                            </button>




                                        </div>
                                    {!! Form::close() !!}
                                    <hr>


                                <div class="table-responsive">
                                <table class="table table-striped table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-thumb-tack"></i>  Nombre </th>
                                        <th> <i class="fa fa-calendar-o"></i> Descripción </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ( isset( $maquinaria) )
                                        @foreach( $maquinaria as $maquina )
                                            <tr>
                                                <td>{{ $maquina->nombre }}</td>
                                                <td>{{ $maquina->descripcion }}</td>
                                                <td style="width: 5px">
                                                    <a href="{{ route('administracion/maquinaria/consultar/item',$maquina->id) }}"><button class="btn btn-success btn-xs tooltips" data-placement="top" data-original-title="Consultar"><i class="fa fa-eye"></i></button></a>
                                                </td>
                                                <td style="width: 5px">
                                                    <a href="{{ route('administracion/maquinaria/modificar/item',$maquina->id) }}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Modificar"><i class="fa fa-pencil"></i></button></a>
                                                </td>
                                                <td style="width: 5px">
                                                    {!! Form::open(['action'=>['maquinariaController@eliminar'],'role'=>'form'] )  !!}
                                                    <button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar" onclick='return confirm("¿Seguro que desea eliminar esta máquina?")'><i class="fa fa-trash-o "></i></button>
                                                    <input type="hidden" name="id" value={{$maquina->id}}>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                </div>
                                    @if (isset($maquinaria))
                                        {!! $maquinaria->setPath('')->appends(Input::query())->render()!!}
                                    @endif
                            </div>
                        </div>
                        </div>
                    <!-- FIN CONTENIDO -->
                    </div>
                </div>
            </section>
        </section>
    </section>
    </section>
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')