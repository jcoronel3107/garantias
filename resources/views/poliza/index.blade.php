	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Polizas</h1>
		@if(Session::has('Importacion_Correcta'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Notificacion_Correcta')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Importacion_Correcta'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Importacion_Correcta')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Borrado'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{session('Registro_Borrado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Actualizado'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Registro_Actualizado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Almacenado'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
		{{session('Registro_Almacenado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-danger" href="poliza/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="polizas/export/">Exporta Excel</a>
		      <a class="btn btn-outline-success" href="polizas/grafic/">Grafica</a>
		    </li>
		</ul>
		<hr style="border:2px;">
		@include('poliza.search')
		<table class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Opciones</td>
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Fecha_Cierre</td>
			</thead>
			<tbody>
				@foreach($polizas as $poliza)
				<tr>
					<td>
						<a class="btn btn-outline-danger " href="{{route('poliza.edit',$poliza->id)}}" role="button"><i class="fa fa-pencil fa-fw"></i></a>

						<a class="btn btn-outline-danger" href="{{route('poliza.notificar',$poliza->id)}}" role="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
					</td>
					<td>{{$poliza->Codigo_Poliza}}</td>
					<td>USD${{$poliza->Valor_Poliza}}</td>
					<td>{{$poliza->Tipo_Poliza}}</td>
					<td>{{$poliza->Vigencia_Desde}}</td>
					<td>{{$poliza->Plazo}}</td>
					<td>{{$poliza->Estado}}</td>
					<td>{{$poliza->Renovacion}}</td>
					<td>{{$poliza->Fecha_Cierre}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $polizas -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection