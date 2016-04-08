

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

                    @if( isset($aplicaciones))
                        @foreach($invernaderos as $invernadero)
                            @if($aplicaciones->id_invernaderoPlantula == $invernadero->id)
                                <option value="{{  $invernadero->id  }}" selected > {{ $invernadero->nombre}}  </option>
                            @else
                               <option value="{{$invernadero->id}}" > {{$invernadero->nombre}}  </option>
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

                    @if( isset($aplicaciones))

                        @foreach($siembras as $siembra)
                            @if($siembraSeleccionada['id_siembra'] == $siembra['id_siembra'])
                                <option value="{{  $siembra['id_siembra']  }}" selected > {{ $siembra['sustrato']."   ". $siembra['variedad'] . " - ". $siembra['fecha'] }}  </option>
                            @else
                                <option value="{{  $siembra['id_siembra']  }}"  > {{ $siembra['sustrato']."   ". $siembra['variedad'] ." - " . $siembra['fecha']  }}  </option>
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
                    @if( isset($aplicaciones))
                        {!!Form::text('fecha' ,$aplicaciones->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="aplicacion" class="col-lg-2 control-label">Aplicación</label>
            <div class="col-lg-10">

                <select  class="form-control" id="aplicacion" name="aplicacion">
                    <option value="">Selecciona</option>

                    @if( isset($aplicaciones))

                        @foreach($aplicacion as $aplicacion)
                            @if($aplicaciones->aplicacion == $aplicacion)
                                <option value="{{  $aplicacion   }}" selected > {{ $aplicacion }}  </option>
                            @else
                                <option value="{{  $aplicacion  }}" > {{ $aplicacion }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($aplicacion as $aplicacion)
                            <option value="{{  $aplicacion }}" > {{ $aplicacion }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="TipoAplicacion" class="col-lg-2 control-label">Tipo de aplicación</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoAplicacion" name="tipoAplicacion">
                    <option value="">Selecciona</option>

                    @if( isset($aplicaciones))

                        @foreach($tipoAplicacion as $tipo)
                            @if($aplicaciones->tipoAplicacion == $tipo)
                                <option value="{{  $tipo   }}" selected > {{ $tipo }}  </option>
                            @else
                                <option value="{{  $tipo  }}" > {{ $tipo }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoAplicacion as $tipo)
                            <option value="{{  $tipo }}" > {{ $tipo }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="producto" class="col-lg-2 control-label">Producto</label>
            <div class="col-lg-10">
                @if( isset($aplicaciones))
                    {!!Form::text('producto' ,$aplicaciones->producto,['class'=>'form-control','id'=>'producto','placeholder'=>'Producto'])!!}
                @else
                    {!!Form::text('producto' ,null,['class'=>'form-control','id'=>'producto','placeholder'=>'Producto'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="cantidad" class="col-lg-2 control-label">Cantidad</label>
            <div class="col-lg-10">
                @if( isset($aplicaciones))
                    {!!Form::text('cantidad' ,$aplicaciones->cantidad,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Cantidad'])!!}
                @else
                    {!!Form::text('cantidad' ,null,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Cantidad'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($aplicaciones))
                    {!!Form::textarea('comentario' ,$aplicaciones->comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @else
                    {!!Form::textarea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($aplicaciones))

                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar esta aplicación?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>



    </div>

</div>
