
<div class="row">
    @if( isset($patrocinadoresItem))
        <input type="hidden" name="patrocinadorID" value={{$patrocinadoresItem->id}}>
    @endif

    <div class="col-md-2"></div>

    <div class="col-md-8">
        <p align="left" class="help-block"> (*) {{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="patrocinador" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.nombre')  }}</label>
            <div class="col-lg-10">

                @if( isset($patrocinadoresItem))

                    {!!Form::text('Nombre' ,$patrocinadoresItem->nombre,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombredelPatrocinador') ])!!}
                @else
                    {!!Form::text('Nombre' ,null,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombredelPatrocinador')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{ trans('validation.attributes.puesto')  }}</label>
            <div class="col-lg-10">

                @if( isset($patrocinadoresItem))

                    {!!Form::text('Puesto' ,$patrocinadoresItem->puesto,['class'=>'form-control','id'=>'Puesto','placeholder'=>trans('validation.attributes.puesto')])!!}
                @else
                    {!!Form::text('Puesto' ,null,['class'=>'form-control','id'=>'Puesto','placeholder'=>trans('validation.attributes.puesto')])!!}
                @endif
            </div>
        </div>



        <div class="form-group">
            <label for="Email" class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">

                @if( isset($patrocinadoresItem))

                    {!!Form::text('Email' ,$patrocinadoresItem->email,['class'=>'form-control','id'=>'Email','placeholder'=>'documentaqro@gmail.com'])!!}
                @else
                    {!!Form::text('Email' ,null,['class'=>'form-control','id'=>'Email','placeholder'=>'documentaqro@gmail.com'])!!}
                @endif
            </div>
        </div>





        <div class="form-group">
            <label for="AsistenciasS" class="col-lg-2 control-label">{{ trans('validation.attributes.telefono')  }}</label>
            <div class="col-lg-10">
                @if( isset($patrocinadoresItem))
                    {!!Form::text('Telefono' ,$patrocinadoresItem->telefono,['class'=>'form-control','id'=>'telefono','placeholder'=>'442200726'])!!}
                @else
                    {!!Form::text('Telefono' ,null,['class'=>'form-control','id'=>'telefono','placeholder'=>'442200726'])!!}
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="SedeS" class="col-lg-2 control-label">{{ trans('validation.attributes.tipo')  }}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="Tipo" name="Tipo">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>

                    @if( isset($patrocinadoresItem))

                        @foreach($Tipos as $tipo)
                            @if($tipo == $patrocinadoresItem->tipo)
                                <option value="{{  $tipo  }}" selected > {{ $tipo}}  </option>
                            @else
                                <option value="{{  $tipo }}" > {{ $tipo }}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Tipos as $tipo)
                            <option value="{{  $tipo }}" > {{ $tipo}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Paquete" class="col-lg-2 control-label">{{ trans('validation.attributes.paquete')  }}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="Paquete" name="Paquete">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>

                    @if( isset($patrocinadoresItem->paquetes))

                        @foreach($Paquetes as $paquete)

                                @if( isset($paqueteSeleccion) && $paqueteSeleccion == $paquete->id)
                                    <option value="{{  $paquete->id  }}" selected > {{ $paquete->descripcion}}  </option>
                                @else
                                    <option value="{{  $paquete->id }}" > {{ $paquete->descripcion }}  </option>
                                @endif
                        @endforeach
                    @else
                        @foreach($Paquetes as $paquete)
                            <option value="{{  $paquete->id }}" > {{ $paquete->descripcion}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{ trans('validation.attributes.notas')  }}</label>
            <div class="col-lg-10">

                @if( isset($patrocinadoresItem))

                    {!!Form::textArea('Notas' ,$patrocinadoresItem->notas,['class'=>'form-control','id'=>'Notas','placeholder'=>trans('validation.attributes.placeNotas')])!!}
                @else
                    {!!Form::textArea('Notas' ,null,['class'=>'form-control','id'=>'Notas','placeholder'=>trans('validation.attributes.placeNotas')])!!}
                @endif
            </div>
        </div>






        <div class="form-group" align="center">
            @if( isset($patrocinadoresItem))

                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%','onclick'=>trans('validation.attributes.mensajeModificarPatrocinador')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>




</div>

