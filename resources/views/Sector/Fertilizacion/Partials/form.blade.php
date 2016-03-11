

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

                    @if( isset($fertilizacionSector))

                        @foreach($sectores as $sector)
                            @if($fertilizacionSector->id_sector == $sector->id)
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
            <label for="fuente" class="col-lg-2 control-label">Fuente</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionSector))
                    {!!Form::text('fuente' ,$fertilizacionSector->fuente,['class'=>'form-control','id'=>'fuente','placeholder'=>'Fuente'])!!}
                @else
                    {!!Form::text('fuente' ,null,['class'=>'form-control','id'=>'fuente','placeholder'=>'Fuente'])!!}
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
                    @if( isset($fertilizacionSector))
                        {!!Form::text('fecha' ,$fertilizacionSector->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="TipoFertilizacion" class="col-lg-2 control-label">Tipo de fertilización</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoFertilizacion" name="tipoFertilizacion">
                    <option value="">Selecciona</option>

                    @if( isset($fertilizacionSector))

                        @foreach($tipoFertilizaciones as $tiposFertilizacion)
                            @if($fertilizacionSector->tipo == $tiposFertilizacion)
                                <option value="{{  $tiposFertilizacion   }}" selected > {{ $tiposFertilizacion }}  </option>
                            @else
                                <option value="{{  $tiposFertilizacion  }}" > {{ $tiposFertilizacion}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoFertilizaciones as $tiposFertilizacion)
                            <option value="{{  $tiposFertilizacion  }}" > {{ $tiposFertilizacion}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>




        <div class="form-group">
            <label for="Cantidad" class="col-lg-2 control-label">Cantidad (kg)</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionSector))
                    {!!Form::text('cantidad' ,$fertilizacionSector->cantidad,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Número en kg'])!!}
                @else
                    {!!Form::text('cantidad' ,null,['class'=>'form-control','id'=>'cantidad','placeholder'=>'Número en kg'])!!}
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="programaNPK" class="col-lg-2 control-label">Programa NPK</label>
            <div class="col-lg-10">
                @if( isset($fertilizacionSector))
                    {!!Form::text('programaNPK' ,$fertilizacionSector->programaNPK,['class'=>'form-control','id'=>'programaNPK','placeholder'=>'Programa NPK'])!!}
                @else
                    {!!Form::text('programaNPK' ,null,['class'=>'form-control','id'=>'programaNPK','placeholder'=>'Programa NPK'])!!}
                @endif
            </div>
        </div>



        <div class="form-group" align="center">
            @if( isset($fertilizacionSector))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la fertilización?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
