

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
                <strong>*</strong>Invernadero
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="invernadero" name="invernadero">
                    <option value="">Selecciona</option>

                    @if( isset($siembraInvernadero))

                        @foreach($invernaderos as $invernadero)
                            @if($siembraInvernadero->id_invernadero == $invernadero->id)
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
            <label for="Cultivo" class="col-lg-2 control-label">
                <strong>*</strong>Cultivo
            </label>
            <div class="col-lg-10">

                <select  class="form-control" id="cultivo" name="cultivo">
                    <option value="">Selecciona</option>

                    @if( isset($siembraInvernadero))

                        @foreach($cultivos as $cultivo)
                            @if($siembraInvernadero->id_cultivo == $cultivo->id)
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
                    @if( isset($siembraInvernadero))
                        {!!Form::text('fecha' ,$siembraInvernadero->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="Variedad" class="col-lg-2 control-label">Variedad</label>
            <div class="col-lg-10">
                @if( isset($siembraInvernadero))
                    {!!Form::text('variedad', $siembraInvernadero->variedad, ['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @else
                    {!!Form::text('variedad' ,null,['class'=>'form-control','id'=>'variedad','placeholder'=>'Variedad'])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Status" class="col-lg-2 control-label">
                <strong>*</strong>Status
            </label>
            <div class="col-lg-10" align="left">
                @if( isset($siembraInvernadero))
                    @foreach($tipoStatus as $tiposStatus)
                        @if($siembraInvernadero->status == $tiposStatus)
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
                    @if( isset($siembraInvernadero))
                        {!!Form::text('fechaTerminacion' ,$siembraInvernadero->fechaTerminacion,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fechaTerminacion' ,null,['class'=>'form-control','id'=>'fechaTerminacion','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="comentario" class="col-lg-2 control-label">Comentarios</label>
            <div class="col-lg-10">
                @if( isset($siembraInvernadero))
                    {!!Form::textarea('comentario', $siembraInvernadero->comentario, ['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @else
                    {!!Form::textarea('comentario' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Comentarios'])!!}
                @endif
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($siembraInvernadero))
                {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la siembra?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
