@include('Partials.ScriptsGenerales.scriptsPartials')
<body>

<section id="container" >
    @include('Partials.ScriptsGenerales.headerPartials')
    <!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    @include('Home.aside')
            <!--sidebar end-->

    <section id="container">
        <section id="main-content">
            <section class="wrapper site-min-height">
                <div class="espacio"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-tabla">
                    <table class="table-bordered tabla-inicio">
                        <tr>
                            <th colspan="4">
                                Siembras en los Sectores
                            </th>
                        </tr>
                        <tr>
                            <td id="sector">
                                @if($siembras_sector1 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector1 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector2 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector2 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector3 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector3 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector4 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector4 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td id="sector">
                                @if($siembras_sector5 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector5 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector6 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector6 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector7 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector7 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector8 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector8 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td id="sector">
                                @if($siembras_sector9 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector9 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector10 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector10 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector11 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector11 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="sector">
                                @if($siembras_sector12 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_sector12 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-tabla">
                    <table class="table-bordered tabla-inicio">
                        <tr>
                            <th colspan="4">
                                Siembras en los Invernaderos
                            </th>
                        </tr>
                        <tr>
                            <td id="invernadero">
                                @if($siembras_invernadero1 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_invernadero1 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="invernadero">
                                @if($siembras_invernadero2 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_invernadero2 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td id="invernadero">
                                @if($siembras_invernadero3 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_invernadero3 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                            <td id="invernadero">
                                @if($siembras_invernadero4 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_invernadero4 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-tabla">
                    <table class="table-bordered tabla-inicio">
                        <tr>
                            <th>
                                Siembras en el Invernadero de Plántula
                            </th>
                        </tr>
                        <tr>
                            <td id="invernadero-plantula">
                                @if($siembras_invernaderoPlantula1 == "[]")
                                    {{ "Sin siembras" }}
                                @else
                                    @foreach($siembras_invernaderoPlantula1 as $siembra)
                                        {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>



            </section>
        </section>
    </section>
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')