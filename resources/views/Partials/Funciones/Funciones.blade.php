<script type="text/javascript">

    $(document).ready(function() {
        $('#Pelicula').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });

        $('#Patrocinador').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });

        $('#Sede').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });

        $('#Programa').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });

        $('#Festival').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });

        $('#ProgramadoPor').change(function() {
            //Para obtener de que grupo es
            var selected = $(':selected', this);
            // alert(selected.parent().attr('label'));
            $('#Tipo').val(selected.parent().attr('label'));
            //   alert($('#Tipo').val());
            //   alert(selected.closest('optgroup').attr('label'));
        });

    });
</script>


<div class="row">
    <div class="col-md-5">

        <div class="form-group">
            <div class="col-lg-12">
                @if( isset($funcionesItem))
                    <input type="hidden" name="funcionId" value={{$funcionesItem->id}}>
                {!!  Form::file('image',['id'=>'imagenDocumentaQro','align'=>'center','type'=>'file','class'=>'img-responsive form-control file-loading'] )  !!}
                @else
                    {!!  Form::file('image',['id'=>'imagenDocumentaQro','align'=>'center','type'=>'file','class'=>'img-responsive form-control file-loading'] )  !!}
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
    <p align="left" class="help-block"> (*) {{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong> {{ trans('validation.attributes.Titulo')  }}</label>
            <div class="col-lg-10">

                @if( isset($funcionesItem))

                 {!!Form::text('Titulo' ,$funcionesItem->titulo,['class'=>'form-control','id'=>'Titulo','placeholder'=>trans('validation.attributes.tituloFuncion')])!!}
                @else
                    {!!Form::text('Titulo' ,null,['class'=>'form-control','id'=>'Titulo','placeholder'=>trans('validation.attributes.tituloFuncion')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Fecha')  }}</label>
            <div class="col-lg-10">
                <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                    @if( isset($funcionesItem))
                    {!!Form::text('Fecha' ,$funcionesItem->fecha,['class'=>'form-control','placeholder'=>'dd/mm/yyyy'])!!}
                    @else
                        {!!Form::text('Fecha' ,null,['class'=>'form-control','placeholder'=>'dd/mm/yyyy'])!!}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="SedeS" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.sede')  }}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="Sede" name="Sede">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>

                    @if( isset($funcionesItem))

                        @foreach($Sedes as $sede)
                            @if($funcionesItem->sedes->id == $sede->id)
                            <option value="{{  $sede->id  }}" selected > {{ $sede->descripcion}}  </option>
                            @else
                            <option value="{{  $sede->id  }}" > {{ $sede->descripcion}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Sedes as $sede)
                            <option value="{{  $sede->id  }}" > {{ $sede->descripcion}}  </option>
                        @endforeach
                    @endif
                    </select>
            </div>
        </div>


        <div class="form-group">
            <label for="AsistenciasS" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.asistencia')  }}</label>
            <div class="col-lg-10">
                @if( isset($funcionesItem))
                {!!Form::text('Asistencia' ,$funcionesItem->asistencia,['class'=>'form-control','id'=>'AsistenciasS','placeholder'=>trans('validation.attributes.asistenciaMensaje')])!!}
                @else
                    {!!Form::text('Asistencia' ,null,['class'=>'form-control','id'=>'AsistenciasS','placeholder'=>trans('validation.attributes.asistenciaMensaje')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="StatusS" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.status')  }}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="StatusS" name="Status">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>

                    @if( isset($funcionesItem))

                        @foreach($status as $statu)
                            @if($funcionesItem->status== $statu)
                                <option value="{{  $statu  }}" selected> {{ $statu}}  </option>
                                @else
                                <option value="{{  $statu  }}" > {{ $statu}}  </option>
                            @endif
                        @endforeach

                    @else
                        @foreach($status as $statu)
                        <option value="{{  $statu  }}" > {{ $statu}}  </option>
                        @endforeach

                     @endif
                    </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Peliculas')  }}</label>
            <div class="col-lg-10">
                <select class="form-control" id="Pelicula" name="Pelicula[]" multiple="multiple">
                    @if(isset($funcionesPeliculas) && !$funcionesPeliculas->isEmpty())

                        @foreach($Peliculas as $Pelicula)
                            @foreach($funcionesPeliculas as $funcionPelicula)
                                @if ($funcionPelicula->id== $Pelicula->id  )
                                    <option value="{{  $Pelicula->id }}" selected> {{ $Pelicula->titulo}} {{ $Pelicula->anio }}  </option>
                                    @break;
                                @elseif ($funcionPelicula == $ultimaPeli)
                                    <option value="{{  $Pelicula->id }}" > {{ $Pelicula->titulo}} {{ $Pelicula->anio }}  </option>
                                @endif
                            @endforeach
                        @endforeach

                    @else
                            @foreach($Peliculas as $Pelicula)
                            <option value="{{  $Pelicula->id }}" > {{ $Pelicula->titulo}} {{ $Pelicula->anio }}  </option>
                            @endforeach
                    @endif

                    </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.Programa')  }}</label>
            <div class="col-lg-10">


                <select class="form-control" id="Programa" name="Programa">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>
                    @if( isset($funcionesProgramas))
                        @foreach($Programas as $Programa)
                            @if($funcionesProgramas->id== $Programa->id )
                            <option value="{{  $Programa->id }}" selected> {{ $Programa->titulo}}</option>
                            @else
                            <option value="{{  $Programa->id }}" > {{ $Programa->titulo}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Programas as $Programa)
                            <option value="{{  $Programa->id }}" > {{ $Programa->titulo}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Festival')  }}</label>
            <div class="col-lg-10">
                <select class="form-control" id="Festival" name="Festival">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>
                    @if( isset($funcionesFestivales))
                        @foreach($Festivales as $Festival)
                            @if($funcionesFestivales->id== $Festival->id )
                            <option value="{{  $Festival->id }}" selected > {{ $Festival->titulo}}</option>
                            @else
                            <option value="{{  $Festival->id }}" > {{ $Festival->titulo}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Festivales as $Festival)
                            <option value="{{  $Festival->id }}" > {{ $Festival->titulo}}</option>
                        @endforeach
                    @endif



                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.Patrocinadores')  }}</label>
            <div class="col-lg-10">
                <select class="form-control" id="Patrocinador" name="Patrocinadores[]" multiple="multiple">
                    @if(isset($funcionesPatrocinadores) && !$funcionesPatrocinadores->isEmpty())

                        @foreach($Patrocinadores  as $Patrocinador)
                            @foreach($funcionesPatrocinadores as $funcionPatrocinadores )
                                @if($funcionPatrocinadores->id== $Patrocinador->id )
                                    <option value="{{  $Patrocinador->id }}" selected> {{ $Patrocinador->nombre}}</option>
                                    @break;
                                @elseif ( $funcionPatrocinadores == $ultimoPatrocinador )
                                    <option value="{{  $Patrocinador->id }}" > {{ $Patrocinador->nombre}} </option>
                                @endif
                            @endforeach
                        @endforeach

                        @else
                            @foreach($Patrocinadores as $Patrocinador)
                                <option value="{{  $Patrocinador->id }}" > {{ $Patrocinador->nombre}}</option>
                            @endforeach
                        @endif
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.programadoPor')  }}</label>
            <div class="col-lg-10">
                @if (isset($funcionesItem))
                 {!!Form::text('Programado' ,$funcionesItem->programadopor,['class'=>'form-control','placeholder'=>trans('validation.attributes.programadoPor')])!!}
                @else
                    {!!Form::text('Programado' ,null,['class'=>'form-control','placeholder'=>trans('validation.attributes.programadoPor')])!!}
                @endif

            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($funcionesItem))

            {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs', 'style'=>'width:20%', 'onclick'=>trans('validation.attributes.mensajeModificarFuncion')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs', 'style'=>'width:20%'])!!}
            @endif
        </div>

    </div>

</div>
