
<div class="row">
    <div class="col-md-5">

        <div class="form-group">
            <div class="col-lg-12">
                @if( isset($peliculasItem))
                    <input type="hidden" name="peliculaId" value={{$peliculasItem->id}}>
                {!!  Form::file('image',['id'=>'imagenDocumentaQro','align'=>'center','type'=>'file','class'=>'img-responsive form-control file-loading'] )  !!}
                @else
                    {!!  Form::file('image',['id'=>'imagenDocumentaQro','align'=>'center','type'=>'file','class'=>'img-responsive form-control file-loading'] )  !!}
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <p align="left" class="help-block"> (*)  {{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong> {{ trans('validation.attributes.Título')  }}</label>
            <div class="col-lg-10">

                @if( isset($peliculasItem))

                 {!!Form::text('Titulo' ,$peliculasItem->titulo,['class'=>'form-control','id'=>'Título','placeholder'=> trans('validation.attributes.tituloPeliculaPlace')  ])!!}
                @else
                    {!!Form::text('Titulo' ,null,['class'=>'form-control','id'=>'Titulo','placeholder'=>trans('validation.attributes.tituloPeliculaPlace') ])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Director')  }}</label>
            <div class="col-lg-10">

                @if( isset($peliculasItem))

                    {!!Form::text('Director' ,$peliculasItem->director,['class'=>'form-control','id'=>'Director','placeholder'=>trans('validation.attributes.directorPeliculaPlace')])!!}
                @else
                    {!!Form::text('Director' ,null,['class'=>'form-control','id'=>'Director','placeholder'=>trans('validation.attributes.directorPeliculaPlace')])!!}
                @endif
            </div>
        </div>



        <div class="form-group">
            <label for="SedeS" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Pais')  }}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="Pais" name="Pais">
                    <option value="">{{ trans('validation.attributes.Selecciona')  }}</option>

                    @if( isset($peliculasItem))

                        @foreach($Paises as $Pais)
                            @if($peliculasItem->pais == $Pais)
                            <option value="{{  $Pais  }}" selected > {{ $Pais}}  </option>
                            @else
                            <option value="{{  $Pais  }}" > {{ $Pais}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Paises as $Pais)
                            <option value="{{  $Pais }}" > {{ $Pais}}  </option>
                        @endforeach
                    @endif
                    </select>
            </div>
        </div>




        <div class="form-group">
            <label for="AsistenciasS" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Anno')  }}</label>
            <div class="col-lg-10">
                @if( isset($peliculasItem))
                {!!Form::text('Anio' ,$peliculasItem->anio,['class'=>'form-control','id'=>'Anio','placeholder'=>trans('validation.attributes.annoPeliculaPlace') ])!!}
                @else
                    {!!Form::text('Anio' ,null,['class'=>'form-control','id'=>'Anio','placeholder'=>trans('validation.attributes.annoPeliculaPlace')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="AsistenciasS" class="col-lg-2 control-label"><strong>*</strong>{{trans('validation.attributes.Duracion')}}</label>
            <div class="col-lg-10">
                @if( isset($peliculasItem))
                    {!!Form::text('Duracion' ,$peliculasItem->duracion,['class'=>'form-control','id'=>'Duracion','placeholder'=>trans('validation.attributes.duracionPeliculaPlace')])!!}
                @else
                    {!!Form::text('Duracion' ,null,['class'=>'form-control','id'=>'Duracion','placeholder'=>trans('validation.attributes.duracionPeliculaPlace')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Subtitulos" class="col-lg-2 control-label"><strong>*</strong>{{trans('validation.attributes.Subtitulos')}}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="subtitulos" name="Subtitulos">
                    <option value="">{{trans('validation.attributes.Selecciona')}}</option>

                    @if( isset($peliculasItem))

                        @foreach($Subtitulos as $subtitulo)
                            @if($peliculasItem->subtitulos == $subtitulo)
                                <option value="{{  $subtitulo }}" selected > {{ $subtitulo}}  </option>
                            @else
                                <option value="{{  $subtitulo  }}" > {{ $subtitulo}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($Subtitulos as $subtitulo)
                            <option value="{{  $subtitulo }}" > {{ $subtitulo}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Subtitulos" class="col-lg-2 control-label"><strong>*</strong>{{trans('validation.attributes.Tipo')}}</label>
            <div class="col-lg-10">

                <select  class="form-control" id="Tipo" name="Tipo">
                    <option value="">{{trans('validation.attributes.Selecciona')}}</option>

                    @if( isset($peliculasItem))

                        @foreach($Tipos as $tipo)
                            @if($peliculasItem->tipo == $tipo)
                                <option value="{{  $tipo }}" selected > {{ $tipo}}  </option>
                            @else
                                <option value="{{  $tipo  }}" > {{ $tipo}}  </option>
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
            <label for="Titulo" class="col-lg-2 control-label">{{trans('validation.attributes.Trailer')}}</label>
            <div class="col-lg-10">

                @if( isset($peliculasItem))

                    {!!Form::text('Trailer' ,$peliculasItem->trailer,['class'=>'form-control','id'=>'Trailer','placeholder'=>trans('validation.attributes.trailerPeliculaPlace')])!!}
                @else
                    {!!Form::text('Trailer' ,null,['class'=>'form-control','id'=>'Trailer','placeholder'=>trans('validation.attributes.trailerPeliculaPlace')])!!}
                @endif
            </div>
        </div>
        @if( isset($peliculasItem)&&$peliculasItem->material!="")
            <div class="form-group">
                <label for="Titulo" class="col-lg-2 control-label">{{trans('validation.attributes.materialActual')}}</label>
                <div class="col-lg-10">
                    <br>

                        <a height="20px" href="{{asset($peliculasItem->material)}}"><strong>{{trans('validation.attributes.clickDescargar')}}</strong></a>

                </div>
            </div>

        @endif

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">  @if( isset($peliculasItem)&&$peliculasItem->material!=""){{trans('validation.attributes.reemplazarMaterial')}} @endif {{trans('validation.attributes.Material')}}</label>
            <div class="col-lg-10">

                    {!!  Form::file('material',['id'=>'material','align'=>'center','type'=>'file'] )  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{trans('validation.attributes.Sinopsis')}}</label>
            <div class="col-lg-10">

                @if( isset($peliculasItem))

                    {!!Form::textArea('Sinopsis' ,$peliculasItem->sinopsis,['class'=>'form-control','id'=>'Trailer','placeholder'=>trans('validation.attributes.sinopsisPeliculaPlace')])!!}
                @else
                    {!!Form::textArea('Sinopsis' ,null,['class'=>'form-control','id'=>'Trailer','placeholder'=>trans('validation.attributes.sinopsisPeliculaPlace')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{trans('validation.attributes.notas')}}</label>
            <div class="col-lg-10">

                @if( isset($peliculasItem))

                    {!!Form::textArea('Notas' ,$peliculasItem->notas,['class'=>'form-control','id'=>'Notas','placeholder'=>trans('validation.attributes.placeNotas')])!!}
                @else
                    {!!Form::textArea('Notas' ,null,['class'=>'form-control','id'=>'Notas','placeholder'=>trans('validation.attributes.placeNotas')])!!}
                @endif
            </div>
        </div>



        <div class="form-group" align="center">
            @if( isset($peliculasItem))

                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top','style'=>'width:20%','onclick'=>'return confirm ("¿Seguro que desea modificar la película?")'])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>




    </div>

