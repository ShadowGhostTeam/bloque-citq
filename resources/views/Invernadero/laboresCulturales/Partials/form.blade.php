

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

                    @if( isset($laboresCulturales))

                        @foreach($invernaderos as $invernadero)
                            @if($laboresCulturales->id_invernadero== $invernadero->id)
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

                    @if( isset($laboresCulturales))

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
            <label for="Actividad" class="col-lg-2 control-label"><strong>*</strong>Actividad</label>
            <div class="col-lg-10">

                <select  class="form-control" id="actividad" name="actividad">
                    <option value="">Selecciona</option>

                    @if( isset($laboresCulturales))

                        @foreach($actividades as $actividad)
                            @if($laboresCulturales->actividad == $actividad)
                                <option value="{{  $actividad  }}" selected > {{ $actividad}}  </option>
                            @else
                                <option value="{{  $actividad }}"  > {{ $actividad }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($actividades as $actividad)
                            <option value="{{  $actividad }}"  > {{ $actividad }}</option>
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
                    @if( isset($laboresCulturales))
                        {!!Form::text('fecha' ,$laboresCulturales->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>




        <div class="form-group" align="center">
            @if( isset($laboresCulturales))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la labor cultural?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
