	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Polizas Activas / Vigentes</h1>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	  <a class="btn btn-outline-primary" href="/consultas/">Regresar</a>
		      <a class="btn btn-outline-success" href="/polizas2/export2/">Exporta Excel</a>

		    </li>
		</ul>

		<hr style="border:2px;">
		@include('poliza.search2')
		<table name="resultados" id="resultados" class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Id_Poliza</td>
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>Aseguradora</td>
					
					<td>Codigo_Contrato</td>
					<td>Nombre_Contrato</td>
					
					
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Vigecia_Hasta</td>
					<td>Dias_Restantes</td>
			</thead>
			<tbody>
				@foreach($polizas as $poliza)
				<tr>
					<td>{{$poliza->id}}</td>
					<td>{{$poliza->Codigo_Poliza}}</td>
					<td>USD${{$poliza->Valor_Poliza}}</td>
					<td>{{$poliza->Tipo_Poliza}}</td>
					<td>{{$poliza->Vigencia_Desde}}</td>
					<td>{{$poliza->Plazo}}</td>
					<td>{{$poliza->Razon_Social}}</td>
					<td>{{$poliza->Codigo_Contrato}}</td>
					<td>{{$poliza->Nombre_Contrato}}</td>
					<td>{{$poliza->Estado}}</td>
					<td>{{$poliza->Renovacion}}</td>
					<td>{{$poliza->Vigecia_Hasta}}</td>
					<td>{{$poliza->Dias_Restantes}}</td>
					

				</tr>
				@endforeach
				</tr>
			</tbody>
			</table>
			{{ $polizas -> appends(['searchText' => $query]) -> links() }}
@endsection
@section( "piepagina" ) @endsection