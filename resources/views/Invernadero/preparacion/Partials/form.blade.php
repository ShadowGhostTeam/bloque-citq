

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

                    @if( isset($preparacionInvernadero))

                        @foreach($invernaderos as $invernadero)
                            @if($preparacionInvernadero->id_invernadero == $invernadero->id)
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
            <label for="Actividad" class="col-lg-2 control-label"><strong>*</strong>Tipo de Siembra</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoSiembra" name="tipoSiembra">
                    <option value="">Selecciona</option>

                    @if( isset($preparacionInvernadero))

                        @foreach($tipoSiembras as $tipoSiembra)
                            @if($preparacionInvernadero->tipoSiembra == $tipoSiembra)
                                <option value="{{  $tipoSiembra  }}" selected > {{ $tipoSiembra}}  </option>
                            @else
                                <option value="{{  $tipoSiembra }}"  > {{ $tipoSiembra }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($tipoSiembras as $tipoSiembra)
                            <option value="{{  $tipoSiembra }}"  > {{ $tipoSiembra }}</option>
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
                    @if( isset($preparacionInvernadero))
                        {!!Form::text('fecha' ,$preparacionInvernadero->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>




        <div class="form-group" align="center">
            @if( isset($preparacionInvernadero))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la preparación?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
