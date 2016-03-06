

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
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>Correo</label>
            <div class="col-lg-10">

                @if( isset($usuario))

                    {!!Form::text('correo' ,$usuario->email,['class'=>'form-control','id'=>'email','placeholder'=>'Correo electrónico'])!!}
                @else
                    {!!Form::text('correo' ,null,['class'=>'form-control','id'=>'email','placeholder'=>'Correo electrónico'])!!}
                @endif
            </div>
        </div>
        @if( isset($usuario))
        @else
        <div class="form-group">
            <label for="Titulo" class="col-lg-2 control-label"><strong>*</strong>Contraseña</label>
            <div class="col-lg-10">

                    {!!Form::text('password' ,null,['class'=>'form-control','id'=>'password','placeholder'=>'Contraseña'])!!}

            </div>
        </div>
        @endif

        <div class="form-group">
            <label for="Sector" class="col-lg-2 control-label"><strong>*</strong>Tipo de usuario</label>
            <div class="col-lg-10">

                <select  class="form-control" id="tipoUsuario" name="tipoUsuario">
                    <option value="">Selecciona</option>

                    @if( isset($usuario))

                        @foreach($roles as $rol)
                            @if($usuarioRol->id == $rol->id)
                                <option value="{{  $rol->id  }}" selected > {{ $rol->name}}  </option>
                            @else
                                <option value="{{  $rol->id  }}" > {{ $rol->name}}  </option>
                            @endif
                        @endforeach
                    @else
                        @foreach($roles as $rol)
                            <option value="{{  $rol->id  }}" > {{ $rol->name}}  </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group" align="center">
            @if( isset($usuario))

            {!! Form::submit('Modificar',['class'=>'btn btn-success', 'onclick'=>"return confirm ('¿Seguro que desea modificar los datos del usuario?')"])!!}
            @else
                {!! Form::submit('Crear',['class'=>'btn btn-success'])!!}
            @endif
        </div>

    </div>

</div>
