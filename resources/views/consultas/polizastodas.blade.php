	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Polizas Registradas</h1>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-primary" href="/consultas/">Regresar</a>
		      <a class="btn btn-outline-success" href="/polizas3/export3/">Exporta Excel</a>

		    </li>
		</ul>
		<hr style="border:2px;">
		<form method="get" action="/consult/polizas3/" autocomplete="off" role="search" >
			<div class="form-group col-12">
				<div class="input-group "> {{csrf_field()}}
					<input type="text" class="form-control" value="{{$query}}" name="searchText" placeholder="Buscar x Administrador..." >
					<span class="input-group-append">
						<button type="submit" class="btn btn-primary">Buscar</button>
					</span>
				</div>

			</div>
		</form>
		<table name="resultados" id="resultados" class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>Aseguradora</td>
					<td>Afianzado</td>
					<td>contrato_id</td>
					<td>Contrato</td>
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Fecha_Cierre</td>
					<td>created_at</td>
			</thead>
			<tbody>
				@foreach($polizas as $poliza)
				<tr>

					<td>{{$poliza->Codigo_Poliza}}</td>
					<td>USD${{$poliza->Valor_Poliza}}</td>
					<td>{{$poliza->Tipo_Poliza}}</td>
					<td>{{$poliza->Vigencia_Desde}}</td>
					<td>{{$poliza->Plazo}}</td>
					<td>{{$poliza->Razon_Social}}</td>
					<td>{{$poliza->afianzado}}</td>
					<td>{{$poliza->contrato_id}}</td>
					<td>{{$poliza->Codigo_Contrato}}</td>
					<td>{{$poliza->Estado}}</td>
					<td>{{$poliza->Renovacion}}</td>
					<td>{{$poliza->Fecha_Cierre}}</td>
					<td>{{$poliza->created_at}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
			</table>
			{{ $polizas -> appends(['searchText' => $query]) -> links() }}
@endsection
@section( "piepagina" ) @endsection