
<div class="row">
    <div class="col-md-2">
        @if( isset($sedesItem))
        <input type="hidden" name="sedeID" value={{$sedesItem->id}}>
            @endif
    </div>

    <div class="col-md-8">
        <p align="left" class="help-block"> (*) {{ trans('validation.attributes.camposObligatorios')  }}</p><br>


        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.nombre')  }}</label>
            <div class="col-lg-10">

                @if( isset($sedesItem))

                    {!!Form::text('Descripcion' ,$sedesItem->descripcion,['class'=>'form-control','id'=>'Sede','placeholder'=>trans('validation.attributes.nombreSede')])!!}
                @else
                    {!!Form::text('Descripcion' ,null,['class'=>'form-control','id'=>'Sede','placeholder'=>trans('validation.attributes.nombreSede')])!!}
                @endif
            </div>
        </div>


        <div class="form-group" align="center">
            @if( isset($sedesItem))

                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top','style'=>'width:20%','onclick'=>trans('validation.attributes.mensajeModificarSede')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips','data-placement'=>'top', 'style'=>'width:20%'])!!}
            @endif
        </div>
    </div>


    </div>




    </div>

