

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
            <label for="InvernaderoPlantula" class="col-lg-2 control-label">
                <strong>*</strong>Invernadero de Plántula
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="invernaderoPlantula" name="invernaderoPlantula">
                    <option value="">Selecciona</option>

                    @if( isset($siembraInvernaderoPlantula))

                        @foreach($invernaderosPlantula as $invernaderoPlantula)
                            @if($siembraInvernaderoPlantula->id_invernaderoPlantula == $invernaderoPlantula->id)
                                <option value="{{  $invernaderoPlantula->id  }}" selected > {{ $invernaderoPlantula->nombre}}  </option>
                            @else
                                <option value="{{  $invernaderoPlantula->id  }}" > {{ $invernaderoPlantula->nombre}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($invernaderosPlantula as $invernaderoPlantula)
                            <option value="{{  $invernaderoPlantula->id  }}" > {{ $invernaderoPlantula->nombre}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Contenedor" class="col-lg-2 control-label">
                <strong>*</strong>Contenedor
            </label>
            <div class="col-lg-10" align="left">
                @if( isset($siembraInvernaderoPlantula))
                    @foreach($tipoContenedor as $tiposContenedor)
                        @if($siembraInvernaderoPlantula->status == $tiposContenedor)
                            <label class="radio-inline">
                                {!!  Form::radio('status', $tiposContenedor, true) !!}{{ $tiposContenedor }}
                            </label>
                        @else
                            <label class="radio-inline">
                                {!! Form::radio('status', $tiposContenedor)  !!}{{ $tiposContenedor }}
                            </label>
                        @endif
                    @endforeach
                @else
                    @foreach($tipoContenedor as $tiposCotenedor)
                        <label class="radio-inline">
                            {!! Form::radio('status', $tiposContenedor) !!}{{ $tiposContenedor }}
                        </label>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Cultivo" class="col-lg-2 control-label">
                <strong>*</strong>Cultivo
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="cultivo" name="cultivo">
                    <option value="">Selecciona</option>

                    @if( isset($siembraInvernaderoPlantula))

                        @foreach($cultivos as $cultivo)
                            @if($siembraInvernaderoPlantula->id_cultivo == $cultivo->id)
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

        <div>
            <label for="NumPlantas" class="col-lg-2 control-label">
                Número de plantas
            </label>
            <div class="col-lg-10">
                @if( isset($siembraInvernaderoPlantula))
                    {!!Form::number('numPlantas', $siembraInvernaderoPlantula->numPlantas, ['class'=>'form-control','id'=>'numPlantas','placeholder'=>'0'])!!}
                @else
                    {!!Form::number('numPlantas' ,null,['class'=>'form-control','id'=>'numPlantas','placeholder'=>'0'])!!}
                @endif
            </div>
        </div>

        <div>
            <label for="Sustrato" class="col-lg-2 control-label">
                Sustrato
            </label>
            <div class="col-lg-10">
                @if( isset($siembraInvernaderoPlantula))
                    {!!Form::text('sustrato', $siembraInvernaderoPlantula->variedad, ['class'=>'form-control','id'=>'sustrato','placeholder'=>'Sustrato'])!!}
                @else
                    {!!Form::text('sustrato' ,null,['class'=>'form-control','id'=>'sustrato','placeholder'=>'Sustrato'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Variedad" class="col-lg-2 control-label">Variedad</label>
            <div class="col-lg-10">
                @if( isset($siembraInvernaderoPlantula))
                    {!!Form::text('variedad', $siembraInvernaderoPlantula->variedad, ['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @else
                    {!!Form::text('variedad' ,null,['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Destino" class="col-lg-2 control label">
                <strong>*</strong>Destino
            </label>
        </div>

        <div class="form-group">
            <label for="Comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($siembraInvernaderoPlantula))
                    {!!Form::textarea('comentario', $siembraInvernaderoPlantula->comentario, ['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @else
                    {!!Form::textarea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @endif
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
                    @if( isset($siembraInvernaderoPlantula))
                        {!!Form::text('fecha' ,$siembraInvernaderoPlantula->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
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
                @if( isset($siembraInvernaderoPlantula))
                    @foreach($tipoStatus as $tiposStatus)
                        @if($siembraInvernaderoPlantula->status == $tiposStatus)
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

        <div class="form-group">
            <label for="FechaTerminacion" class="col-lg-2 control-label">
                Fecha de Terminación
            </label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($siembraInvernaderoPlantula))
                        {!!Form::text('fechaTerminacion' ,$siembraInvernaderoPlantula->fechaTerminacion,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fechaTerminacion' ,null,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($siembraInvernaderoPlantula))
                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la siembra?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
