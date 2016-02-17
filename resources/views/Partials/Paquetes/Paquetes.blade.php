
<div class="row">
    @if( isset($PaquetesItem))
        <input type="hidden" name="paquetes_id" value={{$PaquetesItem->id}}>
    @endif

    <div class="col-md-2"></div>

    <div class="col-md-8">
        <p align="left" class="help-block"> (*) {{ trans('validation.attributes.camposObligatorios')  }}</p><br>
        <div class="form-group">
            <label for="Descripcion" class="col-lg-2 control-label"><strong>*</strong>{{ trans('validation.attributes.nombre')  }}</label>
            <div class="col-lg-10">

                @if( isset($PaquetesItem))
                    {!!Form::text('Nombre' ,$PaquetesItem->descripcion,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombrePaquete')])!!}
                @else
                    {!!Form::text('Nombre' ,null,['class'=>'form-control','id'=>'Nombre','placeholder'=>trans('validation.attributes.nombrePaquete')])!!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="Costo" class="col-lg-2 control-label">{{ trans('validation.attributes.costo')  }}</label>
            <div class="col-lg-10">
                <div class="input-group">
                    <div class="input-group-addon">$</div>
                @if( isset($PaquetesItem))
                {!!Form::text('Costo' ,$PaquetesItem->costo,['class'=>'form-control','id'=>'Costo'])!!}
                @else
                {!!Form::text('Costo' ,null,['class'=>'form-control','id'=>'Costo'])!!}
                @endif
                 </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.Caracteristicas')  }}</label>
             <div class="col-lg-10">
                <select class="form-control" id="Caracteristica" name="Caracteristicas[]" multiple="multiple">
                    @if(isset($PaquetesCaracteristicas) && !$PaquetesCaracteristicas->isEmpty())

                    @foreach($Caracteristicas  as $Caracteristica)
                     @foreach($PaquetesCaracteristicas as $PaqueteCaracteristica )
                      @if($PaqueteCaracteristica->id== $Caracteristica->id )
                       <option value="{{  $Caracteristica->id }}" selected> {{ $Caracteristica->nombre}}</option>
                      @break;
                      @elseif ( $PaqueteCaracteristica == $ultimaCaracteristica )
                       <option value="{{  $Caracteristica->id }}" > {{ $Caracteristica->nombre}} </option>
                     @endif
                     @endforeach
                    @endforeach

                    @else
                    @foreach($Caracteristicas  as $Caracteristica)
                    <option value="{{  $Caracteristica->id }}" > {{ $Caracteristica->nombre}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($PaquetesItem))
            {!! Form::submit(trans('validation.attributes.modificar'),['class'=>'btn btn-success btn-xs', 'style'=>'width:20%', 'onclick'=>trans('validation.attributes.mensajeModificarPaquete')])!!}
            @else
            {!! Form::submit(trans('validation.attributes.agregar'),['class'=>'btn btn-success btn-xs', 'style'=>'width:20%'])!!}
            @endif
        </div>


    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#Caracteristica').multiselect({
            enableCaseInsensitiveFiltering: true,
            maxHeight: '300',
            enableFiltering: true,
            buttonWidth: '100%'
        });
    });
</script>

