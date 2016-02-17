
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <li class="sub-menu">
                <a href="#" >
                    <i class="fa fa-film"></i>
                    <span>{{ trans('validation.attributes.Peliculas')  }} &nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('peliculas')}}">
                            <i class="fa fa-film"></i>
                            <span>{{ trans('validation.attributes.Pelicula')  }} </span>
                        </a></li>

                    <li><a href="{{route('realizadores')}}" >
                            <i class="fa fa-hand-o-up fa-lg"></i>
                            <span>{{ trans('validation.attributes.Realizadores')  }} </span>
                        </a></li>

                    <li><a href="{{route('traficos')}}" >
                            <i class="fa fa-envelope"></i>
                            <span>{{ trans('validation.attributes.Trafico')  }} </span>
                        </a></li>

                </ul>
            </li>

            <li class="sub-menu">
                <a href="{{route('funciones')}}" >
                    <i class="fa fa-video-camera"></i>
                    <span>{{ trans('validation.attributes.Funcion')  }} </span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="{{route('programas')}}" >
                    <i class="fa fa-tasks"></i>
                    <span>{{ trans('validation.attributes.Programa')  }} </span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="{{route('festivales')}}">
                    <i class="fa fa-ticket"></i>
                    <span>{{ trans('validation.attributes.Festival')  }} </span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="{{route('sedes')}}" >
                    <i class="fa fa-map-marker"></i>
                    <span>{{ trans('validation.attributes.Sedes')  }} </span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="{{route('integrantes')}}">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('validation.attributes.Integrantes')  }} </span>
                </a>
            </li>

            <li class="sub-menu">
                <a  href="#" >
                    <i class="fa fa-thumbs-o-up "></i>
                    <span>{{ trans('validation.attributes.Patrocinios')  }}  &nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('caracteristicas')}}">
                            <i class="fa fa-check-square-o"></i>
                            <span>{{ trans('validation.attributes.Caracteristicas')  }} </span>
                        </a></li>

                    <li><a href="{{route('paquetes')}}">
                            <i class="fa fa-cubes"></i>
                            <span>{{ trans('validation.attributes.Paquetes')  }} </span>
                        </a></li>

                    <li><a href="{{route('patrocinadores')}}" >
                            <i class="fa fa-thumbs-o-up"></i>
                            <span>{{ trans('validation.attributes.Patrocinadores')  }} </span>
                        </a></li>

                </ul>
            </li>

            <li class="sub-menu">
                <a href="#">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>{{ trans('validation.attributes.Reportes')  }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('reportesFuncion')}}">
                            <i class="fa fa-video-camera"></i>
                            <span>{{ trans('validation.attributes.ReportesFunciones')  }} </span>
                        </a></li>

                    <li><a href="{{route('reportesPais')}}">
                            <i class="fa fa-globe"></i>
                            <span>{{ trans('validation.attributes.ReportesPaises')  }} </span>
                        </a></li>

                    <li><a href="{{route('reportesSede')}}">
                            <i class="fa fa-map-marker"></i>
                            <span>{{ trans('validation.attributes.ReportesSedes')  }} </span>
                        </a></li>

                    <li><a href="{{route('reportesPrograma')}}">
                            <i class="fa fa-tasks"></i>
                            <span>{{ trans('validation.attributes.ReportesProgramas')  }} </span>
                        </a></li>

                    <li><a href="{{route('reportesFestival')}}">
                            <i class="fa fa-ticket"></i>
                            <span>{{ trans('validation.attributes.ReportesFestivales')  }} </span>
                        </a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="{{route('configuracion')}}" class="active" >
                    <i class="fa fa-cog"></i>
                    <span>{{ trans('validation.attributes.Configuracion')  }} </span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>