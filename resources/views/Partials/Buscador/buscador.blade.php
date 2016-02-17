

<div class="col-lg-14">
    <div class="input-group">


        <span class="input-group-btn">
                       {!! Form::submit(trans('validation.attributes.buscar') ,['class'=>'btn btn-default']) !!}
                </span>


        {!! Form::text('buscador', null, ['class' => 'form-control','placeholder'=>trans('validation.attributes.buscar')  ]) !!}

    </div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
