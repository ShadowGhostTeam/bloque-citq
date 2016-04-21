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
                                > Siembras en los Sectores
                            </th>
                        </tr>
                        <tr class="titulos-menu">
                            <td>Sector 1</td>
                            <td>Sector 2</td>
                            <td>Sector 3</td>
                            <td>Sector 4</td>
                        </tr>
                        <tr>
                            @if($siembras_sector1 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector1 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector2 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector2 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector3 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector3 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector4 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector4 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                        <tr class="titulos-menu">
                            <td>Sector 5</td>
                            <td>Sector 6</td>
                            <td>Sector 7</td>
                            <td>Sector 8</td>
                        </tr>
                        <tr>
                            @if($siembras_sector5 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector5 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector6 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector6 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector7 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector7 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector8 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector8 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                        <tr class="titulos-menu">
                            <td>Sector 9</td>
                            <td>Sector 10</td>
                            <td>Sector 11</td>
                            <td>Sector 12</td>
                        </tr>
                        <tr>
                            @if($siembras_sector9 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector9 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector10 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector10 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector11 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector11 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_sector12 == "[]")
                                <td bgcolor='#986b28' id='sector'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='sector'>
                                    @foreach($siembras_sector12 as $siembra)
                                        <a href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-tabla">
                    <table class="table-bordered tabla-inicio">
                        <tr>
                            <th colspan="4">
                                > Siembras en los Invernaderos
                            </th>
                        </tr>
                        <tr class="titulos-menu">
                            <td>Invernadero 1</td>
                            <td>Invernadero 2</td>
                        </tr>
                        <tr>
                            @if($siembras_invernadero1 == "[]")
                                <td bgcolor='#986b28' id='invernadero'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='invernadero'>
                                    @foreach($siembras_invernadero1 as $siembra)
                                        <a href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_invernadero2 == "[]")
                                <td bgcolor='#986b28' id='invernadero'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='invernadero'>
                                    @foreach($siembras_invernadero2 as $siembra)
                                        <a href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                        <tr class="titulos-menu">
                            <td>Invernadero 3</td>
                            <td>Invernadero 4</td>
                        </tr>
                        <tr>
                            @if($siembras_invernadero3 == "[]")
                                <td bgcolor='#986b28' id='invernadero'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='invernadero'>
                                    @foreach($siembras_invernadero3 as $siembra)
                                        <a href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif

                            @if($siembras_invernadero4 == "[]")
                                <td bgcolor='#986b28' id='invernadero'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='invernadero'>
                                    @foreach($siembras_invernadero4 as $siembra)
                                        <a href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-tabla">
                    <table class="table-bordered tabla-inicio">
                        <tr>
                            <th>
                                > Siembras en el Invernadero de Plántula
                            </th>
                        </tr>
                        <tr class="titulos-menu">
                            <td>Invernadero de Plántula 1</td>
                        </tr>
                        <tr>
                            @if($siembras_invernaderoPlantula1 == "[]")
                                <td bgcolor='#986b28' id='invernadero-plantula'>
                                    {{ "Sin siembras" }}
                                </td>
                            @else
                                <td bgcolor='#4D8942' id='invernadero-plantula'>
                                    @foreach($siembras_invernaderoPlantula1 as $siembra)
                                        <a href="{{ route('plantula/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>



            </section>
        </section>
    </section>
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')