	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Aseguradoras</h1>
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
		      <a class="btn btn-outline-danger" href="aseguradora/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="aseguradoras/export/">Exporta Excel</a>

		    </li>
		</ul>
		<hr style="border:2px;">
		@include('aseguradora.search')
		<table class="table table-hover table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Opciones</td>
					<td>id</td>
					<td>Razon_Social</td>
					<td>Ruc</td>
					<td>created_at</td>
			</thead>
			<tbody>
				@foreach($aseguradoras as $aseguradora)
				<tr>
					<td>
						<a class="btn btn-outline-danger" href="{{route('aseguradora.edit',$aseguradora->id)}}" role="button">Editar</a>
					</td>
					<td>{{$aseguradora->id}}</td>
					<td>{{$aseguradora->Razon_Social}}</td>
					<td>{{$aseguradora->Ruc}}</td>
					<td>{{$aseguradora->created_at}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $aseguradoras -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection