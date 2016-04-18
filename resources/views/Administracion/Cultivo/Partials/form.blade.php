

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
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>Nombre</label>
            <div class="col-lg-10">

                @if( isset($cultivo))

                    {!!Form::text('nombre' ,$cultivo->nombre,['class'=>'form-control','id'=>'nombre','placeholder'=>'Nombre'])!!}
                @else
                    {!!Form::text('nombre' ,null,['class'=>'form-control','id'=>'nombre','placeholder'=>'Nombre'])!!}
                @endif
            </div>
        </div>



        <div class="form-group">
            <label for="Descripcion" class="col-lg-2 control-label">Descripción</label>
            <div class="col-lg-10">
                @if( isset($cultivo))
                    {!!Form::text('descripcion' ,$cultivo->descripcion,['class'=>'form-control','id'=>'descripcion','placeholder'=>'Aquí puedes incluir una descripción.'])!!}
                @else
                    {!!Form::text('descripcion' ,null,['class'=>'form-control','id'=>'comentario','placeholder'=>'Aquí puedes incluir una descripción.'])!!}
                @endif
            </div>
        </div>



        <div class="form-group" align="center">
            @if( isset($cultivo))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar este cultivo?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
