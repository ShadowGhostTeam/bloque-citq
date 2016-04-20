

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
            <label for="Invernadero" class="col-lg-2 control-label"><strong>*</strong>Invernadero Plántula</label>
            <div class="col-lg-10">
                @if(isset($invernadero))
                    <input type="hidden" value="1" name="invernadero"/>
                @endif
                <select  class="form-control" id="invernadero" name="invy" disabled>
                    <option value="">Selecciona</option>
                        @if( isset($riego))
                            @if(isset($invernadero))
                                <option value="{{ $invernadero }}" selected> {{ $invernadero->nombre }} </option>
                            @endif
                        @else
                            <option value="{{ $invernadero }}" selected> {{ $invernadero->nombre }} </option>
                        @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Siembra" class="col-lg-2 control-label"><strong>*</strong>Siembra Plántula</label>
            <div class="col-lg-10">

                <select  class="form-control" id="siembraPlantula" name="siembraPlantula">
                    <option value="">Selecciona</option>

                    @if( isset($riego))

                        @foreach($siembras as $siembra)
                            @if($siembraSeleccionada['id_siembra'] == $siembra['id_siembra'])
                                <option value="{{  $siembra['id_siembra']  }}" selected > {{ $siembra['variedad'] . " - ". $siembra['fecha'] }}  </option>
                            @else
                                <option value="{{  $siembra['id_siembra']  }}"  > {{ $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                            @endif
                        @endforeach

                    @else
                        @foreach($siembras as $siembra)
                            <option value="{{  $siembra['id']  }}"  > {{ $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tiempo" class="col-lg-2 control-label"><strong>*</strong>Tiempo (min.)</label>
            <div class="col-lg-10">
                @if( isset($riego))
                    {!!Form::text('tiempoRiego' ,$riego->tiempoRiego,['class'=>'form-control','id'=>'tiempoRiego','placeholder'=>'Tiempo en minutos'])!!}
                @else
                    {!!Form::text('tiempoRiego' ,null,['class'=>'form-control','id'=>'tiempo','placeholder'=>'Tiempo en minutos'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="tiempo" class="col-lg-2 control-label"><strong>*</strong>Frecuencia (min.)</label>
            <div class="col-lg-10">
                @if( isset($riego))
                    {!!Form::text('frecuencia' ,$riego->frecuencia,['class'=>'form-control','id'=>'frecuencia','placeholder'=>'Tiempo en minutos'])!!}
                @else
                    {!!Form::text('frecuencia' ,null,['class'=>'form-control','id'=>'frecuencia','placeholder'=>'Tiempo en minutos'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Fecha" class="col-lg-2 control-label"><strong>*</strong>Fecha</label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($riego))
                        {!!Form::text('fecha' ,$riego->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="formulacion" class="col-lg-2 control-label">Formulación</label>
            <div class="col-lg-10">
                @if( isset($riego))
                    {!!Form::textarea('formulacion' ,$riego->formulacion,['class'=>'form-control','id'=>'formulacion','placeholder'=>'Formulación'])!!}
                @else
                    {!!Form::textarea('formulacion' ,null,['class'=>'form-control','id'=>'formulacion','placeholder'=>'Formulación'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($riego))

                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar esta aplicación?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>



    </div>

</div>
