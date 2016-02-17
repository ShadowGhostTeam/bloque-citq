<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>DocumentaQro</title>
  </head>

<style>
html, body{
  height: 100%;
}

#estiloTop{
  width: 250px;
  height: 50px;
  position: absolute;
  border: 4;

}

#estiloBottom{
  width: 100%;
  height: 25px;
}

#header{
    width: 100%;
    height: 80px;
    background-color: #221D1E;
}

#rosa{
  width: 100%;
  height: 10px;
  background-color: #F70782;
}

#footer {
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
}


#contenedorImagen{

    background-image: url(oso.jpg);
    background-repeat: no-repeat;
    background-position: left ;
    height: 400px;
    width: 400px;
}
</style>

<style>
html {
  font-family: sans-serif;
  -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
body {
  margin: 0;
}



@font-face {
    font-family: 'Glyphicons Halflings';

}
* {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
*:before,
*:after {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}

html {
  font-size: 10px;

  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
}




@media (min-width: 768px) {
  .dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: left;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
}
dl {
  margin-top: 0;
  margin-bottom: 20px;
}
dt,
dd {
  line-height: 1.42857143;
}
dt {
  font-weight: bold;
}
dd {
  margin-left: 0;
}

</style>

  <body>

    <div id="header">
      <div><br>
           <img id="estiloTop" src="assets/img/DQ2.png">
      </div>
    </div>
    <div id="rosa"></div>

<br>
<table  style="width: 100%" >

    <tr>
        <td>
            <img width="300" height="400" src="{{asset ($funcionesItem->poster)}}">
        </td>
    <td style="width: 10%"></td>
    <td  style="width: 60%">
                <dl class="dl-horizontal">
                    @if (isset($funcionesItem))
                    <dt>Tìtulo de la función</dt><dd>{{$funcionesItem->titulo}}</dd>
                    <dt>Fecha</dt><dd>{{$funcionesItem->fecha}}</dd>
                    <dt>Sede</dt><dd>{{ $funcionesItem->sedes->descripcion}}</dd>
                    <dt>Asistencia</dt><dd>{{ $funcionesItem->asistencia}}</dd>
                    <dt>Status</dt><dd>{{ $funcionesItem->status}}</dd>
                    <dt>Peliculas</dt>
                    @foreach ($funcionesPeliculas as $pelicula)
                    <dd>{{$pelicula->titulo}}</dd>
                    @endforeach
                    <dt>Programa</dt>
                    <dd>
                        @if (isset($funcionesProgramas))
                        {{$funcionesProgramas->titulo}}
                        @else
                        No tiene programa
                        @endif
                    </dd>
                    <dt>Festival</dt>
                    <dd>
                        @if (isset($funcionesFestivales))
                        {{$funcionesFestivales->titulo}}
                        @else
                        No tiene festival
                        @endif
                    </dd>
                    <dt>Patrocinadores</dt>
                    @if(isset($funcionesPatrocinadores)&&!$funcionesPatrocinadores->isEmpty())
                    @foreach ($funcionesPatrocinadores as $patrocinador)
                    <dd>{{$patrocinador->nombre}}</dd>
                    @endforeach
                    @else
                    No tiene patrocinadores
                    @endif
                    <dt>Programado por</dt>
                    <dd>
                        @if ($funcionesItem->programadopor!="")
                        {{$funcionesItem->programadopor}}

                        @else
                        No tiene encargado de programar
                        @endif
                    </dd>
                    @endif
                </dl>
    </td>
</tr>
</table>

    <div id="footer"> 
           <img id ="estiloBottom" src="assets/img/reportes_bottom.png">
    </div>
  </body>
</html>