	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Afianzados</h1>
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

		      <a class="btn btn-outline-danger" href="afianzado/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="afianzados/export/">Exporta Excel</a>
		      <a class="btn btn-outline-success" href="afianzados/grafic/">Grafica</a>

		    </li>
		</ul>
		<hr style="border:2px;">
		@include('afianzado.search')
		<table class="table p-3 table-hover table-condensed">
			<thead>
				<tr class="table-primary">

					<td>id</td>
					<td>Afianzado</td>
					<td>Direccion</td>
					<td>Ruc</td>
					<td>E.Mail</td>
					<td>Opciones</td>


			</thead>
			<tbody>
				@foreach($afianzados as $afianzado)
				<tr>
					<td>{{$afianzado->id}}</td>
					<td>{{$afianzado->afianzado}}</td>
					<td>{{$afianzado->direccion}}</td>
					<td>{{$afianzado->ruc}}</td>
					<td>{{$afianzado->mail}}</td>
					<td>
						<a class="btn btn-outline-danger" href="{{route('afianzado.edit',$afianzado->id)}}" role="button">Editar</a>
					</td>
				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $afianzados -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection