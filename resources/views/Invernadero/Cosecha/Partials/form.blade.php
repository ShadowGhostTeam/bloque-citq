

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

                    @if( isset($cosechaInvernadero))

                        @foreach($invernaderos as $invernadero)
                            @if($cosechaInvernadero->id_invernadero == $invernadero->id)
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

                <select  class="form-control" id="siembra" name="siembra">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSeleccionada))

                        @foreach($siembras as $siembra)
                            @if($siembraSeleccionada['id_stInvernadero'] == $siembra['id_stInvernadero'])
                                <option value="{{  $siembra['id_stInvernadero']  }}" selected > {{ $siembra['nombre']."   ". $siembra['variedad'] . " - ". $siembra['fecha'] }}  </option>
                            @else
                                <option value="{{  $siembra['id_stInvernadero']  }}"  > {{ $siembra['nombre']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
                            @endif
                        @endforeach
                    @else
                        @if( isset($siembras))
                            @foreach($siembras as $siembra)
                                <option value="{{  $siembra['id_stInvernadero']  }}"> {{ $siembra['nombre']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
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
                    @if( isset($cosechaInvernadero))
                        {!!Form::text('fecha' ,$cosechaInvernadero->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="Comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($cosechaInvernadero))
                    {!!Form::textArea('comentario' ,$cosechaInvernadero->comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios.'])!!}
                @else
                    {!!Form::textArea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios.'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($cosechaInvernadero))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la cosecha?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
