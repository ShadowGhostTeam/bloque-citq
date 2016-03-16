

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
            <label for="Sector" class="col-lg-2 control-label"><strong>*</strong>Sector</label>
            <div class="col-lg-10">

                <select  class="form-control" id="sector" name="sector">
                    <option value="">Selecciona</option>

                    @if( isset($riegoSector))

                        @foreach($sectores as $sector)
                            @if($riegoSector->id_sector == $sector->id)
                                <option value="{{  $sector->id  }}" selected > {{ $sector->nombre}}  </option>
                            @else
                                <option value="{{  $sector->id  }}" > {{ $sector->nombre}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($sectores as $sector)
                            <option value="{{  $sector->id  }}" > {{ $sector->nombre}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="siembra" class="col-lg-2 control-label"><strong>*</strong>Siembra</label>
            <div class="col-lg-10">

                <select class="form-control" id="siembra" name="siembra">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSeleccionada))

                        @foreach($siembras as $siembra)
                            @if($siembraSeleccionada['id_siembra'] == $siembra['id_siembra'])
                                <option value="{{  $siembra['id_siembra']  }}" selected > {{ $siembra['nombre']."   ". $siembra['variedad'] . " - ". $siembra['fecha'] }}  </option>
                            @else
                                <option value="{{  $siembra['id_siembra']  }}"  > {{ $siembra['nombre']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                            @endif
                        @endforeach
                    @else
                        @if( isset($siembras))
                            @foreach($siembras as $siembra)
                                <option value="{{  $siembra['id_siembra']  }}"> {{ $siembra['nombre']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                            @endforeach
                        @endif
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
                    @if( isset($riegoSector))
                        {!!Form::text('fecha' ,$riegoSector->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="tiempo" class="col-lg-2 control-label"><strong>*</strong>Tiempo (hrs.)</label>
            <div class="col-lg-10">
                @if( isset($riegoSector))
                    {!!Form::text('tiempo' ,$riegoSector->tiempo,['class'=>'form-control','id'=>'tiempo','placeholder'=>'Tiempo en horas'])!!}
                @else
                    {!!Form::text('tiempo' ,null,['class'=>'form-control','id'=>'tiempo','placeholder'=>'Tiempo en horas'])!!}
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="distanciaLineas" class="col-lg-2 control-label"><strong>*</strong>Distancia Entre Lineas de Riego (metros)</label>
            <div class="col-lg-10">
                @if( isset($riegoSector))
                    {!!Form::text('distanciaLineas' ,$riegoSector->distanciaLineas,['class'=>'form-control','id'=>'distanciaLineas','placeholder'=>'Distancia entre las líneas de riego (metros).'])!!}
                @else
                    {!!Form::text('distanciaLineas' ,null,['class'=>'form-control','id'=>'distanciaLineas','placeholder'=>'Distancia entre las líneas de riego (metros).'])!!}
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="litrosHectarea" class="col-lg-2 control-label">Litros por Hectárea.</label>
            <div class="col-lg-10">
                @if( isset($riegoSector))
                    {!!Form::text('litrosHectarea' ,$riegoSector->litrosHectarea,['class'=>'form-control','id'=>'litrosHectarea','placeholder'=>'Litros por Hectárea.', 'disabled'=>'disabled'])!!}
                @else
                    {!!Form::text('litrosHectarea' ,null,['class'=>'form-control','id'=>'litrosHectarea','placeholder'=>'Litros por Hectárea.', 'disabled'=>'disabled'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="lamina" class="col-lg-2 control-label">Lámina de Riego.</label>
            <div class="col-lg-10">
                @if( isset($riegoSector))
                    {!!Form::text('lamina' ,$riegoSector->lamina,['class'=>'form-control','id'=>'lamina','placeholder'=>'Lámina de Riego.', 'disabled'=>'disabled'])!!}
                @else
                    {!!Form::text('lamina' ,null,['class'=>'form-control','id'=>'lamina','placeholder'=>'Lámina de riego.', 'disabled'=>'disabled'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($riegoSector))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar el riego?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
