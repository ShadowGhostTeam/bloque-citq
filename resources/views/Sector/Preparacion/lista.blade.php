@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="height:375px;">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Preparación de suelo</div>
                    <div class="panel-body">
                        <p>
                            <a class="btn btn-success" href="{{route('preparacion.create')}}" role="button">Nueva preparación</a>
                        </p>
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Sector</th>
                                <th>Fecha</th>
                                <th>Maquinaria</th>
                                <th>Pasadas</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach($preparaciones as $preparacion)
                            <tr>
                                <td>{{ $preparacion->id_sector }}</td>
                                <td>{{ $preparacion->id_sector }}</td>
                                <td>{{ $preparacion->fecha }}</td>
                                <td>{{ $preparacion->id_maquinaria }}</td>
                                <td>{{ $preparacion->numPasadas }}</td>
                                <td>
                                    <a class="btn btn-success" href="" role="button">Edit</a>|
                                    <a class="btn btn-danger" href="" role="button">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {!! $preparacion->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection