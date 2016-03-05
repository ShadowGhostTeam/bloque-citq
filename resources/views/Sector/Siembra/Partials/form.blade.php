

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
            <label for="Sector" class="col-lg-2 control-label">
                <strong>*</strong>Sector
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="sector" name="sector">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSector))

                        @foreach($sectores as $sector)
                            @if($siembraSector->id_sector == $sector->id)
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
            <label for="Cultivo" class="col-lg-2 control-label">
                <strong>*</strong>Cultivo
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="cultivo" name="cultivo">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSector))

                        @foreach($cultivos as $cultivo)
                            @if($siembraSector->id_cultivo == $cultivo->id)
                                <option value="{{  $cultivo->id  }}" selected > {{ $cultivo->nombre }}  </option>
                            @else
                                <option value="{{  $cultivo->id  }}"  > {{ $cultivo->nombre }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($cultivos as $cultivo)
                            <option value="{{  $cultivo->id  }}"  > {{ $cultivo->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Fecha" class="col-lg-2 control-label">
                <strong>*</strong>Fecha
            </label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($siembraSector))
                        {!!Form::text('fecha' ,$siembraSector->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="Status" class="col-lg-2 control-label">
                <strong>*</strong>Status
            </label>
            <div class="col-lg-10" align="left">
                @if( isset($siembraSector))
                    @foreach($tipoStatus as $tiposStatus)
                        @if($siembraSector->status == $tiposStatus)
                            <label class="radio-inline">
                                {!!  Form::radio('status', $tiposStatus, true) !!}{{ $tiposStatus }}
                            </label>
                        @else
                            <label class="radio-inline">
                                {!! Form::radio('status', $tiposStatus)  !!}{{ $tiposStatus }}
                            </label>
                        @endif
                    @endforeach
                @else
                    @foreach($tipoStatus as $tiposStatus)
                        <label class="radio-inline">
                            {!! Form::radio('status', $tiposStatus) !!}{{ $tiposStatus }}
                        </label>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group" id="Terminacion" style="display:none">
            <label for="FechaTerminacion" class="col-lg-2 control-label">
                Fecha Terminacion
            </label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($siembraSector))
                        {!!Form::text('fechaTerminacion' ,$siembraSector->fechaTerminacion,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fechaTerminacion' ,null,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="TipoSiembra" class="col-lg-2 control-label">
                Tipo de siembra
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoSiembra" name="tipoSiembra">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSector))
                        @foreach($tipoSiembras as $tiposSiembra)
                            @if($siembraSector->tipo == $tiposSiembra)
                                <option value="{{  $tiposSiembra   }}" selected > {{ $tiposSiembra }}  </option>
                            @else
                                <option value="{{  $tiposSiembra  }}" > {{ $tiposSiembra }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoSiembras as $tiposSiembra)
                            <option value="{{  $tiposSiembra  }}" > {{ $tiposSiembra }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Variedad" class="col-lg-2 control-label">Variedad</label>
            <div class="col-lg-10">
                @if( isset($siembraSector))
                    {!!Form::text('Variedad', $siembraSector->variedad, ['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @else
                    {!!Form::text('Variedad' ,null,['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Temporada" class="col-lg-2 control-label">
                Temporada
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="temporada" name="temporada">
                    <option value="">Selecciona</option>

                    @if( isset($siembraSector))

                        @foreach($temporadas as $temporada)
                            @if($siembraSector->temporada == $temporada)
                                <option value="{{  $temporada   }}" selected > {{ $temporada }}  </option>
                            @else
                                <option value="{{  $temporada  }}" > {{ $temporada }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($temporadas as $temporada)
                            <option value="{{  $temporada  }}" > {{ $temporada }}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($siembraSector))
                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la siembra?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
