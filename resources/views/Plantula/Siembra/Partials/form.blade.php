

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
            <label for="Invernadero" class="col-lg-2 control-label">
                <strong>*</strong>Invernadero de Plántula
            </label>
            <div class="col-lg-10">
                <select  class="form-control" id="invernadero" name="invernadero" disabled>
                    @if( isset($siembra))
                        @if(isset($invernadero))
                            <option value="{{ $invernadero }}" selected> {{ $invernadero->nombre }} </option>
                        @endif
                    @else
                        <option value="{{ $invernadero }}" selected> {{ $invernadero->nombre }} </option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Contenedor" class="col-lg-2 control-label">
                <strong>*</strong>Tipo de Contenedor
            </label>
            <div class="col-lg-10">
                <select  class="form-control" id="contenedor" name="contenedor">
                    <option value="">Selecciona tipo de contenedor</option>

                    @if( isset($siembra))

                        @foreach($contenedores as $contenedor)
                            @if($siembra->contenedor == $contenedor)
                                <option value="{{  $contenedor  }}" selected> {{ $contenedor }}  </option>
                            @else
                                <option value="{{  $contenedor }}"  > {{ $contenedor }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($contenedores as $contenedor)
                            <option value="{{  $contenedor }}"  > {{ $contenedor }}</option>
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

                    @if( isset($siembra))
                        @foreach($cultivos as $cultivo)
                            @if($siembra->id_cultivo == $cultivo->id)
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
            <label for="NumPlantas" class="col-lg-2 control-label">
                Número de plantas
            </label>
            <div class="col-lg-10">
                @if( isset($siembra))
                    {!!Form::number('numPlantas', $siembra->numPlantas, ['class'=>'form-control','id'=>'numPlantas','placeholder'=>'0'])!!}
                @else
                    {!!Form::number('numPlantas' ,null,['class'=>'form-control','id'=>'numPlantas','placeholder'=>'0'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Sustrato" class="col-lg-2 control-label">
                Sustrato
            </label>
            <div class="col-lg-10">
                @if( isset($siembra))
                    {!!Form::text('sustrato', $siembra->sustrato, ['class'=>'form-control','id'=>'sustrato','placeholder'=>'Sustrato'])!!}
                @else
                    {!!Form::text('sustrato' ,null,['class'=>'form-control','id'=>'sustrato','placeholder'=>'Sustrato'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Variedad" class="col-lg-2 control-label">Variedad</label>
            <div class="col-lg-10">
                @if( isset($siembra))
                    {!!Form::text('variedad', $siembra->variedad, ['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @else
                    {!!Form::text('variedad' ,null,['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Destino" class="col-lg-2 control-label">
                <strong>*</strong>Destino
            </label>
            <div class="col-lg-10">
                <select  class="form-control" id="destino" name="destino">
                    <option value="">Selecciona el destino</option>
                    @if( isset($siembra))
                        @foreach($destinos as $destino)
                            @if($siembra->destino == $destino)
                                <option value="{{  $destino  }}" selected> {{ $destino }}  </option>
                            @else
                                <option value="{{  $destino }}"  > {{ $destino }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($destinos as $destino)
                            <option value="{{  $destino }}"  > {{ $destino }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($siembra))
                    {!!Form::textarea('comentario', $siembra->comentario, ['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
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
                    @if( isset($siembra))
                        {!!Form::text('fecha' ,$siembra->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
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
                @if( isset($siembra))
                    @foreach($tipoStatus as $tiposStatus)
                        @if($siembra->status == $tiposStatus)
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
                    @if( isset($siembra))
                        {!!Form::text('fechaTerminacion' ,$siembra->fechaTerminacion,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fechaTerminacion' ,null,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($siembra))
                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la siembra?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
