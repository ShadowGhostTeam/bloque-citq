@extends('layout')
 
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			
		</div>
	</div>
	<div class="row">
        <br>
		<div class="col-md-4">
            <br>
			<!--<img src="/assets/Captura.PNG" style="width:375px; height:375px;">-->
			{{--foreach(sector--}}
			{{--@endforeach--}}
			<div class="grid">
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
			</div>
		</div>
		<div class="col-md-6" style="height:375px;">
			<br>

			<div class="panel panel-default">
				<div class="panel-heading">Nueva preparación de suelo</div>
                @include('Partials.Mensajes.mensajes')

                @include('Sector.Preparacion.Partials.partialForm')
			</div>
		</div>
	</div>
</div>

@include('Sector.Preparacion.Partials.scripts')
@endsection