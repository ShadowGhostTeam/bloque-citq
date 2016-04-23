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
    <style>
        .text{
            padding-top: 5px;
        }
        .green-darker{
            border-radius: 5px;
            padding: 5px;
            background-color:#3a6732 ;
        }

        #sector{

            border-radius: 5px;
            color: white;
            min-height: 150px;
        }
        #link{
            color: white;
        }
        .brown-darker{
            border-radius: 5px;
            padding: 5px;
            background-color:#795520 ;
        }
        hr{
            border: 2px solid;
            border-color: white;
            background-color:white;
            color: white;
        }
        .brown{
            background-color:#986b28 ;
        }
        .green{
            background-color:#4D8942 ;
        }
        .green-text{
            color: rgb(77, 137, 66);
        }
        .container-fluid{
            background-color: white;
        }
        .block{
            padding-bottom: 20px;
        }
    </style>
    <section id="container" >
        <section id="main-content">
            <section class="wrapper site-min-height">
                <div class="espacio"></div>
                <div class ="container-fluid">
                    <h2 class ="green-text"><i class="fa fa-angle-right"></i>Siembras en los sectores</h2>
                    <div class="row text-center">
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector1 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 1</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 1</h4>
                                    </div>
                                    @foreach($siembras_sector1 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector2 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 2</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 2</h4>
                                    </div>
                                    @foreach($siembras_sector2 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector3 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 3</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 3</h4>
                                    </div>
                                    @foreach($siembras_sector3 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector4 == "[]")
                                <div class="brown" id='sector'>
                                    <h4> Sector 4</h4>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 4</h4>
                                    </div>
                                    @foreach($siembras_sector4 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector5 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 5</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 5</h4>
                                    </div>
                                    @foreach($siembras_sector5 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector6 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 6</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 6</h4>
                                    </div>
                                    @foreach($siembras_sector6 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector7 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 7</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 7</h4>
                                    </div>
                                    @foreach($siembras_sector7 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector8 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 8</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 8</h4>
                                    </div>
                                    @foreach($siembras_sector8 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector9 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 9</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 9</h4>
                                    </div>
                                    @foreach($siembras_sector9 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector10 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 10</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 10</h4>
                                    </div>
                                    @foreach($siembras_sector10 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector11 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 11</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 11</h4>
                                    </div>
                                    @foreach($siembras_sector11 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3 block">
                            @if($siembras_sector12 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Sector 12</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Sector 12</h4>
                                    </div>
                                    @foreach($siembras_sector12 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('sector/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class ="container-fluid">
                    <h2 class ="green-text"><i class="fa fa-angle-right"></i>Siembras en los invernaderos</h2>
                    <div class="row text-center">
                        <div class="col-xs-6 block">
                            @if($siembras_invernadero1 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Invernadero 1</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Invernadero 1</h4>
                                    </div>
                                    @foreach($siembras_invernadero1 as $siembra)
                                        <div class="text">
                                            <a id ="link" href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 block">
                            @if($siembras_invernadero2 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Invernadero 2</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Invernadero 2</h4>
                                    </div>
                                    @foreach($siembras_invernadero2 as $siembra)
                                        <div class="text">
                                            <a id="link" href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-6 block">
                            @if($siembras_invernadero3 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Invernadero 3</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Invernadero 3</h4>
                                    </div>
                                    @foreach($siembras_invernadero3 as $siembra)
                                        <div class="text">
                                            <a id="link" href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6 block">
                            @if($siembras_invernadero4 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Invernadero 4</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Invernadero 4</h4>
                                    </div>
                                    @foreach($siembras_invernadero4 as $siembra)
                                        <div class="text">
                                            <a id="link" href="{{ route('invernadero/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class ="container-fluid">
                    <h2 class ="green-text"><i class="fa fa-angle-right"></i>Siembras en el invernadero de plántula</h2>
                    <div class="row text-center">
                        <div class="container-fluid">
                            @if($siembras_invernaderoPlantula1 == "[]")
                                <div class="brown" id='sector'>
                                    <div class="brown-darker">
                                        <h4> Invernadero de plántula 1</h4>
                                    </div>
                                    <div class="text">
                                        {{ "Sin siembras" }}
                                    </div>
                                </div>
                            @else
                                <div class="green" id='sector'>
                                    <div class="green-darker">
                                        <h4> Invernadero de plántula 1</h4>
                                    </div>
                                    @foreach($siembras_invernaderoPlantula1 as $siembra)
                                        <div class="text">
                                            <a id="link" href="{{ route('plantula/siembra/consultar/item',$siembra->id) }}"> {{ $siembra->cultivo->nombre }} - {{ $siembra->variedad }} </a></br>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>
                </div>
            </section>
        </section>
    </section>
</section>
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')