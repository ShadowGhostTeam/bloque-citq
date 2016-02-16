
				<div class="panel-body">
                    @if( isset($preparacionSector))
                        {!! Form::open(['action'=>['preparacionSectorController@modificar'],'id' =>'formulario'])!!}
                        <input type="hidden" name="id" value={{$preparacionSector->id}}>
                    @else
                         {!! Form::open(['action'=>['preparacionSectorController@crear'],'id' =>'formulario'])!!}
                    @endif

						<div class="form-group">
                            <label>Sector</label>
                            <select class="form-control" id="sector" name="sector">
                                <option value="">Selecciona</option>

                                @if( isset($preparacionSector))

                                    @foreach($sectores as $sector)
                                        @if($preparacionSector->$id_sector== $sector->id)
                                            <option value="{{  $sector->id }}" selected> {{ $sector->nombre}}  </option>
                                        @else
                                            <option value="{{  $sector->id  }}" > {{ $sector->nombre}}  </option>
                                        @endif
                                    @endforeach

                                @else
                                    @foreach($sectores as $sector)
                                        <option value="{{  $sector->id  }}" > {{ $sector->nombre}}  </option>
                                    @endforeach

                                @endif
                            </select>
						</div>

						<div class="form-group">
                            <label>Maquinaria</label>
                            <select class="form-control" id="maquinaria" name="maquinaria">
                                <option value="">Selecciona</option>

                                @if( isset($preparacionSector))

                                    @foreach($maquinarias as $maquinaria)
                                        @if($preparacionSector->$id_maquinaria== $maquinaria->id)
                                            <option value="{{  $maquinaria->id }}" selected> {{ $maquinaria->nombre}}  </option>
                                        @else
                                            <option value="{{  $maquinaria->id  }}" > {{ $maquinaria->nombre}}  </option>
                                        @endif
                                    @endforeach

                                @else
                                    @foreach($maquinarias as $maquinaria)
                                        <option value="{{  $maquinaria->id  }}" > {{ $maquinaria->nombre}}  </option>
                                    @endforeach

                                @endif
                            </select>
						</div>

						<div class="form-group">
                            <label>Número de pasadas</label>
							{!! Form::number('numPasadas', null, ['class' => 'form-control']) !!}
						</div>

                        <div class="form-group">
                            <label>Fecha</label>
                            <br>
                            <div class="input-group date" id="fechaDP">
                                                 <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>

                                {!!Form::text('fecha' ,null,['class'=>'form-control','id'=>'fecha','placeholder'=>'dd/mm/yyyy'])!!}

                            </div>
                        </div>

                        <div class="form-group" align="center">
                            @if( isset($preparacionSector))
                                <button type="submit" class="btn btn-success">Modificar</button>
                            @else
                                <button type="submit" class="btn btn-success">Crear</button>
                            @endif
                        </div>
					{!! Form::close() !!}
				</div>