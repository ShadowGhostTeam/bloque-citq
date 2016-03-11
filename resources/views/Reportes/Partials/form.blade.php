

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

                    @if( isset($preparacionSector))

                        @foreach($sectores as $sector)
                            @if($preparacionSector->id_sector == $sector->id)
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
            <label for="Maquinaria" class="col-lg-2 control-label"><strong>*</strong>Maquinaria</label>
            <div class="col-lg-10">

                <select  class="form-control" id="maquinaria" name="maquinaria">
                    <option value="">Selecciona</option>

                    @if( isset($preparacionSector))

                        @foreach($maquinarias as $maquinaria)
                            @if($preparacionSector->id_maquinaria == $maquinaria->id)
                                <option value="{{  $maquinaria->id  }}" selected > {{ $maquinaria->nombre}}  </option>
                            @else
                                <option value="{{  $maquinaria->id  }}" > {{ $maquinaria->nombre}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($maquinarias as $maquinaria)
                            <option value="{{  $maquinaria->id  }}" > {{ $maquinaria->nombre}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>






        <div class="form-group">
            <label for="Pasadas" class="col-lg-2 control-label"><strong>*</strong>Pasadas</label>
            <div class="col-lg-10">
                @if( isset($preparacionSector))
                {!!Form::number('numPasadas' ,$preparacionSector->numPasadas,['class'=>'form-control','min'=>'0','id'=>'numPasadas','placeholder'=>'Número de pasadas'])!!}
                @else
                    {!!Form::number('numPasadas' ,null,['class'=>'form-control','min'=>'0','id'=>'numPasadas','placeholder'=>'Número de pasadas'])!!}
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
                    @if( isset($preparacionSector))
                        {!!Form::text('fecha' ,$preparacionSector->fecha,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @else
                        {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/aaaa'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($preparacionSector))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar la preparación?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
