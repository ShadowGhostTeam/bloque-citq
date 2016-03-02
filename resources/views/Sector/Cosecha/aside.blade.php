
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <li class="sub-menu">
                <a href="#"  class="active">
                    <i class="fa fa-th"></i>
                    <span>Sector&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="sub">
                    <li><a href="{{route('sector/preparacion')}}">
                            <i class="glyphicon glyphicon-tree-deciduous"></i>
                            <span>Preparación </span>
                        </a></li>

                    <li><a href="#">
                            <i class="fa fa-leaf"></i>
                            <span>Siembra </span>
                        </a></li>

                    <li><a href="{{route('sector/fertilizacion')}}" >
                            <i class="fa fa-tasks"></i>
                            <span>Fertilización </span>
                        </a></li>
                    <li><a href="#" >
                            <i class="fa fa-tint"></i>
                            <span>Riego </span>
                        </a></li>
                    <li><a href="#" >
                            <i class="fa fa-wrench"></i>
                            <span>Mantenimiento </span>
                        </a></li>
                    <li><a href="{{route('sector/preparacion')}}" class="active">
                            <i class="fa fa-reply-all"></i>
                            <span>Cosecha </span>
                        </a></li>

                </ul>
            </li>


            <li class="sub-menu">
                <a href="#" >
                    <i class="fa fa-cog"></i>
                    <span>Configuración </span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>