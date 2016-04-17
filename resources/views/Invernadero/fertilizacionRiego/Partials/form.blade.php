

<div class="row" >

    <div class="col-md-3">

        <div class="form-group">
            <div class="col-lg-12">

            </div>
        </div>
    </div>



    <div class="col-md-6" align="center">
        <p align="left" class="help-block"> (*) Obligatorio </p><br>

        <div class="form-group">
            <label for="Invernadero" class="col-lg-2 control-label"><strong>*</strong>Invernadero</label>
            <div class="col-lg-10">

                <select  class="form-control" id="invernadero" name="invernadero">
                    <option value="">Selecciona</option>

                    @if( isset($fertilizacionesRiego))
                        @foreach($invernaderos as $invernadero)
                            @if($fertilizacionesRiego->id_invernadero == $invernadero->id)
                                <option value="{{  $invernadero->id  }}" selected > {{ $invernadero->nombre}}  </option>
                            @else
                                <option value="{{  $invernadero->id  }}" > {{ $invernadero->nombre}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($invernaderos as $invernadero)
                            <option value="{{  $invernadero->id  }}" > {{ $invernadero->nombre}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Siembra" class="col-lg-2 control-label"><strong>*</strong>Transplante</label>
            <div class="col-lg-10">

                <select  class="form-control" id="siembraT" name="siembraT">
                    <option value="">Selecciona</option>

                    @if( isset($fertilizacionesRiego))

                        @foreach($siembras as $siembra)
                            @if($siembraSeleccionada['id_siembra'] == $siembra['id_siembra'])
                                <option value="{{  $siembra['id_siembra']  }}" selected > {{ $siembra['nombre']."   ". $siembra['variedad'] . " - ". $siembra['fecha'] }}  </option>
                            @else
                                <option value="{{  $siembra['id_siembra']  }}"  > {{ $siembra['nombre']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                            @endif
                        @endforeach

                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Fecha" class="col-lg-2 control-label"><strong>*</strong>Fecha</label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($fertilizacionesRiego))
                        {!!Form::text('fecha' ,$fertilizacionesRiego->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="tiempoRiego" class="col-lg-2 control-label"><strong>*</strong>Tiempo Riego</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionesRiego))
                    {!!Form::text('tiempoRiego' ,$fertilizacionesRiego->tiempoRiego,['class'=>'form-control','id'=>'tiempoRiego','placeholder'=>'Tiempo de riego'])!!}
                @else
                    {!!Form::text('tiempoRiego' ,null,['class'=>'form-control','id'=>'tiempoRiego','placeholder'=>'Tiempo de riego'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="etapaFenologica" class="col-lg-2 control-label">Etapa Fenológica</label>
            <div class="col-lg-10">

                <select  class="form-control" id="etapaFenologica" name="etapaFenologica">
                    <option value="">Selecciona</option>

                    @if( isset($fertilizacionesRiego))

                        @foreach($etapaFenologica as $etapa)
                            @if($fertilizacionesRiego->etapaFenologica == $etapa)
                                <option value="{{  $etapa   }}" selected > {{ $etapa }}  </option>
                            @else
                                <option value="{{  $etapa  }}" > {{ $etapa }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($etapaFenologica as $etapa)
                            <option value="{{  $etapa  }}" > {{ $etapa }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tiempoRiego" class="col-lg-2 control-label">Frecuencia</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionesRiego))
                    {!!Form::text('frecuencia' ,$fertilizacionesRiego->frecuencia,['class'=>'form-control','id'=>'frecuencia','placeholder'=>'Frecuencia'])!!}
                @else
                    {!!Form::text('frecuencia' ,null,['class'=>'form-control','id'=>'frecuencia','placeholder'=>'Frecuencia'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Formulacion" class="col-lg-2 control-label">Formulación</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionesRiego))
                    {!!Form::textarea('formulacion' ,$fertilizacionesRiego->formulacion,['class'=>'form-control','id'=>'formulacion','placeholder'=>'Formulación'])!!}
                @else
                    {!!Form::textarea('formulacion' ,null,['class'=>'form-control','id'=>'formulacion','placeholder'=>'Formulación'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($fertilizacionesRiego))

                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la fertilización?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>



    </div>

</div>
