	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Contratos</h1>
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
		      <a class="btn btn-outline-danger" href="contrato/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="contratos/export/">Exporta Excel</a>
		      <a class="btn btn-outline-success" href="contratos/grafic/">Grafica</a>
		    </li>
		</ul>
		<hr style="border:2px;">
		@include('contrato.search')
		<table class="table p-3 table-hover table-responsive table-condensed">
			<thead>
				<tr class="table-primary">
					<td>Opciones</td>
					<td>id</td>
					<td>Codigo_Contrato</td>
					<td>Nombre_Contrato</td>
					<td>Afianzado_id</td>
					<td>Administrador</td>
					<td>Mail_Administrador</td>
					<td>Numero_Partida</td>
					<td>Nombre_Partida</td>
					<td>Observaciones</td>
					<td>Plazo_Contrato</td>
			</thead>
			<tbody>
				@foreach($contratos as $contrato)
				<tr>
					<td>
						<a class="btn btn-outline-danger" href="{{route('contrato.edit',$contrato->id)}}" role="button">Editar</a>
					</td>
					<td>{{$contrato->id}}</td>
					<td>{{$contrato->Codigo_Contrato}}</td>
					<td>{{$contrato->Nombre_Contrato}}</td>
					<td>{{$contrato->afianzado_id}}</td>
					<td>{{$contrato->administrador}}.USD</td>
					<td>{{$contrato->mail_administrador}}</td>
					<td>{{$contrato->Numero_Partida}}</td>
					<td>{{$contrato->Nombre_Partida}}</td>
					<td>{{$contrato->Observaciones}}</td>
					<td>{{$contrato->Plazo_Contrato}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $contratos -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection