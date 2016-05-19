

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

                    @if( isset($aplicacionesMantenimiento))

                        @foreach($invernaderos as $invernadero)
                            @if($aplicacionesMantenimiento->id_invernadero== $invernadero->id)
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

                    @if( isset($aplicacionesMantenimiento))

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
            <label for="Aplicacion" class="col-lg-2 control-label"><strong>*</strong>Aplicación</label>
            <div class="col-lg-10">

                <select  class="form-control" id="aplicacion" name="aplicacion">
                    <option value="">Selecciona</option>

                    @if( isset($aplicacionesMantenimiento))

                        @foreach($aplicacion as $apl)
                            @if($aplicacionesMantenimiento->aplicacion == $apl)
                                <option value="{{  $apl  }}" selected > {{ $apl}}  </option>
                            @else
                                <option value="{{  $apl }}"  > {{ $apl }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($aplicacion as $apl)
                            <option value="{{  $apl }}"  > {{ $apl }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="TipoAplicacion" class="col-lg-2 control-label"><strong>*</strong>Tipo de aplicación</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoAplicacion" name="tipoAplicacion">
                    <option value="">Selecciona</option>

                    @if( isset($aplicacionesMantenimiento))

                        @foreach($tipoAplicacion as $tipo)
                            @if($aplicacionesMantenimiento->tipoAplicacion == $tipo || substr_compare('Botellas Españolas', $aplicacionesMantenimiento->tipoAplicacion, 0, 8, true) == 0)
                                <option value="{{  $tipo  }}" selected > {{ $tipo}}  </option>
                            @else
                                <option value="{{  $tipo }}"  > {{ $tipo }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoAplicacion as $tipo)
                            <option value="{{  $tipo }}"  > {{ $tipo }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="Producto" class="col-lg-2 control-label"><strong>*</strong>Producto</label>
            <div class="col-lg-10">
                @if (isset($producto))
                    <input class ="form-control" type="text" value ="{{ $producto  }}" id="producto" name="producto">
                @else
                    <input class ="form-control" type="text" placeholder="Producto" value ="" id="producto" name="producto">
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="Cantidad" class="col-lg-2 control-label">Cantidad (kg-l/ha)</label>
            <div class="col-lg-10">
                @if (isset($cantidad))
                    {!!Form::text('cantidad' ,$cantidad,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Cantidad'])!!}
                @else
                    {!!Form::text('cantidad' ,null,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Cantidad'])!!}
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
                    @if( isset($aplicacionesMantenimiento))
                        {!!Form::text('fecha' ,$aplicacionesMantenimiento->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="Comentario" class="col-lg-2 control-label">Comentario</label>
            <div class="col-lg-10">
                @if (isset($comentario))
                    {!!Form::textArea('comentario' ,$comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentario'])!!}

                @else
                    {!!Form::textArea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentario'])!!}
                @endif
            </div>
        </div>




        <div class="form-group" align="center">
            @if( isset($aplicacionesMantenimiento))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la  aplicación de mantenimiento?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
