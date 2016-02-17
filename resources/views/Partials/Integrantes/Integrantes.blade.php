
<div class="row">
    <div class="col-md-2">
        @if( isset($integrantesItem))
        <input type="hidden" name="integrantesID" value={{$integrantesItem->id}}>
            @endif
    </div>

    <div class="col-md-7">
        <p align="left" class="help-block"> (*) {{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.nombre')  }}</label>
            <div class="col-lg-10">

                @if( isset($integrantesItem))

                    {!!Form::text('Nombre' ,$integrantesItem->nombre,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombreIntegrante')])!!}
                @else
                    {!!Form::text('Nombre' ,null,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombreIntegrante')])!!}
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{ trans('validation.attributes.telefono')  }}</label>
            <div class="col-lg-10">

                @if( isset($integrantesItem))

                    {!!Form::text('Telefono' ,$integrantesItem->telefono,['class'=>'form-control','id'=>'Telefono','placeholder'=>trans('validation.attributes.telefono')])!!}
                @else
                    {!!Form::text('Telefono' ,null,['class'=>'form-control','id'=>'Telefono','placeholder'=>trans('validation.attributes.telefono')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{ trans('validation.attributes.puesto')  }}</label>
            <div class="col-lg-10">

                @if( isset($integrantesItem))

                    {!!Form::text('Puesto' ,$integrantesItem->puesto,['class'=>'form-control','id'=>'Puesto','placeholder'=>trans('validation.attributes.puesto')])!!}
                @else
                    {!!Form::text('Puesto' ,null,['class'=>'form-control','id'=>'Puesto','placeholder'=>trans('validation.attributes.puesto')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label">{{ trans('validation.attributes.e-mail')  }}</label>
            <div class="col-lg-10">

                @if( isset($integrantesItem))

                    {!!Form::text('Email' ,$integrantesItem->email,['class'=>'form-control','id'=>'Email','placeholder'=>trans('validation.attributes.e-mail')])!!}
                @else
                    {!!Form::text('Email' ,null,['class'=>'form-control','id'=>'Email','placeholder'=>trans('validation.attributes.e-mail')])!!}
                @endif
            </div>
        </div>


        <div class="form-group" align="center">
            @if( isset($integrantesItem))

                {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs tooltips', 'style'=>'width:20%','onclick'=>trans('validation.attributes.mensajeModificarIntegrante')])!!}
            @else
                {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs tooltips', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>




    </div>

