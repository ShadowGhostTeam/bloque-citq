
<div class="row">
    <div class="col-md-2">
        @if( isset($caracteristicasItem))
        <input type="hidden" name="caracteristicasID" value={{$caracteristicasItem->id}}>
            @endif
    </div>

    <div class="col-md-7">
        <p align="left" class="help-block"> (*){{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.caracteristica')  }}</label>
            <div class="col-lg-10">

                @if( isset($caracteristicasItem))

                    {!!Form::text('Nombre' ,$caracteristicasItem->nombre,['class'=>'form-control','id'=>'Caracteristica','placeholder'=>trans('validation.attributes.caracteristicaPaquete')])!!}
                @else
                    {!!Form::text('Nombre' ,null,['class'=>'form-control','id'=>'Caracteristica','placeholder'=>trans('validation.attributes.caracteristicaPaquete')])!!}
                @endif
            </div>
        </div>



        <div class="form-group" align="center">
            @if( isset($caracteristicasItem))

                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips', 'style'=>'width:20%','onclick'=>trans('validation.attributes.mensajeModificarCaracteristica')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>




    </div>

