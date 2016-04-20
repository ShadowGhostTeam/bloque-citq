
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            @permission('sector')
            <li class="sub-menu">
                <a href="{{route('home')}}">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="#" >
                    <i class="fa fa-th"></i>
                    <span>Sector&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('sector/preparacion')}}">
                            <i class="glyphicon glyphicon-tree-deciduous"></i>
                            <span>Preparación </span>
                        </a></li>

                    <li><a href="{{route('sector/siembra')}}">
                            <i class="fa fa-leaf"></i>
                            <span>Siembra </span>
                        </a></li>

                    <li><a href="{{route('sector/fertilizacion')}}" >
                            <i class="fa fa-tasks"></i>
                            <span>Fertilización </span>
                        </a></li>
                    <li><a href="{{route('sector/riego')}}" >
                            &nbsp;<i class="fa fa-tint"></i>
                            <span>&nbsp;Riego </span>
                        </a></li>
                    <li><a href="{{route('sector/mantenimiento')}}" >
                            <i class="fa fa-wrench"></i>
                            <span>Mantenimiento </span>
                        </a></li>
                    <li><a href="{{route('sector/cosecha')}}" >
                            <i class="fa fa-reply-all"></i>
                            <span>Cosecha </span>
                        </a></li>

                </ul>
            </li>
            @endpermission

            @permission('invernadero')
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-th-large"></i>
                    <span>Invernadero&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('invernadero/preparacion')}}" >
                            <i class="glyphicon glyphicon-tree-deciduous"></i>
                            <span>Preparación </span>
                        </a></li>

                    <li><a href="{{route('invernadero/siembra')}}" >
                            <i class="fa fa-leaf"></i>
                            <span>Siembra </span>
                        </a></li>

                    <li><a href="{{route('invernadero/laboresCulturales')}}"  >
                            <i class="fa fa-tasks"></i>
                            <span>Labores culturales</span>
                        </a></li>
                    <li><a href="{{route('invernadero/fertilizacionRiego')}}" >
                            &nbsp;<i class="fa fa-tint"></i>
                            <span>&nbsp;Fertilización/Riego </span>
                        </a></li>
                    <li><a href="{{route('invernadero/aplicacionMantenimiento')}}" >
                            <i class="fa fa-wrench"></i>
                            <span>Aplicaciones Mant.</span>
                        </a></li>
                    <li><a href="{{route('invernadero/cosecha')}}" >
                            <i class="fa fa-reply-all"></i>
                            <span>Cosecha </span>
                        </a></li>

                </ul>
            </li>
            @endpermission


            @permission('invernaderoplantula')
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-stop"></i>
                    <span>Inv. Plántula&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('plantula/siembra')}}">
                            <i class="fa fa-leaf"></i>
                            <span>Siembra </span>
                        </a></li>

                    <li><a href="{{route('plantula/aplicaciones')}}" >
                            <i class="fa fa-tasks"></i>
                            <span>Aplicaciones</span>
                        </a></li>
                    <li><a href="#" >
                            &nbsp;<i class="fa fa-tint"></i>
                            <span>&nbsp;Riego </span>
                        </a></li>
                    <li><a href="{{route('plantula/salidaplanta')}}" >
                            <i class="fa fa-reply-all"></i>
                            <span>Salida planta</span>
                        </a></li>

                </ul>
            </li>
            @endpermission

            @permission('reportes')
            <li class="sub-menu">
                <a href="#"  class="active">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Reportes&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('reportes/sector')}}" >
                            <i class="fa fa-th"></i>
                            <span>Sector</span>
                        </a></li>

                    <li><a href="{{route('reportes/invernadero')}}"  class="active">
                            <i class="fa fa-th-large"></i>
                            <span>Invernadero</span>
                        </a></li>

                    <li><a href="{{route('reportes/plantula')}}"  >
                            <i class="fa fa-stop"></i>
                            <span>Inv. Plántula</span>
                        </a></li>



                </ul>
            </li>
            @endpermission


            @permission('administracion')
            <li class="sub-menu">
                <a href="#"  >
                    <i class="fa fa-cogs" ></i>
                    <span>Administración&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    @permission('gestionarusuarios')
                    <li><a href="{{route('administracion/usuarios')}}" >
                            <i class="fa fa-users"></i>
                            <span>Usuarios</span>
                        </a></li>
                    @endpermission

                    <li><a href="{{route('administracion/cultivos')}}" >
                            <i class="fa fa-leaf"></i>
                            <span>Cultivo</span>
                        </a></li>

                    <li><a href="{{route('administracion/maquinaria')}}" >
                            <i class="fa fa-truck"></i>
                            <span>Maquinaria</span>
                        </a></li>



                </ul>
            </li>
            @endpermission


            <li class="sub-menu">
                <a href="{{route('configuracion')}}" >
                    <i class="fa fa-cog"></i>
                    <span>Configuración </span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>