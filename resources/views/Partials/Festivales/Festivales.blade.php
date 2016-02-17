
<div class="row">
    <div class="col-md-5">


        <div class="form-group">
            <div class="col-lg-12">
                @if( isset($festivalesItem))
                    <input type="hidden" name="festivalId" value={{$festivalesItem->id}}>
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
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.Título')  }}</label>
            <div class="col-lg-10">

                @if( isset($festivalesItem))

                 {!!Form::text('Titulo' ,$festivalesItem->titulo,['class'=>'form-control','id'=>'Titulo','placeholder'=>trans('validation.attributes.tituloFestival')])!!}
                @else
                    {!!Form::text('Titulo' ,null,['class'=>'form-control','id'=>'Titulo','placeholder'=>trans('validation.attributes.tituloFestival')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.Patrocinadores')  }}</label>
            <div class="col-lg-10">
                <select class="form-control" id="Patrocinador" name="Patrocinadores[]" multiple="multiple">
                    @if(isset($festivalesPatrocinadores))

                        @foreach($Patrocinadores  as $Patrocinador)
                            @foreach($festivalesPatrocinadores as $festivalPatrocinadores )
                                @if($festivalPatrocinadores->id== $Patrocinador->id )
                                    <option value="{{  $Patrocinador->id }}" selected> {{ $Patrocinador->nombre}}</option>
                                    @break;
                                @elseif ( $festivalPatrocinadores == $ultimoPatrocinador )
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

        <div class="form-group" align="center">
            @if( isset($festivalesItem))
                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%','onclick'=>trans('validation.attributes.mensajeModificarFestival')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>




    </div>

