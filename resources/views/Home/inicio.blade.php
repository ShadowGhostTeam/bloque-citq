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
                <table>
                    <tr>
                        <td>Invernadero 1</td>
                        <td>Invernadero 2</td>
                        <td>Sector 1</td>
                        <td>Sector 2</td>
                        <td>Sector 3</td>
                        <td>Sector 4</td>
                    </tr>
                    <tr>
                        <td>Invernadero 3</td>
                        <td>Invernadero 4</td>
                        <td>Sector 5</td>
                        <td>Sector 6</td>
                        <td>Sector 7</td>
                        <td>Sector 8</td>
                    </tr>
                    <tr>
                        <td colspan="2">Invernadero Plantula</td>
                        <td>Sector 9</td>
                        <td>Sector 10</td>
                        <td>Sector 11</td>
                        <td>Sector 12</td>
                    </tr>
                </table>
            </section>
        </section>
    </section>
@include('Partials.ScriptsGenerales.scriptsPartialsAbajo')