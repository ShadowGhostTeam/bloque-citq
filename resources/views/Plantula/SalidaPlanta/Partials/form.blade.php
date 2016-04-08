

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

                <select  class="form-control" id="invernadero" name="invernadero">
                    <option value="">Selecciona</option>

                    @if( isset($salidaPlanta))
                        @foreach($invernaderos as $invernadero)
                            @if($salidaPlanta->id_invernaderoPlantula == $invernadero->id)
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
            <label for="Siembra" class="col-lg-2 control-label"><strong>*</strong>Siembra Plántula</label>
            <div class="col-lg-10">

                <select  class="form-control" id="siembraPlantula" name="siembraPlantula">
                    <option value="">Selecciona</option>

                    @if( isset($salidaPlanta))

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
                    @if( isset($salidaPlanta))
                        {!!Form::text('fecha' ,$salidaPlanta->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($salidaPlanta))
                    {!!Form::textarea('comentario' ,$salidaPlanta->comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @else
                    {!!Form::textarea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($salidaPlanta))

                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar esta aplicación?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>



    </div>

</div>
