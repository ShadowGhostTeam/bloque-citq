

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

                    @if( isset($mantenimientoSector))

                        @foreach($sectores as $sector)
                            @if($mantenimientoSector->id_sector == $sector->id)
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
            <label for="Siembra" class="col-lg-2 control-label"><strong>*</strong>Siembra</label>
            <div class="col-lg-10">

                <select  class="form-control" id="siembra" name="siembra">
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
            <label for="Actividad" class="col-lg-2 control-label"><strong>*</strong>Actividad</label>
            <div class="col-lg-10">

                <select  class="form-control" id="actividad" name="actividad">
                    <option value="">Selecciona</option>

                    @if( isset($mantenimientoSector))

                        @foreach($actividades as $actividad)
                            @if($mantenimientoSector->actividad == $actividad)
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

        <div class="form-group" id="divTipoAplicacion">
            <label for="Fuente" class="col-lg-2 control-label">Tipo aplicación</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoAplicacion" name="tipoAplicacion">
                    <option value="">Selecciona</option>

                    @if( isset($mantenimientoSector))

                        @foreach($tipoAplicaciones as $tipoAplicacion)
                            @if($mantenimientoSector->tipoAplicacion == $tipoAplicacion)
                                <option value="{{  $tipoAplicacion  }}" selected > {{ $tipoAplicacion}}  </option>
                            @else
                                <option value="{{  $tipoAplicacion }}"  > {{ $tipoAplicacion}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoAplicaciones  as $tipoAplicacion)
                            <option value="{{  $tipoAplicacion }}"  > {{ $tipoAplicacion }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group" id="divProducto">
            <label for="producto" class="col-lg-2 control-label">Producto</label>
            <div class="col-lg-10">
                @if( isset($mantenimientoSector))
                    {!!Form::text('producto' ,$mantenimientoSector->producto,['class'=>'form-control','id'=>'producto','placeholder'=>'Producto'])!!}
                @else
                    {!!Form::text('producto' ,null,['class'=>'form-control','id'=>'producto','placeholder'=>'Producto'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" id="divCantidad">
            <label for="Cantidad" class="col-lg-2 control-label">Cantidad kg ó l/ha)</label>
            <div class="col-lg-10">
                @if( isset($mantenimientoSector))
                    {!!Form::text('cantidad' ,$mantenimientoSector->cantidad,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Kilogramos o litros por hectárea'])!!}
                @else
                    {!!Form::text('cantidad' ,null,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Kilogramos o litros por hectárea'])!!}
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
                    @if( isset($mantenimientoSector))
                        {!!Form::text('fecha' ,$mantenimientoSector->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">

                @if( isset($mantenimientoSector))

                    {!!Form::textArea('comentario' ,$mantenimientoSector->comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @else
                    {!!Form::textArea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @endif
            </div>
        </div>




        <div class="form-group" align="center">
            @if( isset($mantenimientoSector))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la fertilización?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
